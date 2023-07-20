<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nwidart\Modules\Facades\Module;

class ResetPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:reset-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all permissions data in permissions table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules = Module::all();
        foreach($modules as $module) {
            $moduleName = $module->getName();
            dd(config('user::config.permissions.users'));
            $permissions = config(strtolower($moduleName). '::auth.permissions.users');
        }
    }
}
