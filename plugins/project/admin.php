<?php
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
$output .='
<script language="javascript">
function ConfirmDelete(theId) 
{ 
answer = confirm("Weet u zeker dat u dit project wilt verwijderen")
if (answer !=0) 
{ 
location = "indexadminnew.php?plugin=project&type=delete&sectie='.$sectie.'&Id=" + theId 
} 
</script>
	</header>';



if ($type=="new_Language"){
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td>';$output .=include "./system/newitem.php";$output .= '</td>
			</tr>
			<tr>
				
				<td>';
$output .= '<form action="indexadminnew.php?plugin=project&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on"><table>
		
		</td></tr></table><div id="buttonlayout">
	$output .= '</td>
			</tr>
		</table>';
}elseif ($type=="delete"){
$result = mysqli_query($link,"SELECT Id, MainId FROM projecten WHERE MainId=".$MainId );
}elseif ($type=="select"){
	
			</tr>
			<tr>
			
				<td>';
	
		
	<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="45" border="0" onChange="changeval();"></td></tr>			
		$output .= '</form></td></tr></table>';
}else if ($type=="save"){
	$Id = $_POST["Id"];
	$Naam = $_POST["Naam"];
	$Omschrijving = $_POST["Omschrijving"];
	$Order = $_POST["Order"];
	$Parent = intval($_POST["parentid"]);
	$Id= str_replace("'", " ", $Id);
	$Id= str_replace('"', " ", $Id);
	$Id = str_replace("\\", "\\\\", $Id);
	$Naam= str_replace("'", " ", $Naam);
	$Naam= str_replace('"', " ", $Naam);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Omschrijving = str_replace("'", " ", $Omschrijving);
	$Omschrijving = str_replace('"', " ", $Omschrijving);
	$Omschrijving = str_replace("\\", "\\\\", $Omschrijving);
	$Order= str_replace("'", " ", $Order);
	$Order= str_replace('"', " ", $Order);
	$Order = str_replace("\\", "\\\\", $Order);
	$language = str_replace("\\", "\\\\", $language);
	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
			
	if ($Id == "new"){
	}else{
		mysqli_query($link,"UPDATE projecten SET Omschrijving = '$Omschrijving', uurtarief = '$uurtarief' WHERE Id = '$Id'") or die(mysqli_error($link)); 
	}
	$result = mysqli_query($link,"SELECT MainId FROM groepen WHERE Id=".$IdGroup);
	//$message="Project saved";
	
	
}else {
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td>';$output .=include "./system/newitem.php";$output .= '</td>
			</tr>
			<tr>
				
				</table>';
}
?>