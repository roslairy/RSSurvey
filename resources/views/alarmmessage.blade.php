@extends('base')

@section('right')
             <h3>故障记录查询</h3>
             <div>
              <form action="searchAlarmMessage" method="get">
                <fieldset>
                  <legend>查询条件</legend>
                
                  <label for="start">起始时间</label><input class="laydate-icon" onclick="laydate()" name="alarmTime" value='{{$alarmTime or ""}}'>
                  <label for="stop">结束时间</label><input id='demo' class="laydate-icon" onclick="laydate()" name="endTime" value='{{$endTime or ""}}'>
                 
                   
                  <label >站场</label>
          	 			<select id="stage" name="stageName">
          	 			@foreach($stageNameInEn as $key => $value)
          	 			<option value="{{ $key }}"
          	 			@if ($key == $stageName)
          	 			selected
          	 			@endif
          	 			>{{ $key }}</option>
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
                  <input type="button" onclick="window.location.href=('{{action('MainController@searchAlarmMessage', ['export'=>true])}}')" value="导出excel">
                  
                </fieldset>
              </form>
              <div class="result">
                  <table>
                    <tr><th>电源编号</th><th>路数</th><th>故障类型</th><th>故障时间</th><th>解除故障时间</th></tr>
                    @if(isset($datas))
                      @foreach($datas as $item)
                        <tr>
                          <td>{{$item['PowerName']}}</td>
                          <td>{{$item['PowerNum']}}</td>
                          <td>{{$item['Alarm']}}</td>
                          <td>{{$item['AlarmTime']}}</td>
                          <td>{{$item['EndTime']}}</td>
                        </tr>
                      @endforeach
                    @endif
                  </table>
              </div>
             </div>
             
          </div>
@stop