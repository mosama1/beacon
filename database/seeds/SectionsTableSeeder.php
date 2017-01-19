<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([ //,
            'coupon_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('sections')->insert([ //,
            'coupon_id' => 2,
            'user_id' => 1,
        ]);

        DB::table('sections')->insert([ //,
            'coupon_id' => 3,
            'user_id' => 1,
        ]);
    }
}
