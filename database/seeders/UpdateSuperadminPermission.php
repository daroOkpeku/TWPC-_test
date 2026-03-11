<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UpdateSuperadminPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $adminRole = Role::where('name', 'admin')->first();
     
        $permissions = [
       'delete_product',
       'view_product',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $adminRole->givePermissionTo($permissions);
    }
}
