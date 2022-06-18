<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Nguyễn Anh Vũ',
            'email' => 'anhvu4777@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 1
        ],[
            'name' => 'Phan Việt Anh',
            'email' => 'anhvu122002@gmail.com',
            'password' => bcrypt('user'),
            'role' => 0
        ]]);
    }
}
