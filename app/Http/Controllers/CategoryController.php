<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function add(Request $request)
    {
        $input_genre = $request->input('genre');

        if (!preg_match("/^[a-zA-Z]+(?: [a-zA-Z]+)*$/" , $input_genre)) {
            return back()->with('genre', 'invalid input genre');
        }

        $genre = new Category();
        $genre->name = $input_genre;

        $genre->save();

        return back();
    }
}
