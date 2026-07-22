<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageITController extends Controller
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        return view('home');
    }
}
