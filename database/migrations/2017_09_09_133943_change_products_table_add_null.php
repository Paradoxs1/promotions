<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProductsTableAddNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //

            $table->integer('category_id')->nullable()->default(NULL)->change();
            $table->integer('tag_id')->nullable()->default(NULL)->change();
            $table->string('name')->nullable()->default(NULL)->change();
            $table->string('img')->nullable()->default(NULL)->change();
            $table->text('description')->nullable()->default(NULL)->change();
            $table->float('price')->nullable()->default(NULL)->change();
            $table->float('price_sale')->nullable()->default(NULL)->change();
            $table->integer('sale')->nullable()->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //

            $table->integer('category_id')->change();
            $table->integer('tag_id')->change();
            $table->string('name')->change();
            $table->string('img')->change();
            $table->text('description')->change();
            $table->float('price')->change();
            $table->float('price_sale')->change();
            $table->integer('sale')->change();

        });
    }
}
