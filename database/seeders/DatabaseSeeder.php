<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $permissions = ['access dashboard'];
        $list = [];
        foreach ($permissions as $key => $value) {
            $list[] = [
                'name' => "$value",
                'guard_name' => 'web'
            ];
        }

        \Spatie\Permission\Models\Permission::upsert(
            $list,
            $except = [],
            getArrayKeys($list[0], $except)
        );

        \Spatie\Permission\Models\Role::UpdateOrCreate([
            'name' => 'super-admin',
        ]);
        $user = \App\Models\User::UpdateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'type' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('super-admin');

        foreach (app('modules')->list() as $module) {
            $this->call("\Modules\\$module\Database\Seeders\DatabaseSeeder");
        }
    }
}
