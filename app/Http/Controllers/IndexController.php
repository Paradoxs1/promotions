<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

    	$message = 'Hello Dimas!';

    	return view('page')->with('message', $message);
    }
}
