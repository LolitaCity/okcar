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
        return $this->json($this->service->create(request()->all()));
    }
    
    /**
     * 获取指定所有用户所有仓库列表
     * 
     * @return #
     */
    public function getAllStoreHouseList(){
        return $this->json($this->service->allStoreHouseList(request()->all()));
    }
    
    /**
     * 获取指定用户仓库列表
     * 
     * @return #
     */
    public function getStoreHouseList(){
        return $this->json($this->service->storeHouseList(request()->all()));
    }
    
    /**
     * 获取指定仓库详情
     * 
     * @return #
     */
    public function getStoreHouseInfo(){
        return $this->json($this->service->storeHouseInfo(request()->all()));
    }
    
    /**
     * 修改仓库
     * 
     * return #
     */
    public function editStoreHouse(){
        return $this->json($this->service->editStoreHouse(request()->all()));
    }
    
    /**
     * 删除制定仓库
     * 
     * @return #
     */
    public function deleteStoreHouse(){
        return $this->json($this->service->deleteStoreHouse(request()->all()));
    }
}