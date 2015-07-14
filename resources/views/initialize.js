
 function chushihua(){
    var owrap = document.getElementById("wrap");
    var cheight = document.documentElement.clientHeight;
    owrap.style.minHeight=cheight+"px";
    var obody = document.getElementById("obody");
    obody.style.minHeight=cheight-70+"px";
    var oright = document.getElementById('right');
    oright.style.minHeight=obody.offsetHeight+'px';
    var oleft = document.getElementById('left');
    oleft.style.height=oright.offsetHeight + 'px';
 }

 
