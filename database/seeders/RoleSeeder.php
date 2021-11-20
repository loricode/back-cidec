<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleOne = Role::create(['name' => 'admin']);
        $roleTwo = Role::create(['name' => 'general']);

        $permissionOne = Permission::create(['name' => 'campus'])
        ->syncRoles([$roleOne, $roleTwo]);

        $permissionTWo = Permission::create(['name' => 'affiliate']);

    }
}
