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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//ȫվ��ʾ


Route::get('/',function(){
	
	
	$tableService=new TableServices();
	$datas=$tableService->getNewestData();

	
	return view('index',['datas'=>$datas]);
	//return view('alarmmessage');
	//return view('railuse');
	//return view('error');
	//return view('wuchangstation');
	
});



//Route::get('/','MainController@index');

Route::get('/survey','MainController@sourceSurvey');

Route::get('/searchRailUse',['as' => 'railuse','uses'=>'MainController@searchRailUse']);

Route::get('/searchPowerUse',['as' => 'poweruse','uses'=>'MainController@searchPowerUse']);

Route::get('/searchAlarmMessage',['as' => 'alarmmessage','uses'=>'MainController@searchAlarmMessage']);

Route::get('/viewHistoryRecord','MainController@viewHistoryRecord');




