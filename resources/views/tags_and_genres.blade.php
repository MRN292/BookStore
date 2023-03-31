@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class=" p-4 sm:p-8 bg-white shadow  sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Tag') }}
                </h2>
                <div class=" max-w-sm">
                    {{-- tag --}}
                    <form method="post" action="{{route('add_tag')}}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <input name="tag" type="text" class="mt-1 block w-full rounded border-gray-300" />
                        </div>

                        <div class="flex items-center gap-4">
                            <input type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                value="ADD">
                        </div>
                    </form>

                </div>
                <div class=" max-w-sm mt-2 scrollable-list p-1 sm:p-8 bg-white shadow  sm:rounded-lg">
                    @foreach ($tags as $tag)
                        <ul>
                            {{ $tag->name }}
                        </ul>
                    @endforeach
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Genre') }}
                </h2>
                <div class=" max-w-sm">
                    {{-- Genre --}}
                    <form method="post" action="{{route('add_genre')}}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <input name="genre" type="text" class="mt-1 block w-full rounded border-gray-300" />
                        </div>

                        <div class="flex items-center gap-4">
                            <input type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                value="ADD">
                        </div>
                    </form>

                </div>
                <div class=" max-w-sm mt-2 scrollable-list p-1 sm:p-8 bg-white shadow  sm:rounded-lg">
                    @foreach ($genres as $genre)
                        <ul>
                            {{ $genre->name }}
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
