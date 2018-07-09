<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
include "userdir.php";$userdir = '../../.'.$userdir;
//$userdir="../uploads/";

echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>file gerenamed</stat>';
function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}
 
$oldnieuwfilenaam =$userdir . removeupdir($_POST["oldnieuwfilenaam"]);
$nieuwfilenaam= $userdir . removeupdir($_POST["nieuwfilenaam"]);


$nieuwfilenaam = str_replace ('\'',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('"',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('<',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('>',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('?',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('&',"",$nieuwfilenaam);
$nieuwfilenaam = str_replace ('-',"",$nieuwfilenaam); 
	
rename ($oldnieuwfilenaam, $nieuwfilenaam);
	touch($nieuwfilenaam);
for($i=1;$i<$totalfile+1;$i++)

echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
?>