<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function show()
    {
        if (view()->exists('index')) {

            $data = Product::where('status', 1)->paginate(51);

            return view('index')->withData($data)->withTitle('promotions | home');
        }
        return view('welcome')->withTitle('View not found');
    }
}
