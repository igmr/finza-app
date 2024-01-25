<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetService implements \App\Services\Interfaces\BudgetInterface
{
    protected $model;
    public function __construct(\App\Models\Budget $model)
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
        $data = DB::table('budgets')
            ->join('users', 'users.id', '=', 'budgets.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'budgets.acc_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'budgets.id AS budget_id',
                'budgets.name AS budget',
                'budgets.amount',
                'budgets.period',
                'budgets.observation',
                'budgets.status',
                'budgets.created_at',
                DB::raw('if(isnull(acc_id), 0, acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ban_id), 0, ban_id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(budgets.usr_id), 0, budgets.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )->get();
        return datatables($data)->toJson();
    }

    public function detail(int $id)
    {
    }

    public function list(Request $req, int $paginate = 15)
    {
        return DB::table('budgets')
            ->join('users', 'users.id', '=', 'budgets.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'budgets.acc_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'budgets.id AS budget_id',
                'budgets.name AS budget',
                'budgets.amount',
                'budgets.period',
                'budgets.observation',
                'budgets.status',
                'budgets.created_at',
                DB::raw('if(isnull(acc_id), 0, acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ban_id), 0, ban_id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(budgets.usr_id), 0, budgets.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('budgets')
            ->where('budgets.id', $id)
            ->join('users', 'users.id', '=', 'budgets.usr_id')
            ->leftJoin('accounts', 'accounts.id', '=', 'budgets.acc_id')
            ->leftJoin('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'budgets.id AS budget_id',
                'budgets.name AS budget',
                'budgets.amount',
                'budgets.period',
                'budgets.observation',
                'budgets.status',
                'budgets.created_at',
                DB::raw('if(isnull(acc_id), 0, acc_id) acc_id'),
                DB::raw('if(isnull(accounts.name), "None", accounts.name) account'),
                DB::raw('if(isnull(ban_id), 0, ban_id) ban_id'),
                DB::raw('if(isnull(banks.name), "None", banks.name) bank'),
                DB::raw('if(isnull(budgets.usr_id), 0, budgets.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
