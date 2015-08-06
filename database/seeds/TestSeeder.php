<?php

use Illuminate\Database\Seeder;
use App\TestModel;
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
        
    	//填充历史数据
    	for($i=0;$i<24;$i++){
    		for($j=0;$j<60;$j++){
    			for($k=0;$k<6;$k++){
    				$second=10*$k;
		    		TestModel::create(array(
			    		'PowerName'=>'1',
			    		'savetime'=>'2015-08-06'.' '.$i.':'.$j.':'.$second,
			    		'vol1'=>rand(0, 750),
			    		'volz1'=>rand(0, 750),
			    		'cur1'=>rand(0, 700),
			    		'vol2'=>rand(0, 750),
			    		'volz2'=>rand(0, 750),
			    		'cur2'=>rand(0, 700),
		    		));
    			}
    			
    		}
    	}
    	
        /*
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
         	TestModel3::create(array(
         	'ThisName'=>$i,
         	'PowerName'=>$i,
         	'PowerNum'=>$i,
         	'Alarm'=>$i,
         	'AlarmTime'=>$i,
         	'EndTime'=>$i,
         	));
         }
         */
    }
}
