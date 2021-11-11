<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_sales', function (Blueprint $table) {
            $table->id();
            $table->double('cost');
            $table->integer('quantiy');
            $table->unsignedBigInteger('id_sales')->index('fk_id_sales');
            $table->unsignedBigInteger('id_product')->index('fk_id_product');
            
           
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
        Schema::dropIfExists('details_sales');
    }
}
