@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($books as $book)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <img src="/Books/{{ $book->photo }}" alt="{{ $book->name }}" class="h-64 w-full object-contain rounded">
                    <div class="mt-4">
                        <h2 class="text-lg font-medium text-gray-900">{{ $book->name }}</h2>
                        <p class="text-gray-600">{{ $book->author }}</p>
                        <p class="text-gray-600">${{ $book->price }}</p>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4 hover:bg-blue-700">Add to
                                cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


{{-- {{ route('cart.add', $book->id) }} --}}
