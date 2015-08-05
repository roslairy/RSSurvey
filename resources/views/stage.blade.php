@extends('base') @section('right')

<style>
.cebian {
	width: 140px;
	height: 540px;
	float: left;
}
.cebian-label {
	width: 100px;
	height: 230px;
	margin: 20px 40px;
	outline: 1px solid #999;
	text-align: center;
}
.stage-container{
	width: 800px;
	float: left;
}
</style>

<h1 style="text-align: center; font-size: 30px;">{{$stageNameChinese}}</h1>
<div class="cebian">
	<div class="cebian-label">

		<div class="data-block">电源</div>
		<div class="data-block">整流回路</div>
		<div class="data-block">用电量</div>
		<div class="data-block">电压电流</div>
		<div class="data-block">正向绝缘</div>
		<div class="data-block">负向绝缘</div>

		<div class="data-block"></div>
		<div class="data-block">柜边柜</div>
		<div class="data-block"></div>
		<div class="data-block">轨道</div>
		<div class="data-block">列车</div>

	</div>
	<div class="cebian-label" style="margin-top: 40px;">

		<div class="data-block">电源</div>
		<div class="data-block">整流回路</div>
		<div class="data-block">用电量</div>
		<div class="data-block">电压电流</div>
		<div class="data-block">正向绝缘</div>
		<div class="data-block">负向绝缘</div>

		<div class="data-block"></div>
		<div class="data-block">柜边柜</div>
		<div class="data-block"></div>
		<div class="data-block">轨道</div>
		<div class="data-block">列车</div>

	</div>
</div>
<div class="stage-container"></div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/json_parse.js"></script>
<script>

 					//定义全局container类数组
 					var containerObjs=new Array();
					$.ajax({
	    			     type: "get",//使用get方法访问后台
	    			     dataType: "json",//返回json格式的数据
	    			     url: "survey",//要访问的后台地址
	    			     data:{
		    			      stageName:"{{$stageName}}"//要发送的数据
	    			     },
	    			     success: function(data){	    			                  	
		    			     $.each(data.jsonDatas,function(index,d){
												
				    			 var sourceDiv='<div id="container'+index+'" style="width: 320px; margin: 20px 40px;	float:left"></div>';
					    		 $(".stage-container").append(sourceDiv);	
		
					    		              													
				    			 var source=JSON.parse(d);			
				    			 var container='#container'+index; 	                  	
				    			 containerObjs[index]=$.appendSource(container, source);
	    			     	 });		    			              	
	    			     }
	    			});
			    	self.setInterval(function(){
			    	   //ajax请求
			    			$.ajax({
			    			     type: "get",//使用get方法访问后台
			    			     dataType: "json",//返回json格式的数据
			    			     url: "survey",//要访问的后台地址
			    			     data:{
				    			      stageName:"{{$stageName}}"//要发送的数据
			    			     },
			    			     success: function(data){	    			                  	
			    			     $.each(data.jsonDatas,function(index,d){
													
				    			 //var sourceDiv='<div id="container"'+index+' style="width: 320px; margin: auto;"></div>';
				    			 //$(".right").append(sourceDiv);	
				    			                  													
				    			 var source=JSON.parse(d);	
				    			 containerObjs[index].update(source);
			    			    });		    			              	
			    		    }
			    	  });
	    			    	
			   },5000);
		</script>
@stop
