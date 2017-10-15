<?php

namespace App\Parser;

use Illuminate\Database\Eloquent\Model;

class ShopsParser extends Model
{
    public function AtbParser()
    {
        $atb = new AtbParser();
        $atb->parser();
        return 1;
    }

    public function SilpoParser()
    {
        $silpo = new SilpoParser();
        $silpo->parser();
        return 1;
    }

    public function KlassParser()
    {
        $klass = new KlassParser();
        $klass->parser();
        return 1;
    }

    public function PosadParser()
    {
        $posad = new PosadParser();;
        $posad->parser();
        return 1;
    }

    public function BrusnichkaParser()
    {
        $brusnichka = new BrusnichkaParser();
        $brusnichka->parser();
        return 1;
    }

    public function VelmarketParser()
    {
        $velmarket = new VelmarketParser();
        $velmarket->parser();
        return 1;
    }

    public function TavriaParser()
    {
        $tavria = new TavriaParser();
        $tavria->parser();
        return 1;
    }

    public function OkwineParser()
    {
        $okwine = new OkwineParser();
        $okwine->parser();
        return 1;
    }

    public function AntoshkaParser()
    {
        $antoshka = new AntoshkaParser();
        $antoshka->parser();
        return 1;
    }
}
