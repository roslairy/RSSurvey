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
          	 			<select name="num1" id="stageName">
          	 			<option value="xinyang">信阳</option>
          	 			<option value="yichang">宜昌</option>
          	 			<option value="xiangyang">襄阳</option>
          	 			<option value="wuchang">武昌</option>
          	 			<option value="hankou">汉口</option>
          	 			</select>
          	 			
          	 			<label for="num2">电源编号</label>
          	 			<select name="num2" id="powerName">
          	 			<option value="1">1</option>
          	 			<option value="2">2</option>
          	 			<option value="3">3</option>
          	 			<option value="4">4</option>
          	 			</select>
          	 			<input type="button" value="开始" id="start">
          	 			<input type="button" value="暂停" id="pause">
          	 			<input type="button" value="取消" id="cancel">
          	 			<label>速度</label>
          	 			<input type="radio" name="speed" id="speed1" value=200>X1
          	 			<input type="radio" name="speed" id="speed2" value=50>X2
          	 			<input type="radio" name="speed" id="speed3" value=25>X3
          	 			<input type="radio" name="speed" id="speed4" value=10>X4
          	 		</fieldset>
          	 	</form>
          	 		<form method="post" action="" style="margin-left:120px;">
          	 	    <input type="button" onclick="buttonAction('vol1')"	value="1路电压">
          	 	    <input type="button" onclick="buttonAction('cur1')"	value="1路电流">
          	 	    <input type="button" onclick="buttonAction('i1')"	value="1路漏电电流">
          	 	    <input type="button" onclick="buttonAction('vol2')"	value="2路电压">
          	 	    <input type="button" onclick="buttonAction('cur2')"	value="2路电流">
          	 	    <input type="button" onclick="buttonAction('i2')"	value="2路漏电电流">
          	 	</form>
          	 	<div id="flot" style="width:1000px; height: 400px; margin: auto;">          	 	
	            </div>          	 	
          	 </div>	
	<script type="text/javascript" src="js/jquery.js" 	charset="utf-8"></script>
	<script type="text/javascript" src="js/json2.js"></script> 
  	<script type="text/javascript" src="js/json_parse.js"></script>
	<script type="text/javascript" src='js/laydate/laydate.js'></script>   
	<script type="text/javascript" src="js/initialize.js"></script>
	<script type="text/javascript" src="js/jquery.flot.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.flot.time.js" charset="utf-8"></script>
	<script type="text/javascript">
   //定义全局变量
	var data;
	var time;

	//选择按钮事件
	function buttonAction(selectWhat){
  		var selectWhat=selectWhat;//要查的變量
		var date=document.getElementById('_date').value;
  		var stageName=document.getElementById('stageName').value;
  		var powerName=document.getElementById('powerName').value;


	//ajax请求
	$.ajax({
	     type: "get",//使用get方法访问后台
	     dataType: "json",//返回json格式的数据
	     url: "chart",//要访问的后台地址
	     data:{
	    	 selectWhat:selectWhat,//要发送的数据
	    	 date:date,
	    	 stageName:stageName,
	    	 powerName:powerName
	     },
	     success: function(data){	    			                  							
		 	 myPlot(data.y,data.x)  ;       	    			              	
   },
		 error: function(){	    			                  							
			 	 alert('请求失败')  ;       	    			              	
			}
});			

	
  	}
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
	

	function myPlot(data,time){
	   //将上一个图表清空，否则易产生干扰而使图像不稳定。
	   $('#flot').empty();
       $(function(){

    	   //是否暂停,默认为否
			var pause=false;

			var totalPoints =300,initial=0;
            var i = 0;
			function getRandomData() {

				var res = [];

				// 自己加的函数                
				for(var j = 0; j < totalPoints; j++){
					index = (i + j) % data.length;

					if(i+j>=data.length){
						$('#flot').empty();
						break;
					}
					
                    if(j==0){
                        initial = index;
                    }

                    var date=time[index];
					var millis=(new Date(date)).getTime();
                   	res.push([millis, data[index]]);                   	
				}

				//暂停
				if(!pause)	i++;
             
				return res;
			}
                     
			var plot = $.plot('#flot', [ getRandomData() ], {
				series: {
					shadowSize: 0	// Drawing is faster without shadows
				},
				yaxis: {
					show: true
				},
				xaxis: {
					show: true
				}
			});

			plot.getAxes().xaxis = {
				min : 5,
				max : 100
			}

			function update() {

				var res = getRandomData();
				plot.setData([res]);
				plot.setupGrid();				
				plot.draw();

                //获取速度选项              
				var _interval =$("input[name='speed']:checked").val(); 
				//默认值 
				if(_interval==null)	_interval=100;
												
				setTimeout(update,_interval);	
			}

			//暂停按钮事件
			$("#pause").click(function(){
				pause=true;				
			});
			
			//开始按钮事件
			$("#start").click(function(){
				pause=false;
			});

			//取消按钮事件,撤销图表
			$("#cancel").click(function(){
				$('#flot').empty();
			});
		
			update();
		});
}
  window.onload=function(){
     chushihua();
  }
</script>
@stop