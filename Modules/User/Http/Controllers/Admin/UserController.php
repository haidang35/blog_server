<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\User\Http\Requests\Admin\User\CreateUserRequest;
use Modules\User\Http\Requests\Admin\User\UpdateUserRequest;
use Modules\User\Services\User\IUserService;

class UserController extends ApiController
{
    public function __construct(protected IUserService $userService)
    {
    }

    public function getList()
    {
        $result = $this->userService->findAll();
        return $this->handleResponse($result);
    }

    public function create(CreateUserRequest $request)
    {
        $result = $this->userService->create($request);
        return $this->handleResponse($result);
    }

    public function update(UpdateUserRequest $request)
    {
        $result = $this->userService->update($request);
        return $this->handleResponse($result);
    }
}
