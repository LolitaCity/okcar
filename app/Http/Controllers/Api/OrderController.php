<?php
/**
 * 订单管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-19
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiOrderService;

class OrderController extends Controller{
    protected $service;
    protected $result;
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        $this->service   =new ApiOrderService();
    }
    /**
     * 订单列表
     * 
     * @return #
     */
    public function getOrderList(){
        $this->result['orderList']  =$this->service->orderList(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 指定订单信息
     * 
     * @return #
     */
    public function getOrderInfo(){
        $this->result['orderInfo']  =$this->service->orderInfo(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 获取订单详细信息
     * 
     * @return #
     */
    public function getOrderDetailedInfo(){
        $this->result['orderDetailedInfo']  =$this->service->orderDetailedInfo(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 获取订单地址信息
     * 
     * @return #
     */
    public function getOrderAddress(){
        $this->result['orderaddress']  =$this->service->orderAddress(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 新增订单
     * 
     * @return #
     */
    public function createOrder(){
        $this->result['newOrder']   =$this->service->createOrder(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 编辑订单
     * 
     * @return #
     */
    public function editOrder(){
        $this->result['editOrder']  =$this->service->editOrder(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 删除订单
     * 
     * @return #
     */
    public function deleteOrder(){
        $this->result['deleteOrder']=$this->service->editOrder(request()->all());
        return $this->json($this->result);
    }
    
    /**
     * 快捷编辑订单状态
     * 
     * @return #
     */
    public function setOrderStatus(){
        $this->result=$this->service->setOrderStatus(request()->all());
        return $this->json($this->result);
    }
}