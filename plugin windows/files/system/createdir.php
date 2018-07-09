<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
include "userdir.php";$userdir = '../../.'.$userdir;


echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>dir gemaakt</stat>';
$dirnaam =$_POST["dirnaam"];
$destinationdir = $_POST["destinationdir"];
mkdir($userdir . DIRECTORY_SEPARATOR. $destinationdir . $dirnaam, 0755);
for($i=1;$i<$totalfile+1;$i++)

echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
?>