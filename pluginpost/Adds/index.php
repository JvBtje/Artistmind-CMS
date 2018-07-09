<?php
$curdattime = date('Y-m-j H:i:s');

$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, Startdate, Smalltext, TheDate, TheGroup FROM reclame WHERE Startdate < '$curdattime' AND TheDate > '$curdattime' AND Language=". $_SESSION['Language']." ORDER BY RAND( ) LIMIT 1" );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$output .= $row["Smalltext"];
		preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			//$output .=  "counter".count($theurl[0]);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
	}
	
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, Startdate, Smalltext, TheDate, TheGroup FROM reclame WHERE Startdate < '$curdattime' AND TheDate > '$curdattime' AND Language=". $_SESSION['Language']." ORDER BY RAND( ) LIMIT 1" );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$outputbefore .= $row["Smalltext"];
		preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			//$output .=  "counter".count($theurl[0]);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$row["Smalltext"], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
	}

?>