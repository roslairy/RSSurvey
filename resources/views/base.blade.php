<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<title>Rail Source Management</title>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/comm.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/poweruse.css">
<script type="text/javascript" src="js/initialize.js"></script>
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
<script type="text/javascript" src="js/laydate/laydate.js"></script>
<script type="text/javascript">
		 window.onload=function(){
    	chushihua();
 	 }
	</script>

<style>
.tablelist {
	margin: 10px auto;
	background: #999999;
}

.tablelist td, .tablelist th {
	width: 100px;
	border: 1px solid #999999;
	height: 25px;
	line-height: 25px;
	text-align: center;
}

.tablelist td {
	background: #fff;
}

.tablelist caption {
	font-size: 18px;
}

.active {
	background: skyblue;
}
</style>
</head>
<body>
	<div class="wrap" id="wrap">
		<div class="header">
<<<<<<< HEAD
			<img src="img/dc.jpg" style="height:50px;float: left; margin: 10px 10px;">
			<p style="float: right; font-size: 1em; margin: 0 10px; margin-top: 20px; height: 50px; padding-left:0">武汉迪昌科技有限公司</p>
=======
			<img src="img/dc.jpg" style="height:70px;float: left; margin: 0 10px;">
			<p style="float: left; font-size: 1em; margin: 0 10px; margin-top: 20px; height: 50px; padding-left:0">武汉迪昌科技有限公司</p>
>>>>>>> origin/master
			<p style="float: left;">武昌车辆段DC600V地面电源信息管理</p>
		</div>
		<div class="body" id="obody">
			<div class="left" id="left">
				<ul class="left_menu">
					<li id="index"><a href='./'>全站显示</a></li>
					<li id="chart"><a href='{{route('chart')}}'>曲线图显示</a></li>
<<<<<<< HEAD
					<li id="sepli">历史查询
=======
					<li id="sepli">查询
>>>>>>> origin/master
						<ul>
							<li id="railuse"><a href={{route('railuse')}}>按车次</a></li>
							<li id="poweruse"><a href={{route('poweruse')}}>按电源</a></li>
							<li id="alarmmessage"><a href={{route('alarmmessage')}}>按故障</a></li>
						</ul>
					</li>
					<li id="wuchang"><a href='{{route('survey')}}?stageName=武昌&isFirst=true'>武昌</a></li>
					<li id="hankou"><a href='{{route('survey')}}?stageName=汉口&isFirst=true'>汉口</a></li>
					<li id="yichang"><a href='{{route('survey')}}?stageName=宜昌&isFirst=true'>宜昌</a></li>
					<li id="xiangyang"><a href='{{route('survey')}}?stageName=襄阳&isFirst=true'>襄阳</a></li>					
					<li id="xinyang"><a href='{{route('survey')}}?stageName=信阳&isFirst=true'>信阳</a></li>					
				</ul>
			</div>
			<div class="right-panel" id="right">@yield('right')</div>
		</div>

	</div>
<script type="text/javascript">   
	
   $('#{{$navName}}').addClass('active');
</script>
</body>
</html>