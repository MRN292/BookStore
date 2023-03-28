<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/tailwind.css">
    <title>Document</title>
</head>

<body>

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                {{-- @extends('layouts.app') --}}
                @include('layouts.app')
                @section('content')
                    <div class="container">
                        store
                    </div>
                @endsection
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif


</body>

</html>
