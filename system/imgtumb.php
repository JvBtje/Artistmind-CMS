<?php
	include("../DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
session_start();

$acces = false;
include "include.php";
$fullimgurl = curPageURL();
 //$fullimgurl .= "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
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

$_SESSION['search'] = $searchplug;


include "../plugin windows/files/system/userdir.php";
$imgname = $_GET['url'] ;
$thefiletype = explode(".", $_GET['url']);

$pos = strpos($imgname, '/uploads/');
//echo mb_strtolower ($thefiletype[2]);
// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos === false) {
	switch (mb_strtolower ($thefiletype[2])){
	case "jpg":
	case "png":
	case "gif":
	case "jpeg":
	
    $acces = true;
	break;
	}
}

if ( $_SESSION['TypeUser'] == 'Admin'){
	$acces = true;
}
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator'){
	$strlenght = strlen($userdir);
	$userdir2 = substr($imgname, 0, $strlenght);
	
	if (trim ($userdir2) == trim ($userdir)){
		$acces = true;
	}
}
$imgname = $_GET['url'] ;

if (isset($_SESSION['Accesfiles2'])){
foreach ($_SESSION['Accesfiles2'] as &$File)
		{	
			if ($File == $imgname){
				$acces = true;
				
			}
		}
		
	}	
//print_r($_SESSION['Accesfiles2']);

$imgname = $_GET['url'] ;

function accesdocument2($Parent, $Ids = array() ){
		global $link;
		$acces2 = false;
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
						$acces2 = accesdocument2($row["Parent"], $Ids);
						
					}else{
						$acces2 = "in a loop";
					}
				}
			}else if($row["Publish"] == "No"){
				
			}else if($row["Publish"] == "Public"){
				$acces2 = true;
			}
		include ('timezone.php');
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		//echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		//echo "De string ($str) is niet geldig";
		} 
			
		if ($PublishDate > $todays_date){
			
			$acces2 = false;
		}		
	}
	
	return $acces2;
}
//$acces = true;

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
	//echo $imgname;
	$result = mysqli_query($link,"SELECT Naam, Parent, Type, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE Publish = 'Public' OR Publish='Parent'");
	if (!$result) {
    	die('Query failed2: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$acces2 = accesdocument2($row['MainId'], $Ids = array());
		
		$returntext="";
		
		if ($acces2 == true){
		if (is_file('../plugins/'.$row['Type'].'/whatisthetext.php')) {	
		
			include '../plugins/'.$row['Type'].'/whatisthetext.php';
			$counter = substr_count ($returntext, $imgname);
			//echo $returntext;
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

	
$imgname = $_GET['url'] ;
if (substr(trim($_GET['url']), 0, 4) == "http" or substr(trim($_GET['url']), 0, 4) == "https" ){
$imgname = explode("/uploads/", $_GET['url']);
	$imgname = '../uploads/'.$imgname[1];
	
}else{
	//$imgname = '../'.$_GET['url'] ;
	$imgname = explode("/uploads/", $_GET['url']);
	$imgname = '../uploads/'.$imgname[1];
}

$imgname = '.'.$_GET['url'] ;
//$acces = true;
if ($acces == true){

$lastModified=filemtime($imgname);
//get a unique hash of this file (etag)
$etagFile = md5_file($imgname);
//get the HTTP_IF_MODIFIED_SINCE header if set
$ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
//get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
$etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//set etag-header
header("Etag: $etagFile");
//make sure caching is turned on
header('Cache-Control: public');

//check if page has changed. If not, send 304 and exit

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile)
{
			mysqli_close ($link);
		session_write_close();
    header("HTTP/1.1 304 Not Modified");
   exit;
} 
//set last-modified header

if (file_exists ($imgname)){
 $fullimgurl = explode("imgtumb.php",$fullimgurl);
 $fullimgurl = $fullimgurl[1];
 $fullimgurl = str_replace ( "?", "uh", $fullimgurl);
 $fullimgurl = str_replace ( "&", "and", $fullimgurl);
 $fullimgurl = str_replace ( ".", "dot", $fullimgurl);
 $fullimgurl = str_replace ( "/", "slash", $fullimgurl);
 $fullimgurl = str_replace ( "\\", "bslash", $fullimgurl);
 $fullimgurl = str_replace ( ":", "dbpnt", $fullimgurl);
 $size=getimagesize($imgname);
 
 switch($size["mime"]){
    case "image/jpeg":
		$fullimgurl = "./imgtumbcache/$fullimgurl.jpg";
		break;
		
	default:
		$fullimgurl = "./imgtumbcache/$fullimgurl.png";
		break;
}

function open_image ($file,$size) {
    //detect type and process accordinally
    
	//list($width, $height) = $size;

    switch($size["mime"]){
        case "image/jpeg":
            $im = imagecreatefromjpeg($file); //jpeg file
        break;
        case "image/gif":
            $im = imagecreatefromgif($file); //gif file
      break;
      case "image/png":
		$im = imagecreatefrompng($file);
		
		 
      break;
    default: 
        $im=false;
    break;
    }

    return $im;
}
$cachedupdate = false;
if (file_exists ($fullimgurl)){
	if (fileatime ($fullimgurl)	> fileatime ($imgname) ){
		$cachedupdate = true;
	}
}
if ($cachetumb === false){
	$cachedupdate = false;
}
if ($cachedupdate == true){
	$sizecach=getimagesize($fullimgurl);
	switch($sizecach["mime"]){
    case "image/jpeg":
		case "jpg": $ctype="image/jpeg"; break; 
		
		break;
		
	default:
		 case "png": $ctype="image/png"; break; 
		
		break;
	}

header("Pragma: public");
header("Content-Type: $ctype");
	
$fp = fopen($fullimgurl, 'rb');
//set_time_limit(filesize($imgname));
header("Content-Length: ".filesize($fullimgurl));
//fpassthru($fp);

while (!feof($fp)) {
	set_time_limit('1000');
	print fread($fp, 1024);
	flush();
}

fclose ($fp);

}else{
 mysqli_close ($link);
session_write_close();
ini_set('memory_limit', '2048M');
if (isset ($_GET['maxsize'])){
	$Maxsize = $_GET['maxsize'];
} else {
	$Maxsize = 50;
}

if (isset ($_GET['square'])){
	if ($_GET['square'] == 1){
		$aspectratio = 1;
	}
	//$square = intval($_GET['square']);
} else if (isset ($_GET['aspectratio'])){
	$aspectratio = $_GET['aspectratio'];
}

// create the image

function get_data($url) {
	$ch = curl_init();
	$timeout = 60;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}



list($width, $height) = getimagesize($imgname);
$img = open_image ($imgname, $size);
$fileaspectratio = $height/$width;

	
	if (isset($aspectratio)){
		if ($fileaspectratio > $aspectratio){
			if ($aspectratio > 1){
				$newwidth = $Maxsize / $aspectratio;
				$newheight = $Maxsize;
				$left = 0;
				$top = (($height * $fileaspectratio)- ($height * $aspectratio)) /4;
				$height = $width * $aspectratio;
				//$height = $height - (($height * $fileaspectratio)- ($height * $aspectratio))/3;
			}else{			
				$newwidth = $Maxsize;
				$newheight = $newwidth * $aspectratio;
				$left = 0;
				$top = (($height * $fileaspectratio)- ($height * $aspectratio)) /4;
				$height = $width * $aspectratio;
				//$height = $height - (($height * $fileaspectratio)- ($height * $aspectratio))/3;
			}
		}else{
			if ($aspectratio > 1){
				$newwidth = $Maxsize / $aspectratio;
				$newheight = $Maxsize;
				$left = (($width * $aspectratio)- ($width * $fileaspectratio)) /4;
				$top = 0;
				$width = $height / $aspectratio;
				//$width = $width - (($width * $aspectratio)- ($width * $fileaspectratio))/3;
			}else{			
				$newwidth = $Maxsize;
				$newheight = $newwidth * $aspectratio;
				$left = (($width * $aspectratio)- ($width * $fileaspectratio)) /4;
				$top = 0;
				$width = $height / $aspectratio;
				//$width = $width -(($width * $aspectratio)- ($width * $fileaspectratio))/3;
			}
			
		}
	}else{
		if ($height > $width){
			$percent = $Maxsize / $height ;
			$left = 0;
			$top = 0;
			$newwidth = $width * $percent;
			$newheight = $height * $percent;
		}else {	
			$percent = $Maxsize / $width ;
			$left = 0;
			$top = 0;
			$newwidth = $width * $percent;
			$newheight = $height * $percent;
		}
	}



// send the content type header so the image is displayed properly
switch($size["mime"]){
    case "image/jpeg":
		header('Content-type: image/jpeg');
		break;
		
	default:
		header('Content-type: image/png');
		break;
}
	$image = imagecreatetruecolor($newwidth , $newheight );
	imagesavealpha($image, true);
    $trans_colour = imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagefill($image, 0, 0, $trans_colour);
	
//if ($Maxsize < 300){
	//imagecopyresized($image, $img, 0, 0, $left, $top, $newwidth, $newheight, $width, $height);
//}else{
	imagecopyresampled($image, $img, 0, 0, $left, $top, $newwidth, $newheight, $width, $height);
//}



switch($size["mime"]){
        case "image/jpeg":
	    
			imagesetinterpolation($image, IMG_MITCHELL);
	        //fix photos taken on cameras that have incorrect
	        //dimensions
	        $exif = exif_read_data($imgname);
	 
	        //get the orientation
	        $ort = $exif['Orientation'];
	 
	        //determine what oreientation the image was taken at
	        switch($ort)
	        {
	 
	            case 2: // horizontal flip
	 
	                $image = ImageFlipasdf($image);
	 
	                break;
	 
	            case 3: // 180 rotate left
	 
	                $image = imagerotate($image, 180, 0);
	 
	                break;
	 
	            case 4: // vertical flip
	 
	                $image = ImageFlipasdf($image);
	 
	                break;
	 
	            case 5: // vertical flip + 90 rotate right
	 
	                $image = ImageFlipasdf($image);
	 
	                $image = imagerotate($image, -90, 0);
	 
	                break;
	 
	            case 6: // 90 rotate right
 
                $image = imagerotate($image, -90, 0);
				
	                break;	 
            case 7: // horizontal flip + 90 rotate right

               $image = ImageFlipasdf($image);
 
               $image = imagerotate($image, -90, 0);
               break;
 
            case 8: // 90 rotate left

                $image = imagerotate($image, 90, 0);

                break;
 
       }
		break;
		}
// use white as the background image
//$bgColor = imagecolorallocate ($image, 255, 255, 255); 




// $fullimgurl ="test";
// send the image to the browser
switch($size["mime"]){
    case "image/jpeg":
		imagejpeg($image);
		imagejpeg($image, $fullimgurl);
		break;
		
	default:
		imagepng($image);
		imagepng($image, $fullimgurl);
		break;
}

// destroy the image to free up the memory
imagedestroy($image);
imagedestroy($img);
}
}else{
	header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
	header('Pragma: no-cache'); // HTTP 1.0.
	header('Expires: 0'); // Proxies.
	echo '404 acces denied or 403 not found';
}
}else{
	header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
	header('Pragma: no-cache'); // HTTP 1.0.
	header('Expires: 0'); // Proxies.
	echo '404 acces denied or 403 not found';
}

?>