<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $debug = false;

    public function __construct()
    {
        $this->debug = (env('APP_ENV') == "local");
    }

    public function json($data = null)
    {
        return response()->json([
            'err' => 0,
            'msg' => 'ok',
            'data' => $data,
        ]);
    }

    public function validate($data, $rule, $info)
    {
        $validator = Validator::make($data, $rule, $info);
        $messages = $validator->messages();
        foreach ($messages->toArray() as $key => $value) {
            throw new AppException(array_first($value), 1);
        }
    }
}
