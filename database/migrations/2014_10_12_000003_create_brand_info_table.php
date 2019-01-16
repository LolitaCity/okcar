<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->string('name', 100)->comment('品牌名称')->default('');
            $table->string('logo', 200)->comment('品牌图标')->default('');
            $table->string('pinyin', 200)->comment('品牌拼音')->default('');
            $table->integer('flag')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_info');
    }
}
