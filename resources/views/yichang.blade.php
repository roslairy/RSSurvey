<!DOCTYPE html>
<html lang="en">
 <head> 
  <meta charset="UTF-8" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <title>Rail Source Management </title> 
  <link rel="stylesheet" type="text/css" href="css/style.css" /> 
  <link rel="stylesheet" type="text/css" href="css/comm.css" /> 
  <link rel="stylesheet" type="text/css" href="css/poweruse.css" /> 
  <script type="text/javascript" src="js/jquery.js"></script> 
  <script type="text/javascript" src="js/js.js"></script> 
  <script type="text/javascript" src="js/json2.js"></script> 
  <script type="text/javascript" src="js/json_parse.js"></script> 
  <script type="text/javascript" src="js/initialize.js"></script> 
 </head> 
 <body> 
  <div class="wrap" id="wrap"> 
   <div class="header"> 
    <span> 铁路电源使用信息管理 </span> 
   </div> 
   <div class="body" id="obody"> 
    <div class="left" id="left"> 
     <ul class="left_menu"> 
      <li><a href="/">全站显示</a></li> 
      <li style="background:skyblue;"><a href="{{route('chart')}}">曲线图显示</a></li> 
      <li id="sepli">查询 
       <ul> 
        <li><a href="">按车次</a></li> 
        <li><a href="{{route('poweruse')}}">按电源</a></li> 
        <li><a href="{{route('alarmmessage')}}">按故障</a></li> 
       </ul> </li> 
       <li><a href='{{route('survey')}}?stationId=xinyang&isFirst=true'>信阳</a></li>
       <li><a href='{{route('survey')}}?stationId=yichang&isFirst=true'>宜昌</a></li>
       <li><a href='{{route('survey')}}?stationId=xiangyang&isFirst=true'>襄阳</a></li>
       <li><a href='{{route('survey')}}?stationId=wuchang&isFirst=true'>武昌</a></li>
       <li><a href='{{route('survey')}}?stationId=hankou&isFirst=true'>汉口</a></li>
     </ul> 
    </div> 
    <div class="right" id="right"> 
     <script>

     			//判断是否为第一次请求
				@if(isset($isFirst))
					$.ajax({
	    			     type: "get",//使用get方法访问后台
	    			     dataType: "json",//返回json格式的数据
	    			     url: "survey",//要访问的后台地址
	    			     data:{
		    			      stationId:"yichang"//要发送的数据
	    			      },
	    			     success: function(data){	    			                  	
	    			     $.each(data.jsonDatas,function(index,d){
											
		    			 var sourceDiv='<div id="container'+index+'" style="width: 320px; margin: auto;"></div>';
			    		 $(".right").append(sourceDiv);	
		    			                  													
		    			 var source=JSON.parse(d);			
		    			 var container='#container'+index; 	                  	
		    			 $.appendSource(container, source);
	    			     	 });		    			              	
	    			      }
	    			  });

				@endif
			    	self.setInterval(function(){
			    	   //ajax请求
			    			$.ajax({
			    			     type: "get",//使用get方法访问后台
			    			     dataType: "json",//返回json格式的数据
			    			     url: "survey",//要访问的后台地址
			    			     data:{
				    			      stationId:"yichang"//要发送的数据
			    			     },
			    			     success: function(data){	    			                  	
			    			     $.each(data.jsonDatas,function(index,d){
													
				    			 //var sourceDiv='<div id="container"'+index+' style="width: 320px; margin: auto;"></div>';
				    			 //$(".right").append(sourceDiv);	
				    			                  													
				    			 var source=JSON.parse(d);	
				    			 var container='#container'+index;		    			                  	
				    			 $.appendSource(container, source);
			    			    });		    			              	
			    		    }
			    	  });
	    			    	
			   },5000);
		</script> 
    </div> 
   </div> 
  </div>  
 </body>
</html>