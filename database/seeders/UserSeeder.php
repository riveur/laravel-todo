<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $taskCategory = TaskCategory::factory()->create();

        User::factory()
            ->count(2)
            ->has(Task::factory()
                ->count(5)
                ->for($taskCategory))
            ->create();
    }
}
