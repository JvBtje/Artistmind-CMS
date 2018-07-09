<?php
// Init session settings
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("./system/include.php");
session_start();
$query = "SELECT RedirectLogin, RedirectIndex, Redirect404, Redirect400, Redirect401, Redirect403, Redirect500 FROM system";
$result = mysqli_query($link,$query);
if (!$result) {
	die('Query failed: ' . mysqli_error($link));
}
while($row = mysqli_fetch_array($result)){
	header( 'Location: '.$row["Redirect400"] ) ; 
	exit;
}
?>