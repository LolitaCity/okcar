<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('brand_id')->comment('品牌id')->default(0);
            $table->string('series', 100)->comment('车系名称')->default('');
            $table->string('model', 200)->comment('车型详细名称')->default('');
            $table->string('produce_year', 100)->comment('生产年限')->default('');
            $table->integer('guide_price')->comment('指导价')->default(0);
            $table->string('manufactures', 100)->comment('生产厂家')->default('');
            $table->integer('rule')->comment('规格')->default(0);
            $table->timestamps();

            $table->index(['brand_id']);
            $table->index(['series']);
            $table->index(['model']);
            $table->index(['produce_year']);
            $table->index(['guide_price']);
            $table->index(['manufactures']);
            $table->index(['rule']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_info');
    }
}
