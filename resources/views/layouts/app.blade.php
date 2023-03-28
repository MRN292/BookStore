{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')

        <!-- Page Heading -->
        
        @yield('header')

        <!-- Page Content -->

        @yield('content')

     
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Shop</a>

        <a href="{{ route('profile.edit') }}">Profile</a>

        <a href="{{ route('show.user') }}">Users</a>

        <a href="#">Books</a>
        <a href="#">Tags and Genre</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>

    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776; Dashboard</button>
        @if (Auth::user()->photo == null)
        <img class="user-img" src="img/user.png" alt="">
        @else
            <img class="user-img" src="uploads/{{ Auth::user()->photo }}" alt="">
        @endif
        <span class="user-name">@Auth{{ Auth::user()->name }}@endauth
        </span>

    </div>


    @yield('content')



    <script src="js/main.js"></script>

</body>

</html>
