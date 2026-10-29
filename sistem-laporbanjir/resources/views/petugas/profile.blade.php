@extends('layouts.app')

@section('title', 'Profil Petugas - LaporBanjir')

@section('content')
<div class="card" style="max-width: 600px; margin: 30px auto; padding: 25px;">
    <h2 style="color: #0d47a1; margin-bottom: 20px;">Profil Petugas</h2>
    <p style="margin-bottom: 12px;"><strong>Nama:</strong> {{ $petugas->name }}</p>
    <p style="margin-bottom: 12px;"><strong>Email:</strong> {{ $petugas->email }}</p>
    <p><strong>Akun dibuat:</strong> {{ $petugas->created_at->format('d-m-Y H:i:s') }}</p>
</div>
@endsection
