<?php
/**
 * 仓库数据验证
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Services;

use App\Models\StoreHouse;
use App\Library\Util;
use Illuminate\Support\Facades\Auth;

class StoreHouseService{
    /**
     * 新增仓库验证
     * 
     * @return #
     */
    public function create(array $item){
        $validator = [
            'province_code' => 'required|integer',
            'city_code' => 'required|integer',
            'area_code' =>'integer',
            'type'  =>"integer",
            'name'  =>'string',
            'address'   =>'string',
            'default_flag'  =>'integer'
        ];
        $errorMsg = [
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
        try {
            $data = Util::validate($item, $validator, $errorMsg);
            $data['created_id'] =Auth::user()->id;
            $data['updated_id'] =Auth::user()->id;
            $result =StoreHouse::create($data);
//            $condition  =[
//                'id'=>['<>',$result->id],
//                'created_id'=>$result->created_id
//            ];
            StoreHouse::where(function($query)use($result){
                $query->where('id','<>',$result->id)->where('created_id','=',$result->created_id);
            })->update(['default_flag'=>0]);
            return $result;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}