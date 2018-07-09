<?php
// Init session settings
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
include("./system/include.php");
session_start();
 header("Cache-Control: max-age=0, no-cache, no-store");
 header("Content-type: text/html; charset=utf-8");
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){

// header
$type = $_GET["type"]; 

$MainId = intval($_GET["Id"]);
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
<script language="javascript">


function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je dit groep itiem wilt verwijderen.")

if (answer !=0) { 
	location = "sectieedit.php?type=delete&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'sectieedit.php?type=new_Language&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'sectieedit.php?type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'sectieedit.php?language_id=\'+veld+\'&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){

}

function changeval(){	
	document.forms["form1"]["changed"].value = "true";
}

function submitform(){
	document.forms["form1"]["changed"].value = "false";
	document.form1.submit();
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}
</script>';

// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
// header settings
$banner = "";
include "header.php";

?>
<div id="Middel">
<?php

// laat een lijst zien

function displayList ($MainId = -1){
$output = "";
$menuurl ='./system/LoadLostItemsmenu.php';
$menuname = 'Lost Items';
include ('submenulayout.php');
return $output;
}

		
 if ($type=="save"){
	$Id = $_POST["Id"];
	$Naam = $_POST["Naam"]; 
	$language = $_POST["language"]; 

	$message = "";
	$error = false;

	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);

	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){
		mysqli_query($link,"INSERT INTO groepen ( TheOrder, MainId, Naam,  Language, Parent, Type) VALUES ( '$theorder', '-1', '$Naam', '$language','-1', 'groep')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE groepen SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE groepen SET Naam = '$Naam' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		
	}
	$result = mysqli_query($link,"SELECT MainId FROM groepen WHERE Id=".$Id);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
	}

	if ($message == ""){
		$message="groepen saved";
	}else{
		$error = true;
	}

	echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td> </td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	 displayList ();
echo '</td>
				<td>';

	echo $message;
	if ($error == false){
	echo '<script type="text/javascript">setTimeout("window.open(\'sectieedit.php?type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 2222);</script>';
	}
	

	echo '</td>
			</tr>
		</table>';
}else if($type=="delete"){
$message = "itiem deleted";
mysqli_query($link,"DELETE FROM groepen WHERE MainId=$MainId")or ($message = mysqli_error($link));

echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><table><tr><td>';
		
		echo'</td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="sectieedit.php?type=new"><h4>new</h4></a>
          </div></td>
        </tr>
      </table></td></tr></table></td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	 displayList ();
	
	echo '</td>
				<td>';
				echo $message;
	echo'</td></tr></table>';

}else if($type=="select") {
$result = mysqli_query($link,"SELECT Id, Language FROM groepen WHERE MainId=".$MainId);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false; 
	while($row = mysqli_fetch_array($result)){
	if ($row['Language'] ==$_SESSION['Language']){$Id = $row['Id'];}
		$Present_Language[count($Present_Language)] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id = ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." OR Id = ".$row['Language'];
		}
	}
	
	echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td><td><table><tr><td>
				<select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				
	
	
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	echo '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){echo ' selected '; $foundLanguage = true;}
	echo '>'.$row2['Language'].'</option>';
	}
	
	if ( $foundLanguage == true){echo '<option value="new">new</option>';}else if ($_SESSION['Language']==""){$_SESSION['Language'] = -1;}
	if (count($Present_Language) > 1 and $foundLanguage == true){echo '<option value="delete">Delete current</option>';}
	echo '</select></td><td>
	<table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="sectieedit.php?type=new"><h4>new</h4></a>
          </div></td>
        </tr>
      </table></td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onclick=" ConfirmDelete('.$MainId.'); return false;"><h4>Delete</h4></a>
          </div></td>
        </tr>
      </table></td></tr></table>
				</td>
				
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	displayList ($MainId);
echo '</td>
				<td>';
	

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$Url = $row['Url'];
		
		echo '<form action="sectieedit.php?type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="75" border="0" onChange="changeval();"></td></tr>			
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
	}
	echo '</td>
			</tr>
		</table>';
}else if ($type=="new"){
echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr><td>';
		
		echo'</td>
          <td width="120" height="34"><div align="center">
            <a href="sectieedit.php?type=new"><h4>new</h4></a>
          </div></td>
        </tr>
      </table></td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	displayList ();
	
	echo '</td>
				<td>';
				echo '<form action="sectieedit.php?type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="75" border="0" onchange="changeval();"></td></tr>	
		<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			echo '<option value="'.$row2['Id'].'"';
			if ($_SESSION['Language'] == $row2['Id']){echo ' selected ';}
			echo '>'.$row2['Language'].'</option>';
			}
		echo '</select>';
	echo '</td></tr>
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
				echo'</td></tr></table>';

}else{
echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><table><tr><td>';
		
		echo'</td><td></td>
        </tr>
      </table></td></tr></table></td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	displayList ();
	
	echo '</td>
				<td>';
				
				echo'</td></tr></table>';
}
include "footer.php";
echo '</div>';

// groepen
$languase = 1;
include "menu.php";
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>