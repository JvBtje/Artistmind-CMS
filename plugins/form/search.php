<?php
$query = "SELECT Name, theValue, text, errormsg, FormId FROM formfield WHERE  (Name LIKE '%".$keyword."%') OR (theValue LIKE '%".$keyword."%') OR (text LIKE '%".$keyword."%') OR (errormsg LIKE '%".$keyword."%')";
		
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$query2 = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND Type = 'form' AND Id = ".$row['FormId'];
			$result2 = mysqli_query($link,$query2);
			if (!$result2) {
    				die('Query failed: ' . mysqli_error($link));
			}
			while($row2 = mysqli_fetch_array($result2)){
				$GroupMainId =$row2['MainId'];
				$add = true;
				foreach ($PageIddelete as $Keyworddel){
					if ($Keyworddel["Id"] == $GroupMainId){
						$add = false;
						//break;
					}
				}
				if ($add == true){
					$searchitem = $row['Name'].$row['theValue'].$row['text'].$row['errormsg'];
					$tmppagid = theevalsearch($searchitem,$keyword, $GroupMainId);
					if ( count($tmppagid)> 0){
						$PageId = array_merge ($tmppagid,$PageId);
					}	
				}				
			}
	
		}
?>