<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TableModel;

class TestController extends Controller
{
	//模拟定时刷新最新站场数据
    public function refreshNewDataT(){
    	
    	$i=0;
    	while($i<=15){
	    	$row=TableModel::find($i);
	    	if($row!=null){
	    		$x1=rand(0, 200);
	    		$y1=rand(0, 200);	    		
		    	$row->vol1=$x1>$y1?$x1:$y1;
		    	$row->volz1=$x1<$y1?$x1:$y1;
		    	$row->cur1=rand(0, 700);
		    	
		    	$x2=rand(0, 750);
		    	$y2=rand(0, 750);
		    	$row->vol2=$x2>$y2?$x2:$y2;
		    	$row->volz2=$x2<$y2?$x2:$y2;
		    	$row->cur2=rand(0, 700);
		    	
		    	$row->save();
    		}
	    	$i++;
    	}
    }	
}
