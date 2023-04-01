@extends('layouts.app')

@section('content')
    <div class="p-8">
        <div class="max-w-md mx-auto bg-gray-700 p-6 rounded-md shadow-md">
            <h1 class="text-2xl font-bold text-white mb-4">Edit Profile</h1>

            <form method="POST" action="{{ route('name-edit.user') }}">
                @csrf

                {{-- change name --}}
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="name">Name</label>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                        id="name" type="text" name="name"
                        value="@php if(isset($name)){echo $name;}else{echo $user->name;} @endphp">
                    @isset($name_massage)
                        <p class="text-red-500 text-sm mt-2">{{ $name_massage }}</p>
                    @endisset
                </div>
                <button
                    class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline mt-3 mb-3"
                    type="submit">Save</button>
            </form>


            <form method="POST" action="{{ route('pass-edit.user') }}">
                @csrf
                {{-- change pass button --}}
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="password">Password</label>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input
                        class="appearance-none  border rounded w-full py-21 px-3 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                        id="password" type="password" name="password">
                    @isset($pass_massage)
                        <p class="text-red-500 text-sm mt-2">{{ $pass_massage }}</p>
                    @endisset
                </div>


                <button class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded" type="submit">Change
                    Password</button>
                @isset($massage)
                    <p class="text-green-500 text-sm mt-2">{{ $massage }}</p>
                @endisset
            </form>

            {{-- go back --}}
            <div class="mt-10">
                <a class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded mt-3"
                    href="{{ route('show.user') }}">Done</a>
            </div>
        </div>
    </div>
@endsection
