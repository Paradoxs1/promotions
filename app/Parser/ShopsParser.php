<?php

namespace App\Parser;

use Illuminate\Database\Eloquent\Model;

class ShopsParser extends Model
{
    public function AtbParser()
    {
        $atb = new AtbParser();
        $atb->parser();
    }

    public function SilpoParser()
    {
        $silpo = new SilpoParser();
        $silpo->parser();
    }

    public function KlassParser()
    {
        $klass = new KlassParser();
        $klass->parser();
    }

    public function PosadParser()
    {
        $posad = new PosadParser();;
        $posad->parser();
    }

    public function BrusnichkaParser()
    {
        $brusnichka = new BrusnichkaParser();
        $brusnichka->parser();
    }

    public function VelmarketParser()
    {
        $velmarket = new VelmarketParser();
        $velmarket->parser();
    }

    public function TavriaParser()
    {
        $tavria = new TavriaParser();
        $tavria->parser();
    }

    public function OkwineParser()
    {
        $okwine = new OkwineParser();
        $okwine->parser();
    }

    public function AntoshkaParser()
    {
        $antoshka = new AntoshkaParser();
        $antoshka->parser();
    }
}
