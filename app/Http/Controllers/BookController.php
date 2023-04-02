<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;

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
        else{
            $name_error="";
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $author)) {
            $error_flag = true;

            $author_error = 'invalid name';
        }
        else{
            $author_error = "";
        }
        
        if (!preg_match("/^(.|\s)*[a-zA-Z]+(.|\s)*$/", $description)) {
            $error_flag = true;

            $description_error = 'invalid input description';
        }
        else{
            $description_error = "";
        }


        if (($request->file('book_photo')->extension() == 'jpg' || $request->file('book_photo')->extension() == 'png'
            || $request->file('book_photo')->extension() == 'gif' || $request->file('book_photo')->extension() == 'jpeg')) {
            if ($request->file('book_photo')->getSize() > 15360000) {
                $error_flag = true;

                $img_error = 'image is too large';
            }
            else{
                $img_error = "";
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
                    'category_id' => $genre,
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
                'img_error' => $img_error,
            ]);
        }
    }



    public function show()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $user_id = $book->created_by;

            $input = DB::table('users')->find($user_id);
            $book->created_by = $input->name;
        }
        return view('Books', ['books' => $books]);
    }






    public function shop()
    {
        $books = Book::all();
        return view('shop', ['books' => $books]);
    }






    public function show_edit(Request $request)
    {
        // $book = Book::find();
        $tags = Tag::all();
        $categories = Category::all();
        $book = Book::find($request->input('edit'));
        $input_categories = $book->categories()->get();
        $input_tags = $book->tags()->get();

        return view('editBook', [
            'book' => $book,
            'tags' => $tags,
            'categories' => $categories,
            'input_tags' => $input_tags,
            'input_categories' => $input_categories
        ]);
    }

    public function edit(Request $request)
    {
        $error_flag = false;
        $input_img = true;

        $id = $request->input('book_id');
        $photo = Book::where('id', $id)->get('photo');
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
        else{
            $name_error="";
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $author)) {
            $error_flag = true;

            $author_error = 'invalid name';
        }
        else{
            $author_error = "";
        }
        if (!preg_match("/^(.|\s)*[a-zA-Z]+(.|\s)*$/", $description)) {
            $error_flag = true;

            $description_error = 'invalid input description';
        }
        else{
            $description_error = "";
        }

        if ($request->file('book_photo') != null) {
            if (($request->file('book_photo')->extension() == 'jpg' || $request->file('book_photo')->extension() == 'png'
                || $request->file('book_photo')->extension() == 'gif' || $request->file('book_photo')->extension() == 'jpeg')) {
                if ($request->file('book_photo')->getSize() > 15360000) {
                    $error_flag = true;

                    $img_error = 'image is too large';
                }
                else{
                    $img_error = "";
                }
            } else {
                $error_flag = true;
                $img_error = 'unsupported format';
            }
        } else {
            $input_img = false;

            $img_error = "";
            $imageName = $photo;
        }

        if ($error_flag == false) {
            if ($input_img == true) {
                $imageName = time() . '.' . $request->file('book_photo')->extension();
                $request->file('book_photo')->move(public_path('Books'), $imageName);
                $img_error = "";

            }
            Book::where('id', $id)->update([
                'name' => $name,
                'author' => $author,
                'description' => $description,
                'pages' => $page,
                'available' => $available,
                'price' => $price

            ]);

            // Save the file name in the user's record



            $book = Book::find($id);

            // Retrieve the current categories of the book
            $currentTags = $book->tags;

            // Detach the current categories from the book
            $book->tags()->detach($currentTags);

            // Attach the new categories to the book
            $book->tags()->attach($tags);

            return back()->with('success', 'Book Updated successfully');
        } else {
            return back()->with([
                'name_error' => $name_error,
                'author_error' => $author_error,
                'description_error' => $description_error,
                'img_error' => $img_error,
            ]);
        }
    }


    public function delete (Request $request){
        $id = $request->input('delete');
        $book = Book::find($id);
        $book->delete();

        return back()->with('success', 'Book deleted successfully!');
    }
}
