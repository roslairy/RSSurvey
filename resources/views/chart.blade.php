@extends('base')

@section('right')
<h3>电源使用记录查询</h3>
          	 <div>
          	 	<form action="" method="post" id="fi">
          	 		<fieldset>
          	 			<legend>查询条件</legend>
          	 			<label for="start">起始时间</label>
          	 			<input class="laydate-icon" onclick="laydate()" name="start" id="_date" style="position: relative;">
          	 			
          	 			<label for="num">电源编号</label>
          	 			<select name="num" id="powerName">
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
  		//var stationId='xinyang';
  		var selectWhat=selectWhat;
		var date=document.getElementById('_date').value;
  		var powerName=document.getElementById('powerName').value;	
	//window.location.href='{{route('chart')}}?selectWhat='+selectWhat+'&date='+date+'&powerName='+powerName;  	

	//ajax请求
	$.ajax({
	     type: "get",//使用get方法访问后台
	     dataType: "json",//返回json格式的数据
	     url: "chart",//要访问的后台地址
	     data:{
	    	 selectWhat:selectWhat,//要发送的数据
	    	 date:date,
	    	 powerName:powerName
	     },
	     success: function(data){	    			                  						
		 		//_data=data.y;	
		 		//_time=data.x;	 
		 		myPlot(data.y,data.x)  ;        	    			              	
   }
});			



	
  	}
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
	

	function myPlot(data,time){

	   //将上一个图表清空，否则易产生干扰而是图像不稳定。
	   $('#flot').empty();
       $(function(){

    	   //是否暂停,默认为否
			var pause=false;

			/*
      	 //获取后台传过来的数组			
        	var data=new Array();
        	var time=new Array(); 
        	
        	@if(isset($x)&&isset($y))        
        		@for($i=0;$i<count($x);$i++)          			
        			data.push('{{$y[$i]}}');
        			time.push('{{$x[$i]}}');            			
        		@endfor
        	@endif    		
*/
			var totalPoints =300,initial=0;
            var i = 0;
			function getRandomData() {

				var res = [];

				// 自己加的函数                
				for(var j = 0; j < totalPoints; j++){
					index = (i + j) % data.length;
                    if(j==0){
                        initial = index;
                    }
					//res.push([i + j, data[index]]);

                    //将时间转化为毫秒数，前面的日期只是为了转化方便，无实际意义
					var date="2015/01/01"+' '+time[index];
					var millis=(new Date(date)).getTime();

                   	res.push([millis, data[index]]);

				}

				//暂停
				if(!pause)
                	i++;
             
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
				
				//据pause来判断是否调用draw函数
					plot.draw();

                //获取速度选项              
				var _interval =$("input[name='speed']:checked").val(); 

				//默认值 
				if(_interval==null)
					_interval=100;								
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