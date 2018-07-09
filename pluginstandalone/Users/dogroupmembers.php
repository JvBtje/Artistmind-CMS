<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include "../../DB.php";
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
$totalfriends= $_POST["totalfriends"];
$selectId= intval($_SESSION['Id']);
$type= $_POST["type"];
$thegroup = intval($_GET["groupid"]);
if ($_SESSION['TypeUser'] == 'Admin' or (intval($_SESSION['Id']) == $selectId and $_SESSION['Id'] <> "")){

echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>friends changed</stat>';
echo '<totalfriends>'.$totalfriends.'</totalfriends>';

for($i=1;$i<$totalfriends+1;$i++)
{
	$inputfriend = intval($_POST["friend".$i]);
	$inputfriendfound = false;
	$inputfriendname = "Not found";
	$inputprofilepic = "";
	$result2 = mysqli_query($link,"SELECT Username, Id, Profilepic FROM login WHERE Id = $inputfriend");
		if (!$result2) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$inputfriendfound = true;
			$inputfriendname = $row2['Username'];
			$inputprofilepic = $row2['Profilepic'];
		}
	
			
	$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="left"></td><td> '. $inputfriendname . $thegroup. ' member error did nothing</td></tr></table>';


	if ($type == "Member"){
		$query = 'SELECT Type FROM usergroepen WHERE Mainid = '.$thegroup.' AND Language='. $_SESSION['Language'];
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$grouptype = $row["Type"];
		}
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, theGroup, theUser FROM groupmembers WHERE theUser = '$inputfriend' AND theGroup='$thegroup'" );
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$User1 = $row["User1"];
			$User2 = $row["User2"];
			$found = true;
			if ( $Typeuser == "Member"){			
				$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is already a member</td></tr></table>';					
			}elseif ($Typeuser == "Blocked"){
				if($_SESSION['TypeUser'] == 'Admin'){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is unblocked and is a member</td></tr></table>';
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Member' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				} elseif ($selectId == $inputfriend) {
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is blocked</td></tr></table>';					
				}
			}elseif ( $Typeuser == "Pending"){	
				if($_SESSION['TypeUser'] == 'Admin' or $grouptype == "Open"){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now a member</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Member' WHERE Id = '$Id'") or ($message = mysqli_error($link));		
				} elseif ($selectId == $inputfriend){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' membership request is already pending. pleas wait</td></tr></table>';					
				}				
			}elseif ($Typeuser == "Clear"){
				if($_SESSION['TypeUser'] == 'Admin'or $grouptype == "Open"){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now a member</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Member' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}elseif ($selectId == $inputfriend){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' Membership request has been send</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Pending' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}
		}
		if ($found == false){
			if($_SESSION['TypeUser'] == 'Admin' or $grouptype == "Open"){
				$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now a member</td></tr></table>';					
				mysqli_query($link,"INSERT INTO groupmembers (Type, theGroup, theUser) VALUES ('Member', '$thegroup','$inputfriend')") or ($message = mysqli_error($link));
			}else{
				$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' Membership request has been send</td></tr></table>';					
				mysqli_query($link,"INSERT INTO groupmembers (Type, theGroup, theUser) VALUES ('Pending', '$thegroup','$inputfriend')") or ($message = mysqli_error($link));
			}
			//$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' friend request has been send</td></tr></table>';					
			//mysqli_query($link,"INSERT INTO friends (Type, User1, User2) VALUES ('Pending', '$selectId','$inputfriend')")or ($message = mysqli_error($link));
		}
	
	}elseif ($type == "Blocked"){
	
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, theGroup, theUser FROM groupmembers WHERE theUser = '$inputfriend' AND theGroup='$thegroup'");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$User1 = $row["User1"];
			$User2 = $row["User2"];
			$found = true;
			if ( $Typeuser == "Member" or $Typeuser == "Pending"){
				if($_SESSION['TypeUser'] == 'Admin'){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}elseif ($Typeuser == "Blocked"){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is already blocked</td></tr></table>';
			}elseif ($Typeuser == "Clear"){
				if($_SESSION['TypeUser'] == 'Admin'){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}
		}
		if ($found == false){
			if($_SESSION['TypeUser'] == 'Admin'){
				$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
				mysqli_query($link,"INSERT INTO groupmembers (Type, theGroup, theUser) VALUES ('Blocked', '$thegroup','$inputfriend')") or ($message = mysqli_error($link));
			}
		}
		}elseif ($type == "Clear"){
	
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, theGroup, theUser FROM groupmembers WHERE theUser = '$inputfriend' AND theGroup='$thegroup' ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$found = true;
			if ( $Typeuser == "Member" or $Typeuser == "Pending"){
				if($_SESSION['TypeUser'] == 'Admin'){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now not a member</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Clear' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}elseif ($selectId == $inputfriend){
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' You are not a member anymore</td></tr></table>';					
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Clear' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
				
			}elseif ($Typeuser == "Blocked"){
				if($_SESSION['TypeUser'] == 'Admin'){					
					$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now unblocked</td></tr></table>';
					mysqli_query($link,"UPDATE groupmembers SET Type = 'Clear' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				} 
		}
	
	}
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true) + (2 * $i), "html" => $message));
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