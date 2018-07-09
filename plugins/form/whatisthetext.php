<?php

$queryreturntext = "SELECT Text FROM formfield WHERE Type='richtext' AND Formid=".$row['Id'];
						
$resultreturntext = mysqli_query($link,$queryreturntext);
if (!$resultreturntext) {
		die('Query failed: ' . mysqli_error($link));
}

while($rowreturntext = mysqli_fetch_array($resultreturntext)){
	$returntext = $rowreturntext['Text'];
}

?>