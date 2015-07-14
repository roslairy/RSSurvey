<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TableServices;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
	
	
				/****************以下是实时监控模块***************/
	
	public function  sourceSurvey(){
		
		
		$sourceId=Input::get('sourceId');
		
		$tableService=new TableServices();
		$tableService->getCurrentSourceMessage($sourceId);
	}

	
	/*******************************************************************************/
	
				/****************以下是三个查询模块***************/
	
	/*******************************************************************************/
	
	//车次使用查询
	public function searchRailUse(){
		
	
		//输入参数验证
		$validator=Validator::make(Input::all(),
				[
						'beginTime'=>'date',
						'stopTime'=>'date',
						'powerName'=>'integer'					
				]);		
		
		//验证未通过跳转到出错页面
		if($validator->fails()){
			$validatorMessage=$validator->messages();
			return view('error',['validatorMessage'=>$validatorMessage]);
			
		}
		
		//若验证通过获取参数并设置默认值
		$beginTime=Input::get('beginTime','0000-00-00');
		$stopTime=Input::get('stopTime','0000-00-00');
		$powerName=Input::get('powerName','0');
		
		//判断是否有导出excel表格请求
		if(Input::has('export')){
			$sRailUseDatas=Session::get('sRailUseDatas',['null'=>'null']);
			Excel::create('车次使用情况',function($excel)	use($sRailUseDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sRailUseDatas){
					$sheet->fromArray($sRailUseDatas);
				});
			})->export('xls');
		}
		
		$tableService=new TableServices();
		$datas=$tableService->getRailUse($beginTime, $stopTime, $powerName);
		
		
		
		//构造excel表格数据源，用于导出		
		$excelArray=array();
		
		
		//excel表格字段名
		$excelKeys=['车号','电源编号','轨道号','开始时间','结束时间','用电量'];
				
		//excel表格值
		for($i=0;$i<count($datas);$i++){
			$excelArray[$i]=array_combine($excelKeys, $datas[$i]);
		}
		
		//将数据保存在session中，用于导出excel表格。
		Session::put('sRailUseDatas',$excelArray);
				
		return view('railuse',['datas'=>$datas]);
	}

	/**************************/
	
	//电源使用情况查询
	public function searchPowerUse(){	
		
		//输入参数验证
		$validator=Validator::make(Input::all(),
				[
						'beginTime'=>'date',
						'stopTime'=>'date',
						'powerName'=>'integer'
				]);
		
		//验证未通过跳转到出错页面
		if($validator->fails()){
			$validatorMessage=$validator->messages();
			return view('error',['validatorMessage'=>$validatorMessage]);
				
		}
		
		//判断是否有导出excel表格请求
		if(Input::has('export')){
			$sPowerUseDatas=Session::get('sPowerUseDatas',['null'=>'null']);
			Excel::create('电源使用情况',function($excel)	use($sPowerUseDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sPowerUseDatas){
					$sheet->fromArray($sPowerUseDatas);
				});
			})->export('xls');
		}
		
		//若验证通过获取参数并设置默认值
		$beginTime=Input::get('beginTime','0000-00-00');
		$stopTime=Input::get('stopTime','0000-00-00');
		$powerName=Input::get('powerName','0');
	
		
		$tableService=new TableServices();
		
		//获取查询数据
		$datas=$tableService->getPowerUse($beginTime, $stopTime, $powerName);
		
		/*
		foreach ($datas[0] as $key=>$value)
			echo $key.'=>'.$value.'<br>';
		*/		
		
		//构造excel表格数据源，用于导出
		$excelArray=array();		
		//excel表格字段名
		$excelKeys=['电源编号','路数','轨道号','车号','开始时间','结束时间','用电量'];

		//组合得到完整数据表
		for($i=0;$i<count($datas);$i++){
			$excelArray[$i]=array_combine($excelKeys, $datas[$i]);
		}
		
		//将数据保存在session中，用于导出excel表格。
		Session::put('sPowerUseDatas',$excelArray);		
				
		return view('poweruse',['datas'=>$datas]);
		
	}
	
	/**************************/
	
	//故障情况查询
	public function searchAlarmMessage(){
	
		//输入参数验证
		$validator=Validator::make(Input::all(),
				[
						'alarmTime'=>'date',
						'endTime'=>'date',
						'powerName'=>'integer'
				]);
		
		//验证未通过跳转到出错页面
		if($validator->fails()){
			$validatorMessage=$validator->messages();
			return view('error',['validatorMessage'=>$validatorMessage]);
		
		}
		
		//判断是否有导出excel表格请求
		if(Input::has('export')){
			$sAlarmMessageDatas=Session::get('$sAlarmMessageDatas',['null'=>'null']);
			Excel::create('故障记录',function($excel)	use($sAlarmMessageDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sAlarmMessageDatas){
					$sheet->fromArray($sAlarmMessageDatas);
				});
			})->export('xls');
		}
		
		
		$alarmTime=Input::get('alarmTime','0000-00-00');
		$endTime=Input::get('endTime','0000-00-00');
		$powerName=Input::get('powerName','0');
	
		$tableService=new TableServices();
		$datas=$tableService->getAlarmMessage($alarmTime, $endTime, $powerName);
		
		//构造excel表格数据源，用于导出
		$excelArray=array();
		//excel表格字段名
		$excelKeys=['电源编号','路数','故障类型','故障时间','解除故障时间'];
		
		//组合得到完整数据表
		for($i=0;$i<count($datas);$i++){
			$excelArray[$i]=array_combine($excelKeys, array_values($datas[$i]));
		}
		//将数据保存在session中
		Session::put('$sAlarmMessageDatas',$excelArray);
		
		
		return view('alarmmessage',['datas'=>$datas]);
	
	}
	
	
	
	/*******************************************************************************/
	
				/****************以下是站场历史信息查询模块***************/
	
	/*******************************************************************************/
	
	//站场历时信息查看
	public function viewHistoryRecord(){
		
		$powerName=Input::get('powerName');
		$saveTime=Input::get('saveTime');
		
		$tableService=new TableServices();
		$tableService->getHistoryRecord($powerName, $saveTime);
	}
	

}
