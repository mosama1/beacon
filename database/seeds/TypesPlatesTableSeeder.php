<?php

use Illuminate\Database\Seeder;

class TypesPlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_plates')->insert([ //,
            'name' => "tipo plato 1",
            'description' => "descripcion 1",
            'language_id' => 1,
        ]);

        DB::table('types_plates')->insert([ //,
            'name' => "typo plate 1",
            'description' => "description 1",
            'language_id' => 2,
        ]);
    }
}
