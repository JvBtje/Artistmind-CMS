<?php

session_start();
$acces = false;
include "../plugin windows/files/system/userdir.php";
$imgname = $_POST['url'] ;

if ($_SESSION['TypeUser'] == 'Admin'){
	$acces = true;
}
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator'){
	$strlenght = strlen($userdir);
	$userdir2 = substr($imgname, 0, $strlenght-1);
	
	if ('.'.$userdir2 == $userdir){
		$acces = true;
	}
}
if (isset($_SESSION['Accesfiles2'])){
foreach ($_SESSION['Accesfiles2'] as &$File)
		{	
			if ($File == $imgname){
				$acces = true;
			}
		}
		
	}	
if (substr(trim($_GET['url']), 0, 4) == "http" or substr(trim($_GET['url']), 0, 4) == "https" ){
$imgname = explode("/uploads/", $_POST['url']);
	$imgname = '../uploads/'.$imgname[1] ;
}else{
	$imgname = '../'.$_POST['url'] ;
}
//echo $acces;
//$imgname = '.'.$_POST['url'] ;

if ($acces == true){

$lastModified=filemtime($imgname);
//get a unique hash of this file (etag)
//$etagFile = md5_file($imgname);
//get the HTTP_IF_MODIFIED_SINCE header if set
$ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
//get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
$etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);



//check if page has changed. If not, send 304 and exit

//set last-modified header
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//set etag-header
header("Etag: $etagFile");
//make sure caching is turned on
header('Cache-Control: public');

if (file_exists($imgname)){
	//echo $imgname;
	
	$size=getimagesize($imgname);
	
	list($theWidth, $theHeight) = getimagesize($imgname);
	switch($size["mime"]){
        case "image/jpeg":
		//	echo'jpg';
		  $exif = exif_read_data($imgname);
	 
	        //get the orientation
	        $ort = $exif['Orientation'];
	 
	        //determine what oreientation the image was taken at
	        switch($ort)
	        {
	 
	            case 2: // horizontal flip
	 
	                //$image = ImageFlip($image);
	 
	                break;
	 
	            case 3: // 180 rotate left
	 
	                //$image = imagerotate($image, 180, -1);
	 
	                break;
	 
	            case 4: // vertical flip
	 
	                //$image = ImageFlip($image);
	 
	                break;
	 
	            case 5: // vertical flip + 90 rotate right
				
	 		
	 
	                
	 
	            case 6: // 90 rotate right
 			 
            case 7: // horizontal flip + 90 rotate right
			
 
            case 8: // 90 rotate left
		//	echo 'switch';
				$tmp = $theWidth;
				$theWidth = $theHeight;
				$theHeight=$tmp;
             

                break;
 
       }
		break;
		}
		
	echo $theWidth."-".$theHeight;
}else{
	echo 'file not found';
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
