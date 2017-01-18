<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([ //,
            'name' => "Escpañol",
            'abbreviation' => "ES",
        ]);

        DB::table('languages')->insert([ //,
            'name' => "English",
            'abbreviation' => "EN",
        ]);

        DB::table('languages')->insert([ //,
            'name' => "language 3",
            'abbreviation' => "L3",
        ]);

        DB::table('languages')->insert([ //,
            'name' => "language 4",
            'abbreviation' => "L4",
        ]);
    }
}
