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
@stop