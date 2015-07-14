<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('NewData',function(Blueprint $table){
    		$table->increments('id');
    		$table->timestamps();
    		 
    		$table->string('ThisName');
    		$table->string('PowerName');
    		$table->integer('vol1');
    		$table->integer('volz1');
    		$table->integer('cur1');
    		$table->string('condition1');
    		$table->string('RailwayName1');
    		$table->integer('RailNum1');
    		 
    		$table->integer('vol2');
    		$table->integer('volz2');
    		$table->integer('cur2');
    		$table->string('condition2');
    		$table->string('RailwayName2');
    		$table->integer('RailNum2');
    		 
    	});
    		 
    		Schema::create('RailUse',function(Blueprint $table){
    			$table->increments('id');
    			$table->timestamps();
    			 
    			$table->string('ThisName');
    			$table->string('PowerName');
    			$table->string('RailwayName');
    			$table->integer('RailNum');
    			$table->dateTime('BeginTime');
    			$table->dateTime('StopTime');
    			$table->integer('UseKWH');
    			 
    			 
    		});
    			 
    			Schema::create('PowerUse',function(Blueprint $table){
    				$table->increments('id');
    				$table->timestamps();
    				 
    				$table->string('ThisName');
    				$table->string('PowerName');
    				$table->string('PowerNum');
    				$table->string('RailwayName');
    				$table->integer('RailNum');
    				$table->dateTime('BeginTime');
    				$table->dateTime('StopTime');
    				$table->integer('BeginKWH');
    				$table->integer('StopKWH');
    				$table->integer('UseKWH');
    				 
    			});
    				 
    				Schema::create('AlarmMessage',function(Blueprint $table){
    					$table->increments('id');
    					$table->timestamps();
    					 
    					$table->string('ThisName');
    					$table->string('PowerName');
    					$table->integer('PowerNum');
    					$table->string('Alarm');
    					$table->dateTime('AlarmTime');
    					$table->dateTime('EndTime');
    				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('NewData');
        Schema::drop('RailUse');
        Schema::drop('PowerUse');
        Schema::drop('AlarmMessage');
    }
}
