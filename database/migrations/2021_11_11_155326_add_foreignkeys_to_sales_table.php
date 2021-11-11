<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeysToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
            $table->foreign('id_employee', 'fk_id__employee')->references('id')->on('users')->onDelete('RESTRICT');
            $table->foreign('id_client', 'fk_id__client')->references('id')->on('client')->onDelete('RESTRICT');
      
        });
    }
}
