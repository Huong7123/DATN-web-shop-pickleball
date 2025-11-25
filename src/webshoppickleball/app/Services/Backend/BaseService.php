<?php

namespace App\Services\Backend;

use App\Interfaces\BaseRepositoryInterface;
use App\DTO\DataResult;

class BaseService
{
    protected BaseRepositoryInterface $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $columns = ['*']): DataResult
    {
        $data = $this->repository->getAll($columns);
        return new DataResult('Lấy dữ liệu thành công', 200, $data);
    }

    public function paginateWithFilters(array $filters, int $perPage = 10): DataResult
    {
        $data = $this->repository->paginateWithFilters($filters, $perPage);

        return new DataResult('Lấy danh sách thành công',200,$data);
    }

    public function getById(int $id, array $columns = ['*']): DataResult
    {
        $item = $this->repository->getById($id, $columns);
        if (!$item) {
            return new DataResult("Bản ghi với id $id không tồn tại", 404);
        }
        return new DataResult('Lấy dữ liệu thành công', 200, $item);
    }

    public function create(array $data): DataResult
    {
        $item = $this->repository->create($data);
        return new DataResult('Tạo thành công', 201, $item);
    }

    public function update(int $id, array $data): DataResult
    {
        $item = $this->repository->update($id, $data);
        if (!$item) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }
        return new DataResult('Cập nhật thành công', 200, $item);
    }

    public function delete(int $id): DataResult
    {
        $deleted = $this->repository->delete($id);
        if (!$deleted) {
            return new DataResult("Xóa thất bại, id $id không tồn tại", 404);
        }
        return new DataResult('Xóa thành công', 200, null);
    }
}
