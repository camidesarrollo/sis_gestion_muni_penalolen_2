<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrv')->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('run');
            $table->string('dv');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('about_me')->nullable();
            
            $table->bigInteger("rol_id")->unsigned();
            $table->foreign("rol_id")->references("id")->on("rols");

            

            $table->bigInteger("vigencia_id")->unsigned();
            $table->foreign("vigencia_id")->references("id")->on("vigencia");

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
