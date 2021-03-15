<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gender')->delete();
        $gender = array(
            array('id' => 1, 'gender_name' => 'Male'),
            array('id' => 2, 'gender_name' => 'Female'),
            array('id' => 3, 'gender_name' => 'Trans'),
            array('id' => 4, 'gender_name' => 'Others'),
        );

        DB::table('gender')->insert($gender);

    }
}
