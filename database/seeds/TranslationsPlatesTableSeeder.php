<?php

use Illuminate\Database\Seeder;

class TranslationsPlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translations_plates')->insert([ //,
            'description' => "descripcion 1",
            'language_id' => 1,
            'plate_id' => 1,
        ]);

        DB::table('translations_plates')->insert([ //,
            'description' => "description 1",
            'language_id' => 2,
            'plate_id' => 1,
        ]);
    }
}
