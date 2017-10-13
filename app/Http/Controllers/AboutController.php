<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AboutController extends Controller
{
    public function show()
    {
        if (view()->exists('about')) {

            $page = DB::select("select * from pages where name_page = ?", ['about']);

            return view('about')->withPage($page[0]);
        }
        return view('index')->withTitle('View not found');
    }
}
