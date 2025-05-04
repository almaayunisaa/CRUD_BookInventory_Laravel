<?php

namespace Database\Seeders;
use App\Models\Author;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Author::create(['name' => 'Tere Liye', 'email'=> 'tereliye@gmail.com']);
        Author::create(['name' => 'Raditya Dika', 'email'=> 'raditya@gmail.com']);
        Author::create(['name' => 'Dazai', 'email'=> 'dazaiosamu@gmail.com']);
    }
}
