<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Address;
use Domains\Customer\Models\Cart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory()->create();
        Variant::factory(50)->create();
        Cart::factory(10)->create() ;
    }
}
