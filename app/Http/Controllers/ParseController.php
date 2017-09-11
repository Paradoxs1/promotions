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

        $shop = '\images\atb-small.png';
        $name_action = $doc->find("title")->text();

        Product::where('name_action', '=', $name_action)->delete(); //тут нужно подумать как не записывать уже записанное

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

            $href_img = str_replace('_295_235_f', '', $href_img);

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

        return redirect()->route('home');
    }

    public function parseSilpo()
    {

        $url = 'http://silpo.ua/ru/actions/priceoftheweek/';
        $start = 0;
        $end = 100;

        $html = file_get_contents($url);
        $doc = PhpQuery::newDocument($html);

        $name_action = $doc->find("div.ots div div div font:first")->text();

        Product::where('name_action', '=', $name_action)->delete(); //тут нужно подумать как не записывать уже записанное

        function parser($url, $start, $end)
        {

            if ($start < $end) {

                $html = file_get_contents($url);
                $doc = PhpQuery::newDocument($html);

                $shop = '\images\silpo-small.png';
                $name_action = $doc->find("div.ots div div div font:first")->text();

                foreach ($doc->find("div.ots > div.photo ") as $div) {
                    $div = pq($div);

                    $desc = $div->find('h3')->text();
                    $price_dollar = $div->find('.pr span.hrn')->text();
                    $price_cent = $div->find('.pr span.kop')->text();
                    if (empty($price_dollar) || empty($price_cent)) {
                        $price_dollar = 0;
                        $price_cent = 0;
                    }
                    $price = $price_dollar + $price_cent / 100;
                    $price_dollar_sale = $div->find('.price_2014_new span.hrn')->text();
                    $price_cent_sale = $div->find('.price_2014_new span.kop')->text();
                    $price_sale = $price_dollar_sale + $price_cent_sale / 100;
                    $href_img = $div->find('a')->attr('href');
                    $img = 'http://silpo.ua/' . $href_img;

                    if (!empty($price_sale) && !empty($price)) {
                        $sale = ($price - $price_sale) / $price * 100;
                        $sale = ceil($sale);
                    }

                    $product = new Product();
//            $product->name = $name;
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
                }

                $http = 'http://silpo.ua';
                $next1 = $doc->find('div.page div.act')->next()->find('a')->attr('href');
                $next = $http . $next1;

                if (!empty($next1)) {

                    $start++;
                    parser($next, $start, $end);
                }
            }
        }

        parser($url, $start, $end);

        return redirect()->route('home');
    }
}
