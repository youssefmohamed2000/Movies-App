<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOfPermissionNames = [
            'create_roles',
            'read_roles',
            'update_roles',
            'delete_roles',
            'create_admins',
            'read_admins',
            'update_admins',
            'delete_admins',
            'create_users',
            'read_users',
            'update_users',
            'delete_users',
            'create_genres',
            'read_genres',
            'update_genres',
            'delete_genres',
            'create_movies',
            'read_movies',
            'update_movies',
            'delete_movies',
            'create_actors',
            'read_actors',
            'update_actors',
            'delete_actors',
            'create_settings',
            'read_settings',
            'update_settings',
            'delete_settings'
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $super_admin_role = Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $created_permissions = Permission::pluck('id')->all();
        $super_admin_role->syncPermissions($created_permissions);


    }
}
