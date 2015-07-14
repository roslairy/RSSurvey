<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rail Source Management</title>
    
    
</head>
  
<link rel="stylesheet" type="text/css" href="css/comm.css">
<link rel="stylesheet" type="text/css" href="css/poweruse.css">
<script type="text/javascript" src="js/initialize.js"></script>
  <script type="text/javascript" src="js/laydate/laydate.js"></script>

<body>
   <div class="wrap" id="wrap">
      <div class="header">
          <span>出错啦！</span>
      </div>
      <div class="body" id="obody">
          <div class="left" id='left'>
              <ul class="left_menu">
                  <li><a href="/">全站显示</a></li>
                  <li  style="background:skyblue;"><a href="">曲线图显示</a></li>
                  <li id="sepli" >查询
                      <ul>
                          <li><a href={{route('railuse')}}>按车次</a></li>
                          <li><a href={{route('poweruse')}}>按电源</a></li>
                          <li><a href={{route('alarmmessage')}}>按故障</a></li>
                      </ul>
                  </li>
                  <li><a href="">站场1</a></li>
                  <li><a href="">站场2</a></li>
                  <li><a href="">站场3</a></li>
                  <li><a href="">站场4</a></li>
                  <li><a href="">站场5</a></li>
                  
              </ul>
          </div>
          <div class="right" id='right'>
          	 <h3>出错信息</h3>
          	 <div style="text-align:center">
          	 	
          	 		<fieldset>
          	 			{{$validatorMessage or '未知的错误'}}
          	 		</fieldset>
          	 	
          	 
          	 </div>
             
          </div>
      </div>
       
   </div>
   
   
   <script type="text/javascript">
	;!function(){
		laydate({
		   elem: '#demo'
		})
	}();
  window.onload=function(){
     chushihua();
  }
</script>
</body>
</html>
