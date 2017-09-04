<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
        if (view()->exists('index')) {
            return view('index')->withTitle('promotions');
        }
        return view('welcome')->withTitle('View not found');
    }
}
