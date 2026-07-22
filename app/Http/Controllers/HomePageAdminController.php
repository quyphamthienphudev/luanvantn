<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageAdminController extends Controller
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'admin') 
        {
            return back();
        }
        return view('home');
    }
}
