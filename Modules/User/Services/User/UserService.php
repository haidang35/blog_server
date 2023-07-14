<?php

namespace Modules\User\Services\User;

use Modules\Base\Services\BaseService;
use Modules\User\Repositories\User\IUserRepository;

class UserService extends BaseService implements IUserService
{
    public function __construct(protected IUserRepository $userRepository)
    {
    }


}
