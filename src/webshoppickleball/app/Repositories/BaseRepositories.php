<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepositories
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function getById(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->getById($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    public function delete(int $id)
    {
        $record = $this->getById($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }

    public function paginateWithFilters(array $filters, int $perPage = 10, array $columns = ['*'])
    {
        return $this->model

            ->when(!empty($filters['id']), function ($query) use ($filters) {
                $query->where('id', $filters['id']);
            })

            ->when(!empty($filters['email']), function ($query) use ($filters) {
                $query->where('email', 'LIKE', "%{$filters['email']}%");
            })
            ->when(!empty($filters['name']), function ($query) use ($filters) {
                $query->where('name', 'LIKE', "%{$filters['name']}%");
            })

            ->when(!empty($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })

            ->when(!empty($filters['role']), function ($query) use ($filters) {
                $query->where('role', $filters['role']);
            })

            ->when(!empty($filters['title']), function ($query) use ($filters) {
                $query->where('role', $filters['role']);
            })

            ->when(!empty($filters['code']), function ($query) use ($filters) {
                $query->where('role', $filters['role']);
            })

            ->when(!empty($filters['date']), function ($query) use ($filters) {
                $query->whereDate('start_date', '<=', $filters['date'])
                    ->whereDate('end_date', '>=', $filters['date']);
            })

            ->when(!empty($filters['sort']) || !empty($filters['order']), function ($query) use ($filters) {
                $sort = $filters['sort'] ?? 'id';
                $order = $filters['order'] ?? 'desc';
                $query->orderBy($sort, $order);
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })

            ->paginate($perPage, $columns);
    }

}
