<?php

use Illuminate\Database\Seeder;

class PlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plates')->insert([ //,
            'menu_id' => 1,
            'user_id' => 1,
            'type_plate_id' => 1,
            "img"  => "",
        ]);
        DB::table('plates')->insert([ //,
            'menu_id' => 1,
            'user_id' => 1,
            'type_plate_id' => 2,
            "img"  => "",
        ]);
    }
}
