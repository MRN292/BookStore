<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserBookController extends Controller
{

    public function show(){
        return view('cart');
    }
}
