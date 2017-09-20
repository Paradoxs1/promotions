<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parser;
use phpQuery;
use App\Product;
use DB;

class Shops extends Model
{

    public static function AtbEkonomy()
    {
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
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;
            $product->tag_id = 1;

            $check = DB::select("select img from products where img = ?", ["$img"]);
            if (empty($check)) {
                $product->save();
            }
        }


        return true;
    }

    public static function AtbSevenDay()
    {
        $parser = Parser::parser('http://www.atbmarket.com/ru/hot/akcii/7day/');

        $shop = '\images\atb-small.png';
        $name_action = $parser->find("title")->text();

        foreach ($parser->find("div.tab-content > ul") as $ul) {
            $ul = pq($ul);

            foreach ($ul->find("li") as $li) {
                $li = pq($li);

                $desc = $li->find('.promo_info span.promo_info_text span')->text();
                $li->find('.promo_info span.promo_info_text span')->remove();
                $name = trim($li->find('div.promo_info span.promo_info_text')->text());

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
                if (empty($price)) {
                    $price = null;
                    $sale = 0;
                }
                $product->price = $price;
                $product->price_sale = $price_sale;
                $product->sale = $sale;
                $product->tag_id = 1;

                $check = DB::select("select img from products where img = ?", ["$img"]);
                if (empty($check)) {
                    $product->save();
                }
            }
        }


        return true;

    }

    public static function Silpo()
    {

//        $url = [
//            'http://silpo.ua/ru/actions/priceoftheweek/',
//            'http://silpo.ua/ru/actions/specialpropositions/',
//            'http://silpo.ua/ru/actions/hotproposal/',
//            'http://silpo.ua/ru/actions/weekofchildhood/',
//            'http://silpo.ua/ru/actions/ownimport/'
//        ];
        $url = 'http://silpo.ua/ru/actions/priceoftheweek/';
        $start = 0;
        $end = 100;

        //foreach ($url as $u){
            self::SilpoParser($url, $start, $end);
       // }

        return redirect()->route('promotions');
    }

    public static function SilpoParser($u, $start, $end)
    {
        if ($start < $end) {

            $parser = Parser::parser($u);

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

                $check = DB::select("select img from products where img = ?", ["$img"]);
                if (empty($check)) {
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

    public static function KlassTen(){

        $parser = Parser::parser('http://www.klass.com.ua/catalog.html?cat_id=16');

        $shop = '\images\klass-small.png';
        $name_action = $parser->find('#tttt strong')->text();

        foreach ($parser->find("#goods td[valign='top']") as $li) {
            $li = pq($li);

            $name = trim($li->find('.cmlt_1')->text());

            $href_img = $li->find('.img')->attr('style');
            $href = stristr($href_img, 'gallery');
            $pos = strrpos ($href, ')');
            $img = 'http://www.klass.com.ua/' . substr($href, 0 , $pos);

            $price_old = $li->find('.old_price_through')->text();
            $price_old_cop = $li->find('.old_price_kop')->text();
            $price = $price_old + $price_old_cop / 100;

            $price_new_cop = $li->find('.price_kop')->text();
            $li->find('.new_price>*')->remove();
            $price_new = $li->find('.new_price')->text();
            $price_sale = $price_new + $price_new_cop / 100;

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $img;
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;
            $product->tag_id = 1;

            $check = DB::select("select name from products where name = ?", ["$name"]);
            if (empty($check)) {
                $product->save();
            }
        }

        return redirect()->route('promotions');

    }

    public static function KlassTheme(){

        $parser = Parser::parser('http://www.klass.com.ua/catalog.html?cat_id=43');

        $shop = '\images\klass-small.png';
        $name_action = $parser->find('#tttt strong')->text();

        foreach ($parser->find(".tttt tbody img") as $li) {
            $li = pq($li);
            $href_img = $li->attr('src');

            $product = new Product();

            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $href_img;
            $product->tag_id = 1;

            $check = DB::select("select img from products where img = ?", ["$href_img"]);
            if (empty($check)) {
                $product->save();
            }
        }

        return true;
    }

}
