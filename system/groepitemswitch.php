<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include('../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>Logged in</stat>';
	$item1 = $_POST["item1"];
	$item2 = $_POST["item2"];

	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	

	$result = mysqli_query($link,"SELECT TheOrder FROM groepen WHERE Id = ".$item1);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$found1=false;
	while($row = mysqli_fetch_array($result)){
		$theorder1 = $row["TheOrder"];	
		$found1=true;
	}
		
	$result = mysqli_query($link,"SELECT TheOrder FROM groepen WHERE Id = ".$item2);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}	
	$found2=false;
	while($row = mysqli_fetch_array($result)){
		$theorder2 = $row["TheOrder"];
		$found2=true;	
	}
	if ($found1 == true and $found2 == true){
		mysqli_query($link,"UPDATE groepen SET TheOrder = '$theorder' WHERE Id = '$item1'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"UPDATE groepen SET TheOrder = '$theorder1' WHERE Id = '$item2'") or ($message = mysqli_error($link));
		mysqli_query($link,"UPDATE groepen SET TheOrder = '$theorder2' WHERE Id = '$item1'") or ($message = mysqli_error($link));  
	}
	


echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
?>