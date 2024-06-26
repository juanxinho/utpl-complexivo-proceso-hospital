<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view module']);
        Permission::create(['name' => 'view appointment']);
        Permission::create(['name' => 'delete appointment']);
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);

        // Create roles and assign created permissions
        $role = Role::create(['name' => 'patient']);
        $role->givePermissionTo(['view module', 'view appointment', 'delete appointment', 'create appointment']);

        $role = Role::create(['name' => 'audit']);
        $role->givePermissionTo(['view module', 'view appointment', 'delete appointment', 'create appointment', 'view user', 'delete user', 'create user']);

        $role = Role::create(['name' => 'medic']);
        $role->givePermissionTo(['view module', 'view appointment', 'delete appointment', 'create appointment']);

        $role = Role::create(['name' => 'technician']);
        $role->givePermissionTo('view module');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['view module', 'view appointment', 'delete appointment', 'create appointment', 'view user', 'delete user', 'create user']);

        $role = Role::create(['name' => 'super-admin']);
    }
}
