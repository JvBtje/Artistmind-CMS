<?php
// Init session settings
// header
 $output .= '
<script language="javascript">


 

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
</script>';

$myUrl = explode("?", curPageURL());

$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien

	$RedirectLogin = $_POST["RedirectLogin"];
	$RedirectIndex = $_POST["RedirectIndex"];
	$Redirect404 = $_POST["Redirect404"];
	$Redirect400 = $_POST["Redirect400"];
	$Redirect401 = $_POST["Redirect401"];
	$Redirect403 = $_POST["Redirect403"];
	$RedirectLogin = str_replace("\\", "\\\\", $RedirectLogin);
	$RedirectLogin = str_replace('"', "\\\"", $RedirectLogin);
	$RedirectLogin = str_replace("'", "\\'", $RedirectLogin);
	$RedirectIndex = str_replace("\\", "\\\\", $RedirectIndex);
	$message = "";
	$error = false;
	
	mysqli_query($link,"UPDATE system SET RedirectLogin = '$RedirectLogin',RedirectIndex = '$RedirectIndex',Redirect404= '$Redirect404',Redirect400 = '$Redirect400',Redirect401= '$Redirect401',Redirect403 = '$Redirect403', Redirect500 = '$Redirect500'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="redirections saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
}else {
	
	
	$query = "SELECT RedirectLogin, RedirectIndex, Redirect404, Redirect400, Redirect401, Redirect403, Redirect500 FROM system";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$output .=  '<form action="indexstandalone.php?plugin=redirections&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">		
		<tr><td>Redirect Login</td><td><input type="text" id="RedirectLogin" name="RedirectLogin" value="'.$row['RedirectLogin'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'RedirectLogin\');" /></td></tr>
		<tr><td>Redirect Index</td><td><input type="text" id="RedirectIndex" name="RedirectIndex" value="'.$row['RedirectIndex'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'RedirectIndex\');" /></td></tr>
		<tr><td>Redirect error 404</td><td><input type="text" id="Redirect404" name="Redirect404" value="'.$row['Redirect404'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'Redirect404\');" /></td></tr>
		<tr><td>Redirect error 400</td><td><input type="text" id="Redirect400" name="Redirect400" value="'.$row['Redirect400'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'Redirect400\');" /></td></tr>
		<tr><td>Redirect error 401</td><td><input type="text" id="Redirect401" name="Redirect401" value="'.$row['Redirect401'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'Redirect401\');" /></td></tr>
		<tr><td>Redirect error 403</td><td><input type="text" id="Redirect403" name="Redirect403" value="'.$row['Redirect403'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'Redirect403\');" /></td></tr>
		
		$output .=  '
		<tr><td><div id="buttonlayout">
			

		
	}
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>