<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;

class ResetPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:update-permissions';

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
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('permissions')->truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $modules = Module::all();
        foreach($modules as $module) {
            $moduleName = strtolower($module->getName());
            $permissions = config($moduleName . '.permissions.users') ?? [];
            foreach ($permissions as $permission) {
                $existedPermission = Permission::where('name', $permission)->first();
                if(!$existedPermission) {
                    Permission::create([
                        'name' => $permission,
                        'module' => $moduleName
                    ]);
                }else if(strcmp($permission, $existedPermission->name) !== 0) {
                    $existedPermission->update([
                        'name' => $permission,
                        'module' => $moduleName
                    ]);
                }
            }
        }
        $this->info('Update permissions successfully!');
    }
}
