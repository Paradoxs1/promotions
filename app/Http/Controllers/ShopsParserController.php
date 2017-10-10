<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops;
use App\Product;
use App\Catalog;

class ShopsParserController extends Controller
{
    public function shopsParser(Request $request)
    {
        $input = array_keys($request->except('_token'));

        if (!empty($input)) {
            foreach ($input as $item) {
                $shops[] = Shops::where('id', $item)->pluck('method');
            }

            foreach ($shops as $shop) {
                $arr[] = $shop[0];
            }

            $arr = implode(',', $arr);
            $shops = explode(',', $arr);

            foreach ($shops as $shop) {
                $shop = trim($shop);
                $obj = new Shops();
                $obj->$shop();
            }
        }

        $data = Product::where('category_id', null)->where('status', '=', 1)->take(50)->get();
        $catalog = Catalog::all();
        $shops = Shops::all();
        return view('home')->withData($data)->withCatalog($catalog)->withShops($shops);
    }
}
