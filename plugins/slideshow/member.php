<?php
// Init session settings
$found = false;
$acces = false;
if ($type == "select"){	

	$result = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}


	while($row = mysqli_fetch_array($result)){
		
		$acces = $documentinfo["accesdoc"];
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
		$MessageSetting = findMessagesettings($row['MainId'], array());
		if (($theDate = strtotime($row['theDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		
	}
	

$output .=  '

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



function changeval(){	
	
}
function submitform(){
	
	document.form1.submit();
}

</script>';



if (isset($sectie)){
$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		if ($row["Menu"] == 'Horizontal'){
			$menu = 'Horizontal' ;
		}else if($row["Menu"] == 'Vertical'){
			$menu = 'Vertical' ;
		}else{
			$menu = 'Hidden' ;
		}
		$Showtimestamp = $row["Showtimestamp"];
	}}else{
	$menu = 'Vertical' ;
	$Showtimestamp = 1;
	}
	$MainId = $MainIdGroup;
 if ($found == true and $acces==true){
	
		//$output = '<br><br>';

		
		if ($Showtimestamp==1 and $timestampoverrid != -1){$output .= "<i><b>Created:</b> ".date('Y-m-j',$theDate)." <b>Last modified:</b> ".date('Y-m-j',$LastSaved)." <b>Published:</b> ".date('Y-m-j',$PublishDate)."</i><br><br>";}
	
	$ii = 0;
	$numimg=0;
	
	$result2 = mysqli_query($link,"SELECT Id, IdGroup, Theorder, Imageurl, Url FROM slides WHERE IdGroup=".$IdGroup." ORDER BY Theorder");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	//$after .= '<div id="barwidth" style="left:0px;right:0px;"></div>';
	
	$output .=  '<center><div id="slideshow'.$MainId.'"></div></center><script language="javascript">createslideshow("'.$MainId.'",\'slideshow'.$MainId.'\');';
		while($row2 = mysqli_fetch_array($result2)){
			list($theWidth, $theHeight, $asdfthetype, $asdftheattr) = getimagesize($row2["Imageurl"]);
		$size=getimagesize($row2["Imageurl"]);
		switch($size["mime"]){
        case "image/jpeg":
		//	echo'jpg';
		  $exif = exif_read_data($row2["Imageurl"]);
	 
	        //get the orientation
	        $ort = $exif['Orientation'];
	 
	        //determine what oreientation the image was taken at
	        switch($ort)
	        {   
				case 5: // vertical flip + 90 rotate right
				case 6: // 90 rotate right 			 
            case 7: // horizontal flip + 90 rotate right 
            case 8: // 90 rotate left
				$tmp = $theWidth;
				$theWidth = $theHeight;
				$theHeight=$tmp;  
                break;
       }
		break;
		}
			array_push($_SESSION['Accesfiles2'], $row2["Imageurl"]);
			array_push($_SESSION['Accesfiles2'], $row2["Url"]);
			$output .=  'window.slideshows[\''.$MainId.'\'].slides.push(addslidetoshow(\''.$row2["Url"].'\',\''.$row2["Imageurl"].'\',\''.$theWidth.'\',\''.$theHeight.'\'));';
		}
		//session_write_close();
		
		$output .=  'loadslider(\''.$MainId.'\');</script>';
		
	if ($documentinfo["accesmsg"] == true){		
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroup;
			$msgtype = "photogallery";
		}
		
		

	
} elseif ($found == true and $acces == false){

		$Naam = 'acces denied';
		$output = "";
		if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
		
		}else{
		$output .= '
		<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
		}	
}else{
	$Naam = '';
	$output = "";
	if ($type == "select") {
		$Naam = 'Page not found';
		$output .= 'The page you try to acces is not found, try another Language. Pleas select the Language from the language menu ';
	}
}
 }

?>
