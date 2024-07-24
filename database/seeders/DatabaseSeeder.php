<?php

namespace Database\Seeders;

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
        // 他のシーダーもここで呼び出します。
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
