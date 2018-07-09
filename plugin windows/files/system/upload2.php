<?php
session_start();
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

$target_path = $userdir;

$tmp_name = $_FILES['fileToUpload']['tmp_name'];
$size = $_FILES['fileToUpload']['size'];
$name = $_FILES['fileToUpload']['name'];
$name2 = $_GET['filename'];
$tmp_name = removeupdir($tmp_name);
$name = removeupdir($name);
$name2 = removeupdir($name2);

$target_file = $target_path.$name;


$complete =$target_path.$name2;

$com = fopen($complete, "ab");
error_log($target_path);

// Open temp file
//$out = fopen($target_file, "wb");

//if ( $out ) {
    // Read binary input stream and append it to temp file
    $in = fopen($tmp_name, "rb");
    if ( $in ) {
        while ( $buff = fread( $in, 1048576 ) ) {
           // fwrite($out, $buff);
            fwrite($com, $buff);
        }   
    }
    fclose($in);
    
//}
//fclose($out);
fclose($com);
}else{
	echo'you are not logged in.';
}
?>