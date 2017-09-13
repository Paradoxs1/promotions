<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parser;
use phpQuery;
use App\Product;
use DB;

class Shops extends Model
{

    public static function AtbEkonomy(){
        $parser = Parser::parser('http://www.atbmarket.com/ru/hot/akcii/economy/');

        $shop = '\images\atb-small.png';
        $name_action = $parser->find("title")->text();

        foreach ($parser->find("ul#cat0 > li") as $li) {
            $li = pq($li);

            $desc = $li->find('.promo_info span.promo_info_text span')->text();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $name = trim($li->find('.promo_info span.promo_info_text')->text());

            $href_img = $li->find('.promo_image_wrap img')->attr('src');
            $href_img = str_replace('_295_235_f', '', $href_img);
            $img = 'http://www.atbmarket.com/' . $href_img;

            $price = $li->find('.price_box span.promo_old_price')->text();
            $li->find('.price_box div.promo_price span.currency')->remove();
            $price_cent = $li->find('.price_box div.promo_price span')->html();
            $li->find('.promo_info span.promo_info_text span')->remove();
            $li->find('.price_box div.promo_price span')->remove();
            $price_dollar = $li->find('.price_box div.promo_price')->html();
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
            if(empty($price)){
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;
            $product->tag_id = 1;

            $check = DB::select("select img from products where img = ?",["$img"]);
            if(empty($check)){
                $product->save();
            }
        }

        return redirect()->route('home');
    }

    public static function Silpo(){

        $url = 'http://silpo.ua/ru/actions/priceoftheweek/';
        $start = 0;
        $end = 100;

        self::SilpoParser($url, $start, $end);

        return redirect()->route('home');
    }

    public static function SilpoParser($url, $start, $end){
        if ($start < $end){

            $parser = Parser::parser($url);

            $shop = '\images\silpo-small.png';
            $name_action = $parser->find("div.ots div div div font:first")->text();

            foreach ($parser->find("div.ots > div.photo ") as $div) {
                $div = pq($div);

                $desc = $div->find('h3')->text();

                $href_img = $div->find('a')->attr('href');
                $img = 'http://silpo.ua/' . $href_img;

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

                if (!empty($price_sale) && !empty($price)) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();
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
                $product->tag_id = 1;

                $check = DB::select("select img from products where img = ?",["$img"]);
                if(empty($check)){
                    $product->save();
                }
            }

            $http = 'http://silpo.ua';
            $next1 = $parser->find('div.page div.act')->next()->find('a')->attr('href');
            $url = $http . $next1;

            if (!empty($next1)) {
                $start++;
                self::SilpoParser($url, $start, $end);
            }
        }
    }

}
