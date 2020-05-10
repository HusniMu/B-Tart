<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id' => '1',
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'member satu',
            'username' => 'member satu',
            'email' => 'member1@member.com',
            'password' => bcrypt('test1234')
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'member dua',
            'username' => 'member dua',
            'email' => 'member2@member.com',
            'password' => bcrypt('test1234')
        ]);
    }
}
