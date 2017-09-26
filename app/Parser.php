<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpQuery;
use App\Product;

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

    public function parser($url)
    {
        $html = $this->getContentUrl($url);
        return $doc = PhpQuery::newDocument($html);
    }


    public function statusProductOff($name_action)
    {
        $product = Product::where('name_action', $name_action)->update(['status' => 0]);
        return $product;
    }


}
