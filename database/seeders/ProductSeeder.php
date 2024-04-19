<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate fake data using Faker library
        $faker = Factory::create();

        // Define the number of records you want to insert
        $numberOfRecords = 1000; // Change this number as needed

        // Loop through and insert fake data
        for ($i = 0; $i < $numberOfRecords; $i++) {
            Product::create([
                'title' => $faker->sentence,
                'price' => $faker->randomFloat(2, 10, 1000),
                'description' => $faker->paragraph,
                'category' => $faker->word,
                'image' => $faker->imageUrl(),
                'rating' => $faker->randomFloat(1, 1, 5),
                'rating_count' => $faker->numberBetween(1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
