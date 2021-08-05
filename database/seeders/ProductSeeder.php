<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 30; $i++) {
            Product::create([
                'name' => $faker->text(100),
                'price' => $faker->numberBetween(1, 30) . '000',
                'weight' => $faker->numberBetween(1, 30) . $faker->randomElement(['500', '000', '0000']),
                'stock' => $faker->numberBetween(1, 40),
                'description' => $faker->sentence(30, true),
                'type' => $faker->randomElement(['Bahan Dasar', 'Siap Konsumsi', 'Tambahan']),
                'tags' => $faker->randomElement(['', 'new', 'bs', 'new,bs']),
            ]);
        }
    }
}
