@extends('base')

@section('right')
<h3>电源使用记录查询</h3>
          	 <div>
          	 	<form action="" method="post">
          	 		<fieldset>
          	 			<legend>查询条件</legend>
          	 			<label for="start">起始时间</label>
          	 			<input class="laydate-icon" onclick="laydate()" name="start" id="_date" style="position: relative;">         	 			
       	 			
          	 			<label for="num1">站场</label>
          	 			<select name="num1" id="stageId">
          	 			<option value="武昌">武昌</option>
          	 			<option value="汉口">汉口</option>
          	 			<option value="宜昌">宜昌</option>
          	 			<option value="襄阳">襄阳</option>
          	 			<option value="信阳">信阳</option>          	 			          	 			
          	 			</select>

          	 			<label for="num2">电源编号</label>
          	 			<select name="num2" id="powerName">
          	 			<option value="1">1</option>
          	 			<option value="2">2</option>
          	 			<option value="3">3</option>
          	 			<option value="4">4</option>
          	 			</select>

          	 			<label for="num3">路数</label>
          	 			<select name="num3" id="lushu">
          	 			<option value="1" selected="selected">1路</option>
          	 			<option value="2">2路</option>
          	 			</select>
          	 			&nbsp;
          	 			<input type="button" value="查询" id="submit" onclick="submitAction()">
          	 			<input type="button" value="暂停" id="pause">
						<input type="button" value="继续" id="continue">	
          	 			<input type="button" value="取消" id="cancel">
          	 			&nbsp;
          	 			<label>速度</label>
          	 			<input type="radio" name="speed" id="speed1" value=200>X1
          	 			<input type="radio" name="speed" id="speed2" value=80>X2
          	 			<input type="radio" name="speed" id="speed3" value=40>X3
          	 			<input type="radio" name="speed" id="speed4" value=10>X4
          	 		</fieldset>
          	 	</form>
          	 	<div id="flot" style="width:1000px; height: 400px; margin: auto;">          	 	
	            </div>          	 	
          	 </div>	

	<script type="text/javascript" src="js/jquery.js" 	charset="utf-8"></script>
	<script type="text/javascript" src="js/json2.js"></script> 
  	<script type="text/javascript" src="js/json_parse.js"></script>
	<script type="text/javascript" src='js/laydate/laydate.js'></script>   
	<script type="text/javascript" src="js/initialize.js"></script>
	<script type="text/javascript" src="js/excanvas.js"></script>

	<script type="text/javascript" src="js/jquery.flot.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.flot.time.js" charset="utf-8"></script>
	<script type="text/javascript">
<<<<<<< HEAD

	function drawEmpty(){
		   $('#flot').empty();
		var plot = $.plot('#flot', [], {

			series: {
						shadowSize: 0	// Drawing is faster without shadows
			},

		
			//设置多个Y轴
			xaxes: [
					   {show: true}
					],
			      
			yaxes: [						            
					    { show: true, position: "left", color:"black", min: 0, max: 660},//电压轴
					    { show: true, position: "right", color:"blue", min: 0, max: 667},//电流轴
					    { show: true, position: "right", color:"red", min: -300, max: 300},//漏电流轴
					]
											 																							
		});
		plot.setupGrid();				
		plot.draw();
	};

	$(function(){
		drawEmpty();
	});
=======
>>>>>>> origin/master
	
   //定义全局变量
	var data;
	var time;

	//提交按钮触发事件
	
	function submitAction(){
  		var lushu=document.getElementById('lushu').value;//要查的變量
		var date=document.getElementById('_date').value;
  		var stageId=document.getElementById('stageId').value;
  		var powerName=document.getElementById('powerName').value;

	//ajax请求
	$.ajax({
	     type: "get",//使用get方法访问后台
	     dataType: "json",//返回json格式的数据
	     url: "chart",//要访问的后台地址
	     data:{
	    	 lushu:lushu,//查询的路数
	    	 date:date,
	    	 stageId:stageId,
	    	 powerName:powerName
	     },

	     success: function(data){  			                  							
		 	 myPlot(data.vol, data.cur, data.lCur, data.savetime);
   },
		 error: function(){	    
			 	$('#flot').empty();			                  							
			 	 alert('请求失败')  ;       	    			              	
			}
});			

	
  	}
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
	
	function myPlot(vol, cur, lCur, savetime){
		
		   //将上一个图表清空，否则易产生干扰而使图像不稳定。
		   $('#flot').empty();
		   
	       $(function(){

	    	   //是否暂停,默认为否
				var pause=false;
<<<<<<< HEAD
				var empty = false;
=======
>>>>>>> origin/master

				var totalPoints =300,initial=0;
	            var i = 0;
				function getRandomData() {

					var vols = [];		//电压
					var curs = [];		//电流
					var lCurs = [];		//漏电流

					// 自己加的函数          
					var len = vol.length;      
					for(var j = 0; j < totalPoints; j++){
						
						var index = (i + j) % len;

						if(i+j>=len){
<<<<<<< HEAD
							pause=true;		
=======
							$('#flot').empty();
>>>>>>> origin/master
							break;
						}
						
	                    if(j==0){
	                        initial = index;
	                    }

	                    var date=savetime[index];
						var millis=(new Date(date)).getTime();
						
	                   	vols.push([millis, vol[index]]); 	//电压
	                   	curs.push([millis, cur[index]]);	//电流
	                   	lCurs.push([millis, lCur[index]]);	//漏电流
	                 	
					}

					//暂停
					if(!pause)	i++;

					var res = [
								{ data: vols, yaxis: 1, label:"电压" },		//电压
								{ data: curs, yaxis: 2, label:"电流" },		//电流
								{ data: lCurs, yaxis: 3, label:"漏电流" }		//漏电流
							   ];
	             
					return res;					
				}
	                     
				var plot = $.plot('#flot', getRandomData(), {

					series: {
<<<<<<< HEAD
								shadowSize: 0	// Drawing is faster without shadows
=======
								shadowSize: 0,	// Drawing is faster without shadows
>>>>>>> origin/master
					},

				
					//设置多个Y轴
					xaxes: [
							   {show: true}
							],
					      
					yaxes: [						            
							    { show: true, position: "left", color:"black", min: 0, max: 660},//电压轴
							    { show: true, position: "right", color:"blue", min: 0, max: 667},//电流轴
							    { show: true, position: "right", color:"red", min: -300, max: 300},//漏电流轴
							]
													 																							
				});

				
				plot.getAxes().xaxis = {
					min : 5,
					max : 100
				}
<<<<<<< HEAD

				function update() {

					var res = empty ? [] : getRandomData();
					plot.setData(res);
					plot.setupGrid();				
					plot.draw();

	                //获取速度选项              
					var _interval =$("input[name='speed']:checked").val(); 
					//默认值 
					if(_interval==null)	_interval=100;
					
					if (!empty) setTimeout(update, _interval);	

=======

				function update() {

					var res = getRandomData();
					plot.setData(res);
					plot.setupGrid();				
					plot.draw();

	                //获取速度选项              
					var _interval =$("input[name='speed']:checked").val(); 
					//默认值 
					if(_interval==null)	_interval=100;
													
					setTimeout(update,_interval);	
>>>>>>> origin/master
				}

				//暂停按钮事件
				$("#pause").click(function(){
<<<<<<< HEAD
					pause=true;		
=======
					pause=true;				
>>>>>>> origin/master
				});
				
				//开始按钮事件
				$("#continue").click(function(){
					pause=false;
				});

				//取消按钮事件,撤销图表
				$("#cancel").click(function(){
					//pause = true;
<<<<<<< HEAD
					//$('#flot').empty();
					empty = true;
=======
					$('#flot').empty();
>>>>>>> origin/master
				});
			
				update();
			});
	}

  window.onload=function(){
     chushihua();
  }
</script>
@stop