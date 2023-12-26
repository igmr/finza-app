<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryService implements \App\Services\Interfaces\CategoryInterface
{
    protected $model;
    public function __construct(\App\Models\Category $model)
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

    public function list(Request $req)
    {
        try {
            return DB::table('categories')
                ->join('users', 'users.id', '=', 'categories.usr_id')
                ->join('genders', 'genders.id', '=', 'categories.gen_id')
                ->select(
                    'categories.id AS category_id',
                    'categories.code',
                    'categories.name AS category',
                    'categories.observation',
                    'categories.status',
                    'categories.created_at',
                    'genders.id AS gender_id',
                    'genders.name AS gender',
                    DB::raw('if(isnull(users.id), 0, users.id) usr_id'),
                    DB::raw('if(isnull(users.name), "Administrator", users.name) user')
                )->paginate(2);
        } catch (\Exception $e) {
            //return $e->getMessage();
            return [];
        }
    }

    public function info(string $id)
    {
        try {

            return DB::table('categories')
                ->join('users', 'users.id', '=', 'categories.usr_id')
                ->join('genders', 'genders.id', '=', 'categories.gen_id')
                ->where('categories.id', '=', $id)
                ->select(
                    'categories.id AS category_id',
                    'categories.code',
                    'categories.name AS category',
                    'categories.observation',
                    'categories.status',
                    'categories.created_at',
                    'genders.id AS gender_id',
                    'genders.name AS gender',
                    DB::raw('if(isnull(users.id), 0, users.id) usr_id'),
                    DB::raw('if(isnull(users.name), "Administrator", users.name) user')
                )->first();
        } catch (\Exception $e) {
            //return $e->getMessage();
            return null;
        }
    }

    public function select()
    {
        return $this->model::all();
    }
}

