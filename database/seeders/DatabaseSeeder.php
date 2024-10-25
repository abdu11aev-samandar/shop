<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Category;
use Domains\Catalog\Models\Range;
use Domains\Customer\Models\Address;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Location::factory(50)->create();
        Address::factory()->create();
        Category::factory(10)->create();
        Range::factory(10)->create();
    }
}
