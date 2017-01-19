<?php

use Illuminate\Database\Seeder;

class PlateTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plate_translations')->insert([ //,
            'description' => "descripcion 1",
            'language_id' => 1,
            'plate_id' => 1,
        ]);

        DB::table('plate_translations')->insert([ //,
            'description' => "description 1",
            'language_id' => 2,
            'plate_id' => 1,
        ]);
    }
}
