@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class=" p-4 sm:p-8 bg-gray-100 shadow  sm:rounded-lg">



                <h2 class="text-xl font-medium text-black-1000">
                    {{ __('Add New Book') }}
                </h2>
                @if (session('success'))
                    <span class='inline-block' style="color:green ">{{ session('success') }}</span>
                @endif




                <div class="max-w-sm">

                    <form method="post" enctype="multipart/form-data" action="{{ route('insert_book') }}"
                        class="mt-6 space-y-6">
                        @csrf


                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Books Name') }}
                            </p>

                            <input required name="book_name" type="text"
                                class=" max-w-sm block  rounded border-gray-300" />
                            @if (session('name_error'))
                                <span class='text-sm ' style="color:red ">{{ session('name_error') }}</span>
                            @endif
                        </div>




                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Books Author') }}
                            </p>
                            <input name="book_author" required type="text"
                                class=" max-w-sm block  rounded border-gray-300" />
                        </div>
                        @if (session('author_error'))
                            <span class='inline-block' style="color:red ">{{ session('author_error') }}</span>
                        @endif




                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Description') }}
                            </p>
                            <textarea required name="book_description" cols="70" rows="10"
                                value="0"class=" block  rounded border-gray-300"></textarea>

                        </div>
                        @if (session('description_error'))
                            <center>
                                <span class='inline-block' style="color:red ">{{ session('description_error') }}</span>
                            </center>
                        @endif




                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Pages') }}
                            </p>
                            <input required type="number" name="book_page" min="1" value="1"
                                class="rounded border-gray-300">

                        </div>



                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Available') }}
                            </p>
                            <input required type="number" name="book_available" min="0" value="0"
                                class=" block rounded border-gray-300">
                        </div>




                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Price') }}
                            </p>
                            <input required type="number" name="book_price" value="0" min="0"
                                class=" block rounded border-gray-300">

                        </div>



                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Genres') }}
                            </p>
                            <select required name="genres[]" id="genres" multiple>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div>
                            <p class="mt-10 mb-2 text-md text-gray-900">
                                {{ __('Tags') }}
                            </p>
                            <select required name="tags[]" id="tags" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>




                        <div>
                            <p class="book_img mb-2 text-md text-gray-900">
                                {{ __('Book image') }}
                            </p>
                            <div class="flex">
                                <input required type="file" name="book_photo">
                            </div>
                        </div>

                        @if (session('img_error'))
                            <span class='inline-block' style="color:red ">{{ session('img_error') }}</span>
                        @endif

                        <div class=" items-center gap-4">
                            <input type="submit"
                                class="add-book items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900"
                                value="Add New Book">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection
