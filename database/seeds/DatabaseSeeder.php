<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(TypesPlatesTableSeeder::class);
        $this->call(TranslationsPlatesTableSeeder::class);
        $this->call(PlatesTableSeeder::class);
    }
}
