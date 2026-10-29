@extends('layouts.app')

@section('title', 'Register Petugas - LaporBanjir')

@section('content')
<div class="card" style="max-width: 600px; margin: 30px auto; padding: 25px;">
    <h2 style="color: #0d47a1; margin-bottom: 20px;">Register Akun Petugas</h2>

    @if ($errors->any())
        <div class="alert-card" style="background: #f8d7da; color: #721c24; border-color: #f5c6cb;">
            <ul style="padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
        <div class="form-group">
            <label for="password">Password (minimal 8 karakter)</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn-submit">Buat Akun</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login di sini</a>
    </p>
</div>
@endsection
