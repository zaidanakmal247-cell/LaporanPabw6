@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 600px; margin: 30px auto; padding: 25px; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div class="card-header" style="margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
        <h2 style="color: #0d47a1; margin-bottom: 5px;">Form Pelaporan Banjir</h2>
        <p style="color: #666; font-size: 14px;">BPBD Kabupaten Bandung</p>
    </div>

    @if ($errors->any())
        <div class="alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 6px; border: 1px solid #f5c6cb; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lapor.kirim') }}" method="POST" onsubmit="return konfirmasiKirim()">
        @csrf
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="nama_pelapor" style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Pelapor</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Masukkan nama lengkap Anda" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="lokasi" style="display: block; font-weight: bold; margin-bottom: 5px;">Lokasi Kejadian (Kecamatan/Desa)</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Dayeuhkolot / Desa Cangkuang" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="tinggi_genangan" style="display: block; font-weight: bold; margin-bottom: 5px;">Tinggi Genangan Air (cm)</label>
            <input type="number" id="tinggi_genangan" name="tinggi_genangan" value="{{ old('tinggi_genangan') }}" placeholder="Contoh: 50" required min="1" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="tanggal_kejadian" style="display: block; font-weight: bold; margin-bottom: 5px;">Tanggal Kejadian</label>
            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', date('Y-m-d')) }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" class="btn" style="width: 100%; background-color: #0d47a1; color: white; padding: 12px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Kirim Laporan</button>
    </form>
</div>

<script>
    function konfirmasiKirim() {
        return confirm("Apakah data laporan banjir yang Anda masukkan sudah benar?");
    }
</script>
@endsection