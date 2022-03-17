<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Libro;
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

        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);

        User::factory(10)->create();
        Blog::factory(10)->create();
        Libro::factory(10)->create();
        
    }
}
