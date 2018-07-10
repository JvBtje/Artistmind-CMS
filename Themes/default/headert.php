<title>Your website - <?php echo $Naam; ?></title>
<meta name="keywords" content="Dit is coole content">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">

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
	
		
		
		if (typeof load == 'function') { load();}
		

	
		
}
function load()
{
	if (document.getElementById('menuajax')){
		slidemenu(document.getElementById('menuslidertop'),document.getElementById('menusliderbottom'),document.getElementById('footer'),document.getElementById('menuslider'),document.getElementById('menuslider'));
	}
	if (document.getElementById('menuajax2')){
		slidemenu(document.getElementById('menuslidertop2'),document.getElementById('menusliderbottom2'),document.getElementById('footer'),document.getElementById('menuslider2b'),document.getElementById('menuslider2b'));
	}
	if (document.getElementById('menuajax3')){
		slidemenu(document.getElementById('menuslidertop3'),document.getElementById('menusliderbottom3'),document.getElementById('footer'),document.getElementById('menuslider3'),document.getElementById('menuslider3'));
	}

if (window.width1000 != true && window.width1000 != false){
	window.width1000 ;
}

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
 
	if (document.getElementById("menuajax3")){
	if (document.getElementById("menuajax")){
		if (viewportwidth<700 ){
			if (document.getElementById("menuajax3").innerHTML.length < 1){
				document.getElementById("menuajax3").innerHTML = document.getElementById("menuajax").innerHTML ;
				document.getElementById("menuajax").innerHTML = "";	
			}
		}else{
			if (document.getElementById("menuajax").innerHTML.length < 1){
				document.getElementById("menuajax").innerHTML = document.getElementById("menuajax3").innerHTML ;
				document.getElementById("menuajax3").innerHTML = "";	
		}}
		}}
	
	var d= document, root= d.documentElement, body= d.body;
	var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
	realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;

	
	

	
	
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

<body  onLoad="window_onload2();" onresize="load();">


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

