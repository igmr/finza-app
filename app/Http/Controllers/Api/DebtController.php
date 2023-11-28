<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\DebtFormRequest;
use App\Services\DebtService;
use stdClass;

class DebtController extends  ApiController
{
    protected $service;
    public function __construct(DebtService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(DebtFormRequest $req)
    {
        $payload = $req->validated();
        $this->isEmpty($payload);
        $payload = $this->setData(\App\Enums\MethodType::POST->value, $payload);
        $data    = $this->service->store($payload);
        return $this->responseCreated($data);
    }

    public function show(string $id)
    {
        return $this->service->show($id) ?? new stdClass();
    }

    public function update(DebtFormRequest $req, string $id)
    {
        $payload = $req->validated();
        $this->isEmpty($payload);
        $payload = $this->setData(\App\Enums\MethodType::PUT->value, $payload, $id);
        $data    = $this->service->update($id, $payload);
        return $this->responseUpdated($data);
    }

    public function destroy(string $id)
    {
        $this->service->destroy($id);
        return $this->responseDeleted();
    }

    public function restore(string $id)
    {
        $this->service->restore($id);
        return $this->responseRestored();
    }

    private function setData($method, $data, $id = 0)
    {
        switch ($method) {
            case 'POST':
                $data['cat_id'] = $data['category'] ?? null;
                return $data;
            case 'PUT':
                $debt = $this->service->show($id);
                $data['cat_id'] = $data['category'] ?? $debt->cat_id;
                return $data;
        }
    }
}
