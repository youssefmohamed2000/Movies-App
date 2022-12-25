<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::query()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'type' => 'super_admin'
        ]);

        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'type' => 'admin'
        ]);

        $user = User::query()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'type' => 'user'
        ]);

        $super_admin_role = Role::query()->where('name', '=', 'super_admin')
            ->pluck('id');
        $super_admin->assignRole($super_admin_role);

        $admin_role = Role::query()->where('name', '=', 'admin')
            ->pluck('id');
        $admin->assignRole($admin_role);


    }
}
