<?php
/**
 * 问题反馈管理
 * 
 * @author  nobody
 * @date    2019-01-17
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;


class QaController extends Controller
{
    private $service;

    public function __construct(QuestionService $service)
    {
        $this->service = $service;
    }

    public function getList()
    {
        return $this->json([
            'items' => $this->service->getList()
        ]);
    }

    public function get()
    {
        return $this->json($this->service->get(request()->input('id')));
    }

    public function add()
    {
        return $this->json($this->service->create(request()->all()));
    }

    public function delete()
    {
        return $this->json([
            'success' => $this->service->remove(request()->input('id'))
        ]);
    }

    public function edit()
    {
        return $this->json([
            'success' => $this->service->update(request()->input('id'), request()->all())
        ]);
    }

    public function move()
    {
        return $this->json([
            'success' => $this->service->move(request()->input('id'), !empty(request()->input('up')))
        ]);
    }
}
