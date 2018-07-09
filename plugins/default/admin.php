<?php
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
$output = "";




$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td>';$output .= include "./system/newitem.php";
$output .= '</td>
			</tr>
			<tr>
				
				<td>';
				
				$output .='</td></tr></table>';


}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
