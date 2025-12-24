<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll(array $columns = ['*']);
    
    public function getById(int $id, array $columns = ['*'], array $with = []);
    
    public function create(array $data);
    
    public function update(int $id, array $data);
    
    public function delete(int $id);

    public function paginateWithFilters(array $filters, int $perPage = 10, array $columns = ['*']);
}
