<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFamilySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('rgi_id')->unsigned();
            $table->string('type_housing', 200);
            $table->decimal('rent_value', 12, 2)->nullable();
            $table->boolean('family_bag')->default(false);
            $table->decimal('value_bag', 12, 2)->nullable();
            $table->boolean('inss_benefit')->default(false);;
            $table->decimal('value_inss_benefit', 12, 2)->nullable();
            $table->boolean('pension')->default(false);
            $table->decimal('pension_amount', 12, 2)->nullable();
            $table->decimal('drug_spending', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('rgi_id')->on('rgi')->references('id')
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
        Schema::dropIfExists('family_settings');
    }
}
