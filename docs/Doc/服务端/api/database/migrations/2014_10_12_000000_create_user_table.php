<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->string('phone', 50)->unique()->comment('手机号')->default('');
            $table->string('name', 100)->comment('昵称')->default('');
            $table->string('password', 100)->comment('密码')->default('');
            $table->string('head_img', 200)->comment('头像')->default('');
            $table->string('sale_brand', 100)->comment('销售品牌')->default('');
            $table->string('company_name', 100)->comment('公司名称')->default('');
            $table->string('selfdesc', 1024)->comment('个人简介')->default('');
            $table->string('huanxin_password', '16')->commenct('环信密码')->default('');
            $table->string('huanxin_id', 128)->comment('环信id');
            $table->integer('area')->comment('地区')->default(0);
            $table->rememberToken()->comment('登录凭证');
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
        Schema::dropIfExists('user');
    }
}
