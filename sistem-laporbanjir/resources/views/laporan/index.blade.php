@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px; margin: 30px auto; padding: 0 15px;">
    <h2 style="margin-bottom: 20px; color: #0d47a1;">Lihat Laporan Banjir Terkini</h2>

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px 20px; border-radius: 6px; border: 1px solid #c3e6cb; margin-bottom: 20px; font-weight: bold;">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- List Data Laporan --}}
    @forelse($daftarLaporan as $laporan)
        @include('partials.laporan-card', ['laporan' => $laporan])
    @empty
        <div class="card" style="padding: 20px; background: #fff; border-radius: 8px;">
            <p style="margin: 0;">Belum ada laporan bencana banjir yang diterima saat ini.</p>
        </div>
    @endforelse
</div>
@endsection