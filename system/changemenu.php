<?php
session_start();
$Menu = $_POST["Menu"];

if ($Menu == "Admin"){
	$_SESSION['Menu'] = "Admin";
}else if ($Menu == "User" or $Menu == "Member"){
	$_SESSION['Menu'] = "User";
}else{
	$_SESSION['Menu'] = "Public";
}

?>