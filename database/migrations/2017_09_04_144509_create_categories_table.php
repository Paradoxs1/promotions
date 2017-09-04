<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table=categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('shop_id');
            $table->string('name');
            $table->string('img');
            $table->unsignedTinyInteger('status')->default('1');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table=categories');
    }
}
