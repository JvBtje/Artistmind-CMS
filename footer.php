
<?php
if ($_SESSION['Themeoverride'] == ""){
	include $_SESSION['Theme']."footert.php";
}else{
	include $_SESSION['Themeoverride']."footert.php";
}
/*echo '
<textarea id="outputhtml">

</textarea>';*/



?>