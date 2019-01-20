<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppearanceDecorationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appearance_decoration', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('model_id')->comment('车型id')->default(0);
            $table->string('appearance', 100)->comment('外观')->default('');
            $table->string('decoration', 100)->comment('内饰')->default('');

            $table->index(['model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appearance_decoration');
    }
}
