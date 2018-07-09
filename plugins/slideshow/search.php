<?php		
	$resultreturntext2 = mysqli_query($link,"SELECT Id, IdGroup, Imageurl FROM slides WHERE (Imageurl LIKE '%".$keyword."%')");
	if (!$resultreturntext2) {
		die('Query failed: ' . mysqli_error($link));
	}

	while($rowreturntext2 = mysqli_fetch_array($resultreturntext2)){
		
		$queryreturntext = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND MainId=".$rowreturntext2['IdGroup']." AND Type = 'slideshow'";
						
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
				$searchitem = $rowreturntext2['Imagurl'];	
				$tmppagid = theevalsearch($searchitem,$keyword, $GroupMainId);
				if ( count($tmppagid)> 0){
				 $PageId = array_merge ($tmppagid,$PageId);
				}
			}
		}
	}
?>