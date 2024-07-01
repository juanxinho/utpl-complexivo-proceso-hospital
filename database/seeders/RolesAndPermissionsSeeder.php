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

        // Appointment
        Permission::create(['name' => 'view appointment']);
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'update appointment']);
        Permission::create(['name' => 'delete appointment']);

        // Users
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // Roles
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        // Specialties
        Permission::create(['name' => 'view specialty']);
        Permission::create(['name' => 'create specialty']);
        Permission::create(['name' => 'update specialty']);
        Permission::create(['name' => 'delete specialty']);

        // Clinical History
        Permission::create(['name' => 'view clinical history']);
        Permission::create(['name' => 'create clinical history']);
        Permission::create(['name' => 'update clinical history']);
        Permission::create(['name' => 'delete clinical history']);

        // Invoices
        Permission::create(['name' => 'view invoice']);
        Permission::create(['name' => 'create invoice']);
        Permission::create(['name' => 'update invoice']);
        Permission::create(['name' => 'delete invoice']);

        // Schedules
        Permission::create(['name' => 'view schedule']);
        Permission::create(['name' => 'create schedule']);
        Permission::create(['name' => 'update schedule']);
        Permission::create(['name' => 'delete schedule']);

        // Create roles and assign created permissions
        $superAdmin = Role::create(['name' => 'super-admin']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view module', 'view appointment', 'create appointment', 'update appointment', 'delete appointment',
            'view user', 'create user', 'update user', 'delete user',
            'view role', 'create role', 'update role', 'delete role',
            'view specialty', 'create specialty', 'update specialty', 'delete specialty',
            'view clinical history', 'create clinical history', 'update clinical history', 'delete clinical history',
            'view invoice', 'create invoice', 'update invoice', 'delete invoice',
            'view schedule', 'create schedule', 'update schedule', 'delete schedule'
        ]);

        $technician = Role::create(['name' => 'technician']);
        $technician->givePermissionTo('view module');

        $medic = Role::create(['name' => 'medic']);
        $medic->givePermissionTo([
            'view module', 'view appointment', 'create appointment', 'update appointment', 'delete appointment',
            'view clinical history', 'create clinical history', 'update clinical history', 'delete clinical history',
            'view specialty'
        ]);

        $audit = Role::create(['name' => 'audit']);
        $audit->givePermissionTo([
            'view module', 'view appointment', 'create appointment', 'update appointment', 'delete appointment',
            'view user', 'create user', 'update user', 'delete user',
            'view clinical history', 'view invoice', 'view schedule'
        ]);

        $patient = Role::create(['name' => 'patient']);
        $patient->givePermissionTo([
            'view module', 'view appointment', 'create appointment', 'delete appointment',
            'view clinical history'
        ]);
    }
}
