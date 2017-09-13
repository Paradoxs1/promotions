<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function show()
    {
        if (view()->exists('about')) {


//            DB::insert("INSERT INTO pages(name_page, title, h1, content1, content2) VALUES(?, ?, ?, ?, ?)", ['about', 'promotions | about', 'О нас', 'content1', 'content2']);
            $lastInsertIdPage = DB::connection()->getPdo()->lastInsertId();

            $page = DB::select("select * from pages where name_page = ?", ['about']);

//            $data = [];
//            foreach ($page as $value) {
//                $data['name_page'] = $value->name_page;
//                $data['title'] = $value->title;
//                $data['h1'] = $value->h1;
//                $data['content1'] = $value->content1;
//                $data['content2'] = $value->content2;
//                $data['content3'] = $value->content3;
//                $data['content4'] = $value->content4;
//                $data['content5'] = $value->content5;
//            }

//            dump($data);

            return view('about')->withPage($page[0]);
        }
        return view('index')->withTitle('View not found');
    }
}
