<?php
namespace App;
use App\TableModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;


//此类实现与数据库的交互，兼处理原始数据
class TableServices {
	
	
	/************************全站显示相关函数*************************************/	
	
	//获取最新信息
	public function getNewestData() {				
		
			//绑定数据表
			$tableModel=new TableModel();			
			$tableModel->setTable('NewData');
			
			//执行分站场查询操作
			$thisName1Datas=$tableModel::where('PowerName','<>','')
										->where('ThisName','=','武昌')
										->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
										->orderBy('PowerName')
										->get()
										->toArray();
			
			$thisName2Datas=$tableModel::where('PowerName','<>','')
										->where('ThisName','=','汉口')
										->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
										->get()
										->toArray();
			
			$thisName3Datas=$tableModel::where('PowerName','<>','')
										->where('ThisName','=','宜昌')
										->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
										->get()
										->toArray();
			
			$thisName4Datas=$tableModel::where('PowerName','<>','')
										->where('ThisName','=','襄阳')
										->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
										->get()
										->toArray();
			
			$thisName5Datas=$tableModel::where('PowerName','<>','')
										->where('ThisName','=','信阳')
										->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
										->get()
										->toArray();
						
			//调用格式化函数处理数据
			$thisName1Datas=$this->formatArray($thisName1Datas);
			$thisName2Datas=$this->formatArray($thisName2Datas);
			$thisName3Datas=$this->formatArray($thisName3Datas);
			$thisName4Datas=$this->formatArray($thisName4Datas);
			$thisName5Datas=$this->formatArray($thisName5Datas);
							
			//存储每个站场的电源数
			$powerNum=array(count($thisName1Datas),count($thisName2Datas),count($thisName3Datas),count($thisName4Datas),count($thisName5Datas));
			$datas=array($thisName1Datas,$thisName2Datas,$thisName3Datas,$thisName4Datas,$thisName5Datas,$powerNum);
			
			return $datas;
			
	}
		
	//处理指定站场数据，包括计算，格式化
	public function formatArray($datas){
		
		//处理结果数组
		$thisDatas=array();
		
		//分电源处理
		$len=count($datas);
		for($i=0;$i<$len;$i++){
			
			//一路
			$vol1=$datas[$i]['vol1'];
			$volz1=$datas[$i]['volz1'];
			
			//二路
			$vol2=$datas[$i]['vol2'];
			$volz2=$datas[$i]['volz2'];
			
			
			//Rx1,Rx2分别为负对地，正对地绝缘电阻			
			$Rx1s=$this->calculateResistor($vol1, $volz1);
			$Rx11=$Rx1s['$Rx1'];
			$Rx12=$Rx1s['$Rx2'];
			
			$Rx2s=$this->calculateResistor($vol2, $volz2);
			$Rx21=$Rx2s['$Rx1'];
			$Rx22=$Rx2s['$Rx2'];
			
			//判断结果，floor函数为取整
			$Rx11Result=($Rx11==-1||$Rx11>2500)?'绝缘正常':floor($Rx11).'Ω';			
			$Rx12Result=($Rx12==-1||$Rx12>2500)?'绝缘正常':floor($Rx12).'Ω';
			$Rx21Result=($Rx21==-1||$Rx21>2500)?'绝缘正常':floor($Rx21).'Ω';
			$Rx22Result=($Rx22==-1||$Rx22>2500)?'绝缘正常':floor($Rx22).'Ω';
			
			//只保留数组的值，以方便下一步插入操作和视图遍历
			$datas[$i]=array_values($datas[$i]);
			
			//插入处理后的数据
			array_splice($datas[$i], 5,0,$vol1-$volz1);//插入负对地电压
			array_splice($datas[$i], 6,0,$Rx12Result);//插入正对地绝缘电阻
			array_splice($datas[$i], 7,0,$Rx11Result);//插入负对地绝缘电阻
			array_splice($datas[$i], 14,0,$vol2-$volz2);
			array_splice($datas[$i], 15,0,$Rx22Result);
			array_splice($datas[$i], 16,0,$Rx21Result);
			
			//最后处理结果保存到返回数组
			$thisDatas[$i]=$datas[$i];
		}
				
		return $thisDatas;		
	}
		
	//此函数用来计算对地绝缘电阻
	public function calculateResistor($vol1,$volz1){
		
		//Rx1,Rx2分别为负对地绝缘电阻、正对地绝缘电阻
		
		//设定默认值
		$Rx1=$Rx2=-1;
		
		//正常情况下（即正对地电压=负对地电压）
		if($volz1==($vol1-$volz1)){}
		
		//若正负对地电压小于20V，直接显示绝缘正常
		else if($volz1 < 20 && ($vol1 - $volz1) < 20){}

		//负线存在对地电阻时
		else if($volz1>($vol1-$volz1))
			$Rx1=2100*($vol1-$volz1)/(2*$volz1-$vol1);
				
		//正线存在对地电阻时
		else
			$Rx2=2100*$volz1/($vol1-2*$volz1);	
		//返回计算结果
		return array('$Rx1'=>$Rx1,'$Rx2'=>$Rx2);						
	}
	
	
	
	
	/**************************分块查询相关函数***********************************/
		
	//获取车次使用信息
	public function getRailUse($beginTime,$stopTime,$stageName,$powerName){
		
		$tableModel=new TableModel();
		$tableModel->setTable('RailUse');
		
		$datas=$tableModel	->where('BeginTime','>=',$beginTime)
							->where('StopTime','<=',$stopTime)
							->where('ThisName','=',$stageName)
							->where('PowerName','=',$powerName)
							->select('ThisName','RailNum','PowerName','RailwayName','BeginTime','StopTime','UseKWH')
							->get()
							->toArray();
				
		return $datas;
		
	}
	
	//获取电源使用信息
	public function getPowerUse($beginTime,$stopTime, $stageName,$powerName){
		

		$tableModel=new TableModel();
		$tableModel->setTable('PowerUse');

		$datas=$tableModel	->where('BeginTime','>=',$beginTime)
							->where('StopTime','<=',$stopTime)
							->where('ThisName','=',$stageName)
							->where('PowerName','=',$powerName)
							->select('ThisName','PowerName','PowerNum','RailwayName','RailNum','BeginTime','StopTime','UseKWH')
							->orderBy('PowerNum')
							->get()
							->toArray();
	
		return $datas;				
	}
	
	//获取故障信息
	public function getAlarmMessage($alarmTime,$endTime,$stageName,$powerName){
		$tableModel=new TableModel();
		$tableModel->setTable('AlarmMessage');
	
		$datas=$tableModel  ->where('AlarmTime','>=',$alarmTime)
							->where('ThisName','=',$stageName)
							->where('PowerName','=',$powerName)
<<<<<<< HEAD
							->select('ThisName','PowerName','PowerNum','Alarm','AlarmTime','EndTime')
=======
							->select('PowerName','PowerNum','Alarm','AlarmTime','EndTime')
>>>>>>> origin/master
							->orderBy('PowerName')
							->get()
							->toArray();
		
		return $datas;
	
	}
				
	
	
	/**********************图表显示模块相关函数************************************/

	//获取指定日期指定电源的信息
	public function getSourceMessageInHistory($stageId,$date,$powerName,$lushu){
		
		//按约定规则构造得到对应表名
		
		//获取站场ID与名称的对应关系
		$tableModel = new TableModel();
		$tableModel -> setTable("ServerMessage");
		
		//从数据库中查找对应站场的实际ID
		$serverStageId = $tableModel -> where ('ThisName','=',$stageId)
									 ->select('ID')
									 ->get()
									 ->toArray();
		//转换日期格式		
		$date=date_create($date);
		$date_Y=date_format($date, 'Y');
		$date_m=date_format($date, 'm');
		$date_d=date_format($date, 'd');

		if ($date_m[0] == '0'){
			$date_m = substr($date_m, 1);
		}
		if ($date_d[0] == '0'){
			$date_d = substr($date_d, 1);
		}

		$date = "{$date_Y}_{$date_m}_{$date_d}";
			
		$tableName='z'.$serverStageId[0]['ID'].'_'.$date;
		
		//绑定数据表
		$tableModel=new TableModel();
		$tableModel->setTable($tableName);
		
		$datas = $tableModel -> where('PowerName','=',$powerName)
							 -> select('vol'.$lushu, 'volz'.$lushu , 'cur'.$lushu, 'savetime')
							 -> orderBy('savetime')
						     -> get()
							 -> toArray();
			
			//处理原始数据
			
			//注意$item使用的是引用,i1为一路漏电流和二路漏电流
			foreach($datas as &$item){
				
				//格式化日期
				$item['savetime'] = Carbon::createFromFormat('Y-m-d H:i:s',substr($item['savetime'],0,19))->format('Y/m/d H:i:s');
				
				//添加进漏电电流
				$item['lCur'] = (2*$item['volz'.$lushu]-$item['vol'.$lushu])/2100;
			}
			//注意重置悬挂指针，防止后面有可能出现的错误
			unset($item);
			
			return $datas;
	}	
			

	
	/***********************指定站场监控相关函数***********************************/
		
	//分站场获取最新信息
	public function getStationMessageById($stationId){
		
		$tableModel=new TableModel();
		$tableModel->setTable('NewData');
		
		$datas=$tableModel::where('ThisName','=',$stationId)
							->select('ThisName','PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')
							->orderBy('PowerName')
							->get()
							->toArray();
		
		//调用函数格式化数组
		$datas=$this->formatArray2($datas,$stationId);
		
		
		return $datas;
	}
		
	//格式化以得到站场监控页面所需的数据
	public function formatArray2($datas,$stationId){
		
		//定义结果数组
		$resultDatas=array();		
		$len=count($datas);
		
		for($i=0;$i<$len;$i++){
			
			//计算对地电阻，1，2分别为负对地电阻，正对地电阻
			//一路
			$vol1=$datas[$i]['vol1'];
			$volz1=$datas[$i]['volz1'];
				
			//二路
			$vol2=$datas[$i]['vol2'];
			$volz2=$datas[$i]['volz2'];
			
			//Rx1,Rx2分别为负对地，正对地绝缘电阻			
			$Rx1s=$this->calculateResistor($vol1, $volz1);
			$Rx11=$Rx1s['$Rx1'];
			$Rx12=$Rx1s['$Rx2'];
			
			$Rx2s=$this->calculateResistor($vol2, $volz2);
			$Rx21=$Rx2s['$Rx1'];
			$Rx22=$Rx2s['$Rx2'];
			
			//判断结果
			$Rx11Result=($Rx11==-1||$Rx11>2500)?'绝缘正常':floor($Rx11);			
			$Rx12Result=($Rx12==-1||$Rx12>2500)?'绝缘正常':floor($Rx12);
			$Rx21Result=($Rx21==-1||$Rx21>2500)?'绝缘正常':floor($Rx21);
			$Rx22Result=($Rx22==-1||$Rx22>2500)?'绝缘正常':floor($Rx22);
			
			//插入处理得到的数值
			$datas[$i]=array_add($datas[$i], 'volfo1', $Rx11Result);//一路负对地电阻
			$datas[$i]=array_add($datas[$i], 'volzo1', $Rx12Result);//二路正对地电阻
			$datas[$i]=array_add($datas[$i], 'volfo2', $Rx21Result);
			$datas[$i]=array_add($datas[$i], 'volzo2', $Rx22Result);
			
			$datas[$i]=array_add($datas[$i], 'volf1', $vol1-$volz1);//负对地电压
			$datas[$i]=array_add($datas[$i], 'volf2', $vol2-$volz2);
			
			//设置站场的柜边柜
			if($stationId=='信阳')
				$datas[$i]=array_add($datas[$i], 'rails', ['k1','k2','k5','k6']);
			
			else if($stationId=='宜昌')
				$datas[$i]=array_add($datas[$i], 'rails', ['k1','k2','k3','k4']);
			
			else if($stationId=='襄阳'){
				if($i==0)
					$datas[$i]=array_add($datas[$i], 'rails', ['k3','k4','k5','k6']);
				else 
					$datas[$i]=array_add($datas[$i], 'rails', ['k7','k8','k9','k10']);
			}
			
			else if($stationId=='武昌'){
				switch ($i){
						case 0:$datas[$i]=array_add($datas[$i], 'rails', ['k5','k6']);break;
						case 1:$datas[$i]=array_add($datas[$i], 'rails', ['k7','k8']);break;
						case 2:$datas[$i]=array_add($datas[$i], 'rails', ['k9','k10']);break;
						case 3:$datas[$i]=array_add($datas[$i], 'rails', ['k11','k12']);break;
						default:break;
					}	
				}
				
			else if($stationId=='汉口'){
				if($i==0)
					$datas[$i]=array_add($datas[$i], 'rails', ['k2','k3','k4','k5','k6','k7']);
				else
					$datas[$i]=array_add($datas[$i], 'rails', ['k8','k9','k10','k11','k12','k13']);
				}
				
			else{}
	
			//测试用
			// TODO: 去掉(实际用不到)
			$datas[$i]=array_add($datas[$i],'PowerUse1',' ');
			$datas[$i]=array_add($datas[$i],'PowerUse2',' ');

			
			$resultDatas[$i]=json_encode($datas[$i]);
					
		}
		
		return $resultDatas;
		
	}
}

	