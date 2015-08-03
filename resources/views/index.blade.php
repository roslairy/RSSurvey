@extends('base')

@section('right')
<table class="tablelist" cellspacing="0">

    <caption>武昌</caption>
    <tr style="background:#fc6;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>
    @if(isset($datas))
        @for($i=0;$i<$datas[5][0];$i++)
        
            <tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
                @for($j=1;$j<10;$j++)
                    <td>{{$datas[0][$i][$j]}}</td>
                @endfor
            <tr>
            <tr><td>2路</td>
                
                @for($j=10;$j<19;$j++)
                    <td>{{$datas[0][$i][$j]}}</td>
                @endfor
            </tr>
        @endfor
    @endif

    
</table>

<table class="tablelist" cellspacing="0">
<caption>汉口</caption>
<tr style="background:springgreen;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>

    @if(isset($datas))
    @for($i=0;$i<$datas[5][1];$i++)
    
        <tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
            @for($j=1;$j<10;$j++)
                <td>{{$datas[1][$i][$j]}}</td>
            @endfor
        <tr>
        <tr><td>2路</td>
            
            @for($j=10;$j<19;$j++)
                <td>{{$datas[1][$i][$j]}}</td>
            @endfor
        </tr>
    @endfor
@endif


</table>
<table class="tablelist" cellspacing="0">
<caption>宜昌</caption>
<tr style="background:skyblue;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>

    @if(isset($datas))
    @for($i=0;$i<$datas[5][2];$i++)
    
        <tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
            @for($j=1;$j<10;$j++)
                <td>{{$datas[2][$i][$j]}}</td>
            @endfor
        <tr>
        <tr><td>2路</td>
            
            @for($j=10;$j<19;$j++)
                <td>{{$datas[2][$i][$j]}}</td>
            @endfor
        </tr>
    @endfor
@endif

</table>


<table class="tablelist" cellspacing="0">
<caption>襄阳</caption>
<tr style="background:#fc6;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>

    @if(isset($datas))
    @for($i=0;$i<$datas[5][3];$i++)
    
        <tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
            @for($j=1;$j<10;$j++)
                <td>{{$datas[3][$i][$j]}}</td>
            @endfor
        <tr>
        <tr><td>2路</td>
            
            @for($j=10;$j<19;$j++)
                <td>{{$datas[3][$i][$j]}}</td>
            @endfor
        </tr>
    @endfor
    @endif

</table>
<table class="tablelist" cellspacing="0">
<caption>信阳</caption>
<tr style="background:skyblue;"><th>电源名称</th><th>路数</th><th>状态</th><th>总电压</th><th>总电流</th><th>正对地电压</th><th>负对地电压</th><th>正对地绝缘</th><th>负对地绝缘</th><th>使用轨道</th><th>车号</th></tr>


    @if(isset($datas))
    @for($i=0;$i<$datas[5][4];$i++)
    
        <tr><td rowspan="3">电源{{$i+1}}</td><td>1路</td>
            @for($j=1;$j<10;$j++)
                <td>{{$datas[4][$i][$j]}}</td>
            @endfor
        <tr>
        <tr><td>2路</td>
            
            @for($j=10;$j<19;$j++)
                <td>{{$datas[4][$i][$j]}}</td>
            @endfor
        </tr>
    @endfor
    @endif
</table>
@stop