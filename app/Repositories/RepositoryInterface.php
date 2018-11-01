<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function updateWhere(array $data, array $conditions);

    public function whereFirst(array $data);
    public function whereAll(array $where);

    public function whereWithFirst(array $relations,array $conditions);

    public function delete($id);

    public function show($id);
}
