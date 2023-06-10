<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Coach;
use App\Models\Player;
use App\Models\Team;
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
        User::truncate();
        Team::truncate();
        Player::truncate();
        Coach::truncate();

        User::factory(2)->create();

        Team::factory(5)
            ->has(Coach::factory(1))
            ->has(Player::factory(10))
            ->create();
    }
}
