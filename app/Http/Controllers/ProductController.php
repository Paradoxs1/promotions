<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Product;

class ProductController extends Controller
{
    //

    public function show()
    {
        if (view()->exists('product')) {

//            $data = $this->getProducts();
//            $product = $this->createProduct();
//            $product = $this->updateProduct();

            $data = Product::all();
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

        $data = Product::where('id', '>', 2)->get();

        return $data;
    }

    public function getFirstProduct()
    {
        $data = DB::table('products')->first();

        return $data;
    }

    public function createProduct(){

        $product = new Product;
        $product->name = 'name 5';
        $product->category_id = 8;
        $product->tag_id = 128;
        $product->img = 'img2258.jpg';
        $product->description = 'описание';
        $product->price = 125.00;
        $product->price_sale = 120.00;
        $product->sale = 5;

        $product->save();

    }

    public function updateProduct(){

        $product = Product::find(8);
        $product->name = 'name 8';
        $product->category_id = 7858525;
        $product->tag_id = 1258;
        $product->img = 'img2252258.jpg';
        $product->description = 'описание';
        $product->price = 125.00;
        $product->price_sale = 120.00;
        $product->sale = 5;

        $product->save();

    }
}
