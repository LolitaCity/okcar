<?php
/**
 * 地区管理列表
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-19
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\AppException;
use App\Models\OkcarStoreHouse;
use App\Models\Area;

class AreaController extends Controller{
    protected $result;
    /**
     * 地区列表
     * 
     * @return #
     */
    public function getAreaList(){
        $this->result['areaList']   =config('arealist');
        return $this->json($this->result);
    }
    
    /**
     * 获取指定地区
     * 
     * @return #
     */
    public function getAreaInfo($map=[]){
        if(request()->all()){
            $map=request()->all();
        }
        if(!isset($map['area_code'])){
            throw new AppException("地区code不能为空", 1);
        }
        $areaList   =config('arealist');
        $areaArr    =[];
        $areaInfo   =[];
        foreach($areaList as $vo){
            if($vo['id']==substr($map['area_code'],0,2)){
                $areaArr[]  =$vo;
            }
        }
        foreach ($areaArr[0]['sub'] as $vo){
            if($vo['id']==$map['area_code']){
                $areaInfo[] =$vo;
            }
        }
        $this->result['areaInfo']['id']     =$areaArr[0]['id'];
        $this->result['areaInfo']['name']   =$areaArr[0]['name'];
        $this->result['areaInfo']['code']   =$areaInfo[0]['id'];
        $this->result['areaInfo']['area_name']  =$areaInfo[0]['name'];
        return $this->json($this->result);
    }
    
    /**
     * 
     */
    public function getareaStoreHouseList(){
        $t1 = microtime(true);
        $areaList= Area::get();
        $storeHouseList = OkcarStoreHouse::get();
        $result =[
            'areaList'  =>$areaList,
            'storeHouseList'=>$storeHouseList
        ];
        $t2 = microtime(true);
        echo '耗时'.round($t2-$t1,3).'秒';exit;
        return $this->json($result);
    }
}