<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;


class ContactController extends Controller
{
    public function show()
    {
        return view('contact')->withTitle('promotions | contact');
    }

}
