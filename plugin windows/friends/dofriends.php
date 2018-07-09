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
if ($_SESSION['TypeUser'] == 'Admin'){
	if( isset($_POST["openfriend"]) ){
		$selectId = $_POST["openfriend"];
	}
}

$type= $_POST["type"];
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
	
			
	$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="left"></td><td> '. $inputfriendname .' error did nothing</td></tr></table>';
	if ($inputfriend == $selectId){
		$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="left"></td><td> '. $inputfriendname . ' error: You are this. You cannot do anything</td></tr></table>';
	} else {
	if ($type == "Friend"){
		
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' AND User2 = '$inputfriend') OR (User1 = '$inputfriend' AND User2 = '$selectId')  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$User1 = $row["User1"];
			$User2 = $row["User2"];
			$found = true;
			if ( $Typeuser == "Friend"){			
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is already your friend</td></tr></table>';					
			}elseif ($Typeuser == "Blocked"){
				if ($row["User1"] == $selectId){
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is unblocked and send a friend request</td></tr></table>';
					mysqli_query($link,"UPDATE friends SET Type = 'Pending' WHERE Id = '$Id'") or ($message = mysqli_error($link));
					mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Email, Username, Language, UserId, TheDate, Mainid, Filelist) VALUES ('".$_SESSION['Username']." wants to be your friend. Add him: ./Users.php?type=Friends&Id=".$inputfriend."', '$inputfriend','privatemessage','normal', '', '', '".$_SESSION['Language']."', '".$selectId."', '".date("Y-m-d H:i:s")."','$MainId','')")or $themessage = mysqli_error($link);
					$Id = mysqli_insert_id($link);
					mysqli_query($link,"UPDATE reply SET MainId = '$Id' WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
				} else {
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' has blocked you</td></tr></table>';					
				}
			}elseif ( $Typeuser == "2Blocked"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is unblocked but has blocked you</td></tr></table>';					
				if ($row["User1"] == $selectId){					
					mysqli_query($link,"UPDATE friends SET User1 = '$User2', User2 = '$User1', Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				} else {
					mysqli_query($link,"UPDATE friends SET Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}elseif ( $Typeuser == "Pending"){	
				if ($row["User1"] == $selectId){
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' friendrequest is already pending. pleas wait</td></tr></table>';					
				} else {
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' you accepted the request</td></tr></table>';					
					mysqli_query($link,"UPDATE friends SET Type = 'Friend' WHERE Id = '$Id'") or ($message = mysqli_error($link));
					mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Email, Username, Language, UserId, TheDate, Mainid, Filelist) VALUES ('".$_SESSION['Username']." is now your friend.', '$inputfriend','privatemessage','normal', '', '', '".$_SESSION['Language']."', '".$selectId."', '".date("Y-m-d H:i:s")."','$MainId','')")or $themessage = mysqli_error($link);
					$Id = mysqli_insert_id($link);
					mysqli_query($link,"UPDATE reply SET MainId = '$Id' WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
				}				
			}elseif ($Typeuser == "Clear"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' friend request has been send</td></tr></table>';					
				mysqli_query($link,"UPDATE friends SET Type = 'Pending', User1='$selectId', User2='$inputfriend ' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Email, Username, Language, UserId, TheDate, Mainid, Filelist) VALUES ('".$_SESSION['Username']." wants to be your friend. Add him: ./Users.php?type=Friends&Id=".$inputfriend."', '$inputfriend','privatemessage','normal', '', '', '".$_SESSION['Language']."', '".$selectId."', '".date("Y-m-d H:i:s")."','$MainId','')")or $themessage = mysqli_error($link);
					$Id = mysqli_insert_id($link);
					mysqli_query($link,"UPDATE reply SET MainId = '$Id' WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
			}
		}
		if ($found == false){
			$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' friend request has been send</td></tr></table>';					
			mysqli_query($link,"INSERT INTO friends (Type, User1, User2) VALUES ('Pending', '$selectId','$inputfriend')")or ($message = mysqli_error($link));
			mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Email, Username, Language, UserId, TheDate, Mainid, Filelist) VALUES ('".$_SESSION['Username']." wants to be your friend. Add him: ./Users.php?type=Friends&Id=".$inputfriend."', '$inputfriend','privatemessage','normal', '', '', '".$_SESSION['Language']."', '".$selectId."', '".date("Y-m-d H:i:s")."','$MainId','')")or $themessage = mysqli_error($link);
			$Id = mysqli_insert_id($link);
			mysqli_query($link,"UPDATE reply SET MainId = '$Id' WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
		}
	
	}elseif ($type == "Blocked"){
	
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' AND User2 = '$inputfriend') OR (User1 = '$inputfriend' AND User2 = '$selectId')  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$User1 = $row["User1"];
			$User2 = $row["User2"];
			$found = true;
			if ( $Typeuser == "Friend" or $Typeuser == "Pending"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
				if ($row["User1"] == $selectId){			
					mysqli_query($link,"UPDATE friends SET Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}else{
					mysqli_query($link,"UPDATE friends SET User1 = '$User2', User2 = '$User1', Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}elseif ($Typeuser == "Blocked"){
				if ($row["User1"] == $selectId){
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is already blocked</td></tr></table>';
				} else {
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked and has blocked you</td></tr></table>';					
					mysqli_query($link,"UPDATE friends SET Type = '2Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}elseif ( $Typeuser == "2Blocked"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is already blocked</td></tr></table>';					
			}elseif ($Typeuser == "Clear"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
				mysqli_query($link,"UPDATE friends SET Type = 'Blocked', User1='$selectId', User2='$inputfriend ' WHERE Id = '$Id'") or ($message = mysqli_error($link));
			}
		}
		if ($found == false){
			$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
			mysqli_query($link,"INSERT INTO friends (Type, User1, User2) VALUES ('Blocked', '$selectId','$inputfriend')")or ($message = mysqli_error($link));
		}
		}elseif ($type == "Clear"){
	
		$found = false;
		$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' AND User2 = '$inputfriend') OR (User1 = '$inputfriend' AND User2 = '$selectId')  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Id = $row["Id"];
			$Typeuser = $row["Type"];
			$User1 = $row["User1"];
			$User2 = $row["User2"];
			$found = true;
			
			if ( $Typeuser == "Friend" or $Typeuser == "Pending"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now unfriend</td></tr></table>';					
				mysqli_query($link,"UPDATE friends SET Type = 'Clear' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				
			}elseif ($Typeuser == "Blocked"){
				if ($row["User1"] == $selectId){
					
					$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now unblocked</td></tr></table>';
					mysqli_query($link,"UPDATE friends SET Type = 'Clear' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				} else {
					//$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked and has blocked you</td></tr></table>';					
					//mysqli_query($link,"UPDATE friends SET Type = '2Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}elseif ( $Typeuser == "2Blocked"){
				$message = '<table><tr><td><img src="../../system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is unblocked but has blocked you</td></tr></table>';					
				if ($row["User1"] == $selectId){					
					mysqli_query($link,"UPDATE friends SET User1 = '$User2', User2 = '$User1', Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				} else {
					mysqli_query($link,"UPDATE friends SET Type = 'Blocked' WHERE Id = '$Id'") or ($message = mysqli_error($link));
				}
			}
		}
		
		//if ($found == false){
			//$message = '<table><tr><td><img src="./system/imgtumb.php?url='.$inputprofilepic.'&maxsize=50&square=1 " align="middle"> </td><td>'. $inputfriendname .' is now blocked</td></tr></table>';					
			//mysqli_query($link,"INSERT INTO friends (Type, User1, User2) VALUES ('Blocked', '$selectId','$inputfriend')")or ($message = mysqli_error($link));
		//}
	
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