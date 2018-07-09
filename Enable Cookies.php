<?php
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("system/include.php");

session_start();
header("Cache-control: private"); 

if ($_SESSION['newsessionany'] != 10 ){
	$url = curPageURL();
	$myUrl = explode("/", curPageURL());
	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}
// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
// header settings
// header
$_SESSION['Cookie'] = true;
echo '<body><script type="text/javascript">history.go(-1)
</script></body>';
?>
