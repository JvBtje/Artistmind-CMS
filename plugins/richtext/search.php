<?php
	header("Content-type: text/html; charset=utf-8");
$query = "SELECT MainId, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6 FROM richtext WHERE Language=". $_SESSION['Language'] ." AND ((LargText LIKE '%".$keyword."%' COLLATE utf8_general_CI) OR (Largtext2 LIKE '%".$keyword."%') OR (Largtext3 LIKE '%".$keyword."%') OR (Largtext4 LIKE '%".$keyword."%') OR (Largtext5 LIKE '%".$keyword."%') OR (Largtext6 LIKE '%".$keyword."%')) ";
		
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
		
			$query2 = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND Type = 'richtext' AND targetmainid = ".$row['MainId'];
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
				$searchitem = $row['LargText'].$row['Largtext2'].$row['Largtext3'].$row['Largtext4'].$row['Largtext5'].$row['Largtext6'];
				
				$tmppagid = theevalsearch($searchitem,$keyword, $GroupMainId);			
				if ( count($tmppagid)> 0){
				 $PageId = array_merge ($tmppagid,$PageId);
				}
			}
		}
?>