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
	
	$result = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){

		//print_r ($documentinfo);
		$acces = $documentinfo["accesdoc"];
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
		$MessageSetting = findMessagesettings($row['MainId'], array());
		if (($theDate = strtotime($row['theDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		if (($todays_date = strtotime($todays_date)) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
	}
	
$query = "SELECT NumCol,ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, DATE_FORMAT(TheDate, '%d-%c-%Y %H:%i:%s') AS TheDate  FROM richtext WHERE MainId =".$MainId." AND Language =".$_SESSION['Language'];
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		//$Id = $Idgroup;
		$NumCols = intval($row['NumCol']);
		$ColWidth = intval($row["ColWidth"]);
		$ColHeigth = intval($row["ColHeigth"]);
		
		$LargText = array();	
		$LargText[1] = $row['LargText'];
		$LargText[2] = $row['Largtext2'];
		$LargText[3] = $row['Largtext3'];
		$LargText[4] = $row['Largtext4'];
		$LargText[5] = $row['Largtext5'];
		$LargText[6] = $row['Largtext6'];
		
		$bg = array();	
		$bg[1] = $row['Largtext1bg'];
		$bg[2] = $row['Largtext2bg'];
		$bg[3] = $row['Largtext3bg'];
		$bg[4] = $row['Largtext4bg'];
		$bg[5] = $row['Largtext5bg'];
		$bg[6] = $row['Largtext6bg'];
		
		$output2 = "";
		
		if ($acces == true){
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[1], $theurl);
			//$output .=  "counter".count($theurl[0]);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[1], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[1], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[2], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[2], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[2], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[3], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[3], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[3], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[4], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[4], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[4], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[5], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[5], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[5], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
			preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$LargText[6], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
			}
			preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$LargText[6], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
			}
			preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$LargText[6], $theurl);
			for($i=0;$i<count($theurl[0]);$i++){		
				array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
			}
		}
		$LargText[1] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		$LargText[1] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		$LargText[1] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		$LargText[2] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[2]);
		$LargText[2] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[2]);
		$LargText[2] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[2]);
		$LargText[3] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[3]);
		$LargText[3] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[3]);
		$LargText[3] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[3]);
		$LargText[4] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[4]);
		$LargText[4] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[4]);
		$LargText[4] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[4]);
		$LargText[5] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[5]);
		$LargText[5] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[5]);
		$LargText[5] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[5]);
		$LargText[6] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[6]);
		$LargText[6] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[6]);
		$LargText[6] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[6]);
		
		
		
		$LargText[1] = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		$LargText[1] = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		$LargText[1] = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $LargText[1]);
		
		if ($NumCols == 1){
			$output2 =$output2. '<div style="background:'.$bg[$i+1].';">'.$LargText[$i+1]."</div>";
		}else{
			 $output2 =$output2.  '<div style="-webkit-column-count: auto; -moz-column-count: '.$NumCols.'; column-count: auto; -webkit-column-width: '.$ColWidth.'px; -moz-column-width: '.$ColWidth.'px; column-width: '.$ColWidth.'px; " >';
			for ($i=0; $i<$NumCols; $i++){
				$output2 =$output2.  '<div style=" display: inline-block;">';				
				$output2 =$output2.$LargText[$i+1];
				$output2 =$output2. "</div>";
				$output2 =$output2.  '<div style=" display: inline-block;">';
				$output2 =$output2. "&nbsp; </div>";
			}
			$output2 =$output2. "</div>";
		}
		$found = true;
		$TheDate = $row["TheDate"];
		
		
		
	}
}

if (isset($sectie)){
		$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Showtimestamp = $row["Showtimestamp"];
		}
	}else{
	//$menu = 'Vertical' ;
	$Showtimestamp = 1;
	}
	


$MainId = $MainIdGroup;



if ($found == true and $acces == true){
		if ($Showtimestamp==1 and $timestampoverrid != -1){$output .= "<i><b>Created:</b> ".date('Y-m-j',$theDate)." <b>Last modified:</b> ".date('Y-m-j',$LastSaved)." <b>Published:</b> ".date('Y-m-j',$PublishDate)."</i><br><br>".$output2;}else{$output .= $output2 ;}
		if ($documentinfo["accesmsg"] == true){
		//$output .='<h2>Reply\'s</h2>';
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroup;
			$msgtype = "richtext";
		}
		//$output .= '<br><br>';
		
} elseif ($found == true and $acces == false){

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
