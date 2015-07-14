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
          <div class="left" id="left">
              <ul class="left_menu">
                  <li><a href="/">全站显示</a></li>
                  <li  style="background:skyblue;"><a href="">曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href={{route('railuse')}}>按车次</a></li>
                          <li><a href={{route('poweruse')}}>按电源</a></li>
                          <li><a href="">按故障</a></li>
                      </ul>
                  </li>
                  <li><a href="">站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id="right">
          	 <h3>故障记录查询</h3>
          	 <div>
          	 	<form action="searchAlarmMessage" method="get">
          	 		<fieldset>
          	 			<legend>查询条件</legend>
          	 		
          	 			<label for="start">起始时间</label><input class="laydate-icon" onclick="laydate()" name="alarmTime">
          	 			<label for="stop">结束时间</label><input class="laydate-icon" onclick="laydate()" name="endTime">
          	 			<label for="num">电源编号</label><select name="powerName">
          	 			<option value="1">1</option>
          	 			<option value="2">2</option>
          	 			<option value="3">3</option>
          	 			<option value="4">4</option>
          	 			</select>

          	 			<input type="submit" value="查询">
            	 		<input type="button" onclick="window.location.href=('{{action('MainController@searchAlarmMessage', ['export'=>true])}}')" value="导出excel">
          	 			
          	 		</fieldset>
          	 	</form>
          	 	<div class="result">
          	 			<table>
          	 				<tr><th>电源编号</th><th>路数</th><th>故障类型</th><th>故障时间</th><th>接触故障时间</th></tr>
          	 				@if(isset($datas))
	          	 				@for($i=0;$i<count($datas);$i++)
	          	 					<tr>
	          	 						<td>{{$datas[$i]['PowerName']}}</td>
	          	 						<td>{{$datas[$i]['PowerNum']}}</td>
	          	 						<td>{{$datas[$i]['Alarm']}}</td>
	          	 						<td>{{$datas[$i]['AlarmTime']}}</td>
	          	 						<td>{{$datas[$i]['EndTime']}}</td>
	          	 					</tr>
	          	 				@endfor
          	 				@endif
          	 			</table>
          	 	</div>
          	 </div>
             
          </div>
      </div>
       
   </div>
   <script type="text/javascript" src="js/initialize.js"></script>
   <script type="text/javascript" src="js/laydate/laydate.js"></script>
   <script type="text/javascript">
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
  window.onload=function(){
     chushihua();
  }
</script>
</body>
</html>