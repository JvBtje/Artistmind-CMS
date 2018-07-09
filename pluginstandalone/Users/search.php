<?php
$query = "SELECT Username, Id FROM login WHERE  Username LIKE '%".$keyword."%' AND TypeUser != 'Nieuws'";
		
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$searchitem = $row['Username'];
			$add = true;
			foreach ($PageIddelete as $Keyworddel){
				if ($Keyworddel["Id"] == $row["Id"]){
					$add = false;
					//break;
				}
			}
			if ($add == true){
				$tmppagid = theevalsearch($searchitem,$keyword, $row['Id'],'pluginstandalone','Users');			
				if ( count($tmppagid)> 0){
				 $PageId = array_merge ($tmppagid,$PageId);
				}
			}
		}
?>