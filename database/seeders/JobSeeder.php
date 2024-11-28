<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings
        $jobListings = include database_path("seeders/data/job_listings.php");

        $testUserId = User::where("email", "test@test.com")->value("id");
        // Get user id
        $userIds = User::where("email", "!=", "test@test.com")->pluck("id")->toArray();

        foreach ($jobListings as $index => &$listing) {
            // Assign user id to listing
            if ($index > 2) {
                $listing["user_id"]  = $testUserId;
            } else {
                $listing["user_id"] = $userIds[array_rand($userIds)];
            }


            $listing["created_at"] = now();
            $listing["updated_at"] = now();
        }

        // Insert into job listing
        DB::table("job_listings")->insert($jobListings);
        echo "Job created successfully!";
    }
}
