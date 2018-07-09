<?php
ini_set('memory_limit', '2048M');
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
include "userdir.php";$userdir = '../../.'.$userdir;
$totalfile= intval($_POST["totalfile"]);
$destinationdir = "";

function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}
$inputdir = removeupdir($_POST["sourcedir"]);

$sourcedir = $userdir . DIRECTORY_SEPARATOR. $inputdir;
$pastcopy = $_POST["pastcopy"];

$zip = new ZipArchive();
$zip->open( $sourcedir.'download.zip', ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE ); 
//$zip->open($sourcedir.'download.zip', ZipArchive::CREATE); 

$dirName = $sourcedir; 

if (!is_dir($dirName)) { 
    throw new Exception('Directory ' . $dirName . ' does not exist'); 
} 

$dirName = realpath($dirName); 
if (substr($dirName, -1) != '/') { 
    $dirName.= '/'; 
} 

/* 
 * NOTE BY danbrown AT php DOT net: A good method of making 
 * portable code in this case would be usage of the PHP constant 
 * DIRECTORY_SEPARATOR in place of the '/' (forward slash) above. 
 */ 

$dirStack = array($dirName); 
//Find the index where the last dir starts 
$cutFrom = strrpos(substr($dirName, 0, -1), '/')+1; 

while (!empty($dirStack)) { 
    $currentDir = array_pop($dirStack); 
    $filesToAdd = array(); 

    $dir = dir($currentDir); 
    while (false !== ($node = $dir->read())) { 
        if (($node == '..') || ($node == '.')) { 
            continue; 
        } 
        if (is_dir($currentDir . $node)) { 
            array_push($dirStack, $currentDir . $node . '/'); 
        } 
        if (is_file($currentDir . $node)) { 
            $filesToAdd[] = $node; 
        } 
    } 

    $localDir = substr($currentDir, $cutFrom); 
    $zip->addEmptyDir($localDir); 
    
    foreach ($filesToAdd as $file) { 
        $zip->addFile($currentDir . $file, $localDir . $file); 
    } 
} 

$zip->close();
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';	
	echo '</lijst>';
}
?>