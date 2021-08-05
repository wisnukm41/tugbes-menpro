<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 50; $i++) {
            $user = User::inRandomOrder()->first();
            $product = Product::inRandomOrder()->first();
            Review::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'description' => $faker->sentence(30, true),
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
