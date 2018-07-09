<?php
// Init session settings
include("DB.php");



$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
//mysql_select_db($Db, $link) or die('Could not select database.');
session_start();
mysqli_set_charset($link, "utf8");

  header("Content-type:text/html; charset=utf-8");
    header("Cache-control: private"); 
include("system/include.php");
	$url = curPageURL();
	$myUrl = explode("/", curPageURL());
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
//echo $_SERVER["HTTP_ACCEPT_ENCODING"];
// set and check language
if (isset($_GET["language_id"] )) {
	$language_id = intval($_GET["language_id"]); 
	if ($language_id != ""){$_SESSION['Language'] =$language_id;}
}
//if ($_SESSION['error404'] == $url
$_SESSION['Accesfiles2'] = Array();
// header settings
// header
if (isset( $_SESSION["Id"])) {
	$documentinfo = getdocumentinfo($MainId,array(), $_SESSION["Id"]);
}else{
	$documentinfo = getdocumentinfo($MainId,array());
} 

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>

 <script>';
include ("./system/jquery-1.10.2.min.js");
echo'
</script>

<script language="javascript">

themeurl = "'.$_SESSION['Theme'].'";
function window_onload(){
	';eval ($_SESSION['onloadjs']); 
	echo'
}

function window_onunload(){

}
function resizeframe(){	
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
    realWidth = parseInt(realWidth) - 70;
	realHeight =  parseInt(realHeight) - 120;
    
	';eval ($_SESSION['resizejs']); 
	echo'
	clearTimeout(window.scrollertimer);
	window.scrollertimer = setTimeout("scrollalles();", 300); 
   
}
function scrollalles(){	    
	';eval ($_SESSION['scroll.js']); 
	echo'
	
	if (typeof(loadmessage) === \'function\'){
		clearTimeout(window.msgtimer2); 
		window.msgtimer = setTimeout("loadmessage(window.themessage)", 100); 
	}
}
function mousemovealles(){	    
	';eval ($_SESSION['mousemovejs']); 
	echo'
}
</script>';
$pluginhasadmin = "./plugins/$plugin/admin.php";

if(file_exists($pluginhasadmin)){
	$pluginhasadmin = true;
}else{
	$pluginhasadmin = false;
}

$newrealurl ='indexadminnew.php?plugin='.$plugin.'&type=select&Id='.$MainId.'&sectie='.$sectie;
$output ="";
$outputbefore ="";
$after = "";
$Naam = "";
$msgview = false;
$msgpost = false;
eval($_SESSION['includephp']);
$plugin= str_replace(array(":","/","\\","&","?",".."), array(" "," "," "," "," "," "),$plugin);
	if (is_file('./plugins/'.$plugin.'/member.php')) {
		include './plugins/'.$plugin.'/member.php';
	}else{
		$Naam = "Plugin $plugin not found";
		$output = "The plugin $plugin is not found. Contact the webmaster of this website. The content you try to acces can't be showed.";
	}
	
eval ($_SESSION['includejs']);

eval($_SESSION['pluginpost']);
$banner = "";
include "header.php";

//sectie plugins laden



echo '<div id="Middel">';
// submenu gedoe


// laat middel plugin

	
if (isset($sectie)){
	$menuurl ='./system/groepenviewmenu.php';
	$result = mysqli_query($link,"SELECT MainId, Naam, Menu FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		if (isset($_SESSION['Id'])) {
			$accessectie = accesdocument($row['MainId'], $Ids2 = array(),$_SESSION["Id"]);
		} else {
			$accessectie = accesdocument($row['MainId'], $Ids2 = array());
		}
		if ($accessectie == true){
			$menuname = $row["Naam"] ;
			$menu = $row["Menu"];
		}else{
			$menuname = 'Unkown Sectie ';
		}
	}}else{
		$menuurl ='./system/groepenviewmenu.php';
		$menuname = 'Unkown Sectie ';
}

	
	


// laat middel zien
if ($menu == "Horizontal" or $menu == "Hidden"){
	echo '<div id="getsize" style="width:100%;">';
		echo $outputbefore;
		echo '<h1>'.$Naam.' </h1><br>';
	if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' and $pluginhasadmin == true){
		echo '<div id="buttonlayout">
           <h4> <a href="'.$newrealurl.'">Admin view</a></h4>
         </div><br>';
	}

	include ("./system/message.php");
	echo '<div Id="content">'.$output."</div>";
	echo '</div>';
	}else{
  echo '		<table width="97%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%" valign="top" class="leftbar">';
	// ouput user selectie
	$MainId = intval($_GET["Id"]);
	include ('submenulayout.php');
	
	echo '</td>
				<td>';
				echo '<div id="getsize" style="width:100%;">';
				echo $outputbefore;
	echo '<h1>'.$Naam.' </h1><br>';
		if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' and $pluginhasadmin == true){
		echo '<div id="buttonlayout">
           <h4> <a href="'.$newrealurl.'">Admin view</a></h4>
         </div><br>';
	}
		
	//$output .= "<br>";
	include ("./system/message.php");
	echo '<div Id="content">'.$output."</div>";
	echo '</div>';
	echo '</td></tr></table>';
	
	}

include "footer.php";
echo '<script language="javascript">resizeframe();</script>';?>
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

session_write_close();

?>