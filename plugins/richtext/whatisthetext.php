<?php

$queryreturntext = "SELECT MainId, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6 FROM richtext WHERE Language=". $_SESSION['Language'] ." AND MainId=".$row['targetmainid'];
						
$resultreturntext = mysqli_query($link,$queryreturntext);
if (!$resultreturntext) {
		die('Query failed: ' . mysqli_error($link));
}


while($rowreturntext = mysqli_fetch_array($resultreturntext)){
	$returntext = $rowreturntext['LargText'].$rowreturntext['Largtext2'].$rowreturntext['Largtext3'].$rowreturntext['Largtext4'].$rowreturntext['Largtext5'].$rowreturntext['Largtext6'];
}

?>