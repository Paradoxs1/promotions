<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpQuery;

class Parser extends Model
{
    protected function getContentUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function parser($url){
        $html = $this->getContentUrl($url);
        return $doc = PhpQuery::newDocument($html);
    }

}
