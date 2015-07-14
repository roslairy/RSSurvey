<?php

use Illuminate\Database\Seeder;
use App\TestModel0;
use App\TestModel1;
use App\TestModel2;
use App\TestModel3;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        for($i=10;$i<16;$i++){
        	TestModel0::create(array(
        		'ThisName'=>$i,
        		'PowerName'=>$i,
        		'vol1'=>$i,
        		'volz1'=>$i,
        		'cur1'=>$i,
        		'condition1'=>$i,
        		'RailwayName1'=>$i,
        		'RailNum1'=>$i,
        		
        		'vol2'=>$i,
        		'volz2'=>$i,
        		'cur1'=>$i,
        		'condition2'=>$i,
        		'RailwayName2'=>$i,
        		'RailNum2'=>$i,
        		
        	));
        }
        
        
        for($i=10;$i<16;$i++){
        	TestModel1::create(array(
        		'ThisName'=>$i,
        		'PowerName'=>$i,
        		'RailwayName'=>$i,
        		'RailNum'=>$i,
        		'BeginTime'=>$i,
        		'StopTime'=>$i,
        		'UseKWH'=>$i,
        	));
        }
       
        
         for($i=10;$i<16;$i++){
        	TestModel2::create(array(
        		'ThisName'=>$i,
        		'PowerName'=>$i,
        		'PowerNum'=>$i,
        		'RailwayName'=>$i,
        		'RailNum'=>$i,
        		'BeginTime'=>$i,
        		'StopTime'=>$i,
        		'BeginKWH'=>$i,
        		'StopKWH'=>$i,
        		'UseKWH'=>$i,
        	));
        	
         }
         
         for($i=10;$i<16;$i++){
         	TestModel3::create(array(
         	'ThisName'=>$i,
         	'PowerName'=>$i,
         	'PowerNum'=>$i,
         	'Alarm'=>$i,
         	'AlarmTime'=>$i,
         	'EndTime'=>$i,
         	));
         }
    }
}
