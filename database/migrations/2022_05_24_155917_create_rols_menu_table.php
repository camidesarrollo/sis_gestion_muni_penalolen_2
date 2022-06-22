<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrv')->create('rols_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_role')->unsigned();
            $table->bigInteger('id_menu')->unsigned();
            $table->foreign("id_role")->references("id")->on("rols");
            $table->foreign("id_menu")->references("id")->on("menus");
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
        Schema::dropIfExists('rols_menu');
    }
};
