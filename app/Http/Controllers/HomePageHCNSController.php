<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageHCNSController 
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        return view('home');
    }
}
