<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->text('name');
            $table->text('country');
            $table->text('travel_agancy')->nullabe();
            $table->text('email');
            $table->text('hotel');
            $table->text('mobile');
            $table->text('arrival_flight_no')->nullable();
            $table->text('arrival_flight_time')->nullable();
            $table->text('departure_flight_no')->nullable();
            $table->text('departure_flight_time')->nullable();
            $table->text('arrival_date');
            $table->text('departure_date');
            $table->integer('tours');
            $table->float('total');
            $table->float('deposit');
            $table->boolean('paid')->default(0);
            $table->boolean('confirm')->nullable()->default(null);
            $table->boolean('admin_deleted')->deafult(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reservations');
    }

}
