<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $superadmin = Role::where('name', 'admin')->first();

        $permissions = [
            'view_users',
            'block_unblock_users',
            'view_product',
            'delete_product',
        ];

foreach ($permissions as $permission) {
    Permission::firstOrCreate([
        'name' => $permission,
        'guard_name' => 'web'
    ]);
}

$superadmin->givePermissionTo($permissions);
    }
}
