<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingService implements \App\Services\Interfaces\SavingInterface
{
    protected $model;
    public function __construct(\App\Models\Saving $model)
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
        return DB::table('savings')
            ->join('users', 'users.id', '=', 'savings.usr_id')
            ->select(
                'savings.id AS saving_id',
                'savings.name AS saving',
                'savings.amount',
                'savings.date_finish',
                'savings.observation',
                'savings.status',
                'savings.created_at',
                DB::raw('if(isnull(savings.usr_id), 0, savings.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->paginate(2);
    }

    public function info(string $id)
    {
        return DB::table('savings')
            ->where('savings.id', $id)
            ->join('users', 'users.id', '=', 'savings.usr_id')
            ->select(
                'savings.id AS saving_id',
                'savings.name AS saving',
                'savings.amount',
                'savings.date_finish',
                'savings.observation',
                'savings.status',
                'savings.created_at',
                DB::raw('if(isnull(savings.usr_id), 0, savings.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
