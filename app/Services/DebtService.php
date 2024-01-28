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

    public function datatable()
    {
        $data = DB::table('debts')
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
            )->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
        $sql = "SELECT bank, account, description, saving, debt, amount, created_at, type
                FROM (SELECT banks.name AS bank, accounts.name AS account,
					classifications.name AS description,
                    savings.name AS saving, debts.name AS debt,
                    ingresses.amount, ingresses.created_at, 'ingress' AS type
                FROM ingresses
                LEFT JOIN classifications ON classifications.id = ingresses.cls_id
                LEFT JOIN savings ON savings.id = ingresses.sav_id
                LEFT JOIN debts ON debts.id = ingresses.deb_id
                LEFT JOIN accounts ON accounts.id = ingresses.acc_id
                LEFT JOIN banks ON banks.id = accounts.ban_id
                WHERE 1=1
                AND debts.id = ?
                UNION
                SELECT banks.name AS bank, accounts.name AS account, CONCAT(genders.name, ' - ', categories.name) AS description,
                    savings.name AS saving, debts.name AS debt,
                    egresses.amount, egresses.created_at, 'egress' AS type
                FROM egresses
                LEFT JOIN categories ON categories.id = egresses.cat_id
                LEFT JOIN genders ON genders.id = categories.gen_id
                LEFT JOIN savings ON savings.id = egresses.sav_id
                LEFT JOIN debts ON debts.id = egresses.deb_id
                LEFT JOIN accounts ON accounts.id = egresses.acc_id
                LEFT JOIN banks ON banks.id = accounts.ban_id
                WHERE 1=1
                AND debts.id = ?) AS detail
                ORDER BY created_at DESC";
        $query = DB::select($sql, [$id, $id]);
        return datatables($query)->toJson();
    }

    public function list(Request $req, int $paginate = 15)
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
            )->paginate($paginate);
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
