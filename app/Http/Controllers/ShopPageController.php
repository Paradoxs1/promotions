<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopPageController extends Controller
{
    //

    public function showAtb()
    {
        $shop = 'АТБ';
        $shopImg = '\images\atb-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(12);

        return view('shop')->withData($data)->withTitle('promotions | atb')->withShop($shop);
    }

    public function showSilpo()
    {
        $shop = 'Сильпо';
        $shopImg = '\images\atb-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(12);

        return view('shop')->withData($data)->withTitle('promotions | atb')->withShop($shop);
    }
}

