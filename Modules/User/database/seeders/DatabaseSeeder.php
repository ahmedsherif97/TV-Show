<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->seedPermissions();
        $this->seedRoles();
    }

    protected function seedPermissions()
    {
        $moduleName = Str::snake('User');

        $permissions = ['list', 'show', 'create', 'update', 'delete'];
        $list = [];
        foreach ($permissions as $key => $value) {
            $list[] = [
                'name' => "$value $moduleName",
                'guard_name' => 'web'
            ];
        }
        Permission::upsert(
            $list,
            $except = [],
            getArrayKeys($list[0], $except)
        );
    }

    protected function seedRoles()
    {
        \Spatie\Permission\Models\Role::FirstOrCreate([
            'name' => 'user',
        ])?->givePermissionTo([
            '',
        ]);
    }
}
