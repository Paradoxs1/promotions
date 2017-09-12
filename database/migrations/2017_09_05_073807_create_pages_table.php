<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_page')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('h1')->nullable()->change();
            $table->text('content1')->nullable()->default(NULL)->change();
            $table->text('content2')->nullable()->default(NULL)->change();
            $table->text('content3')->nullable()->default(NULL)->change();
            $table->text('content4')->nullable()->default(NULL)->change();
            $table->text('content5')->nullable()->default(NULL)->change();
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
        Schema::dropIfExists('pages');
    }
}
