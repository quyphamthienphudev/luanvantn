<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageUserController 
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        return view('home');
    }
}
