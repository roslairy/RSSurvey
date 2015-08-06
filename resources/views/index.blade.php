@extends('base') @section('right')

<table class="tablelist" cellspacing="0" id="wuchang2">
	<caption>武昌</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="hankou2">
	<caption>汉口</caption>
	<tr style="background: springgreen;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="yichang2">
	<caption>宜昌</caption>
	<tr style="background: skyblue;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>


<table class="tablelist" cellspacing="0" id="xiangyang2">
	<caption>襄阳</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="xinyang2">
	<caption>信阳</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>

<table id="table-tpl" style="display: none">
	<tr style="background: skyblue;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>总电压</th>
		<th>总电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车号</th>
	</tr>
</table>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/json_parse.js"></script>
<script>

	//此方法用于填充数据
	function appendDatas(selector,datas,length){ 
		var obj = $(selector);
		var chineseName;
		if(selector=='#wuchang2')chineseName='武昌';
		else if(selector=='#hankou2')chineseName='汉口';
		else if(selector=='#yichang2')chineseName='宜昌';
		else if(selector=='#xiangyang2')chineseName='襄阳';
		else	chineseName='信阳';
		obj.empty();
		var append = '<caption>'+chineseName+'</caption>'+$('#table-tpl').html();

		if (datas!=null){
			for(var i = 0; i <length; i++){
				append += '<tr><td rowspan="2">'+datas[i][0]+'</td><td>1路</td>';
				for(var j =1; j<10; j++)
					append += '<td>'+datas[i][j]+'</td>';
				append += '</tr>';
				
				append += '<tr><td>2路</td>';
				for(var j =10; j<19; j++)
					append += '<td>'+datas[i][j]+'</td>';
				append += '</tr>';
			}
			obj.append(append);
		}
	}	
	//异步请求
	$.ajax({
	     type: "get",//使用get方法访问后台
	     dataType: "json",//返回json格式的数据
	     url: "index",//要访问的后台地址	 
	     data:{
	    	 notFirst:'true'
		 },			    
	     success: function(data){	  			                  	
	    	 var powerNum=data.powerNum;										
			 appendDatas('#wuchang2',data.wuchang,powerNum[0])	;
			 appendDatas('#hankou2',data.hankou,powerNum[1])	;
			 appendDatas('#yichang2',data.yichang,powerNum[2])	;
			 appendDatas('#xiangyang2',data.xiangyang,powerNum[3]);
			 appendDatas('#xinyang2',data.xinyang,powerNum[4])	;		   		 	    			              	
   		}
 
});
	
	//定时ajax异步请求
	self.setInterval(function(){
		$.ajax({
		     type: "get",//使用get方法访问后台
		     dataType: "json",//返回json格式的数据
		     url: "index",//要访问的后台地址	 
		     data:{
		    	 notFirst:'true'
			 },			    
		     success: function(data){	  			                  	
		    	 var powerNum=data.powerNum;										
				 appendDatas('#wuchang2',data.wuchang,powerNum[0])	;
				 appendDatas('#hankou2',data.hankou,powerNum[1])	;
				 appendDatas('#yichang2',data.yichang,powerNum[2])	;
				 appendDatas('#xiangyang2',data.xiangyang,powerNum[3]);
				 appendDatas('#xinyang2',data.xinyang,powerNum[4])	;		   		 	    			              	
	   		}
	 
	});
			    	
	},10000);
	
</script>

@stop
