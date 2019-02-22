<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMembersFamilySetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_member_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('family_settings_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->string('degree_kinship', 12)->nullable();
            $table->integer('sacrament')->nullable();
            $table->string('profession', 45)->nullable();
            $table->string('work_company', 45)->nullable();
            $table->string('health_problem', 20)->nullable();
            $table->string('addiction', 45)->nullable();
            $table->boolean('deceased')->default(false);
            $table->boolean('responsible')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_member_settings');
    }
}
