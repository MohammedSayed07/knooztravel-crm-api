<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Client::create([
                'name' => $faker->name,
                'mobile_number' => $faker->phoneNumber,
                'whatsapp_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'national_id' => $faker->creditCardNumber
            ]);
        }
    }
}
