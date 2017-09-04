<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        if (view()->exists('contact')) {
//            $request->all();
            $request->flash();
//            $request->flashExcept('_token');
            return view('contact')->withTitle('promotions | contact');
        }
        return view('index')->withTitle('not view');
    }
}
