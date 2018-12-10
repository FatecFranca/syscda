<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiocese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dioceses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rgi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->date('opening_date')->nullable();
            $table->string('responsible');
            $table->string('telephone', '45')->nullable();
            $table->string('cnpj', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('rgi_id')->on('rgi')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dioceses');
    }
}
