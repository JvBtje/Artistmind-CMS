<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
 header("Cache-Control: max-age=0, no-cache, no-store");

include('../../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>Logged in</stat>';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM menumember WHERE Language =".$_SESSION['Language']." ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
	echo '<menuitem id="'.$row['Id'].'" mainid="'.$row['MainId'].'">'.json_encode(mb_convert_encoding($row['Naam'], "UTF-8"),JSON_UNESCAPED_UNICODE);

	echo '</menuitem>  ';
	}

echo '</lijst>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
mysqli_close ($link);
?>