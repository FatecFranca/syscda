<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypePersonTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_person_types', function (Blueprint $table) {
            $table->integer('person_id')->unsigned();
            $table->integer('type_people_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_people_id')->on('type_people')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('person_id')->on('people')->references('id')
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
        Schema::dropIfExists('type_person_types');
    }
}
