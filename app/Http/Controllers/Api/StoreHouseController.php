<?php
/**
 * 仓库管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StoreHouseService;

class StoreHouseController extends Controller{
    protected $service;
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        $this->service   =new StoreHouseService();
    }
    
    /**
     * 新建仓库
     * 
     * @return #
     */
    public function creatStoreHouse(){
        $result =$this->service->create(request()->all());        
        return $this->json($result);
    }
}