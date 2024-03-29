<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function datatable()
    {
        $data = DB::table('genders')
            ->join('users', 'users.id', '=', 'genders.usr_id')
            ->select(
                'genders.id AS gender_id',
                'genders.code',
                'genders.name AS gender',
                'genders.observation',
                'genders.status',
                'genders.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
        $data = DB::table('egresses')
            ->leftJoin('categories', 'categories.id', '=', 'egresses.cat_id')
            ->leftJoin('savings', 'savings.id', '=', 'egresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'egresses.deb_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'egresses.acc_id')
            ->leftJoin('genders', 'genders.id', '=', 'categories.gen_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->where('genders.id', "=", $id)
            ->select([
                'categories.name AS category', 'savings.name AS saving', 'debts.name AS debt',
                'accounts.name AS account', 'banks.name AS bank',
                'egresses.amount', 'egresses.created_at',
                DB::raw('"egress" AS type'),
            ])
            ->orderBy('egresses.created_at', 'desc')
            ->get();
        return datatables($data)->toJson();
    }

    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('genders')
            ->join('users', 'users.id', '=', 'genders.usr_id')
            ->select(
                'genders.id AS gender_id',
                'genders.code',
                'genders.name AS gender',
                'genders.observation',
                'genders.status',
                'genders.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('genders')
            ->where('genders.id', $id)
            ->join('users', 'users.id', '=', 'genders.usr_id')
            ->select(
                'genders.id AS gender_id',
                'genders.code',
                'genders.name AS gender',
                'genders.observation',
                'genders.status',
                'genders.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
