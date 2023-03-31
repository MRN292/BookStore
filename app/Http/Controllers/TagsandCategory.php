<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Category;


use Illuminate\Http\Request;

class TagsandCategory extends Controller
{
    public function show(){
        $tags = Tag::all();
        $genres = Category::all();

        return view('tags_and_genres', ['tags' => $tags , 'genres' => $genres]);
    }
    public function add_book(){
        $tags = Tag::all();
        $genres = Category::all();

        return view('addBook', ['tags' => $tags , 'genres' => $genres]);
    }
}
