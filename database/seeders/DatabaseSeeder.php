<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LaratrustSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Supplier::factory(100)->create();
        // $this->call(LaratrustSeeder::class);
    }
}
