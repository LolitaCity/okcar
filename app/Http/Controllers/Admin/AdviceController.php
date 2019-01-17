<?php
/**
 * 用户建议
 * 
 * @author nobody
 * @date    2019-01-17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdviceService;
use Request;


class AdviceController extends Controller
{
    private $service;

    public function __construct(AdviceService $service)
    {
        $this->service = $service;
    }

    public function getList()
    {
        return $this->json($this->service->getList());
    }

}
