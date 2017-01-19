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
            'name' => "JoseM",
            'email' => "jm_16_2008@hotmail.com",
            'password' => '$2y$10$cWmtj4nzdDMwFtR.LmWw6Oi9ymhXK2SpJiJLFj7e89jSrq21Gk.nO',
            'phone' => "04166369481",
            'language' => "ES",
        ]);
        DB::table('users')->insert([ //,
            'name' => "asdasd",
            'email' => "mu@dementecreativo.com",
            'password' => '$2y$10$a7GhuOsrJACtqc/pMenLYuJnCKeM4HYBzZfHuExlUIcx7Y.5Nhr/u',
            'phone' => "04166362133",
            'language' => "ES",
        ]);
        DB::table('users')->insert([ //,
            'name' => "jd",
            'email' => "jd@dementecreativo.com",
            'password' => bcrypt("123456"),
            'phone' => "04141234567",
            'language' => "ES",
        ]);
    }
}
