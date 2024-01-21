<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EgressService implements \App\Services\Interfaces\EgressInterface
{
    protected $model;
    public function __construct(\App\Models\Egress $model)
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
    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('egresses')
            ->join('users', 'users.id', '=', 'egresses.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'egresses.acc_id')
            ->leftJoin('categories', 'categories.id', '=', 'egresses.cat_id')
            ->leftJoin('savings', 'savings.id', '=', 'egresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'egresses.deb_id')
            ->select(
                'egresses.id AS egr_id',
                'egresses.concept',
                'egresses.description',
                'egresses.reference',
                'egresses.amount',
                'egresses.observation',
                'egresses.status',
                'egresses.created_at',
                DB::raw('if(isnull(egresses.acc_id), 0, egresses.acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(egresses.cat_id), 0, egresses.cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(egresses.sav_id), 0, egresses.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(egresses.deb_id), 0, egresses.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(egresses.usr_id), 0,egresses.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )
            ->paginate($paginate);
    }
    public function info(string $id)
    {
        return DB::table('egresses')
            ->where('egresses.id', $id)
            ->join('users', 'users.id', '=', 'egresses.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'egresses.acc_id')
            ->leftJoin('categories', 'categories.id', '=', 'egresses.cat_id')
            ->leftJoin('savings', 'savings.id', '=', 'egresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'egresses.deb_id')
            ->select(
                'egresses.id AS egr_id',
                'egresses.concept',
                'egresses.description',
                'egresses.reference',
                'egresses.amount',
                'egresses.observation',
                'egresses.status',
                'egresses.created_at',
                DB::raw('if(isnull(egresses.acc_id), 0, egresses.acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(egresses.cat_id), 0, egresses.cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(egresses.sav_id), 0, egresses.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(egresses.deb_id), 0, egresses.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(egresses.usr_id), 0,egresses.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )
            ->first();
    }
    public function select()
    {
        return $this->model::all();
    }
}

