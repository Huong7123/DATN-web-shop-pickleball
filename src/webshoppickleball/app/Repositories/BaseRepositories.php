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

    public function getAll(array $columns = ['*'], array $with = [])
    {
        $query = $this->model->with($with);
        return $query->get($columns);
    }

    public function getById(int $id, array $columns = ['*'], array $with = [])
    {
        $query = $this->model->with($with);
        return $query->find($id, $columns);
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

    public function paginateWithFilters(array $filters, int $perPage = 10, array $columns = ['*'], array $with = [])
    {
        $query = $this->model->with($with);

        $query->when(!empty($filters['id']), function ($q) use ($filters) {
                $q->where('id', $filters['id']);
            })
            ->when(!empty($filters['email']), function ($q) use ($filters) {
                $q->where('email', 'LIKE', "%{$filters['email']}%");
            })
            ->when(!empty($filters['name']), function ($q) use ($filters) {
                $q->where('name', 'LIKE', "%{$filters['name']}%");
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($q) use ($filters) {
                $q->where('status', $filters['status']);
            })
            ->when(!empty($filters['role']), function ($q) use ($filters) {
                $q->where('role', $filters['role']);
            })
            ->when(!empty($filters['title']), function ($q) use ($filters) {
                $q->where('title', 'LIKE', "%{$filters['title']}%");
            })
            ->when(!empty($filters['code']), function ($q) use ($filters) {
                $q->where('code', 'LIKE', "%{$filters['code']}%");
            })
            ->when(!empty($filters['date']), function ($q) use ($filters) {
                $q->whereDate('start_date', '<=', $filters['date'])
                ->whereDate('end_date', '>=', $filters['date']);
            })
            ->when(!empty($filters['sort']) || !empty($filters['order']), function ($q) use ($filters) {
                $sort = $filters['sort'] ?? 'id';
                $order = $filters['order'] ?? 'desc';
                $q->orderBy($sort, $order);
            }, function ($q) {
                $q->orderBy('id', 'desc');
            });

        return $query->paginate($perPage, $columns);
    }

}
