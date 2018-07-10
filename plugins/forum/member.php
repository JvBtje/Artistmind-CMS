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
		//$MessageSetting = findMessagesettings($row['MainId'], array());
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
	
if ($found == true and $acces == true){

$result = mysqli_query($link,"SELECT Id, MainId,  DATE_FORMAT(TheDate, '%d-%c-%Y %H:%i:%s') AS TheDate, MaxLijst FROM forum WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$TheDate = $row['TheDate'];
		$MainId = $row['MainId'];
		$ShowLijst = intval($row['MaxLijst']);
	}
	
	$MainIds = array();
	$Html = "";
	$searchstring = "";
	
function Zoeklijstids($MainIdGroup){
	global $link;
	$output = array();
	
	$query = "SELECT Id,name, Bericht, Stat, Username, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE Stat!='history' AND ParentMainId =".$MainIdGroup." AND ParentType='forum' AND Language =".$_SESSION['Language']." ORDER BY TheDate DESC";
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){	
			
			array_push($output, array("name" =>$row["name"],"Id"=> $row["Id"], "Bericht"=> $row["Bericht"],"Stat"=> $row["Stat"],"Username"=> $row["Username"],"MainId"=> $row["MainId"],"UserId"=> $row["UserId"],"TheDate"=> $row["TheDate"],"Filelist"=> $row["Filelist"],));
		}
	return $output;	
	}
	
$MainIds = Zoeklijstids($MainIdGroup);

if (count($MainIds) ==  0){
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
	$oldsessionusertype = $_SESSION['TypeUser'];
	$_SESSION['TypeUser'] = 'member';
	if ($_SESSION['Themeoverride'] == ""){
		include $_SESSION['Theme']."listt.php";
	}else{
		include $_SESSION['Themeoverride']."listt.php";
	}
	$_SESSION['TypeUser'] = $oldsessionusertype;
	$i=0;
	$ii=$ShowLijst;
	$iii=0;
	//$ShowLijst= $Showlijst-1;
	$lijstclicken = "";

	$query8 = "SELECT Id, UserId, TheDate, MainId FROM reply WHERE Id =".$MainId;
	$result8 = mysqli_query($link,$query8);
	if (!$result8) {
		die('Query failed: ' . mysqli_error($link));
	}
	
	while($row8 = mysqli_fetch_array($result8)){
		//$found = true;
		$UserId = $row8["UserId"];
		//$TheDate = $row8["TheDate"];
		//$MainId = $row8["MainId"];
	}
	foreach ($MainIds as $ThePageId) {
				$changemessage = "false";
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
			$changemessage= "true";
		}
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($UserId)) ){
			$changemessage= "true";
		}	
		if ($changemessage == "true" or $ThePageId["Stat"] == "normal"){
		if ($i == 0){
			$searchstring .= " WHERE (MainId=".$ThePageId.' ';
		}else{
			$searchstring .= " OR MainId=".$ThePageId.' ';
		}
		$i++;
		
		if ($ii==$ShowLijst){
			$iii++;
			$lijstclicken .= '<div id="resultnumberlayout"><a href="indexnew.php?plugin=forum&sectie='.$sectie.'&type=select&Id='.$MainIdGroup.'&Resultnumber='.($i-1).'">'.($iii).'</a></div> ';
			$ii = 0;
		}
		$ii++;
		}
	}
	if ($iii >1){
	$Html .=$lijstclicken.'<br>';
	}
	
	$Html  .='<br><div id="lijst'.$oldMainId.'">	';
	$ib = 0;
	foreach ($MainIds as $ThePageId) {
		$changemessage = "false";
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
			$changemessage= "true";
		}
		if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($UserId)) ){
			$changemessage= "true";
		}	
		if ($changemessage == "true" or $ThePageId["Stat"] == "normal"){
		if ($ib+1  > $Resultnumber and $ib < $Resultnumber + $ShowLijst){
		
		
		
			$Naam2 = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$ThePageId["name"]);
			$url = 'forummsg-'.$sectie.'-'.$MainIdGroup.'-'.$ThePageId['Id'].'-'.$Naam2.'.html';
			
			$returntext = $ThePageId["Bericht"];
			$returntextb="";
			$Naam2 = substr(strip_tags($ThePageId["name"]),0,50);
			if (strlen($ThePageId["Filelist"]) > 2){
			$Files = explode("<li>",$ThePageId["Filelist"]);
			$imgurl = "";
			foreach ($Files as $Thefile) {
				$Thefilelength = strlen($Thefile);
				$filetype = substr ($Thefile,0,strlen($Thefile)-5);
				$filetype = explode(".",$filetype);
				
				if (mb_strtolower ($filetype[2]) == "jpg" or mb_strtolower ($filetype[2]) == "png" or mb_strtolower ($filetype[2]) == "jpeg"){
					$imgurl = substr ($Thefile,0,strlen($Thefile)-5);
					array_push($_SESSION['Accesfiles2'], $imgurl);
					break;
				}
			}
			}else{
				$imgurl = "";
			}
			global $putimgurlindataoriginal;
			$returntext = substr(strip_tags($returntext),0,300);
			if (strlen($imgurl)>5){
				$htmlwithimg2 = str_replace("%listurl%", $url, $listimage);
				$htmlwithimg2 = str_replace("%listtext%", $returntext, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listheading%", $Naam2, $htmlwithimg2);
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
				$htmlwithoutimg2 = str_replace("%listheading%", $Naam2, $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%adminurl%", $adminurl, $htmlwithoutimg2);
				$Html .= $htmlwithoutimg2;
			}
			
		}
		$ib++;
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
	$output .= '<div id="gallerybut"><a href="indexnew.php?plugin=forummsg&type=new&sectie='.$sectie.'&forummainid='.$MainIdGroup.'"><img src="'.$_SESSION['Theme'].'iconfilemanager/add.png"></a></div>';
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
