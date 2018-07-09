<?php
$theMainId = $row['MainId'];
$targetMainId =$row['targetmainid'];


if (isset($returntext)){

}else{
	$returntext = "";
}
$returntext = "";
if (isset($Predirwhattext)){

}else{
	$Predirwhattext = "";
}
$queryb12 = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$theMainId.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
$resultb12 = mysqli_query($link,$queryb12);
if (!$resultb12) {
	die('Query failed: ' . mysqli_error($link));
}

while($rowb12 = mysqli_fetch_array($resultb12)){
	$returntext .= gettextinnerpagetext ($rowb12["MainId"], $rowb12['targetmainid'], $rowb12["Id"], $rowb12["Type"], $link,$Predirwhattext);
}	
$row['MainId']= $theMainId;
$row['targetmainid'] =$targetMainId;

?>