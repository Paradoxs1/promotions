<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Shops;

class ParseController extends Controller
{

    public function show()
    {
        return view('parse')->withTitle('parse');
    }

    public function parseAtb()
    {
        $atbEkonomy = Shops::AtbEkonomy();
        $atbSevenDay = Shops::AtbSevenDay();

        if($atbEkonomy && $atbSevenDay){

            return redirect()->route('promotions');
        }

        return redirect()->route('home');

    }

    public function parseSilpo()
    {
        return Shops::Silpo();

    }
}
