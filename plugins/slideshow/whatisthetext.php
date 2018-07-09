<?php
	$resultreturntext2 = mysqli_query($link,"SELECT Id, IdGroup, Theorder, Imageurl, Url FROM slides WHERE IdGroup= '".$row['Id']."' ORDER BY Theorder");
	if (!$resultreturntext2) {
		die('Query failed: ' . mysqli_error($link));
	}
	//$returntext .= "SELECT Id, IdGroup, Theorder, Imageurl, Url FROM slides WHERE IdGroup= '".$row['Id']."' ORDER BY Theorder";
	while($rowreturntext2 = mysqli_fetch_array($resultreturntext2)){
		
	//$output .=  '<script language="javascript">window.slideshows[\''.$MainId.'\'].slides.push(addslidetoshow(\''.$row2["Url"].'\',\''.$row2["Imageurl"].'\', \'0\', \'0\'));</script>';
		$returntext .= '<a href="'.$rowreturntext2['Url'].'">';
		$returntext .= '<img src="'.$rowreturntext2['Imageurl'].'">';
	}

?>