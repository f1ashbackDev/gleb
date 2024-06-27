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
//        'surname',
//        'name',
//        'login',
//        'email',
//        'password',
//        'role'
         \App\Models\User::factory()->create([
             'surname' => 'admin',
             'name' => 'admin',
             'login' => 'admin',
             'email' => 'admin@admin',
             'password' => Hash::make('admin'),
             'role' => 'Администратор'
         ]);
        \App\Models\User::factory()->create([
            'surname' => 'manager',
            'name' => 'manager',
            'login' => 'manager',
            'email' => 'manager@admin',
            'password' => Hash::make('manager'),
            'role' => 'Менеджер'
        ]);
    }
}
