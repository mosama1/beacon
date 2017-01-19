<?php

use Illuminate\Database\Seeder;

class MenuTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_translations')->insert([ //,
            'name' => "menú 1",
            'language_id' => 1,
            'menu_id' => 1,
        ]);

        DB::table('menu_translations')->insert([ //,
            'name' => "menú 1",
            'language_id' => 2,
            'menu_id' => 1,
        ]);
    }
}
