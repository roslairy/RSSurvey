<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rail Source Management</title>
    
    <link rel="stylesheet" type="text/css" href="css/comm.css">
	<script type="text/javascript" src="js/initialize.js"></script> 
	 
	<script type="text/javascript">
		 window.onload=function(){
    	chushihua();
 	 }
	</script>
</head>

<style>
   
    .tablelist{
        margin: 10px auto;
        background: #999999;
    }
    .tablelist td,.tablelist th{
        width: 100px;
        border: 1px solid #999999;
        height: 25px;
        line-height: 25px;
        text-align: center;

    }
    .tablelist td{
    	background: #fff;
    }
    .tablelist caption {
    	font-size: 18px;
    	color: white;
    }

</style>


<body>
   <div class="wrap" id="wrap">
      <div class="header">
          <span>铁路电源使用信息管理</span>
      </div>
      <div class="body"  id="obody">
          <div class="left" id="left">
              <ul class="left_menu">
                  <li style="background:skyblue;"><a href=''>全站显示</a></li>
                  <li><a href={{route('chart')}}>曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href={{route('railuse')}}>按车次</a></li>
                          <li><a href={{route('poweruse')}}>按电源</a></li>
                          <li><a href={{route('alarmmessage')}}>按故障</a></li>
                      </ul>
                  </li>
                  <li><a href='{{route('survey')}}?stationId=001'>站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id="right">
              <table class="tablelist" cellspacing="0">
              
				<caption>武昌</caption>
				<tr style="background:#fc6;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
				@if(isset($datas))
					@for($i=0;$i<$datas[5][0];$i++)
					
						<tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
							@for($j=1;$j<10;$j++)
								<td>{{$datas[0][$i][$j]}}</td>
							@endfor
						<tr>
						<tr><td>2路</td>
							
							@for($j=10;$j<19;$j++)
								<td>{{$datas[0][$i][$j]}}</td>
							@endfor
						</tr>
					@endfor
				@endif
				
					
              </table>
              
              <table class="tablelist" cellspacing="0">
				<caption>汉口</caption>
				<tr style="background:springgreen;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
             	
             		@if(isset($datas))
					@for($i=0;$i<$datas[5][1];$i++)
					
						<tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
							@for($j=1;$j<10;$j++)
								<td>{{$datas[1][$i][$j]}}</td>
							@endfor
						<tr>
						<tr><td>2路</td>
							
							@for($j=10;$j<19;$j++)
								<td>{{$datas[1][$i][$j]}}</td>
							@endfor
						</tr>
					@endfor
				@endif
				
				
              </table>
              <table class="tablelist" cellspacing="0">
				<caption>宜昌</caption>
				<tr style="background:skyblue;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
	
             		@if(isset($datas))
					@for($i=0;$i<$datas[5][2];$i++)
					
						<tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
							@for($j=1;$j<10;$j++)
								<td>{{$datas[2][$i][$j]}}</td>
							@endfor
						<tr>
						<tr><td>2路</td>
							
							@for($j=10;$j<19;$j++)
								<td>{{$datas[2][$i][$j]}}</td>
							@endfor
						</tr>
					@endfor
				@endif
             	
              </table>
              
              
              <table class="tablelist" cellspacing="0">
				<caption>襄阳</caption>
				<tr style="background:#fc6;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
                
             		@if(isset($datas))
					@for($i=0;$i<$datas[5][3];$i++)
					
						<tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
							@for($j=1;$j<10;$j++)
								<td>{{$datas[3][$i][$j]}}</td>
							@endfor
						<tr>
						<tr><td>2路</td>
							
							@for($j=10;$j<19;$j++)
								<td>{{$datas[3][$i][$j]}}</td>
							@endfor
						</tr>
					@endfor
				@endif
              
              </table>
              <table class="tablelist" cellspacing="0">
				<caption>信阳</caption>
				<tr style="background:skyblue;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
				
              	
             		@if(isset($datas))
					@for($i=0;$i<$datas[5][4];$i++)
					
						<tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
							@for($j=1;$j<10;$j++)
								<td>{{$datas[4][$i][$j]}}</td>
							@endfor
						<tr>
						<tr><td>2路</td>
							
							@for($j=10;$j<19;$j++)
								<td>{{$datas[4][$i][$j]}}</td>
							@endfor
						</tr>
					@endfor
				@endif
              </table>
          </div>
      </div>
       
   </div>

</body>
</html>