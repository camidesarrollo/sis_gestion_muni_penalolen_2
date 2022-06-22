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
        Schema::connection('sqlsrv')->create('rols', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger("vigencia_id")->unsigned();
            $table->foreign("vigencia_id")->references("id")->on("vigencia");
            $table->bigInteger("privilegios_id")->unsigned();
            $table->foreign("privilegios_id")->references("id")->on("privilegios");
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
        Schema::dropIfExists('rols');
    }
};
