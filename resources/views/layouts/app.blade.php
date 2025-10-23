<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <ul style="list-style: none; display: flex; gap: 15px; align-items: center; padding: 0;">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/books') }}">Books</a></li>
                <li><a href="{{ url('/authors') }}">Authors</a></li>

                {{-- Push auth section to the right --}}
                <li style="margin-left:auto;"></li>

                {{-- Authentication Links --}}
                @if(Auth::check())
                    <li>Welcome, {{ Auth::user()->name }}!</li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Dewey and Krisna Library</p>
    </footer>
</body>
</html>
