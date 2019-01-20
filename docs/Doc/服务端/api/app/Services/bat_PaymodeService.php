<?php

namespace App\Services;

use App\Library\Util;
use App\Models\PayModeInfo;

class PaymodeService
{

    private $validator = [
        'mode' => 'required|min:1|max:200',
        'description' => 'required|min:1|max:200'
    ];

    private $errorMsg = [
        'model.unique' => '该车型已经存在',
        'model.*' => '名称必填且长度不能超过50',
    ];

    public function getList()
    {
        return PayModeInfo::get()->toArray();
    }

    public function create(array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        return ModelInfo::create($data);
    }

    public function remove($id)
    {
        return ModelInfo::where('id', $id)->delete();
    }

    public function update($id, array $item)
    {
        $validator = array_merge($this->validator, [
            'model' => 'required|min:1|max:50|unique:model_info,model',
            'brand_id' => 'required|min:1|max:200',
            'series' => 'required|min:1|max:200',
            'series_id' => 'required|min:1|max:200',
            'produce_year' => 'required|min:1|max:200',
            'guide_price' => 'required|min:1|max:200',
            'manufactures' => 'required|min:1|max:200',
            'rule' => 'required|min:1|max:2'
        ]);
        $data = Util::validate($item, $validator, $this->errorMsg);
        return ModelInfo::where('id', $id)->update($data);
    }

}
