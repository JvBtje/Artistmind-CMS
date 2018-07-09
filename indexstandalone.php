<?php
// Init session settings
include("DB.php");



$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
session_start();

  header("Cache-control: private"); 
  header("Content-type: text/html; charset=utf-8");
include("system/include.php");
	$url = curPageURL();
	$myUrl = explode("/", curPageURL());
	$_SESSION['Accesfiles2']= array();
if ($_SESSION['newsessionany'] != 10 ){

	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}else{
	loadplugin ();
}
$plugin = $_GET["plugin"];
$type = $_GET["type"]; 
$MainId = intval($_GET["Id"]);
if (isset($_GET["sectie"])){
	$sectie = intval($_GET["sectie"]);
}

// set and check language
if (isset($_GET["language_id"] )) {
	$language_id = intval($_GET["language_id"]); 
	if ($language_id != ""){$_SESSION['Language'] =$language_id;}
}
// header settings
// header
$output ="";
$outputbefore ="";
$after = "";
$msgview = false;
$msgpost = false;
eval($_SESSION['includephp']);
$plugin= str_replace(array(":","/","\\","&","?",".."), array(" "," "," "," "," "," "),$plugin);
	if (is_file('./pluginstandalone/'.$plugin.'/index.php')) {
		include './pluginstandalone/'.$plugin.'/index.php';
	}else{
		$Naam = "Plugin $plugin not found";
		$output = "The plugin $plugin is not found. Contact the webmaster of this website. The content you try to acces can't be showed.";
	}
 echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
 <script>';
include ("./system/jquery-3.2.1.min.js");
echo'
</script>
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";
function window_onload(){
	';eval ($_SESSION['onloadjs']); echo'
}
function window_onunload(){

}


function resizeframe(){	
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
    realWidth = parseInt(realWidth) - 70;
	realHeight =  parseInt(realHeight) - 120;
    
	';eval ($_SESSION['resizejs']); echo'
    clearTimeout(window.scrollertimer);
	window.scrollertimer = setTimeout("scrollalles();", 300); 
}
function scrollalles(){	    
	';eval ($_SESSION['scroll.js']); echo'
	
	if (typeof(loadmessage) === \'function\'){
		clearTimeout(window.msgtimer2); 
		window.msgtimer = setTimeout("loadmessage(window.themessage)", 100); 
	}
}
function mousemovealles(){	    
	';eval ($_SESSION['mousemovejs']); echo'
}
</script>';
eval ($_SESSION['includejs']); 

eval($_SESSION['pluginpost']);
$banner = "";
include "header.php";



echo '<div id="Middel">';


	
if (isset($sectie)){
	$menuurl ='./system/groepenviewmenu.php';
	$result = mysqli_query($link,"SELECT MainId, Naam, Menu FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		$menu = $row["Menu"];
		//if ($row["Menu"] == Horizontal){
			//$menuurl ='./system/groepenviewmenuhor.php';
		//}
	}}else{
		$menuname = 'Unkown Sectie ';
}

	
	


// laat middel zien
echo '
<table width="97%" border="0" cellspacing="0" cellpadding="0">
			<tr>';
		if (is_file('./pluginstandalone/'.$plugin.'/displaylist.php')) {
				echo '<td width="30%" valign="top" class="leftbar">';
	
	
		include './pluginstandalone/'.$plugin.'/displaylist.php';
	
	
	echo '</td>';
	}
				echo '<td>';

	
	
	
	echo $outputbefore;
	include ("./system/message.php");
	echo $output;
	echo '</td></tr></table>';

echo '<script language="javascript">resizeframe()</script>';
include "footer.php";?>
</div>

<?php




echo '<div name="directory" id="directory" onclick="closeeditimg();return false"><div name="directorystyle" id="directorystyle" onclick="closeeditimg();return false"></div></div> ';

$languase = 1;
include "menu.php";
eval ($_SESSION['afterphp']);
echo $after;
//include ("./system/backup.php");
//include ("./system/sendnieuwsbrief.php");
mysqli_close ($link);
?>