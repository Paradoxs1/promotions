<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catalog;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $input = $request->except('_token');
        $arr = array_keys($input);

        foreach ($arr as $var) {
            $array[] = Product::where('category_id', $var)->where('status', '=', 1)->get();
        }

        if(!empty($array)) {
            foreach ($array as $var) {
                foreach ($var as $item) {
                    $data[] = $item;
                }
            }
            $num = true;
            $catalog = Catalog::all();

            return view('index')->withData($data)->withCatalog($catalog)->withNum($num)->withTitle('promotions');
        }else{
            $data = 'Sorry, but nothing found.';
            return view('welcome')->withData($data);
        }

    }
}
