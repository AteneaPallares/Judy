<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable;
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('roles')->insert(
            array(
                'name' => 'Administrador',
                'description'=>'Acceso total'
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Vendedor',
                'description'=>'Acceso total pacientes'
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Gerente',
                'description'=>'Acceso parcial a pacientes'
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Personal de almacén',
                'description'=>'Acceso parcial del sistema'
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
        Schema::dropIfExists('roles');
    }
}
