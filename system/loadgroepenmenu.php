<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

include('../DB.php');

include('./include.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>Logged in</stat>	<groepen>';

	

	function displaymenu($Start, $Laag, $text, $Ids){
		global $link;
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$found = "false";
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					$found = "true";
				}
			}
			$row["Naam"] = str_replace("&", " ", $row["Naam"]);
			$row["Naam"] = str_replace("\"", " ", $row["Naam"]);
			echo '<menuitem open="'.$found.'" type="'.$row["Type"].'" mainid="'.$row["MainId"].'" id="'.$row["Id"].'" naam="'.mb_convert_encoding($row['Naam'], "UTF-8").'" parent="'.$row["Parent"].'" targetmaindid="'.$row["targetmainid"].'" ';
					echo '>';
			
				if (is_file('../plugins/'.$row["Type"].'/menuadmin.php')) {
					include '../plugins/'.$row["Type"].'/menuadmin.php';
				}
			
			//echo '</div>';
			echo '</menuitem>';
		}
	}
	if (isset($_GET["MainId"])){
	$MainId = intval($_GET["MainId"]);
	}
	if (isset($_GET["sectie"])){
	$sectie = intval($_GET["sectie"]);
	} else {
		$result = findId($MainId, array());
		$sectie = $result[0];
	}
	
	if (isset($MainId)){	
			
		displaymenu($sectie,0,"root/",findId($MainId, array()));		
	}else{
		displaymenu($sectie,0,"root/",array());
	}
	echo '</groepen></lijst>';
	

} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
mysqli_close ($link);
?>