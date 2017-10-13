<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        if (view()->exists('contact')) {

            $request->flash();

            return view('contact')->withTitle('promotions | contact');
        }
        return view('index')->withTitle('not view');
    }
}
