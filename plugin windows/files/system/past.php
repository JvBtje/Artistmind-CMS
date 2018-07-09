<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
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

$totalfile= intval($_POST["totalfile"]);

$destinationdir = $userdir . DIRECTORY_SEPARATOR. removeupdir($_POST["destinationdir"]);
$sourcedir = $userdir . DIRECTORY_SEPARATOR. removeupdir($_POST["sourcedir"]);
$pastcopy = $_POST["pastcopy"];

function copydir($filename, $sourcedir, $destinationdir, $pastcopy)
{
	foreach (scandir($sourcedir.$filename) as $item) {
   	 	if ($item == '.' || $item == '..') continue;
	if(is_dir ($sourcedir.$filename.DIRECTORY_SEPARATOR.$item)){
		mkdir($destinationdir.$filename.DIRECTORY_SEPARATOR.$item, 0755);
		copydir($item, $sourcedir.$filename.DIRECTORY_SEPARATOR, $destinationdir.$filename.DIRECTORY_SEPARATOR, $pastcopy);
	}else{
		copy($sourcedir.$filename.DIRECTORY_SEPARATOR.$item, $destinationdir.$filename.DIRECTORY_SEPARATOR.$item);
		if ($pastcopy == 'false'){
			unlink($sourcedir.$filename.DIRECTORY_SEPARATOR.$item);
		}
	}
    	
	}
	if ($pastcopy == 'false'){
		rmdir($sourcedir.$filename);
	}
}

echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>file pasted</stat>';
echo '<totalfile>'.$totalfile.'</totalfile>';
for($i=1;$i<$totalfile+1;$i++)
{
	$filename = $_POST["file".$i];
	

	if(is_dir ($sourcedir.$filename)){
		mkdir($destinationdir.$filename, 0755);
		copydir($filename, $sourcedir, $destinationdir ,$pastcopy );
	}else{
		copy($sourcedir.$filename, $destinationdir . $filename);
		if ($pastcopy == 'false'){
			unlink($sourcedir.$filename);
		}
	}
	echo '<filename >'.$filename .'</filename>';

}
echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
?>