<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_order', function (Blueprint $table) {
            $table->id();
            $table->double('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('id_order')->index('fk_id_order');
            $table->unsignedBigInteger('id_product')->index('fk_id_product_order');
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
        Schema::dropIfExists('detailes_order');
    }
}
