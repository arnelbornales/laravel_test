<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class TasksUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks_users')->insert([
        'task_id' => 1,
        'user_id' => 1
        ]);
        DB::table('tasks_users')->insert([
         'task_id' => 1,
         'user_id' => 2
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 2,
         'user_id' => 1
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 2,
         'user_id' => 3
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 3,
         'user_id' => 2
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 3,
         'user_id' => 3
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 4,
         'user_id' => 1
         ]);
        DB::table('tasks_users')->insert([
         'task_id' => 4,
         'user_id' => 2
         ]);
    }
}
