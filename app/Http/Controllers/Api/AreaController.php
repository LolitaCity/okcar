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
        $areaList= Area::get()->toArray();
//        foreach($areaList as $k=>$v){
//            if(substr($v['id'],2)==='0000'){
//                $a[$k]=[
//                    'id'    =>$v['id'],
//                    'name'  =>$v['province'],
//                ];                
//            }
//        }
//        unset($a['3311']);
//        unset($a['3312']);
//        $b=[];
//        foreach ($a as $k=>$vo){
//            foreach ($areaList as $v){
//            
//                if(substr($v['id'],2)!='0000' && substr($v['id'],0,2)==substr($v['id'],0,2)){
//                    $b[$k]=[
//                        'id'=>$vo['id'],
//                        'name'  =>$vo['name'],
//                        'sub'   =>[$k=>['id'=>$v['id'],['name'=>$v['city']]]
//                        ]
//                    ];
//                }
//            }
//        }
        $c=[];
        foreach($areaList as $vo){
            if(substr($vo['id'],2)!='0000' && substr($vo['id'],4)!=='00'){
                $c[]=[
                    'id'    =>$vo['id'],
                    'name'  =>$vo['district']
                ];
            }
        }
        $b=[];     
        foreach ($areaList as $vo){
                if(substr($vo['id'],2)!='0000' && substr($vo['id'],4)==='00'){
                    $b[]=[
                        'id'    =>$vo['id'],
                        'name'  =>$vo['city'],
                    ];                   
                }
        }
        $a=[];
        foreach ($areaList as $v){
            if(substr($v['id'],2)==='0000'){
                $a[]=[
                    'id'    =>$v['id'],
                    'name'  =>$v['province']
                ];
            }
        }
        $xxx=[];
        foreach ($b as $bbb){
            $xxx[$bbb['id']]=[
                'id'    =>$bbb['id'],
                'name'  =>$bbb['name']
            ];
            foreach ($c as $ccc){
                if(substr($bbb['id'],0,4)==substr($ccc['id'],0,4)){
                    $xxx[$bbb['id']]['sub'][]=$ccc;
                }
            }
        }
        $i=0;
        foreach($a as $aa){
            $aaa[$i]    =[
                'id'=>$aa['id'],
                'name'  =>$aa['name'],
            ];
            foreach ($xxx as $bb){
                if(substr($aa['id'],0,2)==substr($bb['id'],0,2)){
                    $aaa[$i]['sub'][]=$bb;
                }
            }
            $i++;
        }
//        print_r($aaa);exit;
//        
//        $storeHouseList = OkcarStoreHouse::get();
//        $result =[
//            'areaList'  =>$areaList,
//            'storeHouseList'=>$storeHouseList
//        ];
        return $this->json(['areaList'=>$aaa]);
    }
    
    /**
     * 测试
     */
    public function test(){
        $areaLists      = Area::get()->toArray();
        $newArealList   = config('newarealist');
        $arealList      = config('arealist');
        $b=[];     
        foreach ($areaLists as $vo){
                if(substr($vo['id'],2)!='0000' && substr($vo['id'],4)==='00'){
                    $b[]=[
                        'id'    =>$vo['id'],
                        'name'  =>$vo['city'],
                    ];                   
                }
        }
        
        var_dump($arealList);exit;
        $oldcity=[];
        foreach ($arealList as $vo){
            
        }
        
        
        
        
        foreach($b as $k=>$bb){
            foreach($arealList as $vo){
                if(mb_substr($bb['name'],0,2)==mb_substr($vo['name'],0,2)){
                    $b[$k]['id']=$vo['id'];
                }
            }
        }
        var_dump($b);exit;
        return $this->json($b);
    }
    
}