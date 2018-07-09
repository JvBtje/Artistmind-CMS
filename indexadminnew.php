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
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
header("Cache-control: private");
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
// serverside caching start 

/*
$starttime = $_GET['starttime'];
$userid = $_SESSION['Id'];
$cache_file = "/cache/url=$url.time=$starttime.userid=$userid.html";
$dynamicpath = $_GET['dynamicpath'];
//$session_cache = "/cache/localhost.$starttime.sessions";
 
if (file_exists($cache_file) && !isset($dynamicpath)) {
    // Display cache contents
    echo explode("\n", file_get_contents($cache_file));
    // Load sessions variables
    $filehandle = fopen ($session_cache, 'r'); 
    // open file containing session data
    $sessiondata = fread ($filehandle, 4096); 
    // read the session data from file
fclose ($filehandle);
    session_decode($sessiondata); // Decode the session data
else {
	// serverside caching end
    // Cache does not exist or force a cache
    // Dynamically load the data and display it
	
    // Save session data 
    if (isset($_GET['savesessions'])) {
        $session_data = session_encode(); // Get the session data
        $filehandle = fopen ($session_cache, 'w+'); 
        // open a file write session data
        fwrite ($filehandle, $session_data); 
        // write the session data to file
        fclose ($filehandle);
    }
}
*/
$output = "";
$msgview = false;
$msgpost = false;
eval($_SESSION['includephp']);
$plugin= str_replace(array(":","/","\\","&","?",".."), array(" "," "," "," "," "," "),$plugin);
	if (is_file('./plugins/'.$plugin.'/admin.php')) {
		include './plugins/'.$plugin.'/admin.php';
	}else{
		$Naam = "Plugin $plugin not found";
		$output = "The plugin $plugin is not found. Contact the webmaster of this website. The content you try to acces can't be showed.";
	}
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<head>
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
 <script>';
include ("./system/jquery-3.2.1.min.js");
echo'
</script>
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";
function window_onload(){

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
include "header.php";
$newrealurl = str_replace('indexadminnew.php','indexnew.php',curPageURL());



echo '<div id="Middel">';

	
if (isset($sectie)){
	$menuurl ='./system/groepenmenuajax.php';
	$result = mysqli_query($link,"SELECT MainId, Naam, Menu FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		$menu = $row["Menu"];
	}
}else{
	$menuurl ='./system/groepenmenuajax.php';
	$menuname = 'Unkown Sectie ';
}

// laat middel zien

  echo '		<table width="97%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%" valign="top" class="leftbar">';
	// ouput user selectie
	include ('submenulayout.php');
	
	echo '</td>
				<td>';
	echo '<h1>'.$Naam.' </h1>';
	echo '<div id="buttonlayout">
           <h4> <a href="'.$newrealurl.'">User view</a></h4>
          </div><br>';
	echo $outputbefore;
	include ("./system/message.php");
	echo $output;
	echo '</td></tr></table>';
	
	

include "footer.php";
echo '<script language="javascript">resizeframe()</script>';?>

</div>

<?php
echo '<div name="directory" id="directory" onclick="closeeditimg();return false"><div name="directorystyle" id="directorystyle" onclick="closeeditimg();return false"></div></div> ';

$languase = 1;
include "menu.php";
eval ($_SESSION['afterphp']);
echo $after;
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
mysqli_close ($link);
?>