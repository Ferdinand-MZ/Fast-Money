<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
            'username' => 'UsernameAdmin',
            'fullname' => 'Admin Full Name',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'), // Set a secure password for the admin
            'tgl_lahir' => '1990-01-01',
            'no_telp' => '123456789',
            'saldo' => 0.00,
            'role' => 'admin',
            'picture' => 'admin-profile.jpg',
            'created_at' => '2023-11-28 12:00:00',
            'updated_at' => '2023-11-28 12:00:00'
            ],
        ];

        User::insert($users);
    }
}
