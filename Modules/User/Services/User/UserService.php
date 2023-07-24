<?php

namespace Modules\User\Services\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Base\Services\BaseService;
use Modules\User\Http\Requests\Admin\User\CreateUserRequest;
use Modules\User\Http\Requests\Admin\User\GetUserListRequest;
use Modules\User\Http\Requests\Admin\User\UpdateUserRequest;
use Modules\User\Repositories\User\IUserRepository;

class UserService extends BaseService implements IUserService
{
    public function __construct(protected IUserRepository $userRepository)
    {
    }

    public function findAll(GetUserListRequest $request)
    {
        return $this->userRepository->findAllWithPagination($request->limit);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);
            DB::commit();
            return $user;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update(UpdateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findById($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);
            DB::commit();
            return $user;
        }catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return false;
        }
    }

    public function deleteById($id)
    {
        return $this->userRepository->deleteById($id);
    }
}
