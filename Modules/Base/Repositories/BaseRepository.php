<?php

namespace Modules\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected $modal;

    public function findAll()
    {
        return $this->modal
            ->latest()
            ->all();
    }

    public function findById(int $id)
    {
        return $this->modal->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->modal->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $entity = $this->modal->findOrFail($id);
        $entity->update($attributes);
        return $entity;
    }

    public function deleteById(int $id)
    {
        $this->modal->findOrFail($id)->delete();
    }
}
