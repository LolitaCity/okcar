<?php
/**
 * 上行代码测试
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-16
 */
namespace App\Http\Controllers\Upstream;

use App\Http\Controllers\Controller;

class TestController extends Controller{
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 首选项
     * 
     * @return #
     */
    public function index(){
        echo 333;exit;
    }
}