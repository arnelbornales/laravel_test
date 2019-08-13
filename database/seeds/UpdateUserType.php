<?php

use Illuminate\Database\Seeder;

class UpdateUserType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update('UPDATE users SET type = 3 where id = ?', ['1']);
        DB::update('UPDATE users SET type = 3 where id = ?', ['2']);
        DB::update('UPDATE users SET type = 2 where id = ?', ['3']);
        DB::update('UPDATE users SET type = 2 where id = ?', ['4']);
        DB::update('UPDATE users SET type = 1 where id = ?', ['5']);
        DB::update('UPDATE users SET type = 1 where id = ?', ['6']);
    }
}
