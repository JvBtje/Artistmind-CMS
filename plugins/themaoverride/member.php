<?php

echo '

<script language="javascript">
function layerActie(divID,ImgId) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
	  document.getElementById(ImgId).src = "./iconen/mapje.png";
   } else {
   
      document.getElementById(divID).style.display="none";
	  document.getElementById(ImgId).src = "./iconen/mapje-dicht.png";
	  
   }
}

function changeval(){	
	
}
function submitform(){
	
	myNicEditor1.removeInstance(\'Bericht\');	
	document.form1.submit();
}
</script>';

	
$banner = "";

$found = false;
if ($type == "select"){

		$result = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$acces = $documentinfo["accesdoc"];
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
		$MessageSetting = findMessagesettings($row['MainId'], array());
		if (($theDate = strtotime($row['theDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		
	}
	
if ($found == true){

$result = mysqli_query($link,"SELECT Id, IdGroup, Themeurl FROM themeoverride WHERE IdGroup=".$IdGroup);
	
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Themeurl = $row["Themeurl"];
	}
	
}}
if (isset($sectie)){
$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		if ($row["Menu"] == Horizontal){
			$menu = 'Horizontal' ;
		}else if($row["Menu"] == Vertical){
			$menu = 'Vertical' ;
		}else{
			$menu = 'Hidden' ;
		}
		$Showtimestamp = $row["Showtimestamp"];
	}}else{
	$menu = 'Vertical' ;
	$Showtimestamp = 1;
	}

//$MainId = $MainIdGroup;
if ($found == true and $acces == true){
	$_SESSION['Themeoverride'] = $Themeurl;
	} elseif ($found == true and $acces == false){

		$Naam = 'acces denied';
		$output = "";
		if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
		
		}else{
		$output .= '
		<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
		}	
}else{
	$Naam = '';
	$output = "";
	if ($type == "select") {
		$Naam = 'Page not found';
		$output .= 'The page you try to acces is not found, try another Language. Pleas select the Language from the language menu ';
	}
}  



?>
