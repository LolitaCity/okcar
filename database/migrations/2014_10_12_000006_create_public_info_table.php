<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *w
     * @return void
     */
    public function up()
    {
        Schema::create('public_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('user_id')->comment('发布用户id')->default(0);
            $table->integer('type')->comment('发布者类型，0:自发布，1:爬虫')->default(0);
            $table->string('enterprise_name', '100')->comment('公司名称')->default('');
            $table->integer('model_info_id')->comment('车型id')->default(0);
            $table->string('custom_model', 200)->comment('自定义车型')->default('');
            $table->string('appearance', 100)->comment('外观')->default('');
            $table->string('decoration', 100)->comment('内饰')->default('');
            $table->integer('stock')->comment('是否现车')->default(0);
            $table->integer('quantity')->comment('数量')->default(0);
            $table->integer('sale_price')->comment('销售价')->default(0);
            $table->integer('source')->comment('区域')->default(0);
            $table->string('sale_area')->comment('可售区域')->default(0);
            $table->integer('formalities')->comment('手续情况')->default(0);
            $table->integer('ticket_type')->comment('票据来源')->default(0);
            $table->string('comment', 500)->comment('备注')->default('');
            $table->string('pics', 1000)->comment('图片')->default('');
            $table->integer('status')->comment('状态')->default(0);
            $table->integer('access_count')->comment('访问次数')->default(0);
            $table->datetime('expire')->default('0000-01-01 00:00:00');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['model_info_id']);
            $table->index(['user_id']);
            $table->index(['type']);
            $table->index(['enterprise_name']);
            $table->index(['custom_model']);
            $table->index(['appearance']);
            $table->index(['decoration']);
            $table->index(['sale_area']);
            $table->index(['formalities']);
            $table->index(['ticket_type']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_info');
    }
}
