<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFavourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_favour', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('user_id')->comment('用户id')->default(0);
            $table->integer('publish_id')->comment('发布车源id')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'publish_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_favour');
    }
}
