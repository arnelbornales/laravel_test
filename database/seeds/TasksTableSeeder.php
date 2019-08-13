<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
          'subject' => 'Task 1',
          'body' => str_random(20),
        ]);
        DB::table('tasks')->insert([
           'subject' => 'Task 2',
           'body' => str_random(60),
        ]);
        DB::table('tasks')->insert([
           'subject' => 'Task 3',
           'body' => str_random(50),
        ]);
        DB::table('tasks')->insert([
           'subject' => 'Task 4',
           'body' => str_random(55),
        ]);
        DB::table('tasks')->insert([
           'subject' => 'Task 5',
           'body' => str_random(80),
        ]);
    }
}
