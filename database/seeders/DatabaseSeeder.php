<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'firstname' => 'Raie',
            'lastname' => 'Aswajjillah',
            'email' => 'rai010303@gmail.com',
            'password' => bcrypt('123123'),
            'is_admin' => true,
            'created_at' => 20230616,
            'picture' => 'team-1.jpg'
            // 'tgl_lahir' => '20030301',
            // 'no_identity' => '2392482823',
            // 'hp' => '082832837132'
        ]);
    }
}
