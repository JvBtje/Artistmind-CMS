<?php
// Init session settingsif ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
 $output .= '
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

$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien
if ($type=="save"){
	$BackupEmail = $_POST["BackupEmail"];
	$submitemail = $_POST["submitemail"];
	$submitreplyemail = $_POST["submitreplyemail"];
	$submitsenderemail = $_POST["submitsenderemail"];
	$Nieuwsbriefwachttijd = $_POST["Nieuwsbriefwachttijd"];

	if(isset($_POST["Nieuwsbrief"])){ 
		$Nieuwsbrief = 1;					 
	}else {
		$Nieuwsbrief = 0;
	}
	
	if(isset($_POST["Backup"])){ 
		$Backup = 1;					 
	}else {
		$Backup = 0;
	}	
	$BackupEmail = str_replace("\\", "\\\\", $BackupEmail);
	$BackupEmail = str_replace('"', " ", $BackupEmail);
	$BackupEmail = str_replace("'", " ", $BackupEmail);
	$submitemail = str_replace("\\", "\\\\", $submitemail);
	$submitemail = str_replace('"', " ", $submitemail);
	$submitemail = str_replace("'", " ", $submitemail );
	$submitreplyemail= str_replace("\\", "\\\\", $submitreplyemail);
	$submitreplyemail= str_replace('"', " ", $submitreplyemail);
	$submitreplyemail= str_replace("'", " ", $submitreplyemail);
	$submitsenderemail= str_replace("\\", "\\\\", $submitsenderemail);
	$submitsenderemail= str_replace('"', " ", $submitsenderemail);
	$submitsenderemail= str_replace("'", " ", $submitsenderemail);
	$Nieuwsbriefwachttijd= str_replace("\\", "\\\\", $Nieuwsbriefwachttijd);
	$Nieuwsbriefwachttijd= str_replace('"', " ", $Nieuwsbriefwachttijd);
	$Nieuwsbriefwachttijd= str_replace("'", " ", $Nieuwsbriefwachttijd);
	
	
	
	$message = "";
	$error = false;
	
	mysqli_query($link,"UPDATE system SET BackupEmail = '$BackupEmail',submitemail = '$submitemail',submitreplyemail= '$submitreplyemail',submitsenderemail = '$submitsenderemail',Nieuwsbrief= '$Nieuwsbrief',Backup = '$Backup', Nieuwsbriefwachttijd = '$Nieuwsbriefwachttijd'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="Email options saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));	echo '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=emailoptions&\',\'_self\',\'\',\'true\')", 0);</script>';
}else {
	
	
	$query = "SELECT BackupEmail, submitemail, submitreplyemail, submitsenderemail, Nieuwsbrief, Backup, Nieuwsbriefwachttijd  FROM system";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$output .=  '
		
		
		<form action="indexstandalone.php?plugin=emailoptions&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		
		
		<tr><td>Backup email</td><td><input type="text" name="BackupEmail" value="'.$row['BackupEmail'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Submit email</td><td><input type="text" id="submitemail" name="submitemail" value="'.$row['submitemail'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Submit reply email</td><td><input type="text" name="submitreplyemail" value="'.$row['submitreplyemail'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Submit sender email</td><td><input type="text" id="submitsenderemail" name="submitsenderemail" value="'.$row['submitsenderemail'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Nieuwsbrief </td><td><input type="checkbox" name="Nieuwsbrief" id="Nieuwsbrief"'; if($row['Nieuwsbrief'] == 1){$output .=  ' checked ';}$output .=  '/></td></tr>
		<tr><td>Backup</td><td><input type="checkbox" name="Backup" id="Backup"'; if($row['Backup'] == 1){$output .=  ' checked ';}$output .=  '/></td></tr>';
		
		$output .=  '
		<tr><td><div id="buttonlayout">            <h4><a href="javascript: submitform()">Save</a></h4>          </div></td><td></td></tr></table>';
			

		
	}
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
