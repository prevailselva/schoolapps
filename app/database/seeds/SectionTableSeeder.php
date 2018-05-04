<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SectionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('section')->delete();        
        Section::create(array('code'=>'A','name'=>'A','description'=>'A Section','combinePass' => '1'));
		Section::create(array('code'=>'B','name'=>'B','description'=>'B Section','combinePass' => '1'));
		Section::create(array('code'=>'C','name'=>'C','description'=>'C Section','combinePass' => '1'));
		Section::create(array('code'=>'D','name'=>'D','description'=>'D Section','combinePass' => '1'));
		Section::create(array('code'=>'E','name'=>'E','description'=>'E Section','combinePass' => '1'));	
    }

}
