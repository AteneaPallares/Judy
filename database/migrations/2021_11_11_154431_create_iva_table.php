<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iva', function (Blueprint $table) {
            $table->id();
            $table->double('porcentage');
            $table->timestamp('start');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('iva')->insert(
            array(
                'porcentage' => '16',
                'start'=>'2021-11-23'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iva');
    }
}
