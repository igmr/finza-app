<?php

namespace App\Services\Interfaces;

interface ServiceInterface
{
    public function index();
    public function store(array $model);
    public function show(string|int $id);
    public function update(string|int $id, array $model);
    public function destroy(string|int $id);
    public function restore(string|int $id);
}