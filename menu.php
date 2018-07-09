<?php
if ($_SESSION['Themeoverride'] == ""){
	
	if ($_SESSION['TypeUser'] == 'Admin' and $_SESSION['Menu'] == "Admin"){
		include "menuadmin.php";
	}else if ( $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ){
		if ($_SESSION['Menu'] == "User"){
			include $_SESSION['Theme']."menumembert.php";
		}else{
			include $_SESSION['Theme']."menut.php";
		}
	}else{		
		include $_SESSION['Theme']."menut.php";
	}
}else{
	if ($_SESSION['TypeUser'] == 'Admin' and $_SESSION['Menu'] == "Admin"){
		include "menuadmin.php";
	}else if ( $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ){
		if ($_SESSION['Menu'] == "User"){
			include $_SESSION['Themeoverride']."menumembert.php";
		}else{
			include $_SESSION['Themeoverride']."menut.php";
		}
	}else{
		include $_SESSION['Themeoverride']."menut.php";
	}
}
$_SESSION['Themeoverride'] = "";
?>

