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
        //$this->call(UsersTableSeeder::class);
        //$this->call(LanguagesTableSeeder::class);
        // $this->call(TypesPlatesTableSeeder::class);
        // $this->call(MenusTableSeeder::class);
        // $this->call(MenuTranslationsTableSeeder::class);
        // $this->call(PlatesTableSeeder::class);
        // $this->call(PlateTranslationsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        $this->call(SectionTranslationsTableSeeder::class);
    }
}
