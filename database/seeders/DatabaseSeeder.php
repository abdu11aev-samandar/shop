<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domains\Customer\Models\Address;
use Domains\Customer\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Location::factory()
        //    ->count(50)
        //    ->create();

        Address::factory()
            ->create();
    }
}
