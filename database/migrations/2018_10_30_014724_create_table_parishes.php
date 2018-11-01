<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableParishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parishes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forania_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->date('opening_date')->nullable();
            $table->string('responsible');
            $table->string('cnpj', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('telephone', '45')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('forania_id')->on('foranias')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('address_id')->on('addresses')->references('id')
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
        Schema::dropIfExists('parishes');
    }
}
