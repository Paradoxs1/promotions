<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use hQuery;
use phpQuery;

class ParseController extends Controller
{
    //

    public function show()
    {
        if (view()->exists('parse')) {

            $url = 'http://www.atbmarket.com/ru/hot/akcii/economy/';
            $file = file_get_contents($url);

//            $pattern = '#<table id="course-table-pb.+?</table>#s';

//            preg_match($pattern, $file, $matches);


//            $doc = hQuery::fromUrl('http://example.com/someDoc.html', ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8']);
//            $doc = hQuery::fromFile($file);
            $doc = PhpQuery::newDocument($file);
            $table = $doc->find('#cat0');
//              $data = $doc->find('#selectByPB tr:eq(2) td:eq(1)');
//            $table = $doc->find('#course-table-pb')->html();
//
//            $table = pq($table);
            echo 'привет';
            echo $table;
//            print_r(pq($data)->html());
            dump($table);

//            return view('parse')->withData($tr);
//            return view('parse', $data);


        }
//        return view('index')->withTitle('View not found');
    }

}
