<?php
session_start();
$userdir = "./uploads/";
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator'){	
		$userdir = './uploads/users/'. $_SESSION['Id'].'/';
}


?>