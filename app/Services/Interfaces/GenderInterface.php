<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface GenderInterface extends ServiceInterface
{
    public function list(Request $req);
    public function info(string $id);
    public function select();
}
