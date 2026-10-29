<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir - BPBD Kabupaten Bandung')</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #0d47a1;
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header h1 {
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }
        header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        nav {
            background-color: #1565c0;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        nav a:hover {
            background-color: #0d47a1;
        }
        .nav-button {
            color: white;
            background: transparent;
            border: 0;
            font-size: 1rem;
            font-weight: 500;
            padding: 6px 16px;
            cursor: pointer;
        }
        .nav-button:hover {
            background-color: #0d47a1;
        }
        main {
            flex: 1;
            max-width: 900px;
            width: 90%;
            margin: 30px auto;
        }
        .alert-card {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
        .btn-submit {
            background-color: #0d47a1;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #1565c0;
        }
        .card {
            background: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 6px solid #ccc;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: bold;
            color: white;
        }
        .bg-waspada { background-color: #ffc107; color: #333; border-left-color: #ffc107 !important; }
        .bg-siaga { background-color: #fd7e14; border-left-color: #fd7e14 !important; }
        .bg-awas { background-color: #dc3545; border-left-color: #dc3545 !important; }
        footer {
            background-color: #212529;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <header>
        <h1>BPBD KABUPATEN BANDUNG</h1>
        <p>Sistem Pelaporan Bencana Banjir "LaporBanjir"</p>
    </header>

    <nav>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
        @auth
            <a href="{{ route('laporan.create') }}">Buat Laporan</a>
            <a href="{{ route('laporan.index') }}">Daftar Laporan</a>
            <a href="{{ route('petugas.profile') }}">Profil Petugas</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-button">Logout</button>
            </form>
        @endauth
    </nav>

    <main>
        @if (session('success'))
            <div class="alert-card">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bandung.</p>
    </footer>

</body>
</html>