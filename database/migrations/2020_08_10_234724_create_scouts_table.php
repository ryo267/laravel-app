<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scouts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->comment('企業ID');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->text('text')->comment('本文');
            $table->softDeletes();
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
        Schema::dropIfExists('scouts');
    }
}
