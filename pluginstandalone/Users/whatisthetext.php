<?php

$queryreturntext = "SELECT  Username, Profilepic, Id FROM login WHERE  Id=".$PageId[$i][Id];
						
$resultreturntext = mysqli_query($link,$queryreturntext);
if (!$resultreturntext) {
		die('Query failed: ' . mysqli_error($link));
}


while($rowreturntext = mysqli_fetch_array($resultreturntext)){
	$listheading = $rowreturntext["Username"];
	$returntext .= ' <img src="'.$rowreturntext["Profilepic"].'">';
}

?>