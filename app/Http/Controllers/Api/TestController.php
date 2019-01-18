<?php
/**
 * 上行接口
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-16
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Util;
use App\Models\User;

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
    public function index(Request $request){
        $area   = config("arealist");
        $key    =[];
        foreach ($area as $k=>$v){
            $key[]  =$k;
        }
        return $this->json($key);
    }
}