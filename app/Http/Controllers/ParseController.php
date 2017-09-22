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
        $atb = new Shops;
        $atb->AtbParser();
        return redirect()->route('promotions');
    }

    public function parseSilpo()
    {
        $silpo = new Shops;
        $silpo->Silpo();
        return redirect()->route('promotions');
    }

    public function parseKlass()
    {
        $klass = new Shops;
        $klassTen = $klass->KlassTen();
        $klassTheme = $klass->KlassTheme();

        if ($klassTheme && $klassTen) {
            return redirect()->route('promotions');
        }

    }

    public function parsePosad()
    {
        $posad = new Shops;
        $posad->PosadParser();
        return redirect()->route('promotions');
    }

    public function parseBrusnichka()
    {
        $brusnichka = new Shops;
        $brusnichka->BrusnichkaParser();
        return redirect()->route('promotions');
    }
}
