<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Transaction;
use App\Models\Transaction_List;
use App\Models\Product;
use App\Models\User;

class TransactionSeeder extends Seeder
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
            $trans = Transaction::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'amount' => $faker->numberBetween(10, 150) . '000',
                'status' => $faker->randomElement(['pending', 'settlement', 'process', 'complete']),
                'order_id' => $faker->shuffle('aplemsotk') . '-' . $faker->randomNumber(5),
                'va' => '9880137241732291',
                'address' => $faker->address,
                'contact' => $faker->e164PhoneNumber,
            ]);

            for ($j = 0; $j < rand(1, 4); $j++) {
                $product =  Product::inRandomOrder()->first();
                $qty = rand(1, 8);
                Transaction_List::create([
                    'transaction_id' => $trans->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'qty' => $qty,
                    'price' => $qty * $product->price
                ]);
            }
        }
    }
}
