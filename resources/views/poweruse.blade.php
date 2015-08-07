 @extends('base') @section('right')
<h3>电源查询</h3>
<div>
	<form action="searchPowerUse" method="get">
		<fieldset>
			<legend>查询条件</legend>

			<label for="start">起始时间</label>
				<input class="laydate-icon" onclick="laydate()" name="beginTime" id="_date" value='{{$beginTime or ""}}'>
				 <label for="stop">结束时间</label>
				 <input	id='demo' class="laydate-icon" onclick="laydate()" name="stopTime"value='{{$stopTime or ""}}'>
				 <label>站场</label> 
				 <select id="stage"	name="stageName"> 
				 @foreach($stageNameChinese as $key => $value)
					<option value="{{ $key }}"
						@if ($key==$stageName)selected
          	 			@endif>{{ $value }}
          	 		</option> 
          	 	@endforeach
			</select> 
			<label for="num">电源编号</label><select name="powerName">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select> <input type="submit" value="查询"
				onclick="showOldSelection()"> <input type="button"
				onclick="window.location.href=('{{action('MainController@searchPowerUse', ['export'=>true])}}')"
				value="导出excel">
		</fieldset>
	</form>

	<div class="result">
		<table>
			<tr>
				<th>电源编号</th>
				<th>路数</th>
				<th>轨道号</th>
				<th>车号</th>
				<th>开始时间</th>
				<th>结束时间</th>
				<th>用电量</th>
			</tr>
			<!--  <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr> -->

			@if(isset($datas[0]))
			<tr>
				@foreach($datas[0] as $key=>$value)
				<td>{{$value}}</td> @endforeach
			</tr>
			@endif @if(isset($datas[1]))
			</tr>
			@foreach($datas[1] as $key=>$value)
			<td>{{$value}}</td> @endforeach
			</tr>
			@endif



		</table>
	</div>
</div>
@stop
