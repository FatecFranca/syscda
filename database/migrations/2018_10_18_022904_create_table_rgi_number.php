<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRgiNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rgi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rgi_number')->unique();
            $table->integer('number');
            $table->integer('address_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->on('addresses')->references('id')
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
        Schema::dropIfExists('rgi');
    }
}
