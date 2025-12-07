<?php

namespace Modules\TVShow\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->seedPermissions();
    }

    protected function seedPermissions()
    {
        $moduleName = Str::snake('TVShow');

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
}
