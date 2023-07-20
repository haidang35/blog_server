<?php

namespace Modules\User\Services\User;

use Modules\User\Http\Requests\Admin\User\CreateUserRequest;
use Modules\User\Http\Requests\Admin\User\UpdateUserRequest;

interface IUserService
{
    public function findAll();

    public function findById($id);

    public function create(CreateUserRequest $request);

    public function update(UpdateUserRequest $request);

    public function deleteById($id);
}
