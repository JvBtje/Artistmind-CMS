
<?php


function displaymenu($Start, $Laag, $text, $Ids, $sectie){
global $link;
global $documentinfo;
		echo '<table>';
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
		//echo $_SESSION["Id"];
		if (isset($_SESSION['Id'])) {
			$acceslijst = accesdocument($row['MainId'], $Ids2 = array(),$_SESSION["Id"]);
		} else {
			$acceslijst = accesdocument($row['MainId'], $Ids2 = array());
		}
		if ($acceslijst == true){
			$Naam = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$row['Naam']);
			$found = "false";
			
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					
					$found = "true";
				}
			}
		
			if (isset($_SESSION['menumember'][$row["Type"]] )) {
				include './plugins/'.$row["Type"].'/menumember.php';
			}else{
				include './plugins/default/menumember.php';
			}
			
		}}
		echo '</table>';
	
	}

	$Ids= $documentinfo["Ids"];
	
	if ($Ids != "Loop detected"){
		if (isset($sectie)){		
		}else{
			//echo 'no sectie';
			$sectie = $Ids[count($Ids)];
		}
		if (isset($MainId) AND count($Ids)>0){
				
			displaymenu($sectie,0,"root/",$Ids, $sectie);		
		}else{
			displaymenu($sectie,0,"",array(), $sectie);
		}
	}else{
		echo 'Loop detected';
	}

?>