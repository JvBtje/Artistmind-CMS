<?php

$queryreturntext = "SELECT MainId, Id, LargText FROM soundsmain WHERE Language=". $_SESSION['Language'] ." AND MainId=".$row['targetmainid'];
						
$resultreturntext = mysqli_query($link,$queryreturntext);
if (!$resultreturntext) {
		die('Query failed: ' . mysqli_error($link));
}

while($rowreturntext = mysqli_fetch_array($resultreturntext)){
	$returntext = $rowreturntext['LargText'];
	
	$resultreturntext2 = mysqli_query($link,"SELECT Id, IdGal, Theorder, Url FROM sounds WHERE IdGal=".$rowreturntext['Id']." ORDER BY Theorder");
	if (!$resultreturntext2) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($rowreturntext2 = mysqli_fetch_array($resultreturntext2)){
		
		$returntext .= '<a href="'.$rowreturntext2['Url'].'">';
		if ($rowreturntext2['Url'] != ""){
			$dir23 = "";
			$direxplode23 = explode("/", $rowreturntext2['Url']);
			$albumartexist = false;
			$albumimgurl = $_SESSION['Theme'].'systemicon/sound icoon.jpg';
			for($iii23=0; $iii23< count ($direxplode23)-1;$iii23++){
				$dir23 .= $direxplode23[$iii23]."/";			
			}
			
			if (file_exists($dir23."album.jpg")){
				$albumartexist = true;
				array_push($_SESSION['Accesfiles2'], $dir23."album.jpg");
				$albumimgurl = $dir23."album.jpg";
				$returntext .= '<img src="'.$albumimgurl.'">';
			}else{
				$returntext .= '<img src="'.$_SESSION['Theme'].'systemicon/sound icoon.jpg">';
			}
		}
		
	}
}
?>