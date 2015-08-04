@extends('base')

@section('right')
<h3>车次使用查询</h3>
             <div>
              <form action="searchRailUse" method="get">
                <fieldset>
                  <legend>查询条件</legend>
                  
                  
                  <label for="start">起始时间</label><input id='demo0' class="laydate-icon" onclick="laydate()" name="beginTime" value ='{{$beginTime or ""}}'>
                  <label for="stop">结束时间</label><input id='demo' class="laydate-icon" onclick="laydate()" name="stopTime" value ='{{$stopTime or ""}}'>
                  
                  <label >站场</label>
          	 			<select id="stage" name="stageName">
          	 			@foreach($stageNameChinese as $key => $value)
          	 			<option value="{{ $key }}"
          	 			@if ($key == $stageName)
          	 			selected
          	 			@endif
          	 			>{{ $value }}</option>
          	 			@endforeach
          	 			</select>		
          	 	  <label for="num">电源编号</label>
                  <select name="powerName">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  </select>

                  <input type="submit" value="查询">
                  <input type="button" onclick="window.location.href=('{{action('MainController@searchRailUse', ['export'=>true])}}')" value="导出excel">
                  
                </fieldset>
              </form>
              <div class="result">
                  <table>
                    <tr><th>车号</th><th>电源编号</th><th>轨道号</th><th>开始时间</th><th>结束时间</th><th>用电量</th></tr>
                    @if(isset($datas))
                      @for($i=0;$i<count($datas);$i++)
                        <tr>
                          <td>{{$datas[$i]['RailNum']}}</td>
                          <td>{{$datas[$i]['PowerName']}}</td>
                          <td>{{$datas[$i]['RailwayName']}}</td>
                          <td>{{$datas[$i]['BeginTime']}}</td>
                          <td>{{$datas[$i]['StopTime']}}</td>
                          <td>{{$datas[$i]['UseKWH']}}</td>
                        </tr>
                      @endfor
                    @endif
                  </table>
              </div>
             </div>
@stop