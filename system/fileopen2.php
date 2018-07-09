<?php

session_start();
	include("../DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
	include "include.php";
if ($_SESSION['newsessionany'] != 10 ){

	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");


$searchplug = Array();
$i = 0;
$root = scandir('../plugins'); 
foreach($root as $value)
{ 
	if (is_file('../plugins/'.$value.'/search.php')) {
		$searchplug[$i][0] = 'include(\'../plugins/'.$value.'/search.php\');';
		$searchplug[$i][1] = $value;
		$i++;
	}
} 

$root = scandir('../plugin windows'); 
foreach($root as $value)
{ 
	if (is_file('../plugin windows/'.$value.'/search.php')) {
		$searchplug[$i][0] = 'include(\'../plugins/'.$value.'/search.php\');';
		$searchplug[$i][1] = $value;
		$i++;
	}
} 
//print_r($searchplug);
$_SESSION['search'] = $searchplug;


$acces = false;
include "../plugin windows/files/system/userdir.php";
$imgname = $_GET['url'] ;

if ($_SESSION['TypeUser'] == 'Admin'){
	
	$acces = true;
}
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' and $acces == false){
	$strlenght = strlen($userdir);	
	$userdir2 = substr($imgname, 0, $strlenght);
	
	if (trim ($userdir2) == trim ($userdir)){
		$acces = true;
	}
}
$imgname = $_GET['url'] ;

if (is_array($_SESSION['Accesfiles2']) and $acces == false){
foreach ($_SESSION['Accesfiles2'] as &$File)
		{	
			//echo $File." ";
			if ($File == $imgname){
				$acces = true;
				break;
			}
		}
}else{
	//echo 'no array';
}

//phpinfo ();
//print_r($_SESSION['Accesfiles2']);
function accesdocument2($Parent, $Ids = array() ){
		global $link;
		$acces = false;
		$Message = "";
		$Parent = intval($Parent);
		if (isset($Ids)){
			
		}else{
			$Ids = array();	
		}
		
		$query2 = 'SELECT Id, MainId, Parent, Publish, PublishDate FROM groepen WHERE MainId = '.$Parent.' ';
		
		$result2 = mysqli_query($link,$query2);
		if (!$result2) {
  			die('Query failed1: ' . mysqli_error($link));
		}
		
		while($row = mysqli_fetch_array($result2)){
			
			if (($row["Publish"] == "Parent" or $row["Publish"]=="") and $row["Parent"] != "-1"){
				if ($row["MainId"] == "-1"){
					$Message = "off";
				}else {
					// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($Parent)){
						$error = true;
					}		
				}
					if ($error == false){
						$Ids = array_merge($Ids, array($row["MainId"]));
						$acces = accesdocument2($row["Parent"], $Ids);
						
					}else{
						$acces = "in a loop";
					}
				}
			}else if($row["Publish"] == "No"){
				
			}else if($row["Publish"] == "Public"){
				$acces = true;
			}
		include ('timezone.php');
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
			
		if ($PublishDate > $todays_date){
			
			$acces = false;
		}		
	}
	
	return $acces;
}
$imgname = $_GET['url'] ;

if ($acces == false){

	$mysqlsearchstring = "";
	foreach ($_SESSION['search'] as $searchplugin) {
		$mysqlsearchstring .=" Type = '".$searchplugin[1]."' OR";
	}
	$mysqlsearchstring = substr($mysqlsearchstring,0,-2);
	
	$PageId = array();
	
	$keyword = mb_strtolower ($imgname);
	$importend = 1;
	$Searchstingadd = " ";
	$Sectie = str_replace("'", " ",$Sectie);
	$Sectie = str_replace("\"", " ",$Sectie);

		$query = "SELECT MainId,Id, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND ($mysqlsearchstring) AND (Naam LIKE '%".$keyword."%')";
		//$query = "SELECT MainId,Id, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND (Type = 'richtext' OR Type = 'photogallery' OR Type = 'form' )AND (Naam SOUNDS LIKE '%".$keyword."%')";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
		//$acces = accesdocument($row['MainId'], $Ids = array(), $_SESSION["Id"]);
		//if ($acces == true){
			preg_match("/\b$keyword\b/",mb_strtolower($row['Naam']), $matches);
			$verschil = (count($matches)*10) +5;
			
			
			$verschil += (substr_count(mb_strtolower($row['Naam']), $keyword) * 10)+5;
			
			
			$verschil = $verschil * $importend;
			
			if ($verschil < 1){
				
			array_push($PageId, array( "Id"=>$row['MainId']));
			}else{
					array_push($PageId, array( "Id"=>$row['MainId']));
			}
		}//}
		$PageIddelete = Array();
		foreach ($_SESSION['search'] as $searchplugin) {
			eval($searchplugin[0]);
		}
		//print_r ($PageId);
		if (count($PageId) > 0){
		if ($SearchString != ""){
			$PageId = multi_unique($PageId);	
		}
		
		
		foreach ($PageId as $themainid) {
			//print_r ($themainid[Id].' ');
			$acces2 = accesdocument2($themainid[Id], $Ids = array());
			if ($acces2 == true){
				$acces = true;
			}
		}
		}
/*
	$imgname = explode("&", $imgname);
	$imgname = explode("?", $imgname[0]);
	$imgname = $imgname[0];

	$result = mysqli_query($link,"SELECT Naam, Parent, Type, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE Publish = 'Public' OR Publish='Parent'");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
			$acces2 = accesdocument2($row['MainId'], $Ids = array());
		
		$returntext="";
		
		if ($acces2 == true){
		if (is_file('../plugins/'.$row['Type'].'/whatisthetext.php')) {	
		
			include '../plugins/'.$row['Type'].'/whatisthetext.php';
			$counter = substr_count ($returntext, $imgname);
			//preg_match("/(.{1,$imgname})\b/", mb_strtolower($returntext), $matches);
			if ($counter > 0) {
				$acces = true;
			}
			if ($acces == true){
				//break;
			}
		}
		}
	}
	*/
}

//echo $acces;
$imgname = '.'.$_GET['url'] ;
//echo $imgname;
if ($acces == true){


$lastModified=filemtime($imgname);
//get a unique hash of this file (etag)
$etagFile = md5_file($imgname);
//get the HTTP_IF_MODIFIED_SINCE header if set
$ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
//get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
$etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);



//check if page has changed. If not, send 304 and exit
if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile)
{
		mysqli_close ($link);
		session_write_close();
      header("HTTP/1.1 304 Not Modified");
       exit;
}else{
//set last-modified header
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//set etag-header
header("Etag: $etagFile");
//make sure caching is turned on
header('Cache-Control: public');

ini_set('memory_limit', '2048M');


$filename = explode("/",$imgname);
$filename = $filename[count($filename)-1];
$filetype = explode(".",$filename);
$filetype = $filetype[count($filetype)-1];

switch($filetype){
      case "pdf": $ctype="application/pdf"; break; 
      case "exe": $ctype="application/octet-stream"; break; 
      case "zip": $ctype="application/zip"; break; 
      case "doc": $ctype="application/msword"; break; 
      case "xls": $ctype="application/vnd.ms-excel"; break; 
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
      case "gif": $ctype="image/gif"; break; 
      case "png": $ctype="image/png"; break; 
      case "jpeg": 
      case "jpg": $ctype="image/jpeg"; break; 
	  case "mp3": $ctype="audio/mpeg";break;
	  case "txt": $ctype="text/plain";break;
      default: $ctype="application/force-download";break; 
}
header("Pragma: public");
header("Content-Type: $ctype");
header("Content-Disposition: inline; filename=\"".$filename."\";" ); 
		mysqli_close ($link);
		session_write_close();	
$fp = fopen($imgname, 'r+b');
$filesize = filesize($imgname);
$cursize = 0;
//set_time_limit(filesize($imgname));
header("Content-Length: ".$filesize );
//fpassthru($fp);

while (!feof($fp)) {
	
	/*if ($cursize + 1024 > $filesize){
		$newbuf = $cursize - $filesize;
		set_time_limit('1000');
		print fread($fp, $newbuf);
		fclose ($fp);
		flush();
		break;
		
		
	}else{*/
		set_time_limit('1000');
		$cursize = $cursize + 1024;
		print fread($fp, 1024);	
		flush();
		
//	}
}



}
}else{
$lastModified=mktime(0, 0, 0, 1, 1, 1971);
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
header("Etag: $etagFile");
//make sure caching is turned on
header('Cache-Control: public');
echo 'acces denied';
}



?>