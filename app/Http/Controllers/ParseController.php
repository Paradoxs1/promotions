<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParseController extends Controller
{
    //

    public function show()
    {
        if (view()->exists('parse')) {

            $data = [];
            dump($data);

            return view('parse')->withData($data);


        }
        return view('index')->withTitle('View not found');
    }

}
