<?php
use App\TableServices;
use App\TableModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//全站信息
Route::get('/',function(){

	$tableService=new TableServices();
	$datas=$tableService->getNewestData();	
	return view('index',['datas'=>$datas,'navName'=>'index']);
	
	//return view('alarmmessage');
	//return view('railuse');
	//return view('error');
	//return view('xinyangstation');
	//return view('chart');
	//return view('xinyangstation');
	//return view('survey');
	
	//echo strtotime("2015-07-21 11:20:30");
	
});

//站场监控
Route::get('/survey',['as'=>'survey','uses'=>'MainController@surveyStation']);

//图表显示
Route::get('/chart',['as'=>'chart','uses'=>'MainController@showChart']);


//车次使用查询
Route::get('/searchRailUse',['as' => 'railuse','uses'=>'MainController@searchRailUse']);

//电源使用查询
Route::get('/searchPowerUse',['as' => 'poweruse','uses'=>'MainController@searchPowerUse']);

//故障信息使用查询
Route::get('/searchAlarmMessage',['as' => 'alarmmessage','uses'=>'MainController@searchAlarmMessage']);





