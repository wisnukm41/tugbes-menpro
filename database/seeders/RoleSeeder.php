<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'id' => '1',
            'level' => 'admin'
        ]);

        DB::table('role')->insert([
            'id' => '2',
            'level' => 'user'
        ]);

        DB::table('users')->insert([
            'id' => '1',
            'name' => 'wis',
            'email' => 'wis@wis.com',
            'password' => '$2y$10$fCqMgcw2sk1TNlXKtB9EbOaxqKniO5lV3Pd6WKxg1DMHCUou3F/Fq'
        ]);

        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);
    }
}