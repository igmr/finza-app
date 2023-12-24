<?php

namespace App\Services;

class GenderService implements \App\Services\Interfaces\GenderInterface
{
    protected $model;
    public function __construct(\App\Models\Gender $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        return $this->model::all();
    }
    public function store(array $payload)
    {
        $data = new $this->model($payload);
        $data->save();
        return $data;
    }
    public function show(string|int $id)
    {
        try {
            return $this->model::findOrFail($id);
        } catch (\Exception $ex) {
            return new \stdClass();
        }
    }
    public function update(string|int $id, array $payload)
    {
        try {
            $data = $this->model::findOrFail($id);
            $data->update($payload);
            $data->save();
            return $data;
        } catch (\Exception $ex) {
            return new \stdClass();
        }
    }
    public function destroy(string|int $id)
    {
        try {
            $data = $this->model->findOrFail($id);
            $data->update(['status' => \App\Enums\StatusType::inactive->value]);
            $data->save();
            return $data->delete();
        } catch (\Exception $ex) {
            return false;
        }
    }
    public function restore(string|int $id)
    {
        try {
            $data = $this->model::withTrashed()->find($id);
            $data->update(['status' => \App\Enums\StatusType::active->value]);
            $data->save();
            return $data->restore();
        } catch (\Exception $ex) {
            return false;
        }
    }
}
