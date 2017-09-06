<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ProductController extends Controller
{
    //

    public function show()
    {
        if (view()->exists('product')) {

            $data = $this->getProducts();

//            $data = $this->getFirstProduct();
//            $data = DB::table('products')->value('id');

            dump($data);

            return view('product')->withData($data);


        }
        return view('index')->withTitle('View not found');
    }

    public function getProducts()
    {
//        $data = DB::table('products')->get();
//        $data = DB::table('products')->select()->where('id', '<', 5)->where('name', 'like', 'п%')->get();

        return $data;
    }

    public function getFirstProduct()
    {
        $data = DB::table('products')->first();

        return $data;
    }
}
