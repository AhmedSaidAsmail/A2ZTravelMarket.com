<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('st_price');
            $table->integer('sec_price');
            $table->integer('third_price')->nullable()->default(null);
            $table->boolean('private')->nullable()->dafault(0);
            $table->string('language')->nullable();
            $table->integer('capacity')->nullable()->default(null);
            $table->string('week_day');
            $table->time('starting_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('prices');
    }

}
