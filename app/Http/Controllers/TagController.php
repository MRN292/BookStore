<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function add(Request $request){
        $input_tag = $request->input('tag');

        $tag = new Tag();
        $tag->name = $input_tag;

        $tag->save();

        return back();
    }
    //
}
