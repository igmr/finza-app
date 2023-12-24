<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GenderFormRequest;
use App\Services\GenderService;
use stdClass;

class GenderController extends Controller
{
    protected $service;
    public function __construct(GenderService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(GenderFormRequest $req)
    {
        $this->isEmpty($req->validated());
        $data = $this->service->store($req->validated());
        return $this->responseCreated($data);
    }

    public function show(string $id)
    {
        return $this->service->show($id) ?? new stdClass();
    }

    public function update(GenderFormRequest $req, string $id)
    {
        $this->isEmpty($req->validated());
        $data = $this->service->update($id, $req->validated());
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
}
