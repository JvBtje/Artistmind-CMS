<?php	
session_start ();
$_SESSION['TypeUser'] = false;
session_destroy();
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("./system/include.php");
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

$message = "You are logged out.";
array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
mysqli_close ($link);
header( 'Location: index.php' ) ; 
exit;

?>