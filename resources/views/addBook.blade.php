@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class=" p-4 sm:p-8 bg-gray-100 shadow  sm:rounded-lg">



                <h2 class="text-xl font-medium text-black-1000">
                    {{ __('Add New Book') }}
                </h2>



                <div class="max-w-sm">
                    {{-- tag --}}
                    <form method="post" action="" class="mt-6 space-y-6">
                        @csrf


                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Books Name') }}
                            </p>
                            <input name="book_name" type="text" class=" max-w-sm block  rounded border-gray-300" />
                        </div>



                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Books Author') }}
                            </p>
                            <input name="book_author" type="text" class=" max-w-sm block  rounded border-gray-300" />
                        </div>



                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Description') }}
                            </p>
                            <textarea name="book_description" cols="70" rows="10" class=" block  rounded border-gray-300"></textarea>

                        </div>


                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Pages') }}
                            </p>
                            <input type="number" name="book_page" min="1" class="rounded border-gray-300">

                        </div>


                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Available') }}
                            </p>
                            <input type="number" name="book_available" min="0"
                                class=" block rounded border-gray-300">

                        </div>

                        <select name="countries" id="countries" multiple>
                            <option value="1">Afghanistan</option>
                            <option value="2">Australia</option>
                            <option value="3">Germany</option>
                            <option value="4">Canada</option>
                            <option value="5">Russia</option>
                        </select>

                        <div class=" items-center gap-4">
                            <input type="submit"
                                class="add-book items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900"
                                value="Add New Book">
                        </div>
                    </form>

                </div>








                {{-- <div class=" max-w-sm mt-2 scrollable-list p-1 sm:p-8 bg-white shadow  sm:rounded-lg">
                    @foreach ($tags as $tag)
                        <ul>
                            {{ $tag->name }}
                        </ul>
                    @endforeach
                </div>

                <div class=" max-w-sm mt-2 scrollable-list p-1 sm:p-8 bg-white shadow  sm:rounded-lg">
                    @foreach ($genres as $genre)
                        <ul>
                            {{ $genre->name }}
                        </ul>
                    @endforeach
                </div> --}}
            </div>

        </div>
    </div>
@endsection
