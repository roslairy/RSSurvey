<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rail Source Management</title>
</head>
<link rel="stylesheet" type="text/css" href="css/comm.css">
<link rel="stylesheet" type="text/css" href="css/poweruse.css">
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
                  <li style="background:skyblue;"><a href="">站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id="right">
          <table>
            <tr><td>电源编号</td><td colspan="7">1号电源</td></tr>
            <tr><td>整流回路</td><td></td><td>1路</td><td></td><td></td><td></td><td>2路</td><td></td></tr>
            <tr><td>用电量(kwh)</td><td colspan="3">34444</td><td></td><td colspan="3">44444</td></tr>
            <tr><td>电压电流</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>正线绝缘</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>负线绝缘</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>轨边柜</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>轨道</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>列车</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
          </table>
          </div>
      </div>
       
   </div>
   <script type="text/javascript" src="js/initialize.js"></script>
  
   <script type="text/javascript">

  window.onload=function(){
     chushihua();
     var td = document.getElementsByTagName('td');
     for (var i = td.length - 1; i >= 0; i--) {
       if(td[i].innerHTML!=''){
        console.log("shuchu");
        td[i].style.background='#fc6';
       }
     };
  }
</script>
</body>
</html>