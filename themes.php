<?php
// Init session settings
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("./system/include.php");
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

// header
  header("Cache-control: private"); 
echo '
<!DOCTYPE HTML PUBLIC 
   "http://www.w3.org/TR/html4/strict.dtd"><accept-charset="UTF-8"><meta charset="utf-8">


<head>
<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">
var myNicEditor1,myNicEditor2,myNicEditor3,myNicEditor4;

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'main.php?type=new_Language\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'main.php?type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'main.php?language_id=\'+veld,\'_self\',\'\',\'true\');
	} 
	
 }
function addArea2() {
	
}
function removeArea2() {
}


function window_onload(){
}


function changeval(){
	document.forms["form1"]["changed"].value = "true";
}

function submitform2(){
document.form1.submit();
}

function submitform(){

	document.forms["form1"]["changed"].value = "false";	

	document.form1.submit();
}
function previewform(){

	document.forms["form1"]["changed"].value = "false";	
	document.form1.action = "themes.php?type=preview";
	document.form1.submit();
}
function dofilemanager(link){
	document.getElementById(window.elementvar).value = link;	
	hidefilemanager();
}

function showfilemanager(elementvar){
	window.elementvar = elementvar;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'filemanager\').style.display = \'block\';
}
function hidefilemanager(){	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'filemanager\').style.display = \'none\';
}
function resizeFrame(){		
    var realHeight = document.getElementById("filelinker").contentWindow.document.body.scrollHeight;
    document.getElementById("filelinker").style.height = realHeight + \'px\';
    var realWidth = document.getElementById("filelinker").contentWindow.document.body.scrollWidth;
    document.getElementById("filelinker").style.width = realWidth + \'px\';
	
    setTimeout(\'resizeFrame()\', 999);
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { submitform()}
}}
</script>';

$myUrl = explode("?", curPageURL());
// DB

// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
// header settings
$banner = "";
include "header.php";

?>
<div id="Middel">
<?php
$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien




if ($type=="save"){
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
	$Theme = $_POST["Theme"];
		
	$Theme = str_replace("\\", "\\\\", $Theme );
	$Theme = str_replace('"', " ", $Theme );
	$Theme = str_replace("'", " ", $Theme );
	
	
	
	$message = "";
	$error = false;
	
	mysqli_query($link,"UPDATE system SET Theme = '$Theme'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="Theme saved";
		$_SESSION['Theme'] = $Theme;
	}else{
		$error = true;
	}

	echo $message;

	echo '<script type="text/javascript">setTimeout("window.open(\'themes.php?\',\'_self\',\'\',\'true\')", 2222);</script>';
	}else{
// user is niet ingelogt
	echo '<script type="text/javascript">setTimeout("window.open(\'Login.php?redirect=?'.curPageURL().'\',\'_self\',\'\',\'true\')", 2222);</script>';	
	//header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	//exit;
}
}else if($type=="preview"){
	$Theme = $_POST["Theme"];
		
	$Theme = str_replace("\\", "\\\\", $Theme );
	$Theme = str_replace('"', " ", $Theme );
	$Theme = str_replace("'", " ", $Theme );

	$message="Theme set as preview";
	$_SESSION['Theme'] = $Theme;
	
	echo $message;

	echo '<script type="text/javascript">setTimeout("window.open(\'themes.php?\',\'_self\',\'\',\'true\')", 2222);</script>';
	
}else{
	
	
	$query = "SELECT Theme FROM system";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo $_SESSION['Theme'];
	while($row = mysqli_fetch_array($result)){
		
		echo '
		
		
		<form action="themes.php?type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">';
		
		echo '<tr><td>Select your theme</td><td><select name="Theme" id="Theme">';
			
	$dir ="./Themes/";
    $root = scandir($dir); 
 	$i=0;
    foreach($root as $value) 
    { 
	$i++;
	if (is_file("$dir/$value") == true){
		
	}else {
		if ($i > 2){
			echo '<option '; if($row['Theme'] == $dir.$value.'/'){echo ' SELECTED ';}echo 'value="'.$dir.$value.'/">'.$value.'</option> ';
		}
	}
    } 
    
echo '</select>
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td><td width="120" height="34"><div align="center">
		<a href="javascript: previewform()"><h4>preview</h4></a>
</div></td>
        </tr>
      </table></td><td></td></tr></table>';
		
	}
}
include "footer.php";
echo '</div>';

// menu
$languase = 1;
include "menu.php";



?>
