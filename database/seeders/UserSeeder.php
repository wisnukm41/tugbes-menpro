<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => '$2y$10$fCqMgcw2sk1TNlXKtB9EbOaxqKniO5lV3Pd6WKxg1DMHCUou3F/Fq'
            ]);

            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => '2',
            ]);
        }
    }
}
