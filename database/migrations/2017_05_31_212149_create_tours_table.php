<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id')->unsigned();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('price_id')->unsigned();
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->text('title');
            $table->float('price');
            $table->text('date');
            $table->integer('st_no');
            $table->integer('sec_no')->nullable()->defult(null);
            $table->integer('third_no')->nullable()->defult(null);
            $table->boolean('confirm')->default(0)->nullable();
            $table->boolean('supplier_deleted')->deafult(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tours');
    }

}
