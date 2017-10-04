<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopPageController extends Controller
{

    public function showAtb()
    {
        $shop = 'АТБ';
        $shopImg = '\images\atb-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | atb')->withShop($shop);
    }

    public function showSilpo()
    {
        $shop = 'Сильпо';
        $shopImg = '\images\silpo-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | silpo')->withShop($shop);
    }

    public function showKlass()
    {
        $shop = 'Класс';
        $shopImg = '\images\klass-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | klass')->withShop($shop);
    }

    public function showPosad()
    {
        $shop = 'Посад';
        $shopImg = '\images\posad-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | posad')->withShop($shop);
    }

    public function showBrusnichka()
    {
        $shop = 'Брусничка';
        $shopImg = '\images\brusnichka-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | brusnichka')->withShop($shop);
    }

    public function showVelmarket()
    {
        $shop = 'Velmarket';
        $shopImg = '\images\velmart-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | velmart')->withShop($shop);
    }

    public function showTavria()
    {
        $shop = 'Таврия B';
        $shopImg = '\images\tavria-small.png';

        $data = Product::where('status', 1)->where('shop', $shopImg)->paginate(51);

        return view('shop')->withData($data)->withTitle('promotions | таврия B')->withShop($shop);
    }
}

