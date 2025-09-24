<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProgramQuest</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Dark Theme */
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        a {
            color: #66aaff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .navbar {
            background-color: #1e1e1e;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .brand {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }
        .navbar .menu a {
            margin-left: 15px;
            color: #ccc;
            font-size: 14px;
        }
        .navbar .menu a:hover {
            color: #fff;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #1e1e1e;
            border-radius: 8px;
        }
        .flash {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .flash-success {
            background: #006633;
            color: #fff;
        }
        .flash-error {
            background: #990000;
            color: #fff;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <div class="navbar">
        <div class="brand">
            <a href="{{ url('/') }}">ProgramQuest</a>
        </div>
        <div class="menu">
            <a href="{{ route('questions.index') }}">Home</a>
            @auth
                <a href="{{ route('questions.create') }}">Buat Pertanyaan</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout ({{ Auth::user()->name }})
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    {{-- Flash message --}}
    <div class="container">
        @if(session('success'))
            <div class="flash flash-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Main Content --}}
        @yield('content')
    </div>
</body>
</html>
