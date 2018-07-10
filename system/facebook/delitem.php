<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
header ("content-type: text/xml; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
include "../plugin windows/files/system/userdir.php";
$totalfile= $_POST["totalfile"];

function cleardir($filename)
{
	foreach (scandir($filename) as $item) {
   	 	if ($item == '.' || $item == '..') continue;
	if(is_dir ($filename.DIRECTORY_SEPARATOR.$item)){;
		cleardir($filename.DIRECTORY_SEPARATOR.$item);
	}else{
		unlink($filename.DIRECTORY_SEPARATOR.$item);
	}
    	unlink($filename.DIRECTORY_SEPARATOR.$item);
	}
	rmdir($filename);
}

echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>file deleted</stat>';
echo '<totalfile>'.$totalfile.'</totalfile>';
for($i=1;$i<$totalfile+1;$i++)
{
	$filename = $userdir . DIRECTORY_SEPARATOR. $_POST["file".$i];

	if(is_dir ($filename)){;
		cleardir($filename);
	}else{
		unlink($filename);
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