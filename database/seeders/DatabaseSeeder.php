<?php

namespace Database\Seeders;

use App\Infrastructure\Models\UserModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserModel::factory(1000)->create();
    }
}
