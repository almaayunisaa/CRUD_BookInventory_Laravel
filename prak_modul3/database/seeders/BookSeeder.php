<?php

namespace Database\Seeders;
use App\Models\Book;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Book::create([
            'author_id' => 1,
            'title' => 'Bumi',
            'year'=> 2020
        ]);

        Book::create([
            'author_id' => 1,
            'title' => 'Putih',
            'year'=> 2024
        ]);

        Book::create([
            'author_id' => 2,
            'title' => 'Radit2',
            'year'=> 2020
        ]);

        Book::create([
            'author_id' => 2,
            'title' => 'Radit3',
            'year'=> 2024
        ]);

        Book::create([
            'author_id' => 3,
            'title' => 'Human',
            'year'=> 1990
        ]);

        Book::create([
            'author_id' => 3,
            'title' => 'Lives',
            'year'=> 1990
        ]);
    }
}
