<?php

namespace Modules\User\Repositories\User;

use Modules\Base\Repositories\IBaseRepository;

interface IUserRepository extends IBaseRepository
{
    /**
     * @param int $limit
     * @param array $filter
     * @param array $sort
     * @return mixed
     */
    public function findAllWithPagination(int $limit, array $filter, array $sort);

}
