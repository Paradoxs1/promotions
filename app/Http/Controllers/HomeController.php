<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catalog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Product::where('category_id', null)->take(100)->get();
        $catalog = Catalog::all();
        return view('home')->withData($data)->withCatalog($catalog);
    }
}
