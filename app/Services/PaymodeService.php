<?php

namespace App\Services;

use App\Library\Util;
use App\Models\PayModeInfo;

class PaymodeService
{

    private $validator = [
        'mode' => 'required|min:1|max:200',
        'description' => 'required|min:1|max:200',
        'type' => 'required|min:1|max:2'
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
        return PayModeInfo::create($data);
    }

    public function remove($id)
    {
        return PayModeInfo::where('id', $id)->delete();
    }

    public function update($id, array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        return PayModeInfo::where('id', $id)->update($data);
    }

}
