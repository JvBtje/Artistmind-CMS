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
function submitform(){	
	document.form1.submit();
}
</script>';

	
$found = false;
$acces = false;
if ($type == "select"){
	
	$resultb11 = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$resultb11) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($rowb11 = mysqli_fetch_array($resultb11)){		
		$acces = $documentinfo["accesdoc"];
		
		$foundb11 = true;
		$Naamb11 = $rowb11['Naam'];
		$Parentb11 = $rowb11['Parent'];
		$IdGroupb11 = $rowb11['Id'];
		$MainIdGroupb11 = $MainId;
		$MainIdb11 = $rowb11['targetmainid'];
		$MessageSettingb11 = findMessagesettings($rowb11['MainId'], array());
		if (($theDate = strtotime($rowb11['theDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($rowb11['LastSaved'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($rowb11['PublishDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		$output .= "De string ($str) is niet geldig";
		}

		$queryb12 = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$MainIdGroupb11.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$resultb12 = mysqli_query($link,$queryb12);
		if (!$resultb12) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($rowb12 = mysqli_fetch_array($resultb12)){
			$outputmixed = loadinnerpage ($rowb12["MainId"], $rowb12["Type"], $documentinfo,$type,$link);			
			$output .= $outputmixed["output"];
			$after .=  $outputmixed["after"];
		}
		//$timestampoverrid = 1;
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


if ($foundb11 == true and $acces == true){
if ($Showtimestamp==1 and $timestampoverrid != -1){$output = "<i><b>Created:</b> ".date('Y-m-j',$theDate)." <b>Last modified:</b> ".date('Y-m-j',$LastSaved)." <b>Published:</b> ".date('Y-m-j',$PublishDate)."</i><br><br>".$output; }
	$Naam = $Naamb11;

		if ($documentinfo["accesmsg"] == true){
		//$output .='<h2>Reply\'s</h2>';
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroupb11;
			$msgtype = "richtext";
		}
		//$output .= '<br><br>';
		
} elseif ($foundb11 == true and $acces == false){

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
