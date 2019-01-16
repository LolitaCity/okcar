<?php

namespace App\Services;

use App\Library\Util;
use App\Models\BrandInfo;

class BrandService
{

    private $validator = [
        'name' => 'required|min:1|max:50|unique:brand_info,name',
        'pinyin' => 'required|min:1|max:200',
        'logo' => 'required|min:1|max:200'
    ];

    private $errorMsg = [
        'name.unique' => '该品牌名已经存在',
        'name.*' => '名称必填且长度不能超过50',
        'pinyin.*' => '拼音必填且长度不超过200',
        'logo.*' => 'logo必填'
    ];

    public function getList()
    {
        return BrandInfo::withCount('modelInfoList')->orderBy('pinyin')->get()->toArray();
    }

    public function create(array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        return BrandInfo::create($data);
    }

    public function remove($id)
    {
        return BrandInfo::where('id', $id)->delete();
    }

    public function update($id, array $item)
    {
        $validator = array_merge($this->validator, [
            'name' => 'required|min:1|max:50|unique:brand_info,name,' . $id
        ]);
        $data = Util::validate($item, $validator, $this->errorMsg);
        return BrandInfo::where('id', $id)->update($data);
    }

}
