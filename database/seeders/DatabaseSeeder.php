<?php

namespace Database\Seeders;

use App\Models\Task;
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
        $users = User::factory(2)->create();
        $tasks = Task::factory()->count(5)->make(['user_id' => null]);

        $tasks->each(function (Task $advt) use ($users) {
            $advt->user()->associate($users->random());
            $advt->save();
        });
    }
}
