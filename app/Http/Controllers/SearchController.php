<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catalog;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $text = 'Sorry, but nothing found.';
        $input = $request->except('_token', 'category');

        $arr = array_keys($input);

        $data = Product::where('status', 1);
        $flag = true;
        foreach($arr as $var){
            if($flag){
                $data =  $data->where('category_id', $var);
                $flag = false;
            }else{
                $data = $data->orWhere('category_id', '=', $var);
            }
        }
        $data = $data->paginate(2);
        $catalog = Catalog::all();
        if($arr){
            if(empty($data)){
                return view('index')->withText($text)->withCatalog($catalog)->withTitle('promotions');
            }else{
                return view('index')->withData($data)->withCatalog($catalog)->withTitle('promotions');
            }
        }else{
            return view('index')->withText($text)->withCatalog($catalog)->withTitle('promotions');
        }

    }
}
