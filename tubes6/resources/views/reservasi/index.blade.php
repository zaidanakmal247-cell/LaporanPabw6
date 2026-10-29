@extends('layouts.app')

@section('title', 'Reservasi Parkir')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 fw-bold">Form Reservasi Tempat Parkir</h4>
    </div>
    <div class="card-body">
        
        {{-- Panggil partial alert di sini --}}
        @include('pemberitahuan.alert')

        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama_pengguna" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
                <label for="plat" class="form-label">Nomor Plat Kendaraan</label>
                <input type="text" class="form-control" id="plat" name="nomor_plat" placeholder="Contoh: D 1234 ABC" required>
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori / Area Parkir</label>
                <select class="form-select" id="kategori_id" name="kategori_id" required>
                    <option value="">-- Pilih Kategori Parkir --</option>
                    @if(isset($kategoriList) && $kategoriList->count() > 0)
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }} ({{ $kat->deskripsi }})</option>
                        @endforeach
                    @else
                        <option value="1">Parkir VIP</option>
                        <option value="2">Parkir Reguler</option>
                    @endif
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
                    <input type="date" class="form-control" id="tanggal_reservasi" name="tanggal_reservasi" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="durasi_jam" class="form-label">Durasi Parkir (Jam)</label>
                    <input type="number" class="form-control" id="durasi_jam" name="durasi_jam" value="2" min="1" max="24" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Reservasi Sekarang</button>
        </form>
    </div>
</div>
@endsection