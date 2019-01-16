<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealnameAuthenticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realname_authentication', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('user_id')->comment('用户id')->default(0);
            $table->string('idcard_front_pic', 200)->comment('身份证正面照片')->default('');
            $table->string('idcard_back_pic', 200)->comment('身份证背面照片')->default('');
            $table->string('card_pic', 200)->comment('名片照片')->default('');
            $table->string('idcard_num', 50)->comment('身份证号码')->default('');
            $table->string('realname', 50)->comment('真实姓名')->default('');
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
        Schema::dropIfExists('realname_authentication');
    }
}
