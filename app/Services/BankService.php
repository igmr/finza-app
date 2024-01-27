<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankService implements \App\Services\Interfaces\BankInterface
{
    protected $model;
    public function __construct(\App\Models\Bank $model)
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
        $data = DB::table('banks')
            ->join('users', 'users.id', '=', 'banks.usr_id')
            ->select(
                'banks.id AS bank_id',
                'banks.abbreviature',
                'banks.name AS bank',
                'banks.observation',
                'banks.status',
                'banks.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
        $sql = "SELECT account, description, saving, debt, amount, created_at, type
                FROM (SELECT accounts.name AS account, classifications.name AS description,
                    savings.name AS saving, debts.name AS debt,
                    ingresses.amount, ingresses.created_at, 'ingress' AS type
                FROM ingresses
                LEFT JOIN classifications ON classifications.id = ingresses.cls_id
                LEFT JOIN savings ON savings.id = ingresses.sav_id
                LEFT JOIN debts ON debts.id = ingresses.deb_id
                LEFT JOIN accounts ON accounts.id = ingresses.acc_id
                WHERE 1=1
                AND accounts.ban_id = ?
                UNION
                SELECT accounts.name AS account, CONCAT(genders.name, ' - ', categories.name) AS description,
                    savings.name AS saving, debts.name AS debt,
                    egresses.amount, egresses.created_at, 'egress' AS type
                FROM egresses
                LEFT JOIN categories ON categories.id = egresses.cat_id
                LEFT JOIN genders ON genders.id = categories.gen_id
                LEFT JOIN savings ON savings.id = egresses.sav_id
                LEFT JOIN debts ON debts.id = egresses.deb_id
                LEFT JOIN accounts ON accounts.id = egresses.acc_id
                WHERE 1=1
                AND accounts.ban_id = ?) AS detail
                ORDER BY created_at DESC";
        $query = DB::select($sql, [$id, $id]);
        return datatables($query)->toJson();
    }

    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('banks')
            ->join('users', 'users.id', '=', 'banks.usr_id')
            ->select(
                'banks.id AS bank_id',
                'banks.abbreviature',
                'banks.name AS bank',
                'banks.observation',
                'banks.status',
                'banks.created_at',
                DB::raw('if(isnull(usr_id), 0, usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('banks')
            ->where('banks.id', $id)
            ->join('users', 'users.id', '=', 'banks.usr_id')
            ->select(
                'banks.id AS bank_id',
                'banks.abbreviature',
                'banks.name AS bank',
                'banks.observation',
                'banks.status',
                'banks.created_at',
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
