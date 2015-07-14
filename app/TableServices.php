<?php
namespace App;
use App\TableModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;



class TableServices {
	
		
	//获取最新信息
	public function getNewestData() {				
		
			//绑定数据表
			$tableModel=new TableModel();			
			$tableModel->setTable('NewData');
			
			//执行分站场查询操作
			$thisName1Datas=$tableModel::where('ThisName','=','1')->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')->orderBy('PowerName')->get()->toArray();
			$thisName2Datas=$tableModel::where('ThisName','=','2')->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')->orderBy('PowerName')->get()->toArray();
			$thisName3Datas=$tableModel::where('ThisName','=','3')->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')->orderBy('PowerName')->get()->toArray();
			$thisName4Datas=$tableModel::where('ThisName','=','4')->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')->orderBy('PowerName')->get()->toArray();
			$thisName5Datas=$tableModel::where('ThisName','=','5')->select('PowerName','condition1','vol1','cur1','volz1','RailwayName1','RailNum1','condition2','vol2','cur2','volz2','RailwayName2','RailNum2')->orderBy('PowerName')->get()->toArray();
			
			
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
			
			/*
			foreach ($thisName1Datas[0] as $key=>$value)
				echo $key.'=>'.$value.'<br>';
				*/
	}
	
	
	//处理数据指定站场数据，包括计算，格式化
	public function formatArray($datas){
		
		//处理结果数组
		$thisDatas=array();
		
		//分电源处理
		for($i=0;$i<count($datas);$i++){
			
			//一路
			$vol1=$datas[$i]['vol1'];
			$volz1=$datas[$i]['volz1'];
			
			//二路
			$vol2=$datas[$i]['vol2'];
			$volz2=$datas[$i]['volz2'];
			
			//Rx1,Rx2分别为负对地，正对地绝缘电阻
			$Rx11=$Rx12=$Rx21=$Rx22=-1;
			
			$this->calculateResistor($Rx11, $Rx12, $vol1, $volz1);
			$this->calculateResistor($Rx21, $Rx22, $vol2, $volz2);
			
			//判断结果
			$Rx11Result=($Rx11==-1||$Rx11>2500)?'绝缘正常':$Rx11;			
			$Rx12Result=($Rx12==-1||$Rx12>2500)?'绝缘正常':$Rx12;
			$Rx21Result=($Rx21==-1||$Rx21>2500)?'绝缘正常':$Rx21;
			$Rx22Result=($Rx22==-1||$Rx22>2500)?'绝缘正常':$Rx22;
			
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
	public function calculateResistor($Rx1,$Rx2,$vol1,$volz1){
		
		//Rx1,Rx2分别为负对地绝缘电阻、正对地绝缘电阻
		
		//正常情况下
		if($volz1==($vol1-$volz1)){}

		//负线存在对地电阻时
		else if($volz1>($vol1-$volz1))
			$Rx1=2100*($vol1-$volz1)/(2*$volz1-$vol1);
				
		//正线存在对地电阻时
		else
			$Rx2=2100*$volz1/($vol1-2*$volz1);
							
	}
		
	
	/*************************************************************************/
	
	//获取站场当前数据
	public function getCurrentSourceMessage($sourceId){
		
		$tableModel=new TableModel();
		$tableModel->setTable("");
		
	}
	
	
	
	/************************************************************************/
	
	
	//获取车次使用信息
	public function getRailUse($beginTime,$stopTime,$powerName){
		
		$tableModel=new TableModel();
		$tableModel->setTable('RailUse');
		
		$datas=$tableModel	->where('BeginTime','>=',$beginTime)
							->where('StopTime','<=',$stopTime)
							->where('PowerName','=',$powerName)
							->select('RailNum','PowerName','RailwayName','BeginTime','StopTime','UseKWH')
							->orderBy('RailNum')
							->get()
							->toArray();
				
		return $datas;
		
	}
	
	
	/***********************************************************************/
	
	
	//获取电源使用信息
	public function getPowerUse($beginTime,$stopTime,$powerName){
		

		$tableModel=new TableModel();
		$tableModel->setTable('PowerUse');

		$datas=$tableModel	->where('BeginTime','>=',$beginTime)
							->where('StopTime','<=',$stopTime)
							->where('PowerName','=',$powerName)
							->select('PowerName','PowerNum','RailwayName','RailNum','BeginTime','StopTime','UseKWH')
							->orderBy('PowerNum')
							->get()
							->toArray();
	
		return $datas;
				
	}
	
	/*****************************************************************************/
	
	//获取故障信息
	public function getAlarmMessage($alarmTime,$endTime,$PowerName){
		$tableModel=new TableModel();
		$tableModel->setTable('AlarmMessage');
	
		$datas=$tableModel  ->where('AlarmTime','>=',$alarmTime)
							->where('EndTime','<=',$endTime)
							->where('PowerName','=',$PowerName)
							->select('PowerName','PowerNum','Alarm','AlarmTime','EndTime')
							->orderBy('PowerName')
							->get()
							->toArray();
		
		return $datas;
	
	}
	
	/*****************************************************************************/
	
	//获取历史站场信息记录
	public function getHistoryRecord($ThisName,$saveTime){
		
		//根据约定规则构造出表名
		$tableName=$ThisName.$saveTime;
		
		//模型绑定数据库
		$tableModel=new TableModel();		
		$tableModel->setTable($tableName);
		
		//取出全部数据
		$datas=$tableModel->all();
		
		
	}
}

?>