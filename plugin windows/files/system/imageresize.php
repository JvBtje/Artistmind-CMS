<?php
ini_set('memory_limit', '2048M');
//include("checksession.php");
session_start();
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
 // het is niet handig om de grootte mee te geven maar voor test doeleinden wel
include "userdir.php";$userdir = '../../.'.$userdir;
function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}
function open_image ($file,$size) {
    //detect type and process accordinally
    global $type;
    
    switch($size["mime"]){
        case "image/jpeg":
            $im = imagecreatefromjpeg($file); //jpeg file
        break;
        case "image/gif":
            $im = imagecreatefromgif($file); //gif file
      break;
      case "image/png":
          $im = imagecreatefrompng($file); //png file
      break;
    default: 
        $im=false;
    break;
    }
    return $im;
}

	$inputdir = removeupdir($_POST['image'] );

	$imgname = $userdir .$inputdir;
if (isset ($_POST['width'])){
	$Maxsize = $_POST['width'];
} else {
	$Maxsize = 50;
}


$error=false;
$size=getimagesize($imgname);
$image_type = $size["mime"];
list($width, $height) = getimagesize($imgname);
$img = open_image ($imgname, $size);

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
    if ($percent > 1){$error = true;}	
    //De nieuwe hoogte berekenen aan de gegevens van het oude plaatje en de doel breedte
    
    //Zeggen dat dit bestand een plaatje is
    header('content-type: image/jpeg'); 
    if ($error == false){
    
    
    
    //een nieuw klein plaatje maken met de gewenste grootte
    $destination = imagecreatetruecolor($newwidth, $newheight);
    
    //Het nieuwe plaatje vullen met verkleinde plaatje
    imagecopyresampled($destination, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    //Het plaatje opslaan
	if( $image_type == "image/jpeg" ) {
        imagejpeg($destination,$imgname,75);
      } elseif( $image_type == "image/gif" ) {
         imagegif(destination,$imgname);         
      } elseif( $image_type == "image/png" ) {
        imagepng($destination,$imgname);
      }   
  //  imagejpeg($destination,$_GET['image'],75);
//imagepng($destination,$_GET['image'],75);

    //Het bronplaatje verwijderen
    imagedestroy($img);
    
    //Het doelplaatje verwijderen
    imagedestroy($destination); 
	echo "Image is resized ".$_POST['image'] ." size: ".$_POST['width'];
	echo '<script type = "text/JavaScript">self.close();</script>';
	}
}
else
{
    echo "Er is geen plaatje meegegeven";
}

?> 
