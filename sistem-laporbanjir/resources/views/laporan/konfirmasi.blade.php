@extends('layouts.app')

@section('title', 'Konfirmasi Laporan - BPBD')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
    
    {{-- Memanggil komponen Blade alert-success --}}
    <x-alert-success>
        Laporan kejadian banjir Anda telah berhasil terkirim dan tercatat di sistem BPBD Kabupaten Bandung.
    </x-alert-success>

    <h3 style="margin-top: 20px; margin-bottom: 15px; color: #0d47a1;">Rincian Data yang Dikirim:</h3>

    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #e9ecef;">
        <p style="margin-bottom: 8px;"><strong>Nama Pelapor:</strong> {{ $laporan['nama_pelapor'] }}</p>
        <p style="margin-bottom: 8px;"><strong>Lokasi Kejadian:</strong> {{ $laporan['lokasi'] }}</p>
        <p style="margin-bottom: 8px;"><strong>Tinggi Genangan Air:</strong> {{ $laporan['tinggi_air'] }} cm</p>
    </div>

    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <a href="{{ route('laporan.index') }}" style="display: inline-block; padding: 10px 15px; background-color: #1565c0; color: white; text-decoration: none; border-radius: 4px;">Lihat Semua Laporan</a>
        <a href="{{ route('laporan.create') }}" style="display: inline-block; padding: 10px 15px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Kirim Laporan Lain</a>
    </div>
</div>
@endsection