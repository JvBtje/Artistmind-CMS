<?php 
include ('./system/timezone.php');
echo '<script type="text/javascript">
function changeOpac(opacity, id) {
	
    var object = document.getElementById(id).style;
    object.opacity = (opacity / 100);
    object.MozOpacity = (opacity / 100);
    object.KhtmlOpacity = (opacity / 100); 	
    object.filter = "alpha(opacity=" + opacity + ")";
}

function fademessage(theMessage){
	var curalpha = parseFloat(document.getElementById(theMessage).style.opacity);	
	curalpha = parseFloat((curalpha - 0.01)*100);	
	changeOpac(curalpha, theMessage);
	
	if (parseFloat(curalpha) > 0){
		setTimeout("fademessage(\'"+theMessage+"\')",30);
	}else{
		document.getElementById(theMessage).style.display="none";
		
	}	
}




</script>';
echo '<div id="Messagebox">';
		$i=0;
		foreach ($_SESSION['Messages'] as &$Message)
		{	
			$timeleft = intval( (($Message[Date]-microtime(true) )*1000) + 15000);
			
			if ($timeleft > 0){
			echo '<div id="Message'.$i.'" style="opacity:1;">';
			echo '<div id="Message">';
			echo $Message[html];
			echo'</div></div><br>';
			
			echo '<script type="text/javascript">
			
			setTimeout("fademessage(\'Message'.$i.'\')", '.$timeleft.');
			</script>';
			$i++;
			} 
		}
		foreach ($_SESSION['Messages'] as &$Message)
		{	
			$timeleft = intval( (($Message[Date]-microtime(true) )*1000) + 15000);
			
			if ($timeleft > 0){
			
			} else {
				 array_shift($_SESSION['Messages']);
			}
		}
echo '</div>';
if ($_SESSION['Themeoverride'] == ""){
	include $_SESSION['Theme']."headert.php";
}else{
	include $_SESSION['Themeoverride']."headert.php";
}
?>