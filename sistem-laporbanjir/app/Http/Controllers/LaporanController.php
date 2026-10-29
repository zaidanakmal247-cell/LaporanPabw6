<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan terbaru di atas
    public function index()
    {
        $daftarLaporan = Laporan::latest()->get();
        return view('laporan.index', compact('daftarLaporan'));
    }

    // Menampilkan form laporan
    public function create()
    {
        return view('laporan.form');
    }

    // Menyimpan data laporan baru dari form ke MySQL
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_pelapor'     => 'required|string|max:255',
            'lokasi'           => 'required|string|max:255',
            'tinggi_genangan'  => 'required|numeric|min:1',
            'tanggal_kejadian' => 'required|date',
        ]);

        // 2. Simpan ke database MySQL
        Laporan::create($validated);

        $destination = Auth::check() ? 'laporan.index' : 'laporan.create';

        return redirect()->route($destination)->with('success', 'Laporan berhasil dikirim dan tersimpan di sistem!');
    }
}