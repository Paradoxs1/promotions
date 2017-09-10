<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use hQuery;
use phpQuery;
use App\Product;

class ParseController extends Controller
{
    //

    public function show()
    {

        return view('parse')->withTitle('parse');
    }

    public function parseAtb()
    {

        $url = 'http://www.atbmarket.com/ru/hot/akcii/economy/';
        $html = file_get_contents($url);
        $doc = PhpQuery::newDocument($html);

        $shop = '\images\atb.png';
        $name_action = $doc->find("title")->text();

        Product::where('id', '>', 0)->where('name_action', '=', $name_action)->delete(); //тут нужно подумать как не записывать уже записанное



        foreach ($doc->find("ul#cat0 > li") as $li) {
            $li = pq($li);

            $desc = $li->find('.promo_info span.promo_info_text span')->text();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $price = $li->find('.price_box span.promo_old_price')->text();
            $li->find('.price_box div.promo_price span.currency')->remove();
            $price_cent = $li->find('.price_box div.promo_price span')->html();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $li->find('.price_box div.promo_price span')->remove();
            $price_dollar = $li->find('.price_box div.promo_price')->html();
            $href_img = $li->find('.promo_image_wrap img')->attr('src');
            $img = 'http://www.atbmarket.com/' . $href_img;
            $name = trim($li->find('.promo_info span.promo_info_text')->text());

            $price_sale = $price_dollar + $price_cent / 100;

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $img;
            $product->description = $desc;
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;
            $product->category_id = 1;
            $product->tag_id = 1;
            $product->save();
            $id = $product->id;
            $arrayId[] = $id;
        }
//        echo '<pre>';
//        print_r($arrayId);
//        echo '</pre>';
//        return view('parse')->withTitle('parse');

        return redirect()->route('home');
    }

    public function parseSilpo()
    {

        $url = 'http://silpo.ua/ru/actions/priceoftheweek/';
        $html = file_get_contents($url);
        $doc = PhpQuery::newDocument($html);

        Product::where('id', '>', 0)->delete(); //тут нужно подумать как не записывать уже записанное




        foreach ($doc->find("ul#cat0 > li") as $li) {
            $li = pq($li);

            $desc = $li->find('.promo_info span.promo_info_text span')->text();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $price = $li->find('.price_box span.promo_old_price')->text();
            $li->find('.price_box div.promo_price span.currency')->remove();
            $price_cent = $li->find('.price_box div.promo_price span')->html();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $li->find('.price_box div.promo_price span')->remove();
            $price_dollar = $li->find('.price_box div.promo_price')->html();
            $href_img = $li->find('.promo_image_wrap img')->attr('src');
            $img = 'http://www.atbmarket.com/' . $href_img;
            $name = trim($li->find('.promo_info span.promo_info_text')->text());

            $price_sale = $price_dollar + $price_cent / 100;

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->img = $img;
            $product->description = $desc;
            if (empty($price)) {
                $price = 0;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;
            $product->category_id = 1;
            $product->tag_id = 1;
            $product->save();
            $id = $product->id;
            $arrayId[] = $id;
        }
//        echo '<pre>';
//        print_r($arrayId);
//        echo '</pre>';
//        return view('parse')->withTitle('parse');

        return redirect()->route('home');
    }
}
