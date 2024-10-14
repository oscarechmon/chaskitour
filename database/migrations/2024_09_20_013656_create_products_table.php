<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('product');
            $table->string('tour');
            $table->string('daily_departures');
            $table->string('itinerary');
            $table->double('price_per_person',10,2)->nullable();
            $table->string('main_image')->nullable();
            $table->string('main_video')->nullable();
            $table->boolean('status')->default(1);            
            $table->foreign('category_id')->references('id')->on('categories');     
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
        Schema::dropIfExists('products');
    }
}
