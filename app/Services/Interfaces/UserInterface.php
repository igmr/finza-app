<?php

namespace App\Services\Interfaces;

interface UserInterface extends ServiceInterface
{
    public function getUserByEmail(string $email);
    public function token(\App\Models\User $user);
    public function logout(int $userId);
    public function getSession(\Illuminate\Http\Request $req);
}
