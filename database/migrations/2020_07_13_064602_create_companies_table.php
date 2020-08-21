<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->unsignedInteger('id')->unique();
            $table->string('screen_name')->unique()->comment('アカウント名');
            $table->string('name');
            $table->text('profile_text')->nullable()->comment('プロフィールテキスト');
            $table->string('profile_image')->nullable()->comment('プロフィール画像');
            $table->string('back_image')->nullable()->comment('背景画像');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('companies');
    }
}
