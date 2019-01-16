<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseAuthenticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_authentication', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('user_id')->comment('用户id')->default(0);
            $table->string('enterprise_name', 200)->comment('企业名称')->default('');
            $table->integer('enterprise_type')->comment('企业类型')->default(0);
            $table->string('legal_person_name', 50)->comment('法人名字')->default(0);
            $table->integer('area')->comment('所在城市')->default(0);
            $table->string('pic1', 200)->comment('图片1')->default('');
            $table->string('pic2', 200)->comment('图片2')->default('');
            $table->string('pic3', 200)->comment('图片3')->default('');
            $table->string('pic4', 200)->comment('图片4')->default('');
            $table->string('pic5', 200)->comment('图片5')->default('');
            $table->integer('status')->comment('状态')->default(0);
            $table->string('reason', 200)->comment('失败原因')->default('');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enterprise_authentication');
    }
}
