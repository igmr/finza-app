<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionService implements \App\Services\Interfaces\TransactionInterface
{
    protected $model;
    public function __construct(\App\Models\Transaction $model)
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
        return DB::table('transactions')
            ->leftJoin('users', 'users.id', '=', 'transactions.usr_id')
            ->leftJoin('ingresses', 'ingresses.id', '=', 'transactions.ing_id')
            ->leftJoin('egresses', 'egresses.id', '=', 'transactions.egr_id')
            ->leftJoin('accounts AS accounts_from', 'accounts_from.id', '=', 'transactions.acc_ing_id')
            ->leftJoin('banks AS banks_from', 'banks_from.id', '=', 'accounts_from.ban_id')
            ->leftJoin('accounts AS accounts_to', 'accounts_to.id', '=', 'transactions.acc_egr_id')
            ->leftJoin('banks AS banks_to', 'banks_to.id', '=', 'accounts_to.ban_id')
            ->leftJoin('classifications', 'classifications.id', '=', 'transactions.cls_id')
            ->leftJoin('categories', 'categories.id', '=', 'transactions.cat_id')
            ->leftJoin('savings', 'savings.id', '=', 'transactions.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'transactions.deb_id')
            ->select(
                'transactions.id AS tra_id',
                'transactions.concept',
                'transactions.description',
                'transactions.reference',
                'transactions.amount',
                'transactions.observation',
                'transactions.status',
                'transactions.created_at',
                DB::raw('if(isnull(transactions.acc_ing_id), 0, transactions.acc_ing_id) acc_ing_id'),
                DB::raw('if(isnull(accounts_from.name), "None", accounts_from.name) account_from'),
                DB::raw('if(isnull(banks_from.id), "None", banks_from.id) bank_from_id'),
                DB::raw('if(isnull(banks_from.name), "None", banks_from.name) bank_from'),
                DB::raw('if(isnull(transactions.acc_egr_id), 0, transactions.acc_egr_id) acc_egr_id'),
                DB::raw('if(isnull(accounts_to.name), "None", accounts_to.name) account_to'),
                DB::raw('if(isnull(banks_to.id), "None", banks_to.id) bank_to_id'),
                DB::raw('if(isnull(banks_to.name), "None", banks_to.name) bank_to'),
                DB::raw('if(isnull(transactions.cls_id), 0, transactions.cls_id) cls_id'),
                DB::raw('if(isnull(classifications.name), "None", classifications.name) classification'),
                DB::raw('if(isnull(transactions.cat_id), 0, transactions.cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(transactions.sav_id), 0, transactions.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(transactions.deb_id), 0, transactions.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(transactions.usr_id), 0,transactions.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )->paginate($paginate);
    }

    public function info(string $id)
    {
        return DB::table('transactions')
            ->where('transactions.id', $id)
            ->leftJoin('users', 'users.id', '=', 'transactions.usr_id')
            ->leftJoin('ingresses', 'ingresses.id', '=', 'transactions.ing_id')
            ->leftJoin('egresses', 'egresses.id', '=', 'transactions.egr_id')
            ->leftJoin('accounts AS accounts_from', 'accounts_from.id', '=', 'transactions.acc_ing_id')
            ->leftJoin('banks AS banks_from', 'banks_from.id', '=', 'accounts_from.ban_id')
            ->leftJoin('accounts AS accounts_to', 'accounts_to.id', '=', 'transactions.acc_egr_id')
            ->leftJoin('banks AS banks_to', 'banks_to.id', '=', 'accounts_to.ban_id')
            ->leftJoin('classifications', 'classifications.id', '=', 'transactions.cls_id')
            ->leftJoin('categories', 'categories.id', '=', 'transactions.cat_id')
            ->leftJoin('savings', 'savings.id', '=', 'transactions.sav_id')
            ->leftJoin('debts', 'debts.id', '=', 'transactions.deb_id')
            ->select(
                'transactions.id AS tra_id',
                'transactions.ing_id AS ing_id',
                'transactions.egr_id AS egr_id',
                'transactions.concept',
                'transactions.description',
                'transactions.reference',
                'transactions.amount',
                'transactions.observation',
                'transactions.status',
                'transactions.created_at',
                DB::raw('if(isnull(transactions.acc_ing_id), 0, transactions.acc_ing_id) acc_ing_id'),
                DB::raw('if(isnull(accounts_from.name), "None", accounts_from.name) account_from'),
                DB::raw('if(isnull(banks_from.id), "None", banks_from.id) bank_from_id'),
                DB::raw('if(isnull(banks_from.name), "None", banks_from.name) bank_from'),
                DB::raw('if(isnull(transactions.acc_egr_id), 0, transactions.acc_egr_id) acc_egr_id'),
                DB::raw('if(isnull(accounts_to.name), "None", accounts_to.name) account_to'),
                DB::raw('if(isnull(banks_to.id), "None", banks_to.id) bank_to_id'),
                DB::raw('if(isnull(banks_to.name), "None", banks_to.name) bank_to'),
                DB::raw('if(isnull(transactions.cls_id), 0, transactions.cls_id) cls_id'),
                DB::raw('if(isnull(classifications.name), "None", classifications.name) classification'),
                DB::raw('if(isnull(transactions.cat_id), 0, transactions.cat_id) cat_id'),
                DB::raw('if(isnull(categories.name), "None", categories.name) category'),
                DB::raw('if(isnull(transactions.sav_id), 0, transactions.sav_id) sav_id'),
                DB::raw('if(isnull(savings.name), "None", savings.name) saving'),
                DB::raw('if(isnull(transactions.deb_id), 0, transactions.deb_id) deb_id'),
                DB::raw('if(isnull(debts.name), "None", debts.name) debt'),
                DB::raw('if(isnull(transactions.usr_id), 0,transactions.usr_id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user'),
            )->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
