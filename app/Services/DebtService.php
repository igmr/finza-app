<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtService implements \App\Services\Interfaces\DebtInterface
{
    protected $model;
    public function __construct(\App\Models\Debt $model)
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
        return DB::table('debts')
            ->join('users', 'users.id', '=', 'debts.usr_id')
            ->leftJoin('categories', 'categories.id', '=', 'debts.cat_id')
            ->leftJoin('genders', 'genders.id', '=', 'categories.gen_id')
            ->select(
                'debts.id AS debt_id',
                'debts.name AS debt',
                'debts.amount',
                'debts.period',
                'debts.day',
                'debts.date_at',
                'debts.observation',
                'debts.status',
                'debts.created_at',
                DB::raw('if(isnull(gen_id), 0, gen_id) gen_id'),
                DB::raw('if(isnull(genders.name), "None", genders.name) gender'),
                DB::raw('if(isnull(cat_id), 0, cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(users.id), 0, users.id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )
            ->paginate(2);
    }

    public function info(string $id)
    {
        return DB::table('debts')
            ->where('debts.id', $id)
            ->join('users', 'users.id', '=', 'debts.usr_id')
            ->leftJoin('categories', 'categories.id', '=', 'debts.cat_id')
            ->leftJoin('genders', 'genders.id', '=', 'categories.gen_id')
            ->select(
                'debts.id AS debt_id',
                'debts.name AS debt',
                'debts.amount',
                'debts.period',
                'debts.day',
                'debts.date_at',
                'debts.observation',
                'debts.status',
                'debts.created_at',
                DB::raw('if(isnull(gen_id), 0, gen_id) gen_id'),
                DB::raw('if(isnull(genders.name), "None", genders.name) gender'),
                DB::raw('if(isnull(cat_id), 0, cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(users.id), 0, users.id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )
            ->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
