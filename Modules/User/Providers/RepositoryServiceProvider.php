<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\Repositories\User\IUserRepository;
use Modules\User\Repositories\User\UserRepository;
use Modules\User\Services\User\IUserService;
use Modules\User\Services\User\UserService;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
    }
}
