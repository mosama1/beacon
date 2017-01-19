<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([ //,
            'type' => "1",
            "price"  => 50.23,
            'section_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('menus')->insert([ //,
            'type' => "2",
            "price"  => 15.23,
            'section_id' => 1,
            'user_id' => 1,
        ]);
    }
}
