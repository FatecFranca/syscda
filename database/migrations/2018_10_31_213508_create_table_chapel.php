<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parish_id')->unsigned();
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

            $table->foreign('parish_id')->on('parishes')->references('id')
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
        Schema::dropIfExists('chapels');
    }
}
