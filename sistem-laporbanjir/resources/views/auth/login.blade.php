@extends('layouts.app')

@section('title', 'Login Petugas - LaporBanjir')

@section('content')
<div class="card" style="max-width: 600px; margin: 30px auto; padding: 25px;">
    <h2 style="color: #0d47a1; margin-bottom: 20px;">Login Petugas</h2>

    @if ($errors->any())
        <div class="alert-card" style="background: #f8d7da; color: #721c24; border-color: #f5c6cb;">
            <ul style="padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn-submit">Login</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
        Belum punya akun?
        <a href="{{ route('register') }}">Register di sini</a>
    </p>
    <p style="margin-top: 12px; text-align: center;">
        Warga dapat <a href="{{ route('laporan.create') }}">membuat laporan tanpa login</a>.
    </p>
</div>
@endsection
