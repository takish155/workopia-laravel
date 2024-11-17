<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables (or empty it)
        DB::table("job_listings")->truncate();
        DB::table("users")->truncate();

        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
    }
}
