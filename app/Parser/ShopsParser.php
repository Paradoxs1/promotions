<?php

namespace App\Parser;

use Illuminate\Database\Eloquent\Model;

class ShopsParser extends Model
{
    public function AtbParser()
    {
        $atb = new AtbParser();
        $atb->parser();
        return redirect()->route('promotions');
    }

    public function SilpoParser()
    {
        $silpo = new SilpoParser();
        $silpo->parser();
        return redirect()->route('promotions');
    }

    public function KlassParser()
    {
        $klass = new KlassParser();
        $klass->parser();
        return redirect()->route('promotions');
    }

    public function PosadParser()
    {
        $posad = new PosadParser();;
        $posad->parser();
        return redirect()->route('promotions');
    }

    public function BrusnichkaParser()
    {
        $brusnichka = new BrusnichkaParser();
        $brusnichka->parser();
        return redirect()->route('promotions');
    }

    public function VelmarketParser()
    {
        $velmarket = new VelmarketParser();
        $velmarket->parser();
        return redirect()->route('promotions');
    }

    public function TavriaParser()
    {
        $tavria = new TavriaParser();
        $tavria->parser();
        return redirect()->route('promotions');
    }

    public function OkwineParser()
    {
        $okwine = new OkwineParser();
        $okwine->parser();
        return redirect()->route('promotions');
    }

    public function AntoshkaParser()
    {
        $antoshka = new AntoshkaParser();
        $antoshka->parser();
        return redirect()->route('promotions');
    }
}
