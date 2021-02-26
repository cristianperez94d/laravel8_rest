<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // \App\Models\User::factory(10)->create();

        $cantidad = 5;
        for ($i=0; $i < $cantidad; $i++) { 
            Book::factory()->create(['id' => $i++]);
        }
        Author::factory(5)->create();
    }
}
