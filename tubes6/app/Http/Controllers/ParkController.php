<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ParkController extends Controller
{
    // Halaman Dashboard
    public function dashboard()
    {
        $totalReservasi = Reservasi::count();
        $totalKategori = Kategori::count();
        $reservasiTerbaru = Reservasi::with('kategori')->latest()->take(5)->get();

        return view('dashboard', compact('totalReservasi', 'totalKategori', 'reservasiTerbaru'));
    }

    // Halaman Form Reservasi
    public function reservasi()
    {
        $kategoriList = Kategori::all();
        return view('reservasi.index', compact('kategoriList'));
    }

    // Memproses data formulir reservasi
    public function storeReservasi(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna'     => 'nullable|string|max:255',
            'nama'              => 'nullable|string|max:255',
            'nomor_plat'        => 'nullable|string|max:50',
            'plat_nomor'        => 'nullable|string|max:50',
            'kategori_id'       => 'nullable|exists:kategori,id',
            'tanggal_reservasi' => 'nullable|date',
            'durasi_jam'        => 'nullable|integer|min:1',
        ]);

        $nama = $request->input('nama_pengguna') ?: $request->input('nama', 'Pengguna');
        $plat = $request->input('nomor_plat') ?: $request->input('plat_nomor', 'D 1234 XX');
        $kategoriId = $request->input('kategori_id') ?: (Kategori::first()->id ?? null);
        $tanggal = $request->input('tanggal_reservasi') ?: now()->toDateString();
        $durasi = $request->input('durasi_jam') ?: 2;

        Reservasi::create([
            'kategori_id'       => $kategoriId,
            'nama_pengguna'     => $nama,
            'nomor_plat'        => $plat,
            'tanggal_reservasi' => $tanggal,
            'durasi_jam'        => $durasi,
            'status'            => 'pending',
        ]);

        return redirect()->route('denda.index')->with('success', 'Reservasi berhasil disimpan ke database!');
    }

    // Halaman Data Pelanggaran / Reservasi (Verifikasi data model Eloquent)
    public function denda()
    {
        $denda = Reservasi::with('kategori')->latest()->get();
        return view('denda.index', compact('denda'));
    }
}