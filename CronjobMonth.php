<?php
// Init session settings
include("DB.php");



$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
//mysql_select_db($Db, $link) or die('Could not select database.');
session_start();
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
include("system/include.php");
	$url = curPageURL();
	$myUrl = explode("/", curPageURL());
if ($_SESSION['newsessionany'] != 10 ){

	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">';

$root = scandir('./plugin cronjobs'); 
	/*$query = "SELECT RedirectLogin, RedirectIndex, Redirect404, Redirect400, Redirect401, Redirect403, Redirect500 FROM system";
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		$_SESSION['error404'] = $row["Redirect404"]  ; 		
	}*/
	foreach($root as $value)
	{ 
	
		if ($value != ".."){
			if (is_file('./plugin cronjobs/'.$value.'/month.php')) {
			
				include('./plugin cronjobs/'.$value.'/month.php');
			}
		}
	} 

mysqli_close ($link);

session_write_close();

?>