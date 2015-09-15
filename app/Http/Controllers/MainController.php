<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TableServices;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Faker\Provider\DateTime;

class MainController extends Controller
{
	
	//站场中英文名映射数组
	public $stageNameChinese=[			
			'wuchang'=>'武昌',
			'hankou'=>'汉口',
			'yichang'=>'宜昌',
			'xiangyang'=>'襄阳',
			'xinyang'=>'信阳'
	];
				/****************以下是全站显示模块***************/
	public function index(){
		
		if(Input::has('notFirst')){
			$tableService=new TableServices();
			$datas=$tableService->getNewestData();
			return response()->json([
					'wuchang'=>$datas[0],
					'hankou'=>$datas[1],
					'yichang'=>$datas[2],
					'xiangyang'=>$datas[3],
					'xinyang'=>$datas[4],
					'powerNum'=>$datas[5]//电源数目
				]);
		}
		
		//若第一次打开主页面
		return view('index',['navName'=>'index']);
 }
	
				/****************以下是站场实时监控模块***************/
	
	
	public function  surveyStation(){	
			
		// TODO: 表单验证
		$stageName=Input::get('stageName','nodefine');//站场ID及默认值
		$isFirst=Input::get('isFirst');
	
		//字段合法性验证
		if($stageName!='yichang'&&$stageName!='xinyang'&&$stageName!='wuchang'&&$stageName!='hankou'&&$stageName!='xiangyang')
			return view('error',['validatorMessage'=>'对不起，您查找的站场不在服务范围']);
		
		//判断是否第一次请求		
		if($isFirst!=null)
			return view('stage',['stageName'=>$stageName,'stageNameChinese'=>$this->stageNameChinese[$stageName],'navName'=>$stageName]);
		
		$tableService=new TableServices();
		$datas=$tableService->getStationMessageById($stageName);
		
		//返回json数据到请求页面
		return response()->json(['jsonDatas'=>$datas]);		
		
	}

	
		
	/**************************************************************************/
	
				/****************以下是图表显示模块***************/
	
	/**************************************************************************/
	
		
	public function showChart(){

		//第一次请求
		if(Input::has('isFirst'))
			return view('chart',['navName'=>'chart']);
				
		$validator = Validator::make(Input::all(),[
				'date' => 'required|date',
				'selectWhat'=> 'required',
				'stageId'=> 'required|between:0,6',
				'powerName'=> 'required',								
		]);
		if($validator->fails())
			return view('error',['navName'=>'chart','validatorMessage'=>'输入参数验证出错！']);
		
		//验证通过则获取相关参数
		$selectWhat=Input::get('selectWhat');
		$stageId=Input::get('stageId');
		$powerName=Input::get('powerName');
		$date=Input::get('date');
		
		if($selectWhat!='vol1'&&$selectWhat!='cur1'&&$selectWhat!='i1'&&$selectWhat!='vol2'&&$selectWhat!='cur2'&&$selectWhat!='i2')
			return view('error',['navName'=>'chart','validatorMessage'=>'暂不支持此选项的图表显示']);
		
		$tableService=new TableServices();
		$datas=$tableService->getSourceMessageInHistory($stageId,$date,$powerName,$selectWhat);

		return response()->json(['x'=>$datas[0],'y'=>$datas[1]]);
	}

	
		
	/**************************************************************************/
	
				/****************以下是三个查询模块***************/
	
	/**************************************************************************/
	
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
		$beginTime=Input::get('beginTime','');
		$stopTime=Input::get('stopTime','');
		$powerName=Input::get('powerName','');
		$stageName=Input::get('stageName','');
		
		//判断是否有导出excel表格请求
		if(Input::has('export')){
			
			$sRailUseDatas=Session::get('sRailUseDatas',['null'=>'null']);
			
			Excel::create('railuse',function($excel)	use($sRailUseDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sRailUseDatas){
					$sheet->fromArray($sRailUseDatas);
				});
			})->export('xls');
		}
		
		$tableService=new TableServices();
		$datas=$tableService->getRailUse($beginTime, $stopTime, $stageName,$powerName);
		
		
		
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
				
		return view('railuse',[
				'stageName'=>$stageName,
				'stageNameChinese'=>$this->stageNameChinese,
				'beginTime'=>$beginTime,
				'stopTime'=>$stopTime,
				'datas'=>$datas,
				'navName'=>'railuse'
		]);
	}

	/**************************/
	
	//电源使用情况查询
	public function searchPowerUse(){	
		
		
		$validator=Validator::make(Input::all(),
				[
						'beginTime'=>'date',
						'stopTime'=>'date',
						'powerName'=>'integer'
				]);
		
		//验证未通过跳转到出错页面
		if($validator->fails()){
			$validatorMessage=$validator->messages();
			return view('error',['validatorMessage'=>$validatorMessage,'navName'=>'error']);
				
		}
		
		//判断是否有导出excel表格请求
		if(Input::has('export')){
			
			$sPowerUseDatas=Session::get('sPowerUseDatas',['null'=>'null']);
			
			Excel::create('poweruse',function($excel)	use($sPowerUseDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sPowerUseDatas){
					$sheet->fromArray($sPowerUseDatas);
				});
			})->export('xls');
		}
		
		//若验证通过获取参数并设置默认值
		$beginTime=Input::get('beginTime','');
		$stopTime=Input::get('stopTime','');
		$powerName=Input::get('powerName','');
		$stageName=Input::get('stageName','');
	
		
		$tableService=new TableServices();
		
		//获取查询数据
		$datas=$tableService->getPowerUse($beginTime, $stopTime, $stageName,$powerName);
		
		//构造excel表格数据源，用于导出
		$excelArray=array();		
		//设置excel表格字段名
		$excelKeys=['电源编号','路数','轨道号','车号','开始时间','结束时间','用电量'];

		//组合得到恰当格式的数据表数据数组
		for($i=0;$i<count($datas);$i++){
			$excelArray[$i]=array_combine($excelKeys, $datas[$i]);
		}
		
		//将最新查询数据保存在session中，用于导出excel表格。
		Session::put('sPowerUseDatas',$excelArray);						
		return view('poweruse',[
				'stageName'=>$stageName,
				'stageNameChinese'=>$this->stageNameChinese,
				'beginTime'=>$beginTime,
				'stopTime'=>$stopTime,
				'datas'=>$datas,
				'navName'=>'poweruse'
		]);
		
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
			Excel::create('trouble record',function($excel)	use($sAlarmMessageDatas){
				$excel->sheet('sheet0' ,function($sheet)	use($sAlarmMessageDatas){
					$sheet->fromArray($sAlarmMessageDatas);
				});
			})->export('xls');
		}
		
		
		$alarmTime=Input::get('alarmTime','');
		$endTime=Input::get('endTime','');
		$powerName=Input::get('powerName','');
		$stageName=Input::get('stageName','');
	
		$tableService=new TableServices();
		$datas=$tableService->getAlarmMessage($alarmTime, $endTime, $stageName,$powerName);
		
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
		
		return view('alarmmessage',[
				'stageName'=>$stageName,
				'stageNameChinese'=>$this->stageNameChinese,
				'alarmTime'=>$alarmTime,
				'endTime'=>$endTime,
				'datas'=>$datas,
				'navName'=>'alarmmessage'
		]);
	
	}
	
	
}
