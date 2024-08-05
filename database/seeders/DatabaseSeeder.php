<?php

namespace Database\Seeders;

use App\Models\Ab;
use App\Models\Photo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Ab::factory(100)->create();
        Photo::factory()
            ->sequence(fn() => [
                'ab_id' => Ab::all()->random(),
            ])
            ->count(300)->create();
    }
}
