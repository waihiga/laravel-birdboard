<?php
/**
 * Created by PhpStorm.
 * User: dmburu
 * Date: 21/01/2019
 * Time: 13:00
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Douglas Mburu',
            'email' => 'douglasmburu10%@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
