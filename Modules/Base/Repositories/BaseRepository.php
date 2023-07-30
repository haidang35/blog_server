<?php

namespace Modules\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    /**
     * @var
     */
    protected $modal;

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->modal
            ->latest()
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->modal->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->modal->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        $entity = $this->modal->findOrFail($id);
        $entity->update($attributes);
        return $entity;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id)
    {
        $this->modal->findOrFail($id)->delete();
    }

    public function deleteByIds(array $ids)
    {
        try {
            $this->modal->whereIn('id', $ids)->delete();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}
