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

        for ($i=0; $i < 10; $i++) { 
            GroupUser::create([
                'group_id' => rand(1, 5),
                'user_id' => rand(1, 10),
                'joined_date' => now(),
            ]);
        }
    }
}
