@extends('layouts.app')

@section('content')


@section('content')
    @if (session('success'))
        <center>
            <span class='inline-block p-4 text-white font-bold bg-yellow-400 rounded mt-4'>{{ session('success') }}</span>
        </center>
    @endif

    <form action="{{ route('search.sort') }}" method="get">
        @csrf
        <div class="flex">
            <div class="search">
                <button class="bg-gray-800 hover:bg-gray-700 text-white p-2 rounded" type="submit">search</button>
                <input class=" w-75 rounded border-0" placeholder="search users name" type="text" name="search"
                    value="@isset($search)
                {{ $search }}
            @endisset" />
            </div>

            <div class="sort flex">
                <select onchange=' this.form.submit();' name="sort" class="sort_box sort-box rounded  border-0">
                    <option value="Oldest"
                        @isset($sort)
                    @if ($sort == 'Oldest')
                        selected
                    @endif
                @endisset>
                        Oldest</option>
                    <option value="Newest"
                        @isset($sort)
                @if ($sort == 'Newest')
                    selected
                @endif
            @endisset>
                        Newest</option>
                </select>
            </div>
        </div>
    </form>


    <div class="table_div">

        <table class=' mt-4'>

            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Pages</th>
                    <th>Available</th>
                    <th>Created by</th>
                    <th>Opration</th>
                </tr>
            </thead>
            <tbody>
                @empty($books)
                    <tr>
                        <td colspan="5">No book found</td>
                    </tr>
                @else
                    @foreach ($books as $book)
                        {{-- @if ($book->deleted_at == null) --}}
                        <tr>
                            {{-- book photo --}}
                            <td>
                                @isset($book->photo)
                                    <img class="user-img" src="{{ asset('Books/' . $book->photo) }}" alt="">
                                @else
                                    <img class="user-img" src="{{ asset('img/book-null.png') }}" alt="">
                                @endisset
                            </td>

                            <td>{{ $book->name }}</td>

                            <td>{{ $book->author }} </td>

                            <td>
                                <div class="description">
                                    {{ $book->description }}
                                </div>

                            </td>

                            <td>{{ $book->price }} </td>

                            <td>{{ $book->pages }} </td>

                            <td>{{ $book->available }} </td>

                            <td>{{ $book->created_by }} </td>

                            <td>

                                <div class="operation">

                                    {{-- edit button --}}
                                    <form action="{{ route('show_edit.books') }}" method="get">
                                        @csrf
                                        <button name="edit" type="submit" class="user_button"
                                            value="{{ $book->id }}">edit</button>
                                    </form>

                                    {{-- delete button --}}
                                    <form action="{{route('delete.books')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button name="delete" type="submit" class="user_button"
                                            value="{{ $book->id }}">Delete</button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                        {{-- @endif --}}
                    @endforeach
                @endempty

            </tbody>
        </table>
    </div>

@endsection


{{-- {{ route('cart.add', $book->id) }} --}}
