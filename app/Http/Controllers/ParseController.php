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
        return Shops::AtbEkonomy();
    }

    public function parseSilpo()
    {
        return Shops::Silpo();

    }
}
