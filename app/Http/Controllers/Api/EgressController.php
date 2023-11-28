<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\EgressFormRequest;
use App\Services\EgressService;
use stdClass;

class EgressController extends ApiController
{
    protected $service;
    public function __construct(EgressService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(EgressFormRequest $req)
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

    public function update(EgressFormRequest $req, string $id)
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
                $data['sav_id'] = $data['saving']   ?? null;
                $data['deb_id'] = $data['debt']     ?? null;
                $data['acc_id'] = $data['account']  ?? null;
                return $data;
            case 'PUT':
                $egress = $this->service->show($id);
                $data['cat_id'] = $data['category'] ?? $egress->cat_id;
                $data['sav_id'] = $data['saving']   ?? $egress->sav_id;
                $data['deb_id'] = $data['debt']     ?? $egress->deb_id;
                $data['acc_id'] = $data['account']  ?? $egress->acc_id;
                return $data;
        }
    }
}
