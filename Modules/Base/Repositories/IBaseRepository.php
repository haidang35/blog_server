<?php

namespace Modules\Base\Repositories;

interface IBaseRepository
{
    /**
     * @return mixed
     */
    public function findAll();

    public function findAllWithFilter($limit, $filter, $sort, $selects = []);

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);

    public function deleteByIds(array $ids);

    public function findByUUID($id);

    public function deleteByUUID($id);
    public function deleteByUUIDs($ids);
}
