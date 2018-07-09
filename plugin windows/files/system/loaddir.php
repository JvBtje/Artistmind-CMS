<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");

if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
include "userdir.php";$userdir = '../../.'.$userdir;

function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}
$inputdir = removeupdir($_GET['url']);
$url = $userdir .DIRECTORY_SEPARATOR .  $inputdir ;

function find_all_files($dir) 
{ 
	$result = "";
    $root = scandir($dir); 
    foreach($root as $value) 
    { 
	if (is_file("$dir/$value") == true){
		$result .= '<file>'.$value .'</file>';
	}else {
		$result .= '<dir>'.$value .'</dir>';
	}
    } 
    return $result; 
} 
echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>Logged in</stat>';
echo find_all_files ($url);
echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
?>