<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Shops;

use App\Product;

class IndexController extends Controller
{
    public function show()
    {
        if (view()->exists('index')) {

            $data = Product::all();

            return view('index')->withData($data)->withTitle('promotions | home');
        }
        return view('welcome')->withTitle('View not found');
    }
}
