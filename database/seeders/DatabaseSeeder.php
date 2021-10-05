<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::truncate();
        User::factory(20)->create();

        Category::truncate();
        Category::factory(20)->create();

        Product::truncate();
        Product::factory(20)->create();

        $this->call(PostSeeder::class);
    }
}
