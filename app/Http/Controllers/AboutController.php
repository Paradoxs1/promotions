<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        if (view()->exists('about')) {
            return view('about')->withTitle('promotions');
        }
        return view('index')->withTitle('View not found');
    }
}
