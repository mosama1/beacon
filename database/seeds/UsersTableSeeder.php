<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ //,
            'name' => "jd",
            'email' => "jd@dementecreativo.com",
            'password' => bcrypt("123456"),
            'phone' => "04141234567",
            'language' => "ES",
        ]);
    }
}
