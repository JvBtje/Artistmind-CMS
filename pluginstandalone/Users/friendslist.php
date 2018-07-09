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
$acces = accesprofile ($selectId, $_SESSION["Id"]);

if ($_SESSION['TypeUser'] == 'Admin' or $acces == true){
echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>friends list</stat>';


//echo '<friendlist>';
$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' OR  User2 = '$selectId') AND Type = 'Friend'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			if ($row["User1"] == $selectId){
				echo '<friendlist>'.$row["User2"].'</friendlist>';
			}else{
				echo '<friendlist>'.$row["User1"].'</friendlist>';
			}
		}		
//echo '</friendlist>';
if ($_SESSION['TypeUser'] == 'Admin' or ( $_SESSION['Id'] == $selectId and $_SESSION['Id']<>"")){
//echo '<pendinglist>';
$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE User1 = '$selectId' AND Type = 'Pending'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
				echo '<pendinglist>'.$row["User2"].'</pendinglist>';
		}		
//echo '</pendinglist>';

//echo '<requestlist>';
$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE User2 = '$selectId' AND Type = 'Pending'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
				echo '<requestlist>'.$row["User1"].'</requestlist>';
		}		
//echo '</requestlist>';

//echo '<blockedlist>';
$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE User1 = '$selectId'  AND Type = 'Blocked'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
				echo '<blockedlist>'.$row["User2"].'</blockedlist>';
		}		
		$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' OR User2 = '$selectId') AND Type = '2Blocked'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			if ($row["User1"] == $selectId){
				echo '<blockedlist>'.$row["User2"].'</blockedlist>';
			}else{
				echo '<blockedlist>'.$row["User1"].'</blockedlist>';
			}
		}	
//echo '</blockedlist>';
}
echo '</lijst>';
} else {
	$message = "Acces denied ";
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
mysqli_close ($link);
?>