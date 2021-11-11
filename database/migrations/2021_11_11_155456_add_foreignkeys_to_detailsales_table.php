<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeysToDetailsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details_sales', function (Blueprint $table) {
            //
            $table->foreign('id_sales', 'fk_id__sales')->references('id')->on('sales')->onDelete('RESTRICT');
            $table->foreign('id_product', 'fk_id__product')->references('id')->on('product')->onDelete('RESTRICT');
      
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_sales', function (Blueprint $table) {
            //
        });
    }
}
