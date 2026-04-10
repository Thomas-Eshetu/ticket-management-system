<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.com'], // unique condition
            [
                'name' => 'Admin',
                'gender' => 'male',
                'phone' => '0900000000',
                'department' => 'admin',
                'position' => 'Administrator',
                'username' => 'admin',
                'role' => 'admin',
                'status' => 'active',
                'password' => $password,
            ]
        );
    }
}
