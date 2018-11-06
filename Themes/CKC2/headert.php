
<?php

	if (intval ($_SESSION['Language']) == 7){
		echo '<title>CKC - Clubhuis KennisCentrum -';
	} else if (intval ($_SESSION['Language']) == 8) {
		echo '<title>CKC - Clubhouse KnowledgeCenter -';
	}
	echo $Naam.'</title>';
	
	if (intval ($_SESSION['Language']) == 7){
		echo '<meta name="keywords" content="Clubhuis, kennis, centrum, model, Clubhuismodel">';
	} else if (intval ($_SESSION['Language']) == 8) {
		echo '<meta name="keywords" content="Clubhouse, Knowledge, Center, model, Clubhousemodel">';
	}
?>
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
		
		
		<?php if ($_SESSION['Cookie'] == true){ ?>
		addthis.init();	
		<?php } ?>
		if (typeof window_onload == 'function') { window_onload();}
		
		if (typeof load == 'function') { load();}
		
		if (startfadbodyintest == false){
			clearTimeout(window.bodyfadegtimer);
			startfadebodyin();
		}
	
		
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
		if (viewportwidth<800 ){
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
function changeOpacybody(opacity, id) {
	
    var object = document.getElementById(id).style;
	
	if (opacity != 0){
		object.opacity = (opacity / 100);
		object.MozOpacity = (opacity / 100);
		object.KhtmlOpacity = (opacity / 100); 	
	}else{
		object.opacity = 0;
		object.MozOpacity = 0;
		object.KhtmlOpacity = 0;
	}
    object.filter = "alpha(opacity=" + opacity + ")";
}


window.imagebodyoffset = -100;
window.imagemiddeloffset = 100;
window.imagemiddeltop = 214;
window.hitmousex = 0;
window.hitmousey = 0;
window.tempX = 0;
window.tempY = 0;
startfadbodyintest = false;

function startfadebodyin(){	
	startfadbodyintest = true;
	changeOpacybody(0, "Middel");
	growbodywindow();
	window.timerIDimg=setTimeout("addalphabody()",30);
	window.timerIDimg=setTimeout("growmiddelwindow()",399);
	window.timerIDimg=setTimeout("addalphamiddel()",400);
	
}
function scrollY() {
    if( window.pageYOffset ) { return window.pageYOffset; }
    return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
}
function startbodyfadeout(){

	changeOpacybody(100, "Middel");
	window.hitmousex = window.tempX;
	window.hitmousey = window.tempY;
	document.getElementById('mouseclicklader').style.display = 'none';
	window.bodyspeed = -0.1;
	window.bodyscale = 1;
	elem = document.elementFromPoint(window.hitmousex, window.hitmousey);
	var tmp = 	""+parseInt(window.hitmousex+scrollX() )+"px "+parseInt(window.hitmousey+scrollY())+"px"
	
	document.getElementById('bodycontainer').style.transformOrigin= tmp;	
	
	valueelemt = ( elem.parentNode.parentNode.href || elem.parentNode.href|| elem.href )
	targetelemt = ( elem.parentNode.parentNode.target || elem.parentNode.target|| elem.target )
	
	if(valueelemt === undefined || valueelemt.indexOf('#') > -1|| valueelemt == "" || valueelemt == elem.src || targetelemt == "_blank") {
		document.getElementById('mouseclicklader').style.display = 'block';	
		elem.click();
		//elem.focus();
		//elem.mouseover();
		
	}else{
		window.timerIDbodyfadealarm=setTimeout("elem.click();",1000);
		delalphabody(elem);
	}
	
}



function scrollX() {
    if( window.pageXOffset ) { return window.pageXOffset; }
    return Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
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

function addalphamiddel(){
	window.timerIDMiddelfade=clearTimeout(window.timerIDMiddelfade);
	var curalpha = parseFloat( document.getElementById('Middel').style.opacity);
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/16) + parseFloat(curalpha))*100
	changeOpacybody(curalpha, "Middel");
	
	if (parseInt(curalpha) < 99){		
		window.timerIDimg=setTimeout("addalphamiddel()",30);
	}else{		
		curalpha = 100;
		changeOpacybody(curalpha, "Middel");		
		window.timerIDMiddelfade=clearTimeout(window.timerIDMiddelfade);		
	}
}

function growmiddelwindow(){
	
	window.timerIDMiddeloffset=clearTimeout(window.timerIDMiddeloffset);
	
	window.imagemiddeloffset =  (parseFloat(parseFloat(1 - window.imagemiddeloffset)/4) + parseFloat(window.imagemiddeloffset))
	
	document.getElementById('Middel').style.top =parseInt( window.imagemiddeltop + window.imagemiddeloffset) + "px"
	
	if (parseInt(window.imagemiddeloffset) > 1){		
		window.timerIDMiddeloffset=setTimeout("growmiddelwindow()",30);
	}else{			
		window.imagemiddeloffset = 0;
		document.getElementById('Middel').style.top = window.imagemiddeltop	+ "px"
		window.timerIDMiddeloffset=clearTimeout(window.timerIDMiddeloffset);
		resizeframe();
	}
}

function addalphabody(){
	window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);
	var curalpha = parseFloat( document.getElementById('bodycontainer').style.opacity);
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/16) + parseFloat(curalpha))*100
	changeOpacybody(curalpha, "bodycontainer");
	
	if (parseInt(curalpha) < 99){		
		window.timerIDbodyfade=setTimeout("addalphabody()",30);
	}else{		
		curalpha = 100;
		changeOpacybody(curalpha, "bodycontainer");		
		window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);		
	}
}



function delalphabody(elem){
	window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);
	thediv = document.getElementById('bodycontainer');
	var curalpha = parseFloat( thediv.style.opacity);
	curalpha =  (parseFloat(curalpha) - parseFloat(parseFloat(curalpha)/6) )*100
	changeOpacybody(curalpha, "bodycontainer");
	window.bodyscale = window.bodyscale + window.bodyspeed;
	window.bodyspeed = window.bodyspeed + 0.04;
	rotation = window.bodyscale * 10
		thediv.style.transform="rotate("+rotation+"deg) scale("+window.bodyscale+","+window.bodyscale+")";
		thediv.style.MozTransform ="rotate("+rotation+"deg) scale("+window.bodyscale+","+window.bodyscale+")";
		thediv.style.WebkitTransform ="rotate("+rotation+"deg) scale("+window.bodyscale+","+window.bodyscale+")";	
		thediv.style.OTransform ="rotate("+rotation+"deg) scale("+window.bodyscale+","+window.bodyscale+")";	
		thediv.style.msTransform ="rotate("+rotation+"deg) scale("+window.bodyscale+","+window.bodyscale+")";
		//thediv.style.webkitTransform = 'rotate('+bodyscale+'deg)'; 
		//thediv.style.mozTransform    = 'rotate('+bodyscale+'deg)'; 
		//thediv.style.msTransform     = 'rotate('+bodyscale+'deg)'; 
		//thediv.style.oTransform      = 'rotate('+bodyscale+'deg)'; 
		//thediv.style.transform       = 'rotate('+bodyscale+'deg)';
	if (parseInt(curalpha) > 1){		
		window.timerIDbodyfade=setTimeout("delalphabody(elem)",30);
	}else{		
		curalpha = 0;
		changeOpacybody(curalpha, "bodycontainer");
		thediv.style.transform="scale(1,1)";
		thediv.style.MozTransform ="scale(1,1)";
		thediv.style.WebkitTransform ="scale(1,1)";	
		thediv.style.OTransform ="scale(1,1)";	
		thediv.style.msTransform ="scale(1,1)";		
		window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);		
		elem.click();
		clearTimeout(window.timerIDbodyfadealarm);
	}
}


function growbodywindow(){
	
	window.timerIDbodyoffset=clearTimeout(window.timerIDbodyoffset);
	
	window.imagebodyoffset =  (parseFloat(parseFloat(1 - window.imagebodyoffset)/4) + parseFloat(window.imagebodyoffset))
	document.getElementById('bodycontainer').style.top = window.imagebodyoffset + "px"
	
	if (parseInt(window.imagebodyoffset) < -1){		
		window.timerIDimg=setTimeout("growbodywindow()",30);
	}else{			
		window.imagebodyoffset = 0;
		document.getElementById('bodycontainer').style.top = window.imagebodyoffset	+ "px"
		window.timerIDbodyoffset=clearTimeout(window.timerIDbodyoffset);		
	}
}
window.down=0;
load();


curalpha = 0;
changeOpacybody(curalpha, "bodycontainer");
</script>
<?php 
include "analitic.php";
?>
</head>

<body  onLoad="window_onload2();" onresize="load();">
<div id ="mouseclicklader" name="mouseclicklader" style="position:fixed; left:0px; right:0px; top:0px; bottom:0px;z-Index:50;" onclick="startbodyfadeout()"><a href="#" ></a></div>
<center>
<div id="bodycontainer" name="bodycontainer" style=" position:absolute; left:0px; right:0px; overflow:visible;">
<script type="text/javascript">  load(); 
curalpha = 0;
changeOpacybody(curalpha, "bodycontainer");

</script>

<div id="midback">

</div>


<div id="letters">

</div>

<div id="menuback">
</div>
<div id="Header">
<?php

	if (intval ($_SESSION['Language']) == 7){
		echo '<img src="./Themes/CKC/iconen/logo.jpg">';
	} else if (intval ($_SESSION['Language']) == 8) {
		echo '<img src="./Themes/CKC/iconen/logo en.jpg">';
	}
?>

</div>



<!-- AddThis Button END -->
<div id="Searchbox">
<form name="formzoek2" action="zoeken.php" method="GET" name="Users"><table><tr><td>
<form action="zoeken.php" method="POST" name="zoeken"><input type="hidden" name="type" value="" border="0"><input id="Searchstring" name="Searchstring" type="text" name="Searchstring" value="" size="24" border="0"> <a href="#" onclick="javascript:searchform()"> Zoeken</a> </td></tr></table>
</form>
<form action="Login.php" method="POST" name="Login">
			<table border="0" >
			<tr><td><input type="text" name="Username" size="24" border="0"></td><td>Gebruikersnaam</td></tr>
			<tr><td><input type="password" name="Password" size="24" border="0"></td><td>Wachtwoord</td></tr>
			<tr><td></td><td><input type="submit" name="submitButtonName" border="0" value="Login"></td></tr></table>
		</form>
		

</div>
<div id="SliderName" class="SliderName">
		
</div>

