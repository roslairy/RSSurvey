<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rail Source Management</title>
</head>
<link rel="stylesheet" type="text/css" href="css/comm.css">
<link rel="stylesheet" type="text/css" href="css/poweruse.css">
<body>
   <div class="wrap" id="wrap">
      <div class="header">
          <span>铁路电源使用信息管理</span>
      </div>
      <div class="body" id="obody">
          <div class="left">
              <ul class="left_menu">
                  <li><a href='/'>全站显示</a></li>
                  <li  style="background:skyblue;"><a href="">曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href={{route('railuse')}}>按车次</a></li>
                          <li><a href={{route('poweruse')}}>按电源</a></li>
                          <li><a href={{route('alarmmessage')}}>按故障</a></li>
                      </ul>
                  </li>
                  <li><a href="">站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
              </ul>
          </div>
          <div class="right">
          	 <h3>电源使用记录查询</h3>
          	 <div>
          	 	<form action="" method="post" name='form1'>
          	 		<fieldset>
          	 			<legend>查询条件</legend>
          	 			<label for="start">日期</label><input class="laydate-icon" onclick="laydate()" id="date" name="start"	style="position: relative;">
          	 			
          	 			<label for="num">电源编号</label><select name="num" id="powerName">
          	 			<option value="station1">1</option>
          	 			<option value="2">2</option>
          	 			<option value="3">3</option>
          	 			<option value="4">4</option>
          	 			</select>
          	 			<input type="button" value="开始">
          	 			<input type="button" value="暂停">
          	 			<input type="button" value="取消">
          	 			<label>速度</label>
          	 			<input type="radio" name="speed">X1
          	 			<input type="radio" name="speed">X2
          	 			<input type="radio" name="speed">X3
          	 			<input type="radio" name="speed">X4
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
	            <div style="width:1000px;margin:0 auto;">
	                <span style="float:left;margin-left:20px;" id="time0">111</span><span style="margin-left:470px;" id="time1">333</span><span style="float:right;" id="time2">222</span>
	            </div>
          	 	
          	 </div>
             
          </div>
      </div>
       
   </div>
   <script type="text/javascript">
   
   			var powerName=document.getElementById('powerName').value;
   			var date=document.getElementById('date').value;
   			
   			function buttonAction(stationId){
				window.location.href='{{route('chart')}}?selectWhat='+stationId+'&date='+date+'&powerName='+powerName;
   				
   	   			}
   </script>
   <script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
   <script type="text/javascript" src="js/initialize.js"></script>
   <script type="text/javascript" src='js/laydate/laydate.js'></script>
   <script src="js/jquery.flot.js" type="text/javascript" charset="utf-8"></script>
   <script type="text/javascript">
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
       $(function(){
    	  //获取后台传过来的数组			
          	var data=new Array();
          	var time=new Array(); 
          	@if(isset($x)&&isset($y))        
          		@for($i=0;$i<count($x);$i++)          			
          			data.push('{{$y[$i]}}');
          			time['$i']='{{$x[$i]}}';            			
          		@endfor
          	@endif    		
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
					res.push([j, data[index]]);
				}
                i++;
             
				return res;
			}
            
            
            

            
            
			var plot = $.plot('#flot', [ getRandomData() ], {
				series: {
					shadowSize: 0	// Drawing is faster without shadows
				},
				yaxis: {
					min: 0,
					max: 100
				},
				xaxis: {
					show:false
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

				// Since the axes don't change, we don't need to call plot.setupGrid()

				plot.draw();
                var mi = Math.floor((totalPoints-1)/2);
                document.getElementById("time0").innerHTML=time[initial];
                document.getElementById("time1").innerHTML=time[initial+mi];
                document.getElementById("time2").innerHTML=time[initial+totalPoints-1];
				setTimeout(update, 100);
			}

			update();
		});
  window.onload=function(){
     chushihua();
  }
</script>
</body>
</html>
