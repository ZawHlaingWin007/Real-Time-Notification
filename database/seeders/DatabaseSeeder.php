<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupUser;
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
        User::factory(10)->create();
        Group::factory(5)->create();

        // Get all group and user IDs
        $groupIds = Group::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        // Shuffle the arrays to generate random pairs
        shuffle($groupIds);
        shuffle($userIds);

        for ($i = 0; $i < 10; $i++) {
            GroupUser::create([
                'group_id' => $groupIds[$i % 5], // Modulus 5 to ensure group_id is within range
                'user_id' => $userIds[$i % 10], // Modulus 10 to ensure user_id is within range
                'joined_date' => now(),
            ]);
        }
    }
}
