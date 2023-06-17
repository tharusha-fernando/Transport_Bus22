<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BaseUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin22@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->addRole('superadministrator'); 

        $user=User::create([
            'name' => 'Superadmin2',
            'email' => 'superadmin2222@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->addRole('superadministrator'); 

        $user=User::create([
            'name' => 'Admin',
            'email' => 'admin22@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->addRole('administrator'); 

        $user=User::create([
            'name' => 'Admin2',
            'email' => 'admin2222@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->addRole('administrator'); 
        //
    }
}
