<?php 

session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include('../../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
header("Content-Description: File Transfer"); 
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=download.csv");
header("Content-Transfer-Encoding: binary");

$listLanguage = Array();
$formelements = Array();
$formpropertys = Array();
function addformelement($MainId, $Name,$theValue,$theGroup,$Language,$theDate,$formeditid){
	if ($formeditid == -1){
		global $formelements;
		global $formpropertys;
		$tmparray = Array("MainId" => $MainId, "Name" => $Name, "theValue" => $theValue, "theGroup" => $theGroup, "Language" => $Language, "theDate" => $theDate);
				
        	if (is_array($formelements[$MainId])){
			$formelements[$MainId][$Name] = Array();
			$formelements[$MainId][$Name] = $tmparray;
			
		}else{		
			$formelements[$MainId] = Array();
			$formelements[$MainId][$Name] = Array();
			$formelements[$MainId][$Name] = $tmparray;
		}

		$found = false;
 		for($i=0; $i< count($formpropertys); $i++) {
        		if ($formpropertys[$i] == $Name){
				$found = true;	
			} 
   		}
		
		if ($found == false){
			array_push($formpropertys,$Name);
		}		
	}
} 

function updateform (){
	
	global $formelements;
	global $formpropertys;
	global $listLanguage;

	 foreach($formelements as $value){
      		$tmptxt = "";		
		$first = true;
		for($i=0; $i< count($formpropertys); $i++) {
			$property = $formpropertys[$i];
			$tmparray = $value[$property];
			if (is_array($tmparray)){
				
				if ($first == true){
					$first = false;
					echo '"'.$tmparray['MainId']  .'";"'. $tmparray['theDate'].'";"'.$listLanguage[$tmparray['Language']]['Language'].'";'.$tmptxt;
				}

			 	echo '"'.$tmparray['theValue'] ;
				echo '";';
			}else{
				if ($first == true){
					
					$tmptxt = $tmptxt .'-;';
				}else{
					echo '-;';
				}
					
			}		
		}
		echo '
';
		
	}
	

	
}

function addLanguage($Id, $Language){
	global $listLanguage;
	$tmparray = Array("Id" => $Id, "Language" => $Language);

	
	$listLanguage[$Id] = Array();
	$listLanguage[$Id] = $tmparray;
}

if($type == ""){
	$SearchString = $_GET["Searchstring"]; 
	//if (isset($_GET["theForm"])){		
		$theForm = $_GET["theForm"];
	//}
	//if (isset($_GET["theLanguage"])){		
		$theLanguage = $_GET["theLanguage"];
	//}
	//if (isset($_GET["StartDate"])){		
		$StartDate = $_GET["StartDate"];
	//}
	//if (isset($_GET["EndDate"])){		
		$EndDate = $_GET["EndDate"];
	//}
	$SortBy = $_GET["OrderBy"];
	$SearchString = str_replace("'", " ", $SearchString);
	$SearchString = str_replace('"', " ", $SearchString);
	$SearchString = str_replace(',', " ", $SearchString);
	$SearchString = str_replace('\\', " ", $SearchString);
	$SortBy = str_replace("'", " ", $SortBy);
	$SortBy = str_replace('"', " ", $SortBy);
	$SortBy = str_replace(',', " ", $SortBy);
	$SortBy = str_replace('\\', " ", $SortBy);
	$theForm = str_replace("'", " ", $theForm);
	$theForm = str_replace('"', " ", $theForm);
	$theForm = str_replace(',', " ", $theForm);
	$theForm = str_replace('\\', " ", $theForm);
	$theLanguage = str_replace("'", " ", $theLanguage);
	$theLanguage = str_replace('"', " ", $theLanguage);
	$theLanguage = str_replace(',', " ", $theLanguage);
	$theLanguage = str_replace('\\', " ", $theLanguage);
	$StartDate = str_replace("'", " ", $StartDate);
	$StartDate = str_replace('"', " ", $StartDate);
	$StartDate = str_replace(',', " ", $StartDate);
	$StartDate = str_replace('\\', " ", $StartDate);
	$EndDate = str_replace("'", " ", $EndDate);
	$EndDate = str_replace('"', " ", $EndDate);
	$EndDate = str_replace(',', " ", $EndDate);
	$EndDate = str_replace('\\', " ", $EndDate);

	
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		addLanguage($row2["Id"],$row2["Language"]);
	}
	

$result2 = mysqli_query($link,"SELECT MainId, Naam, Parent, TheOrder, Type, Id, targetmainid FROM groepen WHERE Type = 'form' AND MainId='$theForm' AND Language=". $_SESSION['Language']);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo "$theForm ;\"".$row2['Naam']."\"
";
	}
	echo "Search ;\"$SearchString\"
";
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language WHERE Id = '$theLanguage'");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo "Language ; ";
	while($row2 = mysqli_fetch_array($result2)){
		echo "\"".$row2['Language']."\"";
	}
	echo "
";
		
		echo "Start Date ;\"$StartDate \"
End Date ;\"$EndDate \"
";
	

	$PageId = array();
	$SearchString = trim($SearchString);
	$SearchString = str_replace("!", " ",$SearchString);
	$SearchString = str_replace(".", " ",$SearchString);
	$SearchString = str_replace("?", " ",$SearchString);
	$SearchString = str_replace(",", " ",$SearchString);
	$SearchstringM = explode(" ", $SearchString );
	//array_push($SearchstringM, $SearchString, $SearchString, $SearchString, $SearchString, $SearchString);
	
	if ($SearchString == ""){
	// nog geen zoekopdracht
	$sqlsearstring = "";

	if ($theForm != ""){
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theGroup = "'.$theForm.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theGroup = "'.$theForm.'"';
		}
	}
	if ($theLanguage != ""){
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE Language = "'.$theLanguage.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND Language = "'.$theLanguage.'"';
		}
	}
	if ($StartDate != ""){
		$dag = substr($StartDate,0,2);
		$maand = substr($StartDate,3,2);
		$jaar = substr($StartDate,6,4);
		$StartDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theDate > "'.$StartDate.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theDate > "'.$StartDate.'"';
		}
	}
	if ($EndDate != ""){
		$dag = substr($EndDate,0,2);
		$maand = substr($EndDate,3,2);
		$jaar = substr($EndDate,6,4);
		$EndDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theDate < "'.$EndDate.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theDate < "'.$EndDate.'"';
		}
	}
	
	
	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		addformelement($row["MainId"],$row["theName"],$row["theValue"],$row["theGroup"],$row["Language"],$row["theDate"],-1);
	}
	updateform ();
	}else{
	// Zoekopdracht
	
$sqlsearstring = "";

	
	if ($SearchString != ""){
	$first = true;
	foreach ($SearchstringM  as $keyword) {
	
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE (theValue LIKE \'%'.$keyword.'%\')';
		}else{
			if ($first == true){
				$sqlsearstring = $sqlsearstring.' OR theValue LIKE \'%'.$keyword.'%\'';
			}else{
				$sqlsearstring = $sqlsearstring.' OR theValue LIKE \'%'.$keyword.'%\'';
			}
		}
	}
	}
	
	

	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	$sqlsearstring2 = "";
	while($row = mysqli_fetch_array($result)){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE ( MainId = "'.$row["MainId"].'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' OR MainId = "'.$row["MainId"].'"';
		}
	}
	if ($sqlsearstring2 != ""){
	$sqlsearstring2 = $sqlsearstring2.' ) ';
	if ($theForm != ""){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theGroup = "'.$theForm.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theGroup = "'.$theForm.'"';
		}
	}
	if ($theLanguage != ""){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  Language = "'.$theLanguage.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND Language = "'.$theLanguage.'"';
		}
	}
	if ($StartDate != ""){
		$dag = substr($StartDate,0,2);
		$maand = substr($StartDate,3,2);
		$jaar = substr($StartDate,6,4);
		$StartDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theDate > "'.$StartDate.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theDate > "'.$StartDate.'"';
		}
	}
	if ($EndDate != ""){
		$dag = substr($EndDate,0,2);
		$maand = substr($EndDate,3,2);
		$jaar = substr($EndDate,6,4);
		$EndDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theDate < "'.$EndDate.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theDate < "'.$EndDate.'"';
		}
	}
	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring2);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	

	while($row = mysqli_fetch_array($result)){
		addformelement($row["MainId"],$row["theName"],$row["theValue"],$row["theGroup"],$row["Language"],$row["theDate"],-1);
	}
	updateform ();
	
	}
}}
}else{
echo 'error not logged in';

}
?>

