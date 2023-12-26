<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountService implements \App\Services\Interfaces\AccountInterface
{
    protected $model;
    public function __construct(\App\Models\Account $model)
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
            return DB::table('accounts')
                ->join('users', 'users.id', '=', 'accounts.usr_id')
                ->join('banks', 'banks.id', '=', 'accounts.ban_id')
                ->select(
                    'banks.id AS bank_id',
                    'banks.abbreviature',
                    'banks.name AS bank',
                    'accounts.id AS account_id',
                    'accounts.name AS account',
                    'accounts.observation',
                    'accounts.status',
                    'accounts.created_at',
                    DB::raw('if(isnull(accounts.usr_id), 0, accounts.usr_id) usr_id'),
                    DB::raw('if(isnull(users.name), "Administrator", users.name) user')
                )
                ->paginate(2);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function info(string $id)
    {
        return DB::table('accounts')
            ->where('accounts.id', $id)
            ->join('users', 'users.id', '=', 'accounts.usr_id')
            ->join('banks', 'banks.id', '=', 'accounts.ban_id')
            ->select(
                'banks.id AS bank_id',
                'banks.abbreviature',
                'banks.name AS bank',
                'accounts.id AS account_id',
                'accounts.name AS account',
                'accounts.observation',
                'accounts.status',
                'accounts.created_at',
                DB::raw('if(isnull(users.id), 0, users.id) usr_id'),
                DB::raw('if(isnull(users.name), "Administrator", users.name) user')
            )
            ->first();
    }

    public function select()
    {
        return $this->model::all();
    }
}
