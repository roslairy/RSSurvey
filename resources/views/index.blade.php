@extends('base') @section('right')

<table class="tablelist" cellspacing="0" id="wuchang2">
	<caption>武昌</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="hankou2">
	<caption>汉口</caption>
	<tr style="background: springgreen;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="yichang2">
	<caption>宜昌</caption>
	<tr style="background: skyblue;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
	</tr>
</table>


<table class="tablelist" cellspacing="0" id="xiangyang2">
	<caption>襄阳</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
	</tr>
</table>

<table class="tablelist" cellspacing="0" id="xinyang2">
	<caption>信阳</caption>
	<tr style="background: #fc6;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
	</tr>
</table>

<table id="table-tpl" style="display: none">
	<tr style="background: skyblue;">
		<th>电源名称</th>
		<th>路数</th>
		<th>状态</th>
		<th>电压</th>
		<th>电流</th>
		<th>正对地电压</th>
		<th>负对地电压</th>
		<th>正对地绝缘</th>
		<th>负对地绝缘</th>
		<th>使用轨道</th>
		<th>车次</th>
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

				//一路信息
				append += '<tr><td rowspan="2">'+datas[i][0]+'</td><td>1路</td>';

				//为特定变量加上了单位
				for(var j =1; j<10; j++){
					if(j == 2 || j == 4 || j == 5)
						append += '<td>'+datas[i][j]+'V</td>';
					else if(j == 3)
						append += '<td>'+datas[i][j]+'A</td>';
					else
						append += '<td>'+datas[i][j]+'</td>';
				}
				append += '</tr>';

				//二路信息
				append += '<tr><td>2路</td>';
				for(var j =10; j<19; j++){

					if(j == 11 || j == 13 || j == 14)
						append += '<td>'+datas[i][j]+'V</td>';
					else if(j == 12)
						append += '<td>'+datas[i][j]+'A</td>';
					else
						append += '<td>'+datas[i][j]+'</td>';
				}
				
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
   		},
      	 error: function(){	    			                  							
    	 	 alert('请求失败！')  ;       	    			              	
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
	   		},
		   	 error: function(){	    			                  							
			 	 alert('定时刷新请求失败！')  ;       	    			              	
			}
	 
	});
			    	
	},10000);
	
</script>

@stop
