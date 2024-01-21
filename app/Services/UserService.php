<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class UserService implements \App\Services\Interfaces\UserInterface
{
    protected $model;
    public function __construct(\App\Models\User $model)
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

    public function getUserByEmail(string $email)
    {
        return \App\Models\User::where('email', 'like', $email)->first();
    }
    public function token(\App\Models\User $user)
    {
        return $user->createToken('token')->plainTextToken;
    }
    public function logout(int $userId)
    {
        return auth()->user()->tokens()->delete();
    }
    public function getSession(\Illuminate\Http\Request $req)
    {
        $credentials = $req->validated();
        if(Auth::attempt($credentials))
        {
            $req->session()->regenerate();
            return 1;
        }
        return 0;
    }
}
