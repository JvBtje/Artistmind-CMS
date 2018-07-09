<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include "../../DB.php";
include "../../system/include.php";
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
$selectId= intval($_POST["Acount"]);
$acces = accesgroup ($selectId, $_SESSION["Id"]);
if ($_SESSION['TypeUser'] == 'Admin' or $acces == true){
echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>friends list</stat>';

$result = mysqli_query($link,"SELECT Id, Type, theUser  FROM groupmembers WHERE theGroup = '$selectId'  AND Type = 'Member'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		
		while($row = mysqli_fetch_array($result)){
			
			echo '<friendlist>'.$row["theUser"].'</friendlist>';
			
		}		
if ($_SESSION['TypeUser'] == 'Admin'){
$result = mysqli_query($link,"SELECT Id, Type, theUser  FROM groupmembers WHERE theGroup = '$selectId' AND Type = 'Pending'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
				echo '<requestlist>'.$row["theUser"].'</requestlist>';
		}		

$result = mysqli_query($link,"SELECT Id, Type, theUser  FROM groupmembers WHERE theGroup = '$selectId'  AND Type = 'Blocked'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
				echo '<blockedlist>'.$row["theUser"].'</blockedlist>';
		}
}
echo '</lijst>';
} else {
	$message = "Acces denied list";
	//array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
mysqli_close ($link);
?>