<?php$type = $_GET["type"]; if (isset($_GET["sectie"])){	$sectie = intval($_GET["sectie"]);}//$selectId = intval($_GET["Id"]);$MainId = intval($_GET["Id"]);
$selectId = intval($_GET["Id"]);$output .='<script language="javascript">function ConfirmDelete(theId) { answer = confirm("Weet u zeker dat u dit urenregistratie wilt verwijderen")if (answer !=0) { location = "indexnew.php?plugin=uren&type=delete&sectie='.$sectie.'&Id=" + theId } }function submitform(){	//document.forms["form1"]["changed"].value = "false";	document.form1.submit();}</script>';$output .= '<script language="javascript">function layerActieb(divID) {   if (divID =="uren") {      	  document.getElementById("urendiv").style.display="block";	  document.getElementById("Uitgavendiv").style.display="none";		  document.getElementById("Inkomstendiv").style.display="none";  	  	  document.getElementById("uren").checked = true;	  document.getElementById("uitgaven").checked = false;	  document.getElementById("inkomsten").checked = false;	     } else if (divID == "uitgaven"){   	  document.getElementById("urendiv").style.display="none";	  document.getElementById("Uitgavendiv").style.display="block";		  document.getElementById("Inkomstendiv").style.display="none";	  document.getElementById("uren").checked = false;	  document.getElementById("uitgaven").checked = true;	  document.getElementById("inkomsten").checked = false; 		   }else{	  document.getElementById("urendiv").style.display="none";	  document.getElementById("Uitgavendiv").style.display="none";		  document.getElementById("Inkomstendiv").style.display="block";	  document.getElementById("uren").checked = false;	  document.getElementById("uitgaven").checked = false;		  document.getElementById("inkomsten").checked = true;	}}</script>';
if ($type=="save"){
	$Id = $_POST["Id"]; 
	$Omschrijving = $_POST["Omschrijving"];
	$StartDatum = $_POST["StartDatum"];
	$EindDatum = $_POST["EindDatum"];
	$StartTijd = $_POST["StartTijd"];
	$EindTijd = $_POST["EindTijd"];
	$StartDatum2 = $_POST["StartDatum2"];
	$StartTijd2 = $_POST["StartTijd2"];
	$StartDatum3 = $_POST["StartDatum3"];
	$StartTijd3 = $_POST["StartTijd3"];
	$ProjectId = $_POST["ProjectId"];
	$Uurtarief = $_POST["Uurtarief"];
	$StartDatumTijd = $StartDatum ." ". $StartTijd;
	$EindDatumTijd = $EindDatum ." ". $EindTijd;
	$Bedrag = $_POST["Bedrag"];
	$Bedrag2 = $_POST["Bedrag2"];
	$Type = $_POST["Type"];
	$User = $_SESSION["Id"];
	$Id= str_replace("'", " ", $Id);
	$Id= str_replace('"', " ", $Id);
	$Id = str_replace("\\", "\\\\", $Id);
	$Omschrijving= str_replace("'", " ", $Omschrijving);
	$Omschrijving= str_replace('"', " ", $Omschrijving);
	$Omschrijving = str_replace("\\", "\\\\", $Omschrijving);
	$StartDatum = str_replace("'", " ", $StartDatum);
	$StartDatum = str_replace('"', " ", $StartDatum);
	$StartDatum = str_replace("\\", "\\\\", $StartDatum);
	$EindDatum= str_replace("'", " ", $EindDatum);
	$EindDatum= str_replace('"', " ", $EindDatum);
	$EindDatum = str_replace("\\", "\\\\", $EindDatum);
	$StartTijd= str_replace("'", " ", $StartTijd);
	$StartTijd= str_replace('"', " ", $StartTijd);
	$StartTijd = str_replace("\\", "\\\\", $StartTijd);
	$StartDatum2 = str_replace("'", " ", $StartDatum2);
	$StartDatum2 = str_replace('"', " ", $StartDatum2);
	$StartDatum2 = str_replace("\\", "\\\\", $StartDatum2);
	$StartTijd2= str_replace("'", " ", $StartTijd2);
	$StartTijd2= str_replace('"', " ", $StartTijd2);
	$StartTijd2= str_replace("\\", "\\\\", $StartTijd2);
	$StartDatum3 = str_replace("'", " ", $StartDatum3);
	$StartDatum3 = str_replace('"', " ", $StartDatum3);
	$StartDatum3 = str_replace("\\", "\\\\", $StartDatum3);
	$StartTijd3= str_replace("'", " ", $StartTijd3);
	$StartTijd3= str_replace('"', " ", $StartTijd3);
	$StartTijd3= str_replace("\\", "\\\\", $StartTijd3);
	$EindTijd = str_replace("'", " ", $EindTijd);
	$EindTijd = str_replace('"', " ", $EindTijd);
	$EindTijd = str_replace("\\", "\\\\", $EindTijd);
	$ProjectId= str_replace("'", " ", $ProjectId);
	$ProjectId= str_replace('"', " ", $ProjectId);
	$ProjectId = str_replace("\\", "\\\\", $ProjectId);
	$Uurtarief= str_replace("'", " ", $Uurtarief);
	$Uurtarief= str_replace('"', " ", $Uurtarief);
	$Uurtarief = str_replace("\\", "\\\\", $Uurtarief);
	$StartDatumTijd= str_replace("'", " ", $StartDatumTijd);
	$StartDatumTijd= str_replace('"', " ", $StartDatumTijd);
	$StartDatumTijd = str_replace("\\", "\\\\", $StartDatumTijd);
	$EindDatumTijd = str_replace("'", " ", $EindDatumTijd);
	$EindDatumTijd = str_replace('"', " ", $EindDatumTijd);
	$EindDatumTijd = str_replace("\\", "\\\\", $EindDatumTijd);
	$Bedrag= str_replace("'", " ", $Bedrag);
	$Bedrag= str_replace('"', " ", $Bedrag);
	$Bedrag = str_replace("\\", "\\\\", $Bedrag);
	$Bedrag2= str_replace("'", " ", $Bedrag2);
	$Bedrag2= str_replace('"', " ", $Bedrag2);
	$Bedrag2 = str_replace("\\", "\\\\", $Bedrag2);
	$Type= str_replace("'", " ", $Type);
	$Type= str_replace('"', " ", $Type);
	$Type = str_replace("\\", "\\\\", $Type);
	$User= str_replace("'", " ", $User);
	$User= str_replace('"', " ", $User);
	$User = str_replace("\\", "\\\\", $User);
	
	if ($Type == "inkomsten"){
		$StartDatumTijd = $StartDatum3 ." ". $StartTijd3;
		$Bedrag = $Bedrag2;
	}else if ($Type == "uitgaven"){
		$StartDatumTijd = $StartDatum2 ." ". $StartTijd2;
	}
	
		$acces == false;	$acces = $documentinfo["accesdoc"];	if ($acces == true){
	$message="Uren saved";
		if ($Id == "new"){
			mysqli_query($link,"INSERT INTO uren (Omschrijving, StartDatumTijd, EindDatumTijd, Bedrag, Type, User, Uurtarief) VALUES ('$Omschrijving', '$StartDatumTijd','$EindDatumTijd','$Bedrag','$Type','$User','$Uurtarief')")or die(mysqli_error($link));			$Id = mysqli_insert_id($link);
			mysqli_query($link,"INSERT INTO linkurenprojecten (IdUren, IdProjecten ) VALUES ('".$Id."', '$ProjectId')")or die(mysqli_error($link));
			
		}else{		if ($User == $_SESSION["Id"] or $_SESSION["TypeUser"] == 'Admin'){
			mysqli_query($link,"UPDATE uren SET Omschrijving = '$Omschrijving', StartDatumTijd = '$StartDatumTijd', EindDatumTijd = '$EindDatumTijd', Bedrag = '$Bedrag', Type = '$Type', Uurtarief = '$Uurtarief' WHERE Id = '$Id'") or die(mysqli_error($link)); 			mysqli_query($link,"UPDATE linkurenprojecten SET IdProjecten = '$ProjectId' WHERE IdUren = '$Id'")or die(mysqli_error($link));						}else{$message='wrong user';}
		}
	}else{$message='Je bent niet bevoegt om toe te voegen aan dit project';}
	

	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td>';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexnew.php?plugin=uren&type=select&sectie='.$sectie.'&Id='.$Id.'\',\'_self\',\'\',\'true\')", 0);</script>';	

	$output .= '</td>
			</tr>
		</table>';				}else if ($type == "delete"){	$message = "deleted";	$UrenId = $MainId;		$result = mysqli_query($link,"SELECT Id, IdProjecten FROM linkurenprojecten WHERE IdUren=".$UrenId);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){		$MainId = $row["IdProjecten"];	}		$result = mysqli_query($link,"SELECT Id, User FROM uren WHERE Id=".$UrenId);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){		$User = $row["User"];	}	$acces == false;	$acces = accesdocument($MainId, $Ids = array(), $_SESSION["Id"]);	if ($acces == true){		if ($User == $_SESSION["Id"] or $_SESSION["TypeUser"] == 'Admin'){			mysqli_query($link,"DELETE FROM uren WHERE Id = '$UrenId'") or die(mysqli_error($link)); 			mysqli_query($link,"DELETE FROM linkurenprojecten WHERE IdUren = '$UrenId'")or die(mysqli_error($link));		}else{$message='wrong user';}	}else{$message='acces deniend';}		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexnew.php?plugin=uren&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';		}else if ($type == "select"){	$UrenId = $MainId;		$result = mysqli_query($link,"SELECT Id, IdProjecten FROM linkurenprojecten WHERE IdUren=".$UrenId);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){		$MainId = $row["IdProjecten"];	}	$acces == false;	$acces = accesdocument($MainId, $Ids = array(), $_SESSION["Id"]);	if ($acces == true){		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">			<tr>								<td> <a href="#" onclick=" ConfirmDelete('.$UrenId.'); return false;"><div id="buttonlayout"><h4>Delete time</h4></div></a><br> <a href = "indexadminnew.php?plugin=project&type=select&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>Project</h4></div></a> <a href = "indexnew.php?plugin=uren&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>New times</h4></div></a> <a href="indexnew.php?plugin=project&type=select&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>overview</h4></div></a> ';$output .= '</td></tr><tr><td>';$result = mysqli_query($link,"SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Uurtarief, Type, User FROM uren WHERE Id=".$UrenId);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){		//$MainId = $UrenId;		if (($StartDatumTijd = strtotime($row['StartDatumTijd'])) === -1) {			$output .= "De string ($str) is niet geldig";		} 		if (($EindDatumTijd = strtotime($row['EindDatumTijd'])) === -1) {			$output .= "De string ($str) is niet geldig";		} 	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">';	$output .= '				<td>';$output .= '<form id = "form1" name="form1" action="indexnew.php?plugin=uren&type=select&Id='.$MainId.'&sectie='.$sectie.'&type=save" method="POST" name="Users">		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$UrenId.'" border="0">		Omschrijving werkzaamheden <input type="text" name="Omschrijving" value="'.$row["Omschrijving"].'" size="50" border="0"><br><input type="radio" name="Type" id="uren" value="uren" '; if( $row["Type"]=="uren"){$output .= ' checked ';}$output .= ' onClick="layerActieb(\'uren\');return true" /> Uren <input type="radio" name="Type" id="uitgaven" value="uitgaven"'; if( $row["Type"]=="uitgaven"){$output .= ' checked ';}$output .= ' onClick="layerActieb(\'uitgaven\');return true"/> Uitgaven <input type="radio" name="Type" id="inkomsten" value="inkomsten"'; if( $row["Type"]=="inkomsten"){$output .= ' checked ';}$output .= ' onClick="layerActieb(\'inkomsten\');return true"/>Inkomsten<br>		<div id="urendiv">		Uurtarief <input type="text" name="Uurtarief" size="24" value="'.$row["Uurtarief"].'" border="0"><br>		StartDatum <input type="text" name="StartDatum" size="24" value="'.date('Y-m-d',$StartDatumTijd).'" border="0"> StartTijd <input type="text" name="StartTijd" value="'.date('H:i:s',$StartDatumTijd).'" size="24" border="0"><br>		EindDatum <input type="text" name="EindDatum" size="24" value="'.date('Y-m-d',$EindDatumTijd).'" border="0"> EindTijd <input type="text" name="EindTijd" value="'.date('H:i:s',$EindDatumTijd).'" size="24" border="0"><br>		</div>		<div id="Uitgavendiv" style= "display:none;">		Datum <input type="text" name="StartDatum2" size="24" value="'.date('Y-m-d',$StartDatumTijd).'" border="0"> Tijd <input type="text" name="StartTijd2" value="'.date('H:i:s',$StartDatumTijd).'" size="24" border="0"><br>		Uitgaven <input type="text" name="Bedrag" size="24" value="'.$row["Bedrag"].'" border="0">				</div>		<div id="Inkomstendiv" style= "display:none;">		Datum <input type="text" name="StartDatum3" size="24" value="'.date('Y-m-d',$StartDatumTijd).'" border="0"> Tijd <input type="text" name="StartTijd3" value="'.date('H:i:s',$StartDatumTijd).'" size="24" border="0"><br>		Inkomsten <input type="text" name="Bedrag2" size="24" value="'.$row["Bedrag"].'" border="0">		</DIV>		Project <select name="ProjectId" size="1">';		$query = 'SELECT Id, MainId, Naam, TheOrder FROM groepen WHERE Type = "project" AND Language='. $_SESSION['Language'] .' ORDER BY TheOrder';	$result = mysqli_query($link,$query);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row2 = mysqli_fetch_array($result)){		$acces == false;		$acces = accesdocument($row2['MainId'], $Ids = array(), $_SESSION["Id"]);		if ($acces == true){							if (intval($row2["MainId"]) == intval($MainId)){				$output .= '<option selected value="'.$row2['MainId'].'"> '.$row2['Naam'].' </option>';			}else{				$output .= '<option value="'.$row2['MainId'].'"> '.$row2['Naam'].' </option>';			}		}	}			$output .= '</select><br>';/*Gebruiker <select name="User" size="1">';			$query = 'SELECT Id, UserName FROM login WHERE ((creator = "'.$_SESSION['UserId'].'" OR Id = "'.$_SESSION['UserId'].'") AND ((TypeUser = "user" AND Saldo > 0) OR TypeUser = "administrator"))';		$result = mysqli_query($link,$query);		if (!$result) {    			die('Query failed: ' . mysqli_error($link));		}		while($row = mysqli_fetch_array($result)){			$id = $row['Id'];			$output .= '<option value="'.$id.'"> '.$row['UserName'].' </option>';		}		$output .= '</select><br>';*/$output .='		<div id="buttonlayout">           <h4> <a href="javascript: submitform()">Save</a></h4>          </div>		</form><script language="javascript">layerActieb("'.$row["Type"].'");</script>';	$output .= '</td>			</tr>		</table>';	$output .= '</td> </tr>				</table>';}
}else{$output .= 'acces denied';		if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){				}else{		$output .= '		<p>Voer hier uw username en password in:</p>		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">			<table>			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>			<input type="submit" name="submitButtonName" border="0" value="Login">		</form>';		}}}else {
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>	<td> <a href = "indexadminnew.php?plugin=project&type=select&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>Project</h4></div></a> <a href = "indexnew.php?plugin=uren&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>New time</h4></div></a> <a href="indexnew.php?plugin=project&type=select&Id='.$MainId.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>overview</h4></div></a> ';$output .= '</td></tr><tr><td>';


	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$output .= '
				<tr><td>';
$output .= '<form id = "form1" name="form1" action="indexnew.php?plugin=uren&type=select&Id='.$MainId.'&sectie='.$sectie.'&type=save" method="POST" name="Users">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		Omschrijving werkzaamheden <input type="text" name="Omschrijving" value="" size="50" border="0"><br>
<input type="radio" name="Type" checked id="uren" value="uren" onClick="layerActieb(\'uren\');return true" /> Uren 
<input type="radio" name="Type" id="uitgaven" value="uitgaven" onClick="layerActieb(\'uitgaven\');return true"/> Uitgaven 
<input type="radio" name="Type" id="inkomsten" value="inkomsten" onClick="layerActieb(\'inkomsten\');return true"/>Inkomsten<br>

		<div id="urendiv">
		Uurtarief <input type="text" name="Uurtarief" size="24" value="0" border="0"><br>
		StartDatum <input type="text" name="StartDatum" size="24" value="'.date('Y-m-d').'" border="0"> StartTijd <input type="text" name="StartTijd" value="'.date("H:i:s").'" size="24" border="0"><br>
		EindDatum <input type="text" name="EindDatum" size="24" value="'.date('Y-m-d').'" border="0"> EindTijd <input type="text" name="EindTijd" value="'.date("H:i:s").'" size="24" border="0"><br>
		</div>

		<div id="Uitgavendiv" style= "display:none;">
		Datum <input type="text" name="StartDatum2" size="24" value="'.date('Y-m-d').'" border="0"> Tijd <input type="text" name="StartTijd2" value="'.date("H:i:s").'" size="24" border="0"><br>
		Uitgaven <input type="text" name="Bedrag" size="24" value="0" border="0">
		
		</div>

		<div id="Inkomstendiv" style= "display:none;">
		Datum <input type="text" name="StartDatum3" size="24" value="'.date('Y-m-d').'" border="0"> Tijd <input type="text" name="StartTijd3" value="'.date("H:i:s").'" size="24" border="0"><br>
		Inkomsten <input type="text" name="Bedrag2" size="24" value="0" border="0">
		</DIV>
		
Project <select name="ProjectId" size="1">';
	
		$query = 'SELECT Id, MainId, Naam, TheOrder FROM groepen WHERE Type = "project" AND Language='. $_SESSION['Language'] .' ORDER BY TheOrder';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){		$acces == false;		$acces = accesdocument($row['MainId'], $Ids = array(), $_SESSION["Id"]);		if ($acces == true){
			$id = $row['Id'];			if ($row["MainId"] == $MainId){				$output .= '<option selected value="'.$row['MainId'].'"> '.$row['Naam'].' </option>';			}else{
				$output .= '<option value="'.$row['MainId'].'"> '.$row['Naam'].' </option>';			}		}
	}
		$output .= '</select><br>';/*
Gebruiker <select name="User" size="1">';

			$query = 'SELECT Id, UserName FROM login WHERE ((creator = "'.$_SESSION['UserId'].'" OR Id = "'.$_SESSION['UserId'].'") AND ((TypeUser = "user" AND Saldo > 0) OR TypeUser = "administrator"))';
		$result = mysqli_query($link,$query);
		if (!$result) {
    			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$id = $row['Id'];
			$output .= '<option value="'.$id.'"> '.$row['UserName'].' </option>';
		}
		$output .= '</select><br>';*/
$output .='		<div id="buttonlayout">           <h4> <a href="javascript: submitform()">Save</a></h4>          </div>
		</form>';
	$output .= '</td></tr></table>';	$output .= '</td></tr></table>';

}

?>
