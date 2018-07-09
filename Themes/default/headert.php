

<title>Your website - <?php echo $Naam; ?></title>
<meta name="keywords" content="this is cool">

<style>
<?php
include ("divstyle.css");
?>
</style>
<style>
<?php
include ("style.css");
?>
</style>
<style>
<?php
include ("../../nicedit.css");
?>
</style>
 <script>
<?php
include ("./menu.js");
?>
</script>
<script type="text/javascript">
function window_onload2(){
		window_onload();
		load();
		
}
function load()
{


var viewportwidth;
 var viewportheight;
 
 // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
 
 if (typeof window.innerWidth != 'undefined')
 {
      viewportwidth = window.innerWidth,
      viewportheight = window.innerHeight
 }
 
// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)

 else if (typeof document.documentElement != 'undefined'
     && typeof document.documentElement.clientWidth !=
     'undefined' && document.documentElement.clientWidth != 0)
 {
       viewportwidth = document.documentElement.clientWidth,
       viewportheight = document.documentElement.clientHeight
 }
 
 // older versions of IE
 
 else
 {
       viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
       viewportheight = document.getElementsByTagName('body')[0].clientHeight
 }
	var d= document, root= d.documentElement, body= d.body;
	var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
	realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;

	
	
     	realWidth = parseInt(realWidth);
	realHeight =  parseInt(realHeight);
	if (realWidth > parseInt(document.getElementById("footer").clientWidth)){
		document.getElementById("footerback").style.right = '-' + parseInt((realWidth - parseInt(document.getElementById("footer").clientWidth)) ) + 'px';
	}else{
		document.getElementById("footerback").style.right = '-'+parseInt(document.getElementById("footer").clientWidth) + 'px';
	}
		
	
	
	if (typeof resizeframe == 'function') {
		
		resizeframe();
		
	}
}
function getMouseXY(e) { 
	
	if (IE) { 		
		window.tempX = event.clientX 
		window.tempY = event.clientY 
	} 
	else 
	{  		
		 window.tempX =  e.pageX - scrollX()
		 window.tempY =  e.pageY - scrollY()
		 window.tempy2 = e.pageY
	} 

	mousemovealles()
	return true
}

var IE = document.all?true:false
if (!IE) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
</script>
</head>

<body  onLoad="window_onload2();" onresize="load();" onmouseup="window.down=0;" onmousedown="window.down=1;">

<script type="text/javascript"> load();</script>

<div id="leftb">
	
</div>



<div id="rightb">
</div>
<div id="left">
	
</div>



<div id="right">
</div>

<div id ="midback">
</div>
<div id="Headerback">
	
</div>
<div id="Header">
 <table width="100%"><tr><td >
<img src="./Themes/default/banner/logo2.png" alt="logo artistmind">
</td><td width="100">

<?php /*if ($_SESSION['Cookie'] == true){ 
} else {
	echo '<form name="formcookie"  action="Enable Cookies.php" method="POST" ><input type="submit" value="This website use Cookies, click to agree"></form><a href="richtext-72-186-Cookies.html">Waarom?</a>';

}*/
?>

</td></tr></table>
</div>

