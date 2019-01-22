<?php
/**
 * 电子公章管理
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-22
 */
namespace App\Services;

use App\Models\Enterprise;
use App\Library\Util;
use Illuminate\Support\Facades\Auth;
use App\Models\EnterpriseAuthentication;
use App\Exceptions\AppException;
use App\Models\ElectronicSealAuth;
use App\Models\ElectronicAuthErr;

class SealService{
    protected $enAuthResult;
    private $validator = [
            'legal_person_name' => 'required|string',
            'legal_person_id_card' => 'required|integer|max:18|min:18',
            'legal_preson_phone' =>'required|integer|max:11|min:11'
        ];
    private    $errorMsg = [
            'legal_person_name.required'=> '请填写法人姓名',
            'legal_person_id_card.required' => '请填写法人身份证',
            'legal_person_id_card.*' => '法人身份证格式号码错误',
            'legal_preson_phone.*'=> '法人手机号码错误',          
        ];  
    /**
     * 构造函数
     * 
     * @return #
     */
    public function __construct() {
        //判断申请人是否企业认证
        $this->enAuthResult =EnterpriseAuthentication::where(['user_id'=> Auth::user()->id])->first();
        if(!isset($this->enAuthResult)||$this->enAuthResult['status']!==0){
            throw new AppException("未进行企业认证，请先完成企业认证",1);
        }
    }

    /**
     * 注册电子公章
     * 
     * @return #
     */
    public function registerSeal(array $item){    
        $validator = [
            'status' => 'required|integer|max:1|min:1'
        ];  
        $errorMsg = [
            'status.*'=> '申请流程错误'  
        ]; 
        $data = Util::validate($item, array_merge($validator,$this->validator), array_merge($errorMsg, $this->errorMsg));        
        $enterpriseInfo = Enterprise::where(['id'=>Auth::user()->en_id])->first();
        if(isset($enterpriseInfo['status']) && $enterpriseInfo['expire']>time() && $enterpriseInfo['status']==1){
            throw new AppException("电子公章审核中，请勿重复提交",1);
        }
        if(isset($enterpriseInfo['status']) && $enterpriseInfo['status']==3){
            throw new AppException("电子公章已存在，请勿重复提交",1);
        }
        $data['enterprise_name']=$this->enAuthResult['enterprise_name'];
        $data['expire'] =time()+48*3600;
        $result =Enterprise::where(['id'=>Auth::user()->en_id])->update($data);
        if($result!==false){
            return Enterprise::where(['id'=>Auth::user()->en_id])->first();
        }
        throw new AppException("电子公章注册申请错误，请稍后尝试",1);
    }
    
    /**
     * 电子公章使用授权申请
     * 
     * @return #
     */
    public function sealAuth(array $item){
        $validator = [
            'status' => 'required|integer|max:1|min:1'
        ];  
        $errorMsg = [
            'status.*'=> '申请流程错误'  
        ]; 
        $data = Util::validate($item, $validator, $errorMsg);
        $sealAuthInfo   = ElectronicSealAuth::where(['created_id'=>Auth::user()->id])->first();
        $enterpriseInfo = Enterprise::where(['id'=>Auth::user()->en_id])->first();
        if(!isset($enterpriseInfo)||$enterpriseInfo['status']!=3){
            throw new AppException("认证企业未进行电子公章注册，请先注册电子公章",1);
        }
        if(isset($sealAuthInfo) && $sealAuthInfo['expire']>time() &&$sealAuthInfo['status']==1){
            throw new AppException("申请待审核，请勿重复提交",1);
        }
        if(isset($sealAuthInfo) && $sealAuthInfo['status']==3){
            throw new AppException("授权已通过，请勿重复提交",1);
        }
        $data['expire'] =time()+48*3600;
        $result = ElectronicSealAuth::where(['created_id'=>Auth::user()->id])->update($data);
        if($result!==false){
            return ElectronicSealAuth::where(['created_id'=>Auth::user()->id])->first();
        }
        throw new AppException("电子公章使用授权申请错误，请稍后尝试",1);
    }
    
    /**
     * 电子公章注册反馈（第三方调用）
     * 
     * @return #
     */
    public function registerSealResult(array $item){
        $validator = [
            'status' => 'required|integer|max:3|min:2'
        ];  
        $errorMsg = [
            'status.*'=> '流程错误'  
        ]; 
        $data = Util::validate($item, $validator, $errorMsg);
        $enterpriseInfo = Enterprise::where(['id'=>Auth::user()->en_id])->first();
        if(isset($enterpriseInfo['status']) && $enterpriseInfo['status']==3){
            throw new AppException("认证企业已存在电子公章，请勿重复申请",1);
        }
        $data['expire'] ='';
        $data['remark'] =$item['remark'];
        return Enterprise::where(['id'=>Auth::user()->en_id])->update($data);
    }
    
    /**
     * 电子公章授权反馈（企业法人）
     * 
     * @return #
     */
    public function sealAuthResult(array $item){
        $validator = [
            'status' => 'required|integer|max:3|min:2'
        ];  
        $errorMsg = [
            'status.*'=> '流程错误'  
        ]; 
        $data = Util::validate($item, $validator, $errorMsg);
        $sealAuthInfo   = ElectronicSealAuth::where(['created_id'=>Auth::user()->id])->first();
        if(!isset($sealAuthInfo) ||$sealAuthInfo['status']==3){
            throw new AppException("授权已通过，请勿重复提交",1);
        }
        $data['expire']     ='';
        $data['remark']     =$item['remark'];        
        if($data['status']==2){
            //申请错误记录 
            $map['auth_id'] =$sealAuthInfo['id'];
            $map['remark']  =$item['remark'];
            $map['created_id']  =Auth::user()->id;
            ElectronicAuthErr::create($map);
        }
        return ElectronicSealAuth::where(['created_id'=>Auth::user()->id])->update($data);
    }
}