<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('overall_rating');
            $table->integer('service_rating')->default(0)->nullable();
            $table->integer('organization_rating')->default(0)->nullable();
            $table->integer('value_rating')->default(0)->nullable();
            $table->integer('safety_rating')->default(0)->nullable();
            $table->text('title');
            $table->text('review');
            $table->text('visit_sort')->nullable();
            $table->date('visit_date')->nullable();
            $table->boolean('confirm')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reviews');
    }

}
