<?php
/**
 * 订单管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-18
 */
namespace App\Services;

use App\Library\Util;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\PublishInfo;
use App\Models\ModelInfo;
use App\Models\BrandInfo;
use App\Models\OrderInfos;
use App\Models\StoreHouse;
use App\Http\Controllers\Api\AreaListController;
use App\Models\OrderAddress;
use App\Models\OrderOptionRecord;
use App\Exceptions\AppException;

class ApiOrderService{
    private $validator = [
            'buyer_id'  =>'integer',
            'seller_id' =>'integer',
            'publish_id'=>'required|integer',
            'number'    =>"required|integer",
            'ratio'     =>"string",
            'comment'   =>"string",
            'status'    =>"integer",
            'store_id'  =>'required|integer',
        ];
    private $errorMsg = [
            'buyer_id.integer'  => '买家id必须为整数',
            'seller_id.integer' => '卖家id必须为整数',
            'publish_id.*' => '发布商品不存在',
            'number'=> '购买数量不正确',
            'ratio' => '垫资比例不正确',
            'comment' => '备注说明格式错误',
            'status' => '状态必须为整数',
            'store_id' => '仓库id不能为空'
        ]; 
    public function createOrder(array $item){
        $data = Util::validate($item,$this->validator,$this->errorMsg);
        $data['buyer_id']   =Auth::user()->id;
        $data['seller_id']  = PublishInfo::where('id','=',$data['publish_id'])->value('user_id');
        $data['status'] =1;
        //创建订单
        $createOrder=Order::create($data);
        //获取发布商品信息
        $publishInfo=PublishInfo::find(['id'=>$data['publish_id']]);
        //获取模型信息
        $modelInfo  =ModelInfo::find(['id'=>$publishInfo['model_info_id']]);
        //获取品牌信息
        $brandInfo  =BrandInfo::find(['id'=>$modelInfo['brand_id']]);
        //获取仓库信息
        $storeHouse =StoreHouse::find(['id'=>$data['store_id']]);        
        //获取地区信息
        $areaModel  =new AreaListController();
        $areaInfo   =json_decode($areaModel->getAreaInfo($storeHouse['city_code']),true);
        //组装订单详情
        $publishInfo['type']        =($publishInfo['type']==0)?"自发布":"爬虫";
        $publishInfo['stock']       =($publishInfo['stock']==0)?"是":"否";
        $publishInfo['brand_name']  =$brandInfo['name'];
        $publishInfo['brand_pinyin']=$brandInfo['pinyin'];
        $publishInfo['series_name'] =$modelInfo['series'];
        $publishInfo['model']       =$modelInfo['model'];
        $publishInfo['produce_year']=$modelInfo['produce_year'];
        $publishInfo['guide_price'] =$modelInfo['guide_price'];
        $publishInfo['manufactures']=$modelInfo['manufactures'];
        $publishInfo['rule']        =$modelInfo['rule'];
        $publishInfo['order_id']    =$createOrder['id'];
        //创建订单详情
        $createOrderInfo=OrderInfos::create($publishInfo);
        //组装地址详情
        $storeHouse['type']     =($storeHouse['type']==0)?'集中仓':"经销商仓";
        $storeHouse['province'] =$areaInfo['name'];
        $storeHouse['city']     =$areaInfo['area_name'];
        $storeHouse['area']     ='';
        $storeHouse['order_id'] =$createOrder['id'];
        //创建收货地址
        $createOrderAddress = OrderAddress::create($storeHouse);
        //操作纪录
        $map['user_id'] =Auth::user()->id;
        $map['remark']  ="发起订单";
        $coreteOrderOptionRecord= OrderOptionRecord::create($map);
        DB::beginTransaction();
        if($createOrder && $createOrderInfo &&$createOrderAddress&&$coreteOrderOptionRecord){
            DB::commit();
            return [
                'createOrder'       =>$createOrder,
                'createOrderInfo'   =>$createOrderInfo,
                'createOrderAddress'=>$createOrderAddress,
            ];
        }
        DB::rollback();
        throw new AppException('订单创建失败');
    }

    /**
     * 订单列表
     * 
     * @return #
     */
    public function orderList(array $item){
        $validator  =[
            'order_type'=>'required|integer',
        ];
        $errorMsg   =[
            'order.*'   =>"订单类型必须填写",
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        if($data['type']==1){
            $map['buyer_id']    =Auth::user()->id;
        }else{
            $map['seller_id']   =Auth::user()->id;
        }
        return Order::where($map)->get();
    }
    
    /**
     * 获取全部用户全部订单列表
     * 
     * @return #
     */
    public function allStoreHouseList(){
        return Order::get();
    }
    
    /**
     * 获取指定订单信息
     * 
     * @return #
     */
    public function orderInfo(array $item){
        $validator = [
            'id' => 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '订单不存在'
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        return Order::find($data);
    }
    
    /**
     * 获取指定订单详细信息
     * 
     * @return #
     */
    public function OrderDetailedInfo(array $item){
        $validator = [
            'order_id' => 'required|integer'
        ];
        $errorMsg = [
            'order_id.*'=> '订单不存在'
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        return OrderInfos::find($data);
    }
    
    /**
     * 获取指定订单地址信息
     * 
     * @return #
     */
    public function orderAddress(array $item){
        $validator = [
            'order_id' => 'required|integer'
        ];
        $errorMsg = [
            'order_id.*'=> '订单不存在'
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        return OrderAddress::find($data);
    }
            
    /**
     * 删除指定订单
     * 
     * @return  #
     */
    public function deleteStoreHouse(array $item){
        $validator = [
            'id' => 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '订单不存在'
        ];
        $data   =Util::validate($item, $validator, $errorMsg);
        $map=[
            'user_id'   =>Auth::user()->id,
            'remark'    =>"删除订单",
        ];
        $orderRecord    =OrderOptionRecord::create($map);
        $deleteResult   =Order::find($data['id'])->delete();
        $updateResult   =Order::where($data)->update(['updated_at'=>date("Y-m-d H:i:s")]);
        DB::beginTransaction();
        if($deleteResult && $orderRecord && $updateResult){
            DB::commit();
            return true;
        }
        DB::rollback();
        throw new AppException('删除订单失败',1);
    }
    
    /**
     * 编辑订单
     * 
     * @return #
     */
    public function editOrder(array $item){
        $validator = [
            'id' => 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '订单不存在'
        ];
        $data = Util::validate($item, array_merge($this->validator,$validator), array_merge($this->errorMsg,$errorMsg));
        $map=[
            'user_id'   =>Auth::user()->id,
            'remark'    =>"编辑订单",
        ];
        $orderRecord=OrderOptionRecord::create($map);
        $result     =Order::where("id",'=',$data['id'])->update(['updated_at'=>date("Y-m-d H:i:s")]);
        DB::beginTransaction();
        if($result && $orderRecord){
            DB::commit();
            return $result;
        }
        DB::rollback();
        throw new AppException('编辑订单失败',1);
    }
    
    /**
     * 快捷编辑订单状态
     * 
     * @return #
     */
    public function setOrderStatus(array $item){
        $validator = [
            'id'    => 'required|integer',
            'status'=> 'required|integer'
        ];
        $errorMsg = [
            'id.*'=> '订单不存在',
            'status.*'=> '订单状态错误'
        ];
        $data   =Util::validate($item,$validator,$errorMsg);
        if($data['status']==1){$remark="买家发起订单";}
        if($data['status']==2){$remark="卖家确定订单";}
        if($data['status']==3){$remark="买家提交订单";}
        if($data['status']==4){$remark="平台核对订单";}
        if($data['status']==5){$remark="资方垫资确认";}
        if($data['status']==6){$remark="买家支付定金";}
        if($data['status']==7){$remark="平台验车";}
        if($data['status']==8){$remark="买家验车";}
        if($data['status']==9){$remark="订单完结";}
        $map=[
            'user_id'   =>Auth::user()->id,
            'remark'    =>$remark,
        ];
        $orderRecord=OrderOptionRecord::create($map);
        $result =Order::where("id",'=',$data['id'])->update(['status'=>$data['status']]);
        DB::beginTransaction();
        if($result && $orderRecord){
            DB::commit();
            return $result;
        }
        DB::rollback();
        throw new AppException('订单状态编辑失败');
    }
}