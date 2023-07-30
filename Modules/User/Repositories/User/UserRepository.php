<?php

namespace Modules\User\Repositories\User;

use Modules\Base\Repositories\BaseRepository;
use Modules\User\Entities\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected $modal;

    public function __construct(User $user)
    {
        $this->modal = $user;
    }

    public function findAllWithPagination($limit, $filter, $sort)
    {
        $baseQuery = $this->modal->latest()->filterValue($filter)->sortColumn($sort);
        return $baseQuery->paginate($limit);
    }
}
