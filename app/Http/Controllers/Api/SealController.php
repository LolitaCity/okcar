<?php
/**
 * 电子公章管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-22
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SealService;

class SealController extends Controller{    
    protected $service;
    protected $result;
    protected $data;
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        $this->service  =new SealService();
        $this->data     =json_decode(request()->input('data'),true);
    }
    
    /**
     * 电子公章注册
     * 
     * @return #
     */
    public function registerSeal(){
        $this->data['status']   =1;
        $this->result['seal']   =$this->service->registerSeal($this->data);
        return $this->json($this->result);
    }
    
    /**
     * 电子公章使用授权申请
     * 
     * @return #
     */
    public function sealAuth(){
        $this->data['status']   =1;
        $this->result['seal']   =$this->service->sealAuth($this->data);
        return $this->json($this->result);
    }
    
    /**
     * 电子公章注册反馈
     * 
     * @return #
     */
    public function registerSealResult(){
        $this->service->registerSealResult($this->data);
    }
    
    /**
     * 电子公章企业法人授权反馈
     * 
     * @return #
     */
    public function sealAuthResult(){
        $this->service->sealAuthResult($this->data);
    }
}