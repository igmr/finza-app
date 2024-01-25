<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassificationService implements \App\Services\Interfaces\ClassificationInterface
{
    protected $model;
    public function __construct(\App\Models\Classification $model)
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

    public function datatable()
    {
        $data = DB::table('classifications')
            ->join('users', 'users.id', '=', 'classifications.usr_id')
            ->select(
                'classifications.id AS classification_id',
                'classifications.code',
                'classifications.name AS classification',
                'classifications.observation',
                'classifications.status',
                'classifications.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
    }

    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('classifications')
            ->join('users', 'users.id', '=', 'classifications.usr_id')
            ->select(
                'classifications.id AS classification_id',
                'classifications.code',
                'classifications.name AS classification',
                'classifications.observation',
                'classifications.status',
                'classifications.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('classifications')
            ->where('classifications.id', $id)
            ->join('users', 'users.id', '=', 'classifications.usr_id')
            ->select(
                'classifications.id AS classification_id',
                'classifications.code',
                'classifications.name AS classification',
                'classifications.observation',
                'classifications.status',
                'classifications.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
