<?php

session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

include('../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");

header ("content-type: text/xml; charset=utf-8");

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
echo '<stat>Logged in</stat>';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
	echo '<menuitem id="'.$row['Id'].'" mainid="'.$row['MainId'].'">'.mb_convert_encoding($row['Naam'], "UTF-8");
					

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