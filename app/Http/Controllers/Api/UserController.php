<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserFormRequest;
use App\Services\Interfaces\UserInterface;
use stdClass;

class UserController extends ApiController
{
    protected $service;
    public function __construct(UserInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(UserFormRequest $req)
    {
        $this->isEmpty($req->validated());
        $data = $this->service->store($req->validated());
        return $this->responseCreated($data);
    }

    public function show(string $id)
    {
        return $this->service->show($id) ?? new stdClass();
    }

    public function update(UserFormRequest $req, string $id)
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
