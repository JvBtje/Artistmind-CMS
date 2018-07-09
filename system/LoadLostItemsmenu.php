<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
global $link;

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, Parent, MainId, targetmainid, Type FROM groepen WHERE Language =".$_SESSION['Language']." ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo '<table>';
	while($row = mysqli_fetch_array($result)){
		$result2 = mysqli_query($link,"SELECT Id, Naam, TheOrder, Type, Parent, MainId FROM groepen WHERE MainId = ".$row["Parent"]." AND Language =".$_SESSION['Language']." ");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		$found =false;
		while($row2 = mysqli_fetch_array($result2)){
			
			$found = true;
			//check of hij in een loop zit
			if (findId($row["Parent"], array())== "in a loop"){$found = false;}
		}
		if ($found == false AND intval($row["Parent"]) != -1){
			echo '<tr><td><a href="indexadminnew.php?plugin='.$row["Type"].'&type=select&Id='.$row['MainId'].'">'.$row["Id"].' '.mb_convert_encoding($row['Naam'], "UTF-8").' </a></td></tr>';
			/*if ($row["Type"]== "richtext"){
				echo '<tr><td><a href="richtext.php?type=select&Id='.$row['MainId'].'">'.$row["Id"].' '.$row["Naam"].'</a></td></tr>';
			} else {
				echo '<tr><td><a href="groepen.php?type=select&Id='.$row['MainId'].'">'.$row["Id"].' '.$row["Naam"].'</a></td></tr>';
			}*/
		}
	}
	echo '</table>';


} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
?>