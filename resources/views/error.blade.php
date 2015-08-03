@extends('base')

@section('right')

             <h3>出错信息</h3>
             <div style="text-align:center">
              
                <fieldset>
                  <!-- 出错信息列表 -->
                  
                  <!-- 字段验证出错 -->
                  {{$validatorMessage or  '未知的错误'}}
                  
                </fieldset>
              
             
             </div>
@stop