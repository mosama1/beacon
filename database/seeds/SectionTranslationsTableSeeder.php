<?php

use Illuminate\Database\Seeder;

class SectionTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('section_translations')->insert([ //,
            'name' => "seccion 1",
            'language_id' => 1,
            'section_id' => 1,
        ]);

        DB::table('section_translations')->insert([ //,
            'name' => "seccion 1",
            'language_id' => 2,
            'section_id' => 1,
        ]);
    }
}
