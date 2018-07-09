<?php

$output .= '


<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";


function domultifilemanager (link){
	
	if (window.elementvar.substr(0,3) == "msg"){
		for (var iaddfi=0;iaddfi<link.length;iaddfi++)
		{			
			addmsgnewfile(link[iaddfi],window.elementvar)			
		}
	
		hidefilemanager();
	
	}else{
		alert ("You can only add 1 file at this item");
	}
}
function dofilemanager(link){	
	if (window.elementvar.substr(0,3) == "msg"){
		
		addmsgnewfile(link,window.elementvar)
	}else{
		document.getElementById(window.elementvar).value = link;
	}
	hidefilemanager();
}
function showfilemanager(elementvar){
	newpath = \'./plugin windows/files/itemenfile.php\';
	if (document.getElementById(\'filelinker\').src.substring(document.getElementById(\'filelinker\').src.length-10,document.getElementById(\'filelinker\').src.length) == "blank.html"){
		document.getElementById(\'filelinker\').src = newpath;
	}
	
	window.elementvar = elementvar;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'filemanager\').style.display = \'block\';
}
function hidefilemanager(){	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'filemanager\').style.display = \'none\';
}
</script>
<script language="javascript">
window.galleryimages = new Array();


function changeval(){	
	
}


</script>';

	
//if (isset($bararray)){
//	$bararray = array();
//}

$found = false;
$acces = false;
if ($type == "select"){
	
	$resultc12 = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$resultc12) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($rowc12 = mysqli_fetch_array($resultc12)){		
		$acces = $documentinfo["accesdoc"];
		
		$foundc12 = true;
		$Naamc12 = $rowc12['Naam'];
		$Parentc12 = $rowc12['Parent'];
		$IdGroupc12 = $rowc12['Id'];
		$MainIdGroupc12 = $MainId;
		$MainIdc12 = $rowc12['targetmainid'];
		//$bararray[$MainIdGroupc12] = array();
		$MessageSettingc12 = findMessagesettings($rowc12['MainId'], array());
		if (($theDate = strtotime($rowc12['theDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($rowc12['LastSaved'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($rowc12['PublishDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		$output .= "De string ($str) is niet geldig";
		}
		$output .= '<div id="bar" class="bar"><div id="bar'.$MainIdGroupc12.'" ><script>if (window.thebars == null || window.thebars == undefined){window.thebars=Array();}window.thebars.push("bar'.$MainIdGroupc12.'")</script>';
		$queryc12 = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$MainIdGroupc12.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$resultc12 = mysqli_query($link,$queryc12);
		if (!$resultc12) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($rowc12 = mysqli_fetch_array($resultc12)){
			$outputmixed = loadinnerpage ($rowc12["MainId"], $rowc12["Type"], $documentinfo,$type,$link);			
			$output .= $outputmixed["output"];
			$after .=  $outputmixed["after"];
		}
		$output .= '<div id="barwidth"></div></div></div>';
		
	}
}



if (isset($sectie)){
$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Showtimestamp = $row["Showtimestamp"];
	}}else{
	//$menu = 'Vertical' ;
	$Showtimestamp = 1;
	}


$MainId = $MainIdGroup;


if ($foundc12 == true and $acces == true){

	$Naam = $Naamc12;
	$after .= '<div id="barscrollwidth" style="left:0px;right:0px;"></div>';
		if ($documentinfo["accesmsg"] == true){
		//$output .='<h2>Reply\'s</h2>';
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroupc12;
			$msgtype = "richtext";
		}
		//$output .= '<br><br>';
		
} elseif ($foundc12 == true and $acces == false){

		$Naam = 'acces denied';
		$output2 = "";

		$output = '
		<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
		
}else{
	$Naam = '';
	$output2 = "";
	if ($type == "select") {
		$Naam = 'Page not found';
		$output = 'The page you try to acces is not found, try another Language. Pleas select the Language from the language menu ';
	}
}

?>
