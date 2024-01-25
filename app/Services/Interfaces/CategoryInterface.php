<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface CategoryInterface extends ServiceInterface
{
    public function datatable();
    public function detail(int $id);
    public function list(Request $req, int $paginate = 15);
    public function info(string $id);
    public function select();
}
