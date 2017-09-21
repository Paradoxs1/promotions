<?php

use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(
            [
                [
                    'name'=>"бакалея"
                ],
                [
                    'name'=>"хлебобулочные"
                ],
                [
                    'name'=>"сладкое, дессерт"
                ],
                [
                    'name'=>"готовые блюда"
                ],
                [
                    'name'=>"овощи и фрукты"
                ],
                [
                    'name'=>"молочные продукты, яйца"
                ],
                [
                    'name'=>"мясо, рыба"
                ],
                [
                    'name'=>"рыбные продукты, икра"
                ],
                [
                    'name'=>"замороженные продукты"
                ],
                [
                    'name'=>"чай, кофе"
                ],
                [
                    'name'=>"напитки"
                ],
                [
                    'name'=>"табак"
                ],
                [
                    'name'=>"товары для животных"
                ],
                [
                    'name'=>"товары для детей"
                ],
                [
                    'name'=>"косметика гигиена"
                ],
                [
                    'name'=>"товары для дома"
                ],
                [
                    'name'=>"косметика и гигиена"
                ],
                [
                    'name'=>"одежда, обувь"
                ]
            ]
        );
    }
}
