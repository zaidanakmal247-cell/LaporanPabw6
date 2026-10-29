@extends('layouts.app')

@section('title', 'Daftar Reservasi & Parkir')

@section('content')
<div class="container my-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Daftar Data Reservasi Parkir</h2>
            <p class="text-muted">Data ini diambil langsung dari database MySQL melalui Model Eloquent (Reservasi & Kategori).</p>
        </div>
        <a href="{{ route('reservasi.index') }}" class="btn btn-primary">+ Tambah Reservasi</a>
    </div>

    @include('pemberitahuan.alert')

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Nama Pengguna</th>
                            <th>Nomor Plat</th>
                            <th>Kategori Parkir</th>
                            <th>Tanggal Reservasi</th>
                            <th>Durasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($denda as $index => $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $item->nama_pengguna }}</td>
                                <td><span class="badge bg-dark font-monospace">{{ $item->nomor_plat }}</span></td>
                                <td>
                                    <span class="badge {{ ($item->kategori->nama_kategori ?? '') == 'Parkir VIP' ? 'bg-primary' : 'bg-info text-dark' }}">
                                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->durasi_jam }} Jam</td>
                                <td>
                                    @if($item->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge bg-secondary">Selesai</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data reservasi atau denda yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection