<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // ユーザーIDの配列を取得
        $userIds = DB::table('users')->pluck('id')->toArray();
        // グループIDの配列を取得
        $groupIds = DB::table('groups')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {

            DB::table('tasks')->insert([
                'user_id' => $faker->randomElement($userIds), // 存在するユーザーIDを使用
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'status' => $faker->randomElement(['pending', 'in_progress', 'completed']),
                'due_date' => $faker->date,
                'priority' => $faker->numberBetween(1, 5),
                'group_id' => $faker->randomElement($groupIds), // 存在するグループIDを使用
                'assigned_to' => $faker->randomElement($userIds), // 存在するユーザーIDを使用
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}
?>
