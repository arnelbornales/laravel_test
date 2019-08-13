<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Arnel Bornales',
            'email' => 'arnelbornales+1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'fullname' => 'Ar Br',
            'email' => 'b'.str_random(4).'@gmail.com',
            'password' => bcrypt('password'),
       ]);
        DB::table('users')->insert([
            'fullname' => 'Clark Steve',
            'email' => 'c'.str_random(4).'@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'fullname' => 'Rose Smith',
            'email' => 'd'.str_random(4).'@gmail.com',
            'password' => bcrypt('password'),
       ]);
        DB::table('users')->insert([
            'fullname' => 'Client 1',
            'email' => 'd'.str_random(4).'@gmail.com',
            'password' => bcrypt('password'),
       ]);
        DB::table('users')->insert([
           'fullname' => 'Client 2',
           'email' => 'd'.str_random(4).'@gmail.com',
           'password' => bcrypt('password'),
        ]);
    }
}
