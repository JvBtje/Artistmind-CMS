<?php
session_start();


include('../DB.php');
include('include.php');
include ('timezone.php');
include('../plugin windows/files/system/userdir.php');

if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}

$acces = false;
$found = false;
$msgtype = $_POST["msgtype"];
$msgtypeid = $_POST["msgtypeid"];
$msgtitle = $_POST["msgtitle"];
$msgid = $_POST["msgid"];
$stat = $_POST["stat"];
$message = $_POST["message"];
$filelist = $_POST["filelist"];
$gebruikersnaam = $_POST["gebruikersnaam"];
$email = $_POST["email"];
$msguserid = $_SESSION['Id'];

$filelist = str_replace("'", " ", $filelist);
$filelist = str_replace('"', " ", $filelist);
$filelist = str_replace("\\", "\\\\", $filelist);
$stat = str_replace("'", " ", $stat);
$stat = str_replace('"', " ", $stat);
$stat = str_replace("\\", "\\\\", $stat);
$msgtype = str_replace("'", " ", $msgtype);
$msgtype = str_replace('"', " ", $msgtype);
$msgtype = str_replace("\\", "\\\\", $msgtype);
$msgtitle = str_replace("'", " ", $msgtitle);
$msgtitle = str_replace('"', " ", $msgtitle);
$msgtitle = str_replace("\\", "\\\\", $msgtitle);
$msgtypeid = str_replace("'", " ", $msgtypeid);
$msgtypeid = str_replace('"', " ", $msgtypeid);
$msgtypeid = str_replace("\\", "\\\\", $msgtypeid);
$gebruikersnaam = str_replace("'", " ", $gebruikersnaam);
$gebruikersnaam = str_replace('"', " ", $gebruikersnaam);
$gebruikersnaam = str_replace("\\", "\\\\", $gebruikersnaam);
$email = str_replace("'", " ", $email);
$email = str_replace('"', " ", $email);
$email = str_replace("\\", "\\\\", $email);
$msgid = str_replace("'", " ", $msgid);
$msgid = str_replace('"', " ", $msgid);
$msgid = str_replace("\\", "\\\\", $msgid);
$message = addslashes ($message);

if ($_SESSION['newsession'] == false and ($msgid != "new" and substr($msgid, 0, 6) != "newsub")){
	
	if(substr($stat, 0, 10) == "submessage"){ 
		$query = "SELECT Id, ParentMainId, ParentType, TheDate, UserId FROM reply WHERE Id =".$msgid;
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){			
			$msgtype = $row["ParentType"];
			$msgtypeid = $row["ParentMainId"];
			$msguserid = $row["UserId"];
		}
		$query = "SELECT Id, ParentMainId, ParentType, TheDate, UserId FROM reply WHERE Stat = 'normal' AND MainId =".$msgtypeid;
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){			
			$msgtype = $row["ParentType"];
			$msgtypeid = $row["ParentMainId"];
		}
	}else{
		$query = "SELECT Id, ParentMainId, ParentType, TheDate, UserId FROM reply WHERE Id =".$msgid;
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){			
			$msgtype = $row["ParentType"];
			$msgtypeid = $row["ParentMainId"];
			$msguserid = $row["UserId"];
		}
	}
}
if ($_SESSION['newsession'] == false and $msgid == "new"){ 
	switch ($msgtype){
	case "user":
	case "privatemessage":
		$acces = accesprofile ($msgtypeid, $_SESSION["Id"]);
		break;
	case "usergroup":
		$acces = accesgroup ($msgtypeid, $_SESSION["Id"]);
	break;
	case "richtext":
	case "photogallery":
		$acces = accesdocumentMessages($msgtypeid,array(), $_SESSION["Id"]);
	break;
	case "forum":
		$formmsginfo = getdocumentinfo($msgtypeid,array(), $_SESSION["Id"]);
		if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
			$acces = true;
		}
	break;
	case  "forummsg";
		$result = mysqli_query($link,"SELECT ParentMainId FROM reply WHERE id=".$msgtypeid." AND Language=". $_SESSION['Language']);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$formmsginfo = getdocumentinfo($row["ParentMainId"],array());
			if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
				$acces = true;
			}
		}
	break;
	}
}

if ($_SESSION['newsession'] == false and substr($msgid, 0, 6) == "newsub"){ 
	switch ($msgtype){
	case "user":
	case "privatemessage":
		$acces = accesprofile ($msgtypeid, $_SESSION["Id"]);
		break;
	case "usergroup":
		$acces = accesgroup ($msgtypeid, $_SESSION["Id"]);
	break;
	case "richtext":
	case "photogallery":
		$acces = accesdocumentMessages($msgtypeid,array(), $_SESSION["Id"]);
	break;
	case "forum":
		$formmsginfo = getdocumentinfo($msgtypeid,array(), $_SESSION["Id"]);
		if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
			$acces = true;
		}
	break;
	case  "forummsg";
		$result = mysqli_query($link,"SELECT ParentMainId FROM reply WHERE id=".$msgtypeid." AND Language=". $_SESSION['Language']);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$formmsginfo = getdocumentinfo($row["ParentMainId"],array());
			if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
				$acces = true;
			}
		}
	break;
	}
}

if ($_SESSION['newsession'] == false and $msgid != "new" and substr($msgid, 0, 6) != "newsub"){ 
	$msgid = intval($msgid);
	switch ($msgtype){
	
	case "user":
	case "privatemessage":
	case "usergroup":
	case "richtext":
	case "photogallery":
	case "forum":
	case "forummsg";
	// checkt the profile and if acces to delete is granded.		
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
			$acces= true;
		}
	$query = "SELECT Id, UserId, TheDate, MainId FROM reply WHERE Id =".$msgid;
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$found = true;
		$UserId = $row["UserId"];
		$TheDate = $row["TheDate"];
		$MainId = $row["MainId"];
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($row["UserId"])) ){
			$acces= true;
		}	
	}
	break;
	}
}


$acces2 = true;
if (strlen($filelist) != 0){
$Filelist =  explode("<li>", $filelist);

for($i = 1; $i < count($Filelist); $i++) {
	$imgname =  substr ($Filelist[$i] , 0, -5 );

	if ($_SESSION['TypeUser'] == 'Admin'){
	
		$acces2 = true;
		break;
	}
	if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' and $acces2 == false){
		/*
		$inputdir = removeupdir($imgname);
		$userdir = substr($userdir, 7,strlen($userdir));
		if ($inputdir != $imgname){
			$acces2 = false;
			break;
		}
		$strlenght = strlen($userdir);
		$userdir2 = substr($imgname, 0, $strlenght);*/
		$strlenght = strlen($userdir);
		$userdir2 = substr($imgname, 0, $strlenght);
		if (trim ($userdir2) == trim ($userdir)){
			
		}else{
			$acces2 = false;
			break;
		}
	}
}
}


if  ($acces== true and $acces2 == true){
$themessage = "message saved";

	if ($msgid == "new"){
	
		mysqli_query($link,"INSERT INTO reply (TheDate, Bericht, ParentMainId, ParentType, stat, Language, UserId, Filelist,name) VALUES ('".date("Y-m-d H:i:s")."', '$message', '$msgtypeid','$msgtype','$stat', '".$_SESSION['Language']."', '$msguserid','$filelist','$msgtitle')")or $themessage = mysqli_error($link);
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE reply SET MainId = '$Id', TheDate= '".date("Y-m-d H:i:s")."'  WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>message saved</stat>';
		echo '</lijst>';
	}else if (substr($msgid, 0, 6) == "newsub"){
		$msgtypeid = substr($msgid, 6, strlen($msgid)-6);
		
		mysqli_query($link,"INSERT INTO reply (TheDate, Bericht, ParentMainId, ParentType, stat, Language, UserId, Filelist) VALUES ('".date("Y-m-d H:i:s")."', '$message', '$msgtypeid','submessage','$stat', '".$_SESSION['Language']."', '$msguserid','$filelist')")or $themessage = mysqli_error($link);
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE reply SET MainId = '$Id', TheDate= '".date("Y-m-d H:i:s")."' WHERE Id = '$Id'") or ($themessage = mysqli_error($link)); 
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>message saved</stat>';
		echo '</lijst>';
	
	}else if ($found == true and substr($stat, 0, 10) == "submessage"){
		$msgtypeid = substr($stat, 10, strlen($stat)-10);
		mysqli_query($link,"UPDATE reply SET Stat = 'history', TheDate='$TheDate' WHERE Id = '$msgid '") or ($themessage = mysqli_error($link)); 
		mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Language, UserId, TheDate, Mainid, Filelist) VALUES ('$message', '$msgtypeid','submessage','normal', '".$_SESSION['Language']."', '$msguserid', '$TheDate','$MainId','$filelist')")or $themessage = mysqli_error($link);
	
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>message saved</stat>';
		echo '</lijst>';
	}else if ($found == true){
	
		mysqli_query($link,"UPDATE reply SET Stat = 'history', TheDate='$TheDate' WHERE Id = '$msgid '") or ($themessage = mysqli_error($link)); 
		mysqli_query($link,"INSERT INTO reply (Bericht, ParentMainId, ParentType, stat, Language, UserId, TheDate, Mainid, Filelist,name) VALUES ('$message', '$msgtypeid','$msgtype','$stat', '".$_SESSION['Language']."', '$msguserid', '$TheDate','$MainId','$filelist','$msgtitle')")or $themessage = mysqli_error($link);
	
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>'.$themessage.'</stat>';
		echo '</lijst>';
	}else{
		echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
		echo '<stat>message not found</stat>';
		echo '</lijst>';
	}

}else{
	$themessage .= "Acces denied";
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>acces denied</stat>';
	echo '</lijst>';
	
}
array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $themessage));
mysqli_close ($link);

?>
