<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rail Source Management</title>
</head>
<link rel="stylesheet" type="text/css" href="css/comm.css">
<link rel="stylesheet" type="text/css" href="css/poweruse.css">

<script type="text/javascript" src="js/initialize.js"></script>

<style>
    .resultshow{
        width: 80%;
        margin: 20px auto;
        border: 1px solid #ccc;
       
    } 
    .resultshow span,.resultshow div{
        font-size: 18px;
        line-height: 20px;
    }
    .tabhead{
        float:left;
        line-height:20px;
        width:100px;
    }
    .divsty{
        display: inline-block;
        width:200px;
        height:20px;
        text-align:center;
        line-height:20px;
        font-size:18px;
        font-weight:bold;
        margin-left:150px;
        background:#ccc;
    }
    .divsty2{
        display:inline-block;
        width:100px;
        height:20px;
        background:#e0e0e0;
        text-align:center;
    }
</style>

<body>
   <div class="wrap" id="wrap">
      <div class="header">
          <span>铁路电源使用信息管理</span>
      </div>
      <div class="body" id="obody">
          <div class="left" id="left">
              <ul class="left_menu">
                  <li><a href="index.html">全站显示</a></li>
                  <li  ><a href="">曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href="">按车次</a></li>
                          <li><a href="">按使用</a></li>
                          <li><a href="">按故障</a></li>
                      </ul>
                  </li>
                  <li style="background:skyblue;"><a href=''>站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id="right"> 
              <div class="resultshow">
                  <span>电源编号</span><span style="margin-left:350px">1号电源</span>
                 
                  <div style="overflow:hidden;margin:20px auto;">
                      <span class="tabhead">整流回路</span>
                      <div id="lu1" class="divsty2" style="margin-left:150px;">I路</div>
                      <div id="lu2"class="divsty2" style="margin-left:215px;">II路</div>
                      
                  </div>
                  
                  <div style="overflow:hidden;margin:20px auto;">
                      <span class="tabhead">用电量</span>
                      <div class="divsty2" style="margin-left:150px;">{{$datas[0][0][4] or ''}}</div>kwh
                      <div class="divsty2" style="margin-left:180px;">{{$datas[0][1][4] or ''}}</div>kwh
                      
                  </div>
                  <div  style="overflow:hiddenmargin:20px auto;;">
                      <span class="tabhead">电压电流</span>
                      <span class="divsty2" style="margin-left:90px">{{$datas[0][0][4] or ''}}</span>
                      V
                      <span class="divsty2"></span>
                      A
                      <span class="divsty2" style="margin-left:72px"></span>
                      V
                      <span class="divsty2"></span>
                      A
                  </div>
                  <div style="overflow:hidden;margin:20px auto;">
                      <span class="tabhead">正线绝缘</span>
                      <span  class="divsty2" style="margin-left:90px"></span>
                      V
                      <span class="divsty2"></span>
                      <span class="divsty2" style="margin-left:90px"></span>
                      V
                      <span class="divsty2"></span>
                  </div>
                  <div style="overflow:hidden;margin:20px auto;">
                      <span class="tabhead">负线绝缘</span>
                      <span class="divsty2" style="margin-left:90px;"></span>
                      V
                      <span class="divsty2"></span>
                      <span class="divsty2" style="margin-left:90px;"></span>
                      V
                      <span class="divsty2"></span>
                  </div>
                  <hr style="border-bottom:1px solid #fc6;border-top:0;">
                  <div style="overflow:hidden;margin:20px auto;">
                      <span class="tabhead">轨边柜</span>
                      
                      <div id="gui1"style="width:40px;height:20px;background:#e0e0e0;float:left;text-align:center;margin-left:190px;">I</div>
                      <div id="gui2"style="width:40px;height:20px;background:#e0e0e0;float:left;text-align:center;margin-left:290px;">II</div>
                   
                  </div>
                  <div style="overflow:hidden;margin:20px auto;">
                      <div style="float:left;">
                          <div style="line-height:20px;width:100px;">轨道</div>
                          <div style="line-height:20px;width:100px;">列车</div>
                      </div>

                      <div style="float:left;margin-left:160px">
                          <div style="width:100px;height:20px;background:#e0e0e0;text-align:center;margin-bottom:5px;">1</div>
                          
                          <div class="lieche"  style="width:100px;height:20px;background:#e0e0e0;text-align:center;">ddd</div>
                      </div>
                      <div style="float:left;margin-left:230px">
                          <div style="width:100px;height:20px;background:#e0e0e0;text-align:center;margin-bottom:5px;">1</div>
                          
                          <div class="lieche"  style="width:100px;height:20px;background:#e0e0e0;text-align:center;"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
       
   </div>  
   <script type="text/javascript">

  window.onload=function(){
     chushihua();
     var lu1 = document.getElementById('lu1');
     var lu2 = document.getElementById('lu2');
     var gui1 = document.getElementById('gui1');
     var gui2 = document.getElementById('gui2');
     var olieche = document.getElementsByClassName('lieche');
    if(olieche[0].innerHTML!=''){
			olieche[0].style.background="skyblue";
			lu1.style.background="skyblue";
			gui1.style.background="skyblue";
        }
    if(olieche[1].innerHTML!=''){
		olieche[1].style.background="skyblue";
		lu2.style.background="skyblue";
		gui2.style.background="skyblue";
    }
     
  }
</script>
</body>
</html>