<?php
// Init session settings
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
$output .=  '
<script language="javascript">

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

function submitformadd(){
document.formadd.submit();
}

function submitformdelete(){
	document.formdelete.submit();
}

function submitformchange(){
	document.formdefault.submit();
}


function submitform(){

	document.forms["form1"]["changed"].value = "false";	
	
	document.form1.submit();
}


function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { submitform()}
}}
</script>';




$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien


if ($type=="delete"){
		
	mysqli_query($link,"DELETE FROM language WHERE Id=".intval($_POST["curlanguage"]))or ($message = mysqli_error($link));
		
		if ($message == ""){	
		$message ="Language deleted";		
		}
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
		$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Language\',\'_self\',\'\',\'true\')", 0);</script>';
}else if ($type=="add"){
	$query = "SELECT Id, Language, iso6392code FROM language WHERE Id=".intval($_POST["alllanguage"]);
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$found = false;
	while($row = mysqli_fetch_array($result)){
		$found = true;		
	}

	if ($found == true){
		$message = 'Language already in list';
	}else{
		$query = "SELECT Id, Language, iso6392code FROM alllanguage WHERE Id=".intval($_POST["alllanguage"]);
		$result = mysqli_query($link,$query);
		if (!$result) {
		    	die('Query failed: ' . mysqli_error($link));
		}
		
		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Language = $row["Language"];
			$iso6392code = $row["iso6392code"];
			mysqli_query($link,"INSERT INTO language ( Id, Language, iso6392code) VALUES ( '$Id', '$Language', '$iso6392code')")or  ($message = mysqli_error($link));
		
		}
		$message = 'Langauge '.$Language.' added';

	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Language\',\'_self\',\'\',\'true\')", 0);</script>';
	

}else if ($type=="setdefault"){
	
	mysqli_query($link,"UPDATE system SET DefaultLanguage = '".intval($_POST["defaultlanguage"])."'") or ($message = mysqli_error($link)); 
	$message =  'Default Language updated';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Language\',\'_self\',\'\',\'true\')", 0);</script>';
	
}else {

	$output .=  '<table><tr><form action="indexstandalone.php?plugin=Language&type=delete" method="POST" name="formdelete" autocomplete="on"><td>Current active language</td><td><select name="curlanguage" id="curlanguage">';

	$query = "SELECT Id, Language, iso6392code FROM language";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$output .=  '<option value="'.$row['Id'].'">'.$row['Id'].' '.$row['Language'].' '.$row['iso6392code'].'</option>';
		
		
	}
	$output .=  '</select></td><td><div id="buttonlayout"><h4><a href="javascript: submitformdelete()">Delete</a></h4></div></td></form>';
	$output .=  '</tr>';

	$output .=  '<tr><form action="indexstandalone.php?plugin=Language&type=setdefault" method="POST" name="formdefault" autocomplete="on"><td>Default Language</td><td><select name="defaultlanguage" id="defaultlanguage">';
	$query2 = "SELECT DefaultLanguage FROM system";
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row2 = mysqli_fetch_array($result2)){

	$query = "SELECT Id, Language, iso6392code FROM language";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$found = false;
	while($row = mysqli_fetch_array($result)){
		
		$output .=  '<option';
		if ($row2["DefaultLanguage"] == $row['Id']){$output .=  ' selected ';$found = true;}
		$output .= ' value="'.$row['Id'].'">'.$row['Id'].' '.$row['Language'].' '.$row['iso6392code'].'</option>';		
	}
	if ($found==false){$output .=  '<script language="javascript">alert ("Error no default language");</script>';}
	}
	$output .=  '</select></td><td><div id="buttonlayout"><h4><a href="javascript: submitformchange()">Sett default</a></h4></div></td></td></form>';
	$output .=  '</tr>';

	$output .=  '<tr><form action="indexstandalone.php?plugin=Language&type=add" method="POST" name="formadd" autocomplete="on"><td>Possibel Language (multi character not supported)</td><td><select name="alllanguage" id="alllanguage">';

	$query = "SELECT Id, Language, iso6392code FROM alllanguage";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$output .=  '<option value="'.$row['Id'].'">'.$row['Id'].' '.$row['Language'].' '.$row['iso6392code'].'</option>';
		
		
	}
	$output .=  '</select></td><td><div id="buttonlayout"><h4><a href="javascript: submitformadd()">Add</a></h4></div></td>';
	$output .=  '</tr></form></table>';
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
