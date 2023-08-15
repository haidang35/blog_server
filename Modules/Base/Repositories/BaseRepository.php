<?php

namespace Modules\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model
            ->latest()
            ->get();
    }

    public function findAllWithFilter($limit, $filter, $sort, $selects = [])
    {
        $query = $this->model
            ->latest()
            ->filterRecord($filter)
            ->sortRecord($sort);

        if($selects) {
            $query->select($selects);
        }
        return $query
            ->paginate($limit);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        $entity = $this->model->findOrFail($id);
        $entity->update($attributes);
        return $entity;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id)
    {
        $this->model->findOrFail($id)->delete();
    }

    public function deleteByIds(array $ids)
    {
        try {
            $this->model->whereIn('id', $ids)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findByUUID($id)
    {
        return $this->model->findByUUID($id);
    }

    public function deleteByUUID($id)
    {
        $this->model->findByUUID($id)->delete();
    }

    public function deleteByUUIDs($ids)
    {
        $this->model->whereIn('uuid', $ids)->delete();
    }
}
