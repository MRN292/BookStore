<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/multi-select-tag.css') }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        @Auth

            <a href="/">Shop</a>

            <a href="{{ route('profile.edit') }}">Profile</a>


            <a href="{{ route('show.user') }}">Users</a>

            <a href="{{ route('add_book') }}">New Book</a>
            <a href="{{ route('show.books')}}">Books</a>
            <a href="{{ route('tags_and_genres') }}">Tags and Genre</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>


        @endauth


    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776;</button>
        @auth
            @if (Auth::user()->photo == null)
                <img class="user-img" src="{{ asset('img/user.png') }}" alt="">
            @else
                <img class="user-img" src="{{ asset('uploads/' . Auth::user()->photo) }}" alt="">
            @endif
            <span class="user-name">{{ Auth::user()->name }}</span>
            <a class="cart-img" href="{{route('show.cart')}}"><img src="{{ asset('img/cart.png') }}" alt=""></a>
        @else
            <img class="user-img" src="{{ asset('img/user.png') }}" alt="">
            <a href="{{ route('login') }}">Login</a>
        @endauth



    </div>


    @yield('content')


    <script src="{{ asset('js/multi-select-tag.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


</body>

</html>
