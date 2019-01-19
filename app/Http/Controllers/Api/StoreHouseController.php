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
    protected $result;
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
        $this->result['createStoreHouse']   =$this->service->createStoreHouse(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 获取指定所有用户所有仓库列表
     * 
     * @return #
     */
    public function getAllStoreHouseList(){
        $this->result['allStoreHouseList']  =$this->service->allStoreHouseList(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 获取指定用户仓库列表
     * 
     * @return #
     */
    public function getStoreHouseList(){
        $this->result['storeHouseList'] =$this->service->storeHouseList(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 获取指定仓库详情
     * 
     * @return #
     */
    public function getStoreHouseInfo(){
        $this->result['storeHouseInfo'] =$this->service->storeHouseInfo(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 修改仓库
     * 
     * return #
     */
    public function editStoreHouse(){
        $this->result['editStoreHouse'] =$this->service->editStoreHouse(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 删除制定仓库
     * 
     * @return #
     */
    public function deleteStoreHouse(){
        $this->result['deleteStoreHouse']   =$this->service->deleteStoreHouse(request()->all());
        return $this->json($this->result);
    }
}