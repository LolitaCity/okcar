<?php

namespace App\Services;

use App\Library\Util;
use App\Models\Question;

class QuestionService
{

    private $validator = [
        'title' => 'required|min:1|max:500',
        'content' => 'required',
    ];

    private $errorMsg = [
        'title.*' => '标题格式不正确',
        'content.*' => '内容必填',
    ];

    public function getList()
    {
        return Question::orderBy('weight')->get()->toArray();
    }

    public function get($id)
    {
        return Question::find($id);
    }

    public function create(array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        $data['weight'] = 0;
        $model = Question::create($data);
        if (!empty($model->id)) {
            return Question::where('id', $model->id)->update(['weight' => $model->id]);
        }
        return 0;
    }

    public function remove($id)
    {
        return Question::where('id', $id)->delete();
    }

    public function update($id, array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        return Question::where('id', $id)->update($data);
    }

    public function move($id, $up = true)
    {
        $item1 = Question::find($id);
        if (empty($item1)) {
            return false;
        }
        if ($up) {
            $item2 = Question::where('weight', '<', $item1->weight)->orderBy('weight', 'desc')->first();
        } else {
            $item2 = Question::where('weight', '>', $item1->weight)->orderBy('weight', 'asc')->first();
        }
        if (empty($item2)) {
            return false;
        }
        return Question::where('id', $item1->id)->update(['weight' => $item2->weight]) &&
            Question::where('id', $item2->id)->update(['weight' => $item1->weight]);
    }

}
