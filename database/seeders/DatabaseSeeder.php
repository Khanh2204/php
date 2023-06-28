<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            OfficeSeeder::class,
            ProductlineSeeder::class,
            ProductSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
            OrderdetailSeeder::class,
        ]);
    }
}
