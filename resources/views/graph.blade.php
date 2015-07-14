<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rail Source Management</title>
</head>
<link rel="stylesheet" type="text/css" href="css/comm.css">

<style>
 #box,#box1{
	padding:13px 0px 10px;
	padding-left:28px;
	width:677px;
	height:180px;
	background:url(bg1.gif) no-repeat;
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
                  <li  style="background:skyblue;"><a href="">曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href="">按车次</a></li>
                          <li><a href="">按使用</a></li>
                          <li><a href="">按故障</a></li>
                      </ul>
                  </li>
                  <li><a href="">站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id="right">
             <div id="box"></div>
             <div id="box1"></div>
          </div>
      </div>
       
   </div>

<script src="js/gov.Graphic.js"></script>
<script type="text/javascript" src="js/initialize.js"></script>
<script type="text/javascript">
  window.onload=function(){
    chushihua();
    var data=new period([0,10,22,13,34,25,28,26,30,35,28,34,39,28,26,50,35,28,34,39,55],//y轴数据
      [188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208]//x轴数据
      );
    var data1=new period([48,23,10,2,12,8,24,25,15,35,25,14,42,58,46,25,12,8,14,28,42],//y轴数据
      [188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208]//x轴数据
      );
    new gov.Graphic(data,"box");
    new gov.Graphic(data1,"box1",{ pointColor:"#3366ff",lineColor:"#33ffff"});



  }
</script>
</body>
</html>