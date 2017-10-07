<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parser;
use phpQuery;
use App\Product;
use DB;

class Shops extends Model
{

    public function AtbParser()
    {

        $url = [
            'http://www.atbmarket.com/ru/hot/akcii/economy/',
            'http://www.atbmarket.com/ru/hot/akcii/7day/'
        ];

        $parser = new Parser;

        foreach ($url as $u) {
            $atb = $parser->parser($u);

            $shop = '\images\atb-small.png';
            $name_action = $atb->find("title")->text();

            $parser->statusProductOff($name_action);

            foreach ($atb->find(".promo_list li") as $li) {
                $li = pq($li);

                $desc = $li->find('.promo_info_text span')->text();
                $li->find('.promo_info_text span')->remove();
                $name = trim($li->find('.promo_info_text')->text());

                $href_img = $li->find('.promo_image_wrap img')->attr('src');
                $href_img = str_replace('_295_235_f', '', $href_img);
                $img = 'http://www.atbmarket.com/' . $href_img;

                $price = $li->find('.promo_old_price')->text();
                $li->find('.promo_price .currency')->remove();
                $price_cent = $li->find('.promo_price span')->html();
                $li->find('.promo_price span')->remove();
                $price_dollar = $li->find('.promo_price')->html();
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

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }
        }

        return true;
    }

    public function Silpo()
    {
        $url = [
            'http://silpo.ua/ru/actions/priceoftheweek/',
            'http://silpo.ua/ru/actions/specialpropositions/',
            'http://silpo.ua/ru/actions/hotproposal/',
            'http://silpo.ua/ru/actions/weekofchildhood/',
            'http://silpo.ua/ru/actions/ownimport/'
        ];
        $start = 0;
        $end = 100;

        $parser = new Parser;
        $name_action = 'Акции в Сильпо';
        $parser->statusProductOff($name_action);

        foreach ($url as $u) {
            $this->SilpoParser($u, $start, $end);
        }

        return true;
    }

    public function SilpoParser($u, $start, $end)
    {
        if ($start < $end) {

            $parser = new Parser;
            $silpo = $parser->parser($u);
            $name_action = 'Акции в Сильпо';
            $shop = '\images\silpo-small.png';

            foreach ($silpo->find(".photo ") as $div) {

                $div = pq($div);

                $name = $div->find('h3')->text();

                $href_img = $div->find('a')->attr('href');
                $img = 'http://silpo.ua/' . $href_img;

                $price_cent = $div->find('.pr .kop, .old_price sup, ')->text();
                $div->find('.old_price sup')->remove();
                $price_dollar = $div->find('.pr .hrn, .old_price .hrn')->text();

                if (empty($price_dollar) || empty($price_cent)) {
                    $price_dollar = 0;
                    $price_cent = 0;
                }
                $price = $price_dollar + $price_cent / 100;

                $price_dollar_sale = $div->find('.price_2014_new span.hrn, .new_price .hrn, .price-hot-new .hrn, .price-child-new .hrn, .ownimp_new .hrn')->text();
                $price_cent_sale = $div->find('.price_2014_new span.kop, .new_price .kop, .price-hot-new .kop, .price-child-new .kop, .ownimp_new .hrn')->text();
                $price_sale = $price_dollar_sale + $price_cent_sale / 100;

                if (!empty($price_sale) && !empty($price)) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();
                $product->name_action = $name_action;
                $product->shop = $shop;
                $product->img = $img;
                $product->name = $name;
                if (empty($price)) {
                    $price = null;
                    $sale = 0;
                }
                $product->price = $price;
                $product->price_sale = $price_sale;
                $product->sale = $sale;

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }

            $http = 'http://silpo.ua';
            $next1 = $silpo->find('div.page div.act')->next()->find('a')->attr('href');
            $url = $http . $next1;

            if (!empty($next1)) {
                $start++;
                $this->SilpoParser($url, $start, $end);
            }
        }
    }

    public function KlassTen()
    {

        $parser = new Parser;
        $klass = $parser->parser('http://www.klass.com.ua/catalog.html?cat_id=16');

        $shop = '\images\klass-small.png';
        $name_action = $klass->find('#tttt strong')->text();

        $parser->statusProductOff($name_action);

        foreach ($klass->find("#goods td[valign='top']") as $li) {
            $li = pq($li);

            $name = trim($li->find('.cmlt_1')->text());

            $href_img = $li->find('.img')->attr('style');
            $href = stristr($href_img, 'gallery');
            $pos = strrpos($href, ')');
            $img = 'http://www.klass.com.ua/' . substr($href, 0, $pos);

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

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;

    }

    public function KlassTheme()
    {

        $parser = new Parser;
        $klass = $parser->parser('http://www.klass.com.ua/catalog.html?cat_id=43');

        $shop = '\images\klass-small.png';
        $name_action = $klass->find('#tttt strong')->text();

        $parser->statusProductOff($name_action);

        foreach ($klass->find(".tttt tbody img") as $li) {
            $li = pq($li);
            $href_img = $li->attr('src');

            $product = new Product();

            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $href_img;

            $oldProduct = Product::where('img', $shop)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

    public function PosadParser()
    {
        $url = [
            'http://posad.com.ua/goryachee_predlogenie/',
            'http://posad.com.ua/specials/'
        ];

        $parser = new Parser;

        $shop = '\images\posad-small.png';

        foreach ($url as $u) {
            $posad = $parser->parser($u);
            $name_action = $posad->find(".entry-title")->text();
            $parser->statusProductOff($name_action);

            foreach ($posad->find(".ngg-galleryoverview > div") as $li) {
                $li = pq($li);

                $img = $li->find('img')->attr('src');

                $product = new Product();

                $product->name_action = $name_action;
                $product->shop = $shop;
                $product->img = $img;

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }
        }

        return true;
    }

    public function BrusnichkaParser()
    {
        $parser = new Parser;
        $brusnichka = $parser->parser('http://brusnichka.com.ua:81/pokupatelyam/aktsii/');
        $shop = '\images\brusnichka-small.png';
        $name_action = 'Лучшая цена';

        $parser->statusProductOff($name_action);

        foreach ($brusnichka->find(".weekly-promo-item") as $li) {
            $li = pq($li);

            $name = trim($li->find('.name span')->text());
            $li->find('.name span')->remove();
            $desc = $li->find('.name')->text();

            $href_img = $li->find('.img')->attr('style');
            $href = stristr($href_img, '/upload');
            $pos = strrpos($href, "'");
            $img = 'https://brusnichka.com.ua' . substr($href, 0, $pos);

            $price_old_cop = $li->find('.price__old .coins')->text();
            $li->find('.price__old .coins')->remove();
            $price_old = $li->find('.price__old')->text();
            if (empty($price_old) || empty($price_old_cop)) {
                $price_old = 0;
                $price_old_cop = 0;
            }
            $price = $price_old + $price_old_cop / 100;

            $price_new_cop = $li->find('.price__new .coins')->text();
            $li->find('.price__new .coins')->remove();
            $price_new = $li->find('.price__new')->text();
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
            $product->description = $desc;
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

    public function VelmarketParser()
    {
        $parser = new Parser;
        $velmarket = $parser->parser('http://velmart.ua/ru/actions/product-of-week?c=xarkov');
        $shop = '\images\velmart-small.png';
        $velmarket->find('h1 a')->remove();
        $name_action = $velmarket->find('h1')->text();

        $parser->statusProductOff($name_action);

        foreach ($velmarket->find(".food .block") as $li) {
            $li = pq($li);

            $href_img = $li->find('img')->attr('src');
            $img = 'http://velmart.ua' . $href_img;

            $product = new Product();

            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $img;

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

    public function TavriaParser()
    {
        $parser = new Parser;
        $tavria = $parser->parser('http://landing.od.ua/?_ga=2.8491445.1699723088.1507105911-1206546573.1507105910');
        $shop = '\images\tavria-small.png';
        $name_action = $tavria->find('h1')->text();

        $parser->statusProductOff($name_action);

        foreach ($tavria->find(".produkt_item") as $li) {
            $li = pq($li);

            $name = trim($li->find('.title')->text());

            $href_img = $li->find('img')->attr('src');
            $img = 'http://landing.od.ua/' . $href_img;

            $price = $li->find('.price span')->text();
            $li->find('.price span')->remove();
            $pos = strrpos($price, ",");
            $price_new = (int) substr($price, 0, $pos);
            $price_new_cop = stristr($price, ',');
            $pos = strrpos($price_new_cop, ' ');
            $price_new_cop = (int) substr($price_new_cop, 1, $pos);
            $price_sale = $price_new + $price_new_cop / 100;

            $price = $li->find('.price')->text();
            $pos = strrpos($price, ",");
            $price_old = (int) substr($price, 0, $pos);
            $price_old_cop = stristr($price, ',');
            $pos = strrpos($price_old_cop, ' ');
            $price_old_cop = (int) substr($price_old_cop, 1, $pos);
            if (empty($price_old) || empty($price_old_cop)) {
                $price_old = 0;
                $price_old_cop = 0;
            }
            $price = $price_old + $price_old_cop / 100;

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();


            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = $img;
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

    public function TavriaParserSale()
    {
        $parser = new Parser;
        $tavria = $parser->parser('http://www.tavriav.org/actions/sale/');
        $shop = '\images\tavria-small.png';
        $name_action = $tavria->find('h1')->text();

        $parser->statusProductOff($name_action);

        foreach ($tavria->find("tbody tr") as $li) {
            $li = pq($li);

            $name = trim($li->find('td:first-child')->text());
            $price_sale = (float) $li->find('td:last-child')->text();
            $price = (float) $li->find('td:nth-child(2)')->text();

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->img = 'http://promotions/images/product.png';
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;

            $oldProduct = Product::where('name', $name)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

    public function Okwine()
    {
        $url = 'https://okwine.ua/action.html';
        $start = 0;
        $end = 100;

        $parser = new Parser;
        $name_action = 'Акции OKwine';
        $parser->statusProductOff($name_action);

        $this->OkwineParser($url, $start, $end);

        return true;
    }

    public function OkwineParser($url, $start, $end)
    {
        if ($start < $end) {

            $parser = new Parser;
            $okwine = $parser->parser($url);
            $name_action = 'Акции OKwine';
            $shop = '\images\okwine-small.png';

            foreach ($okwine->find(".block_product ") as $div) {

                $div = pq($div);

                $str = $div->find('.product-name a')->text();
                $name = substr($str,0, strpos($str, '/'));
                $desc = str_replace('/', '', substr($str, strpos($str, '/')));
                if(empty($desc)){
                    $desc = null;
                }

                $img = $div->find('img')->attr('src');

                $price_sale = (float) $div->find('.special-price span')->text();
                $price = (float) $div->find('.old-price span')->text();

                if (!empty($price_sale) && !empty($price)) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();
                $product->name_action = $name_action;
                $product->shop = $shop;
                $product->img = $img;
                $product->description = $desc;
                $product->name = $name;
                if (empty($price)) {
                    $price = null;
                    $sale = 0;
                }
                $product->price = $price;
                $product->price_sale = $price_sale;
                $product->sale = $sale;

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }

            $http = 'https://okwine.ua';
            $next1 = $okwine->find('.pagination .pagination-active')->next()->find('a')->attr('href');
            $url = $http . $next1;

            if (!empty($next1)) {
                $start++;
                $this->OkwineParser($url, $start, $end);
            }
        }
    }

    public function AntoshkaParser()
    {
        $parser = new Parser;
        $antoshka = $parser->parser('http://antoshka.ua/actions/offers/online');
        $shop = '\images\antoshka-small.png';
        $name_action = 'Акции и скидки Antoshka';

        $parser->statusProductOff($name_action);

        foreach ($antoshka->find(".offer-list__item") as $li) {
            $li = pq($li);

            $name = trim($li->find('.offer-title')->text());
            $desc = $li->find('.offer-description')->text();
            $img = $li->find('img')->attr('src');

            $li->find('.special-price .price span')->remove();
            $price_sale = trim($li->find('.special-price .price')->html());
            $price_sale = str_replace(",",'.',$price_sale);
            $price_sale = preg_replace("/[^x\d|*\.]/","",$price_sale);
            $price = str_replace(",",'.', str_replace('грн.', '', trim($li->find('.old-price .price')->text())));
            $price = preg_replace("/[^x\d|*\.]/","",$price);

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->description = $desc;
            $product->name_action = $name_action;
            $product->shop = $shop;
            $product->category_id = '14';
            $product->img = $img;
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }

}
