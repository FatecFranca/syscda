<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('rgi_id')->unsigned();
            $table->integer('parish_id')->unsigned();
            $table->string('name', 500);
            $table->string('nickname', 100)->nullable();
            $table->date('date_birthday');
            $table->string('cpf', 11);
            $table->string('email')->unique()->nullable();
            $table->string('telephone', 11)->nullable();
            $table->string('marital_status', 12);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('rgi_id')->on('rgi')->references('id')
                ->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('parish_id')->on('parishes')->references('id')
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
        Schema::dropIfExists('people');
    }
}
