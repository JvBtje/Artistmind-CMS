<?php

echo '

<script language="javascript">


function changeval(){	
	
}
function submitform(){
	
	myNicEditor1.removeInstance(\'Bericht\');	
	document.form1.submit();
}

function updatelijst(lijstid,tumbsizelist){
	scale = 1 / window.devicePixelRatio;
	tumbsizelist = tumbsizelist * window.devicePixelRatio;
	html = document.getElementById(\'lijst\'+lijstid).innerHTML;
	html = html.replace(/%maxsize/g, tumbsizelist);
	html = html.replace(/%scale%/g, scale);
	
	document.getElementById(\'lijst\'+lijstid).innerHTML = html;
}
</script>';

	$oldMainId=$MainId;
$banner = "";
$oldurl = $url;
$found = false;
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
	
if ($found == true){

$result = mysqli_query($link,"SELECT Id, MainId,  DATE_FORMAT(TheDate, '%d-%c-%Y %H:%i:%s') AS TheDate, SubGroupContent, MaxLijst, ShowLijst, GroupToShow, Ordering2 FROM lijst WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$TheDate = $row['TheDate'];
		$MainId = $row['MainId'];
		
		$SubGroupContent = intval($row['SubGroupContent']);
		$MaxLijst = intval($row['MaxLijst']);
		$ShowLijst = intval($row['ShowLijst']);
		$GroupToShow = $row['GroupToShow'];
		$Ordering = $row['Ordering2'];
	}
	
	$MainIds = array($GroupToShow);
	$Html = "";
	$searchstring = "";
	$outputsectie = findId($GroupToShow, array());
	$outputsectie = $outputsectie[0];
	
function Zoeklijstids($Start,$SubGroupContent){
	global $link;
	$output = array();
	
	$query = 'SELECT Id, MainId, Type FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] ;
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			
			
			if ($row["Type"] == "groep" and $SubGroupContent== 1){
				$output  = array_merge($output, Zoeklijstids ($row["MainId"],$SubGroupContent));
			} else {
				if (is_file('./plugins/'.$row["Type"].'/whatisthetext.php')) {
					array_push($output, $row["MainId"]);
				}
			}
		
		
		}
	return $output;	
	}
$MainIds = Zoeklijstids($GroupToShow, $SubGroupContent);
//echo "nummainids".print_r($MainIds)."MaxLijst".count($MainIds);
if (count($MainIds) == 0){
	// niks gevonden niks laten zien
	}else{
	if (isset($_GET["Resultnumber"])){
		$Resultnumber = $_GET["Resultnumber"];
	}else {
		$Resultnumber = 0;
	}
	$Resultnumber = str_replace("'", " ", $Resultnumber);
	$Resultnumber = str_replace('"', " ", $Resultnumber);
	$Resultnumber = intval($Resultnumber); 
		/*$url = curPageURL();
		$url = str_replace ('a=0','',$url);
		$url = explode("?", $url);
		$url[1] = explode("&", $url[1]);
		$theurl=$url[0]."?";
		
		$i=0;
		foreach ($url[1] as $urlvar) {
			if (substr($urlvar,0,12) <> "Resultnumber"){
			if ($i==0){$theurl = $theurl."".$urlvar;}else{$theurl = $theurl."&".$urlvar;}
			}
			$i++;
		}*/
	
	/*$query2 = 'SELECT Listview, Listview2 FROM system';
		$result2 = mysqli_query($link,$query2);
		if (!$result2) {
  		  	die('Query failed: ' . mysqli_error($link2));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$htmlwithimg = $row2['Listview'];
			$htmlwithoutimg = $row2['Listview2'];
		}*/
	if ($_SESSION['Themeoverride'] == ""){
		include $_SESSION['Theme']."listt.php";
	}else{
		include $_SESSION['Themeoverride']."listt.php";
	}

	$i=0;
	$ii=$ShowLijst;
	$iii=0;
	//$ShowLijst= $Showlijst-1;
	$lijstclicken = "";
	foreach ($MainIds as $ThePageId) {
		if ($i == 0){
			$searchstring .= " WHERE (MainId=".$ThePageId.' ';
		}else{
			$searchstring .= " OR MainId=".$ThePageId.' ';
		}
		$i++;
		
		if ($ii==$ShowLijst){
			$iii++;
			$lijstclicken .= '<div id="resultnumberlayout"><a href="indexnew.php?plugin=lijst&sectie='.$sectie.'&type=select&Id='.$MainIdGroup.'&Resultnumber='.($i-1).'">'.($iii).'</a></div> ';
			//$lijstclicken .= '<div id="resultnumberlayout"><a href="'.$theurl.'&Resultnumber='.($i-1).'">'.($iii).'</a></div> ';
			$ii = 0;
		}
		$ii++;
	}
	if ($iii >1){
	$Html .=$lijstclicken.'<br>';
	}
	$searchstring .= ") AND Language =".$_SESSION['Language']." ";
	
	if ($Ordering == "Date"){
		$searchstring .= " ORDER BY theDate DESC ";
	} else if ($Ordering == "alfabet") {
		$searchstring .= " ORDER BY Naam ";
	}else {
		$searchstring .= " ORDER BY TheOrder ";
	}
	$searchstring .= ' LIMIT '.($Resultnumber).",".$ShowLijst." ";
	$Html  .='<br><div id="lijst'.$oldMainId.'">	';
	
	$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen '.$searchstring;
	//echo $query;
	//echo $query;
	//$Html .= $query;
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		
		$acceslijst = accesdocument($row['MainId'], $Ids = array(),$_SESSION["Id"]);
		if ($acceslijst == true){
			$Naam2 = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$row['Naam']);
			$url = ''.$row['Type'].'-'.$outputsectie.'-'.$row['MainId'].'-'.$Naam2.'.html';
			$adminurl = 'indexadminnew.php?plugin='.$row['Type'].'&type=select&Id='.$row['MainId'].'&sectie='.$outputsectie;
			$returntext = "";
			$returntextb="";
			if (is_file('./plugins/'.$row["Type"].'/whatisthetext.php')) {
				include './plugins/'.$row["Type"].'/whatisthetext.php';
			}else{
				$returntext = "";
			}
			
			preg_match_all('/<img[^>]+>/i',$returntext, $images);			
			preg_match_all('/src\=\"(.*?)\"/',$images[0][0], $imgurl);
			$imgurl = substr($imgurl[0][0], 5, -1);
			array_push($_SESSION['Accesfiles2'], $imgurl);
			global $putimgurlindataoriginal;
			$returntext = substr(strip_tags($returntext),0,300);
			if (strlen($imgurl)>5){
				$htmlwithimg2 = str_replace("%listurl%", $url, $listimage);
				$htmlwithimg2 = str_replace("%listtext%", $returntext, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listheading%", $row['Naam'], $htmlwithimg2);
				if (isset($putimgurlindataoriginal)){
					$htmlwithimg2 = str_replace("%listimage%", 'blank.png" data-original="./system/imgtumb.php?url='.$imgurl, $htmlwithimg2);
				}else{
					$htmlwithimg2 = str_replace("%listimage%", $imgurl, $htmlwithimg2);
				}
				$htmlwithimg2 = str_replace("%adminurl%", $adminurl, $htmlwithimg2);
				$Html .= $htmlwithimg2;
			}else{
				$htmlwithoutimg2 = str_replace("%listurl%", "$url", $listnoimage);
				$htmlwithoutimg2 = str_replace("%listtext%", $returntext, $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%listheading%", $row['Naam'], $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%adminurl%", $adminurl, $htmlwithoutimg2);
				$Html .= $htmlwithoutimg2;
			}
			//$Html .= ''.substr(strip_tags($returntext),0,300).'<a href=""></a>';
			//$Html .= ' <h4><a href="'.$row['Type'].'-'.$outputsectie.'-'.$row['MainId'].'-'.$Naam2.'.html"> meer...</a></h4></div></td></tr></table><br>';
		}
	}
	
	}	
	if ($iii >1){
	$Html .='<br>'.$lijstclicken;
	}
	

}
	$MainId = $oldMainId;
	$Html .='</div><script language="javascript">updatelijst('.$MainId.','.$tumbsizelist.');</script>';
}
if (isset($sectie)){
$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		if ($row["Menu"] == Horizontal){
			$menu = 'Horizontal' ;
		}else if($row["Menu"] == Vertical){
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
$url = $oldurl;

if ($found == true and $acces == true){

	 '<h1>'.$Naam.' </h1>';
	if ($Showtimestamp==1 and $timestampoverrid != -1){$output = "<i><b>Created:</b> ".date('Y-m-j',$theDate)." <b>Last modified:</b> ".date('Y-m-j',$LastSaved)." <b>Published:</b> ".date('Y-m-j',$PublishDate)."</i><br><br>".$output;}
	$output .= '<center>';
	$output .= $Html;
	$output .= '</center>';
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



?>
