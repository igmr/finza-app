<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngressService implements \App\Services\Interfaces\IngressInterface
{
    protected $model;
    public function __construct(\App\Models\Ingress $model)
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
        $data = DB::table('ingresses')
            ->join('users', 'users.id', '=', 'ingresses.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'ingresses.acc_id')
            ->leftJoin('classifications', 'classifications.id', '=', 'ingresses.cls_id')
            ->leftJoin('savings', 'savings.id', '=', 'ingresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'ingresses.deb_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'ingresses.id AS ing_id',
                'ingresses.concept',
                'ingresses.description',
                'ingresses.reference',
                'ingresses.amount',
                'ingresses.observation',
                'ingresses.status',
                'ingresses.created_at',
                DB::raw('if(isnull(banks.id), 0, banks.id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(ingresses.acc_id), 0, ingresses.acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ingresses.cls_id), 0, ingresses.cls_id) cls_id'),
                DB::raw('if(isnull(classifications.name), "None", classifications.name) classification'),
                DB::raw('if(isnull(ingresses.sav_id), 0, ingresses.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(ingresses.deb_id), 0, ingresses.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(ingresses.usr_id), 0,ingresses.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
    }

    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('ingresses')
            ->join('users', 'users.id', '=', 'ingresses.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'ingresses.acc_id')
            ->leftJoin('classifications', 'classifications.id', '=', 'ingresses.cls_id')
            ->leftJoin('savings', 'savings.id', '=', 'ingresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'ingresses.deb_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'ingresses.id AS ing_id',
                'ingresses.concept',
                'ingresses.description',
                'ingresses.reference',
                'ingresses.amount',
                'ingresses.observation',
                'ingresses.status',
                'ingresses.created_at',
                DB::raw('if(isnull(banks.id), 0, banks.id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(ingresses.acc_id), 0, ingresses.acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ingresses.cls_id), 0, ingresses.cls_id) cls_id'),
                DB::raw('if(isnull(classifications.name), "None", classifications.name) classification'),
                DB::raw('if(isnull(ingresses.sav_id), 0, ingresses.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(ingresses.deb_id), 0, ingresses.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(ingresses.usr_id), 0,ingresses.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('ingresses')
            ->join('users', 'users.id', '=', 'ingresses.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'ingresses.acc_id')
            ->leftJoin('classifications', 'classifications.id', '=', 'ingresses.cls_id')
            ->leftJoin('savings', 'savings.id', '=', 'ingresses.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'ingresses.deb_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'ingresses.id AS ing_id',
                'ingresses.concept',
                'ingresses.description',
                'ingresses.reference',
                'ingresses.amount',
                'ingresses.observation',
                'ingresses.status',
                'ingresses.created_at',
                DB::raw('if(isnull(banks.id), 0, banks.id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(ingresses.acc_id), 0, ingresses.acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ingresses.cls_id), 0, ingresses.cls_id) cls_id'),
                DB::raw('if(isnull(classifications.name), "None", classifications.name) classification'),
                DB::raw('if(isnull(ingresses.sav_id), 0, ingresses.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(ingresses.deb_id), 0, ingresses.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(ingresses.usr_id), 0,ingresses.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
