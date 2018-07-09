<?php
$query = "SELECT MainId, LargText FROM gallery WHERE Language=". $_SESSION['Language'] ." AND (LargText LIKE '%".$keyword."%')";
		
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$query2 = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND Type = 'photogallery' AND targetmainid = ".$row['MainId'];
			$result2 = mysqli_query($link,$query2);
			if (!$result2) {
    				die('Query failed: ' . mysqli_error($link));
			}
			while($row2 = mysqli_fetch_array($result2)){
				$GroupMainId =$row2['MainId'];		
			}
			$add = true;
			foreach ($PageIddelete as $Keyworddel){
				if ($Keyworddel["Id"] == $GroupMainId){
					$add = false;
					//break;
				}
			}
			if ($add == true){
				$searchitem = $row['LargText'];
				$tmppagid = theevalsearch($searchitem,$keyword, $GroupMainId);
				if ( count($tmppagid)> 0){
				 $PageId = array_merge ($tmppagid,$PageId);
				}	
			}
		}
		
	$resultreturntext2 = mysqli_query($link,"SELECT Id, GalleryId, Theorder, Naam, ImgText, Url FROM galimg WHERE (Url LIKE '%".$keyword."%') OR (ImgText LIKE '%".$keyword."%')");
	if (!$resultreturntext2) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($rowreturntext2 = mysqli_fetch_array($resultreturntext2)){
		
		$queryreturntext = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND targetmainid=".$rowreturntext2['GalleryId']." AND Type = 'photogallery'";
						
		$resultreturntext = mysqli_query($link,$queryreturntext);
		if (!$resultreturntext) {
				die('Query failed: ' . mysqli_error($link));
		}

		while($rowreturntext = mysqli_fetch_array($resultreturntext)){
			$GroupMainId =$rowreturntext['MainId'];
			$add = true;
			foreach ($PageIddelete as $Keyworddel){
				if ($Keyworddel["Id"] == $GroupMainId){
					$add = false;
					//break;
				}
			}
			if ($add == true){
				$searchitem = $rowreturntext2['ImgText'].' '.$rowreturntext2['Url'];	
				$tmppagid = theevalsearch($searchitem,$keyword, $GroupMainId);
				if ( count($tmppagid)> 0){
				 $PageId = array_merge ($tmppagid,$PageId);
				}
			}
		}
	}
?>