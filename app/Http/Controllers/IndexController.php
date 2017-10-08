<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Catalog;

class IndexController extends Controller
{
    public function show()
    {
        if (view()->exists('index')) {
            $var = true;

            $data = Product::where('status', 1)->paginate(51);

            $catalog = Catalog::all();

            return view('index')->withData($data)->withCatalog($catalog)->withVar($var)->withTitle('promotions | home');
        }else{
            $data = 'Sorry, but nothing found.';
            return view('welcome')->withData($data);
        }
    }
}
