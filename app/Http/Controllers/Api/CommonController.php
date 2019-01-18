<?php
/**
 * 上行公共接口
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-17
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CommonController extends Controller{
    protected $storeModel;
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        parent::__construct();
        $this->storeModel   =new StoreHouseController();        //仓库
    }
    
    /**
     * 添加仓库
     * 
     * @return #
     */
    public function createHouse(){
        return $this->storeModel->creatStoreHouse();
    }
}