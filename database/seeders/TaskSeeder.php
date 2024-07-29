<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Example Task',
            'description' => 'This is an example task description.',
            'status' => 'pending',
            'user_id' => 1,
            'group_id' => null,
            'due_date' => now(),
            'priority' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
