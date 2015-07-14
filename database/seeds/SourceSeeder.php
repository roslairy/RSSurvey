<?php
namespace App;
use Illuminate\Database\Seeder;
use App\TableModel;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$tableModel=new TableModel();
    	$tableModel->setTable('NewData');
    	
    	for($i=0;$i<10;$i++){
    		TableModel::create(array(
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
    	
    	$tableModel=new TableModel();
    	$tableModel->setTable('RailUse');
    	
    	for($i=0;$i<10;$i++){
    		TableModel::create(array(
    		'ThisName'=>$i,
    		'PowerName'=>$i,
    		'RailwayName'=>$i,
    		'RailNum'=>$i,
    		'BeginTime'=>$i,
    		'StopTime'=>$i,
    		'UseKWH'=>$i,
    		));
    	}
    	
    	
    	$tableModel=new TableModel();
    	$tableModel->setTable('PowerUse');
    	
    	for($i=0;$i<10;$i++){
    		TableModel::create(array(
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
    	 
    	$tableModel=new TableModel();
    	$tableModel->setTable('AlarmMessage');
    	 
    	for($i=0;$i<10;$i++){
    		TableModel::create(array(
    		'ThisName'=>$i,
    		'PowerName'=>$i,
    		'PowerNum'=>$i,
    		'Alarm'=>$i,
    		'AlarmTime'=>$i,
    		'EndTime'=>$i,
    		'UseKWH'=>$i,
    		));
    	}
    }
}
