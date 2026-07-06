<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageQLCLController extends Controller
{
    //HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        return view('home');
    }
}
