<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function add(Request $request){
        $input_tag = $request->input('tag');
        if(!preg_match("/^[a-zA-Z0-9_\-]+$/", $input_tag)){
            return back()->with('tag','invalid input tag');
        }

        $tag = new Tag();
        $tag->name = $input_tag;

        $tag->save();

        return back();
    }
    //
}
