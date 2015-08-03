@extends('base')

@section('right')
  <script type="text/javascript" src="js/jquery.js"></script> 
  <script type="text/javascript" src="js/js.js"></script> 
  <script type="text/javascript" src="js/json2.js"></script> 
  <script type="text/javascript" src="js/json_parse.js"></script> 
 <script>

					$.ajax({
	    			     type: "get",//使用get方法访问后台
	    			     dataType: "json",//返回json格式的数据
	    			     url: "survey",//要访问的后台地址
	    			     data:{
		    			      stationId:"{{$stageName}}"//要发送的数据
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
			    	self.setInterval(function(){
			    	   //ajax请求
			    			$.ajax({
			    			     type: "get",//使用get方法访问后台
			    			     dataType: "json",//返回json格式的数据
			    			     url: "survey",//要访问的后台地址
			    			     data:{
				    			      stationId:"{{$stageName}}"//要发送的数据
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
@stop