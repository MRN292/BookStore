<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Book;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    //
    public function add(Request $request)
    {
        $error_flag = false;
        $user_id = Auth::user()->id;

        $book = new Book();



        $name = $request->input('book_name'); //
        $author = $request->input('book_author'); //
        $description = $request->input('book_description'); //
        $page = $request->input('book_page'); //
        $available = $request->input('book_available'); //
        $price = $request->input('book_price'); //
        $genres = $request->input('genres');
        $tags = $request->input('tags');


        if (!preg_match("/^\w++(?:[.,_:()\s-](?![.\s-])|\w++)*$/", $name)) {
            $error_flag = true;
            $name_error = 'invalid name';
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $author)) {
            $error_flag = true;

            $author_error = 'invalid name';
        }
        if (!preg_match("/^(.|\s)*[a-zA-Z]+(.|\s)*$/", $description)) {
            $error_flag = true;

            $description_error = 'invalid input description';
        }


        if (($request->file('book_photo')->extension() == 'jpg' || $request->file('book_photo')->extension() == 'png'
            || $request->file('book_photo')->extension() == 'gif' || $request->file('book_photo')->extension() == 'jpeg')) {
            if ($request->file('book_photo')->getSize() >15360000) {
                $error_flag = true;

                $img_error = 'image is too large';
            }
        } else {
            $error_flag = true;
            $img_error = 'unsupported format';
        }





        if ($error_flag == false) {
            $imageName = time() . '.' . $request->file('book_photo')->extension();
            $request->file('book_photo')->move(public_path('Books'), $imageName);

            // Save the file name in the user's record

            $book->photo = $imageName;
            $book->name = $name;
            $book->author = $author;
            $book->description = $description;
            $book->pages = $page;
            $book->available = $available;
            $book->created_by = $user_id;
            $book->price = $price;
            $book->save();
            foreach ($genres as $genre) {
                DB::table('cate_books')->insert([
                    'cate_id' => $genre,
                    'book_id' => $book->id
                ]);
            }
            foreach ($tags as $tag) {
                DB::table('tag_books')->insert([
                    'tag_id' => $tag,
                    'book_id' => $book->id
                ]);
            }

            return back()->with('success', 'Book added successfully');


        } else {

            return back()->with([
                'name_error' => $name_error,
                'author_error' => $author_error,
                'description_error' => $description_error,
                'img_error' =>$img_error,
            ]);
        }


    }



    public function show(){
        $books = Book::all();
        return view('Books' , ['books' => $books]);
            
    }



}
