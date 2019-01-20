<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('buyer_id')->comment('用户id')->default(0);
            $table->integer('publish_id')->comment('发布id')->default(0);
            $table->integer('number')->comment('数量')->default(0);
            $table->integer('address')->comment('编号')->default(0);
            $table->integer('pay_mode_id')->comment('金融方案')->default(0);
            $table->string('comment', 500)->comment('备注')->default('');
            $table->integer('status')->comment('状态')->default(0);
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
        Schema::dropIfExists('order');
    }
}
