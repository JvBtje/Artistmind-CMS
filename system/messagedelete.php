<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

include('../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
$acces = false;
$found = false;
$msgid = intval($_POST["msgid"]);
$msgtype = $_POST["msgtype"];

$msgtype = str_replace("'", " ", $msgtype);
$msgtype = str_replace('"', " ", $msgtype);
$msgtype = str_replace("\\", "\\\\", $msgtype);


if ($_SESSION['newsession'] == false and $msgid != "new"){ 
	$msgid = intval($msgid);

			// checkt the profile and if acces to delete is granded.
		
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
			$acces= true;
		}
		$query = "SELECT Id, TheDate, UserId FROM reply WHERE Id =".$msgid;
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$found = true;
		$UserId = $row["UserId"];
		$TheDate = $row["TheDate"];
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($UserId)) ){
			
			$acces= true;
		}	
	}
	
	
}

if  ($acces == false or $found == false){
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>acces denied</stat>';
	echo '</lijst>';
}else{
	if ($msgid == "new"){
	
		
	
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>is a new message</stat>';
		echo '</lijst>';
	}else{

		mysqli_query($link,"UPDATE reply SET Stat = 'deleted', TheDate='$TheDate' WHERE Id = '$msgid '") or ($message = mysqli_error($link)); 
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>message saved</stat>';
		echo '</lijst>';
	}

}
mysqli_close ($link);

?>
