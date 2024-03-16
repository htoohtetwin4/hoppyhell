<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::create(['name' => 'Ivan', 'status' => 'Alive']);
        Character::create(['name' => 'Vic', 'status' => 'Alive']);
        Character::create(['name' => 'Ral', 'status' => 'Alive']);
        Character::create(['name' => 'Smant', 'status' => 'Alive']);
        Character::create(['name' => 'Creature', 'status' => 'Alive']);
    }
}
