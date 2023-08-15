<?php

namespace Modules\User\Repositories\User;

use Modules\Base\Repositories\BaseRepository;
use Modules\User\Entities\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
