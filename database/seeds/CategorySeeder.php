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
                    'name'=>"grocery"
                ],
                [
                    'name'=>"bakery"
                ],
                [
                    'name'=>"sweet_dessert"
                ],
                [
                    'name'=>"ready_meals"
                ],
                [
                    'name'=>"vegetables_fruits"
                ],
                [
                    'name'=>"milk_egg"
                ],
                [
                    'name'=>"meat_fish"
                ],
                [
                    'name'=>"fish_products_caviar"
                ],
                [
                    'name'=>"frozen"
                ],
                [
                    'name'=>"tea_coffe"
                ],
                [
                    'name'=>"beverages"
                ],
                [
                    'name'=>"tobacco"
                ],
                [
                    'name'=>"goods_for_animals"
                ],
                [
                    'name'=>"goods_for_children"
                ],
                [
                    'name'=>"cosmetics_and_hygiene"
                ],
                [
                    'name'=>"goods_for_home"
                ],
                [
                    'name'=>"cosmetics_and_hygiene"
                ],
                [
                    'name'=>"clothes_shoes"
                ],
                [
                    'name'=>"household_goods"
                ]
            ]
        );
    }
}
