<?php$type = $_GET["type"]; if (isset($_GET["sectie"])){	$sectie = intval($_GET["sectie"]);}$MainId = intval($_GET["Id"]);$selectId = intval($_GET["Id"]);


$type = $_GET["type"]; 
$selectId = intval($_GET["Id"]);
$StartDatum = $_GET["StartDatum"];
$EindDatum = $_GET["EindDatum"];
$Date = $_GET["Date"];
$StartDatum= str_replace("'", " ", $StartDatum);
$StartDatum= str_replace('"', " ", $StartDatum);
$StartDatum = str_replace("\\", "\\\\", $StartDatum);
$EindDatum= str_replace("'", " ", $EindDatum);
$EindDatum= str_replace('"', " ", $EindDatum);
$EindDatum = str_replace("\\", "\\\\", $EindDatum);
$Date= str_replace("'", " ", $Date);
$Date= str_replace('"', " ", $Date);
$Date = str_replace("\\", "\\\\", $Date);


if ($type=="select"){
	$viewproject = false;
	$output2 = "";	
	$acces == false;	$acces = $documentinfo["accesdoc"];	if ($acces == true){
		$id = $row['IdProject'];
		$result = mysqli_query($link,"SELECT Publish, Naam, Message,theDate, LastSaved, PublishDate, Parent, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){		$found = true;		$Naam = $row['Naam'];		$Parent = $row['Parent'];		$Publish = $row['Publish'];		$IdGroup = $row['Id'];		$MainIdGroup = $MainId;		$themessage = $row['Message'];		$MainId = $row['targetmainid'];		if (($theDate = strtotime($row['theDate'])) === -1) {		$output .= "De string ($str) is niet geldig";		} 		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {		$output .= "De string ($str) is niet geldig";		} 		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {		$output .= "De string ($str) is niet geldig";		} 	}

			
			$output2 = $output2. '<a href="MyGraph.php?type=select&Id='.$MainIdGroup.'">';
			$output2 = $output2. " ". $Naam;
			$output2 = $output2. "</a><br />";
		
	

	$output2 = $output2. '</td><td>';
	if ($Date == "aan"){
		$outputbefore .= '<center><img src="./plugins/project/projectengraph.php?project='.$MainIdGroup.'&Date=aan&StartDatum='.$StartDatum.'&EindDatum='.$EindDatum.'"></center>';
	}else{
		$outputbefore .= '<center><img src="./plugins/project/projectengraph.php?project='.$MainIdGroup.'"></center>';
	}
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td></td>
			</tr>
			<tr>
			<td><a href = "indexadminnew.php?plugin=project&type=select&Id='.$MainIdGroup.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>Project</h4></div></a> <a href = "indexnew.php?plugin=uren&Id='.$MainIdGroup.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>New times</h4></div></a> <a href="indexnew.php?plugin=project&type=select&Id='.$MainIdGroup.'&sectie='.$sectie.'"><div id="buttonlayout"><h4>overview</h4></div></a>';
/*
	$queryw = "SELECT IdProject FROM linkusersprojecten WHERE IdProject = $selectId AND IdUser = $ThisUserId";
	
	$resultw = mysqli_query($link,$queryw);
	if (!$resultw) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($roww = mysqli_fetch_array($resultw)){
	
	$IdProject = $roww['IdProject'];
	}*/		$IdProject = $MainId;	
	$result = mysqli_query($link,"SELECT Id, Omschrijving, Uurtarief FROM projecten WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);	if (!$result) {    	die('Query failed: ' . mysqli_error($link));	}	while($row = mysqli_fetch_array($result)){
		$id = $MainIdGroup;
		//$creator == $row['Creator'];
		//$datefromdb = $row['TheTime'];
		//$output .= "id = $id Created $datefromdb by $creator <br> ";		
		$title = '<b><h1>'.$Naam.'</b></h1> '.$row['Omschrijving'].'<br>';
		$output .= '<form action="indexnew.php?plugin=project&" method="GET" name="Graph">			<input type="hidden" name="Date" value="aan" border="0">			<input type="hidden" name="sectie" value="'.$sectie.'" border="0">
			<input type="hidden" name="type" value="'.$type.'" border="0">
			<input type="hidden" name="Id" value="'.$selectId.'" border="0">';
		if ($Date == "aan"){
			$output .= ' StartDatum <input type="text" name="StartDatum" size="24" value="'.$StartDatum.'" border="0"> <br>
			EindDatum <input type="text" name="EindDatum" size="24" value="'.$EindDatum.'" border="0"> <br>';
		}else{
			$output .= ' StartDatum <input type="text" name="StartDatum" size="24" value="'.date('Y-m-j').'" border="0"> <br>
			EindDatum <input type="text" name="EindDatum" size="24" value="'.date('Y-m-j').'" border="0"> <br>';
		}
		$output .= ' <input type="submit" name="submitButtonName" border="0" value="Zoek">
		</form>';
		// Members Project
		//';
	$uren ="";	
	$totaaluren = 0;
	$totaalurenkosten = 0 ;
	$totaalonkosten = 0;
	$totaalinkomsten = 0;
	$begindatum = -1;
	$eindatum = -1;
	$uitgaven = '<table width=100%><tr><td>Id</td><td>Bedrag</td><td>Start Datum & Tijd</td><td> Eind Datum & Tijd</td><td>Gewerkte Uren</td><td>Omschrijving werkzaamheden</td><td>Gebruiker</td><td>rekening</td></tr>';	
	$inkomsten =  '<table width=100%><tr><td>Id</td><td>Bedrag</td><td>Start Datum & Tijd</td><td> Eind Datum & Tijd</td><td>Gewerkte Uren</td><td>Omschrijving werkzaamheden</td><td>Gebruiker</td><td>rekening</td></tr>';	
	$query2 = "SELECT IdUren FROM linkurenprojecten WHERE IdProjecten = $id";
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
   		die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		if ($uren == ""){
			$uren = "Id = ".$row2['IdUren'];
		}else{
			$uren = $uren." OR Id = ".$row2['IdUren'];
		}
		
			//$query3 = 'SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Type, User, Uurtarief FROM uren WHERE Id = "'.$row2['IdUren'].' AND StartDatumTijd > '.$StartDatum.' AND StartDatumTijd < '.$EindDatum.'" ORDER BY StartDatumTijd';
		
			$query3 = 'SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Type, User, Uurtarief FROM uren WHERE Id = "'.$row2['IdUren'].' " ORDER BY StartDatumTijd';
		
		$result3 = mysqli_query($link,$query3);
		if (!$result3) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row3 = mysqli_fetch_array($result3)){
			
				if ((strtotime($row3['StartDatumTijd']) > strtotime($StartDatum) and strtotime($row3['StartDatumTijd']) < strtotime($EindDatum) and $Date == "aan") or $Date <> "aan"){
			if ($begindatum >  strtotime($row3['StartDatumTijd']) or $begindatum == -1){
				if (($begindatum = strtotime($row3['StartDatumTijd'])) === -1) {
				
			}}
			if ($eindatum <  strtotime($row3['EindDatumTijd'])){
				if (($eindatum = strtotime($row3['EindDatumTijd'])) === -1) {
				
			}}
			
			$found = false;
			
			//if ($found == false){
				$query5 = 'SELECT Username FROM login WHERE Id = "'.$row3['User'].'"';
				$result5 = mysqli_query($link,$query5);
				if (!$result5) {
    				die('Query failed: ' . mysqli_error($link));
				}
				
				while($row5= mysqli_fetch_array($result5)){
					$Naam = $row5['Username'];
					//$Rekening = $row5['Rekening'];
				}
				if ($row3['Type']== 'uitgaven'){
					$uitgaven = $uitgaven. '<tr><td>'.$row3['Id'] . '</td><td>'.$row3['Bedrag'].'</td><td>'.$row3['StartDatumTijd'].'</td><td></td><td></td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td><a href="indexnew.php?plugin=uren&type=select&sectie='.$sectie.'&Id='.$row3['Id'].'">edit</a></td>';
					
					$totaalonkosten =$totaalonkosten +$row3['Bedrag'];
				}else if ($row3['Type']== 'inkomsten'){
					$inkomsten = $inkomsten. '<tr><td>'.$row3['Id'] . '</td><td>'.$row3['Bedrag'].'</td><td>'.$row3['StartDatumTijd'].'</td><td></td><td></td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td><a href="indexnew.php?plugin=uren&type=select&sectie='.$sectie.'&Id='.$row3['Id'].'">edit</a></td>';
					
					$totaalinkomsten =$totaalinkomsten +$row3['Bedrag'];
				}else{
				if (($timestamp = strtotime($row3['StartDatumTijd'])) === -1) {
    				//$output .= "De string ($str) is niet geldig";
				} 
				if (($timestamp2 = strtotime($row3['EindDatumTijd'])) === -1) {
		    		//$output .= "De string ($str) is niet geldig";
				} 
				$gewerkt = $timestamp2 - $timestamp;
				$gewerkt = ($gewerkt / 60) / 60;
				$totaaluren = $totaaluren + $gewerkt;
				$totaalurenkosten = $totaalurenkosten +($gewerkt*$row3['Uurtarief']);
				$uitgaven = $uitgaven. '<tr><td>'.$row3['Id'] . '</td><td>'.$gewerkt*$row3['Uurtarief'].'</td><td>'.$row3['StartDatumTijd'].'</td><td>'.$row3['EindDatumTijd'].'</td><td>'.$gewerkt.'</td>';
			
				$uitgaven = $uitgaven. $gewerkt. '</td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td><a href="indexnew.php?plugin=uren&type=select&sectie='.$sectie.'&Id='.$row3['Id'].'">edit</a></td>';
				
				}
				}
			$inkomsten = $inkomsten. '</td></tr>';
			$uitgaven = $uitgaven. '</td></tr>';
		}
	
	}
	
	$inkomsten = $inkomsten. '</table>';
	
	$uitgaven = $uitgaven. '</table>';
	$output .= '<h1> Inkomsten '.$totaalinkomsten.'</h1>';
	$output .= $inkomsten;
	$output .= '<h1> Uitgaven '.($totaalurenkosten + $totaalonkosten).'</h1>';
	$output .= $uitgaven;
	//$output .= 'Totaal aantal uren gewerkt is '. $totaaluren. ', totaal aan onkosten is '.$totaalonkosten.' ,totaal aan inkomsten is '.$totaalinkomsten.' totaal bedrag is '. (0-($totaalurenkosten)-$totaalonkosten + $totaalinkomsten) . ' euro';
}
	
	
	$output .= '</td></tr></table>';
	$Naam = $title;
	} else {  	$output .= 'acces denied';		if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){				}else{		$output .= '		<p>Voer hier uw username en password in:</p>		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">			<table>			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>			<input type="submit" name="submitButtonName" border="0" value="Login">		</form>';		}
	}

}else {
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td></td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie/*
	$query = "SELECT IdProject FROM linkusersprojecten WHERE IdUser = '$ThisUserId'";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		
		$id = $row['IdProject'];
		$query2 = "SELECT Naam, TheOrder FROM projecten WHERE Id = '$id' ORDER BY TheOrder";
		$result2 = mysqli_query($link,$query2);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
	
		while($row2 = mysqli_fetch_array($result2)){
			
			$output .= '<a href="MyGraph.php?type=select&Id='.$id.'">';
			$output .= $row2['TheOrder']. " ". $row2['Naam'];
			$output .= "</a><br />";
		}
	}*/

	$output .= '</td>
				</table>';
}

?>
