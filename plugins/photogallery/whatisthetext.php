<?php

$queryreturntext = "SELECT MainId,Id, LargText FROM gallery WHERE Language=".$_SESSION['Language']." AND MainId=".$row['targetmainid'];
						
$resultreturntext = mysqli_query($link,$queryreturntext);
if (!$resultreturntext) {
		die('Query failed: ' . mysqli_error($link));
}

while($rowreturntext = mysqli_fetch_array($resultreturntext)){
	$returntext = $rowreturntext['LargText'];
	
	$resultreturntext2 = mysqli_query($link,"SELECT Id, GalleryId, Theorder, Naam, ImgText, Url FROM galimg WHERE GalleryId=".$rowreturntext['Id']." ORDER BY Theorder");
	if (!$resultreturntext2) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($rowreturntext2 = mysqli_fetch_array($resultreturntext2)){
		$returntext .= '<img src="'.$rowreturntext2['Url'].'">';
	}
}

?>