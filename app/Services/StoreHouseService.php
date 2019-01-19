<?php
/**
 * 仓库管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Services;

use App\Models\StoreHouse;
use App\Library\Util;
use Illuminate\Support\Facades\Auth;

class StoreHouseService{
    private $validator = [
            'province_code' => 'required|integer',
            'city_code' => 'required|integer',
            'area_code' =>'integer',
            'type'  =>"integer",
            'name'  =>'string',
            'address'   =>'string',
            'default_flag'  =>'integer'
        ];
    private    $errorMsg = [
            'province_code.required'=> '省编码必填',
            'province_code.integer' => '省编码必须是整数',
            'city_code.required'=> '城市编码必填',
            'city_code.integer' => '城市编码必须是整数',
            'area_code.integer' => '地区编码必须是整数',
            'type.integer'      => '类型必须是数字',
            'name.*'    => '仓库名称不正确',
            'address.*' => '仓库地址不正确',
            'default_flag.*'    => '默认值必须为整数',            
        ];  
    /**
     * 新增仓库
     * 
     * @return #
     */
    public function createStoreHouse(array $item){            
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        $data['created_id'] =Auth::user()->id;
        $data['updated_id'] =Auth::user()->id;
        $result =StoreHouse::create($data);
        if($result && isset($data['default_flag'])&&$data['default_flag']==1){
            StoreHouse::where(function($query)use($result){
                $query->where('id','<>',$result->id)->where('created_id','=',$result->created_id);
            })->update(['default_flag'=>0]);
        }
        return $result;
    }
    
    /**
     * 获取指定用户仓库列表
     * 
     * @return #
     */
    public function storeHouseList(){
        $data['created_id'] =Auth::user()->id;
        return StoreHouse::where($data)->get();
    }
    
    /**
     * 获取全部用户全部仓库列表
     * 
     * @return #
     */
    public function allStoreHouseList(){
        return StoreHouse::where()->get();
    }
    
    /**
     * 获取指定仓库详细信息
     * 
     * @return #
     */
    public function storeHouseInfo(array $item){
        $validator = [
            'id' => 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '仓库不存在'
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        return StoreHouse::find($data);
    }
    
    /**
     * 编辑指定用户仓库详细详细
     * 
     * @return #
     */
    public function editStoreHouse(array $item){
        $validator = [
            'id' => 'required|integer',
        ];
        $errorMsg = [
            'id.*'=> '仓库不存在',            
        ]; 
        $data   =Util::validate($item, array_merge($this->validator,$validator), array_merge($this->errorMsg,$errorMsg));
        $data['updated_at'] =date("Y-m-d H:i:s");
        $data['updated_id'] =Auth::user()->id;
        $result =StoreHouse::where('id','=',$data['id'])->update($data);
        if($result && isset($data['default_flag'])&& $data['default_flag']==1){
            StoreHouse::where(function($query)use($result){
                $query->where('id','<>',$result->id)->where('created_id','=',$result->created_id);
            })->update(['default_flag'=>0]);
        }        
        return $result;
    }
    
    /**
     * 删除指定仓库
     * 
     * @return  #
     */
    public function deleteStoreHouse(array $item){
        $validator = [
            'id' => 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '仓库不存在'
        ];
        $data   =Util::validate($item, $validator, $errorMsg);
        if(StoreHouse::find($data['id'])->delete()){
            $map['updated_at']  =date("Y-m-d H:i:s");
            $map['updated_id']  =Auth::user()->id;
            StoreHouse::where($data)->update($map);
        }
        return true;
    }
}