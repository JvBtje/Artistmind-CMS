<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}	
header ("content-type: text/xml; charset=utf-8");

	echo '<?xml version="1.0" encoding="UTF-8"?><lijst><groepen>';

	foreach ($_SESSION['Messages'] as &$Message)
		{	
			$timeleft = intval( (($Message[Date]-microtime(true) )*1000) + 15000);
			
			if ($timeleft > 0){
			echo '<messageitem timeleft="'.$timeleft.'" ><![CDATA[
			'.$Message[html].'
			]]>';
		
			
			echo'</messageitem>';
			
			
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


echo '</groepen></lijst>';
?>