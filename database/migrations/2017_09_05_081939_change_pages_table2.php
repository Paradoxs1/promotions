<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePagesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            //

            $table->string('h1')->nullable()->change();
            $table->string('content1')->nullable()->default(NULL)->change();
            $table->string('content2')->nullable()->default(NULL)->change();
            $table->string('content3')->nullable()->default(NULL)->change();
            $table->string('content4')->nullable()->default(NULL)->change();
            $table->string('content5')->nullable()->default(NULL)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
}
