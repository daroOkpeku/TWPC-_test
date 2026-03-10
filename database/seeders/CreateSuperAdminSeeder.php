<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $roles = ['admin', 'user'];
         foreach ($roles as $role) {
                Role::firstOrCreate(['name' => $role]);
         }
       
       $user = User::firstOrCreate(
             ['email' => 'admin@example.com'],
            [
                "name" => "Super Admin",
                "password" =>Hash::make('password'),
            ]);

            $user->assignRole('admin');
    }
}
