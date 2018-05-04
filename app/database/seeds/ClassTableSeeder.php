<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ClassTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('classes')->delete();        
        Class::create(array('code'=>'I','name'=>'I','description'=>'First Standard','combinePass' => '1'));
        Class::create(array('code'=>'II','name'=>'II','description'=>'Second Standard','combinePass' => '1'));
		Class::create(array('code'=>'III','name'=>'III','description'=>'Third Standard','combinePass' => '1'));		
    }

}
