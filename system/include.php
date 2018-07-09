<?php

function theevalsearch($searchitem,$keyword, $GroupMainId, $plugintype="plugins",$pluginname=""){
	$PageId = Array();
	$searchitem = mb_convert_encoding($searchitem, "UTF-8");
	$keyword= mb_convert_encoding($keyword, "UTF-8");
	$searchitem =mb_strtolower($searchitem);
	$verschil = 0;
	$verschil += (substr_count($searchitem, $keyword) )+2;
	//preg_match("/\b$keyword\b/", strip_tags ($searchitem), $matches);
	$verschil = $verschil+(count($matches)  +2);
	$verschil = $verschil * $importend;

	if ($verschil < 1){
		array_push($PageId, array( "Id"=>$GroupMainId,"Plugintype"=>$plugintype,"Pluginname"=>$pluginname));
	}else{
		for($i=0; $i<$verschil;$i++){					
			array_push($PageId, array( "Id"=>$GroupMainId,"Plugintype"=>$plugintype,"Pluginname"=>$pluginname));
		}
	}
	return $PageId;
}

function loadinnerpage ($MainId, $plugin, $documentinfo, $type, $link){
	$output = "";
	$after = "";
	$Naam = "";
	$timestampoverrid = -1;
	if (is_file('./plugins/'.$plugin.'/member.php')) {
		include './plugins/'.$plugin.'/member.php';
	}else{
		//$Naam = "Plugin $plugin not found";
		$output .= "The plugin $plugin is not found. Contact the webmaster of this website. The content you try to acces can't be showed.";
	}
	$output .= "<br>";
	$outputmixed = Array("output"=>$output,"after"=>$after, "naam"=>$Naam);
	
	return $outputmixed;
}

function gettextinnerpagetext ($theMainId,$targetMainId,$Id, $plugin, $link,$Predirwhattext){
	
	$row = Array ();
	$row['MainId'] = $theMainId;
	$row['targetmainid'] = $targetMainId;
	$row['Id'] = $Id;
	
	$timestampoverrid = -1;
	$returntext = "";
	//echo $Predirwhattext.'./plugins/'.$plugin.'/whatisthetext.php'.$row['MainId'];
	if (is_file($Predirwhattext.'./plugins/'.$plugin.'/whatisthetext.php')) {
		include $Predirwhattext.'./plugins/'.$plugin.'/whatisthetext.php';
	}else{
		//$Naam = "Plugin $plugin not found";
		//$returntext .= "The plugin $plugin is not found. Contact the webmaster of this website. The content you try to acces can't be showed.";
	}
	
	return $returntext;
}

include ('timezone.php');
//include ("pdftotext.php");
/*function textWrap($text) {
	mb_internal_encoding('UTF-8'); 
	mb_http_output('UTF-8'); 
	mb_http_input('UTF-8'); 
	mb_regex_encoding('UTF-8');
	$new_text = "";
	$sizeof = strlen($text); 
	$ii = 0;
	$stat = 0;
	for ($i=0; $i<$sizeof+1; ++$i) { 
		$thechar = mb_substr($text, $i, 1);
		$new_text .=  $thechar;
		

		switch ($stat) {
			case 0:
				if ($thechar == "<"){
					$stat = 1;
					$scripttest = str_replace(' ', '', mb_strtolower(mb_substr($text, $i, 8)));
					if ($scripttest == "<script"){
						$stat = 9;
					}
				}	
				if ($thechar == " " or $thechar == "&"){
					$ii=0;
				}		
				break;
			case 1:
				if ($thechar == ">"){
					$stat = 0;
				}
				if ($thechar == "'" or $thechar == '"'){
					$thecharb = mb_substr($text, $i-1, 1);
					if ($thechar <> "\\" ){
						$stat = 2;
					}
				}
				break;
			case 2:
				if ($thechar == "'" or $thechar == '"'){
					if ($thechar <> "\\" ){
						$stat = 1;
					}					
				}
				break;
			case 9:
				$scripttest = str_replace(' ', '', mb_strtolower(mb_substr($text, $i, 9)));
				if ($scripttest == "</script>"){
						$stat = 0;
						$ii = 0;
				}
				break;
		}		

		if ($stat == 0){
			$ii++;
		}
		
			if ($ii == 10){
				if (mb_substr($text, $i+1, 1) == " "){
					$ii = 0;
				}else{
					$ii = 0;
					$new_text .= "<wbr>";
				}
			}
		}
		
		
		return $new_text;
    } */
function ImageFlipasdf($image, $x = 0, $y = 0, $width = null, $height = null)
	{
	 
	    if ($width  < 1) $width  = imagesx($image);
	    if ($height < 1) $height = imagesy($image);
	 
	    // Truecolor provides better results, if possible.
	    if (function_exists('imageistruecolor') && imageistruecolor($image))
	    {
	 
	        $tmp = imagecreatetruecolor(1, $height);
	 
	    }
	    else
	    {
	 
	        $tmp = imagecreate(1, $height);
	 
	    }
	 
	    $x2 = $x + $width - 1;
	 
	    for ($i = (int)floor(($width - 1) / 2); $i >= 0; $i--)
	    {
	 
	        // Backup right stripe.
	        imagecopy($tmp, $image, 0, 0, $x2 - $i, $y, 1, $height);
	 
	        // Copy left stripe to the right.
	        imagecopy($image, $image, $x2 - $i, $y, $x + $i, $y, 1, $height);
	 
	        // Copy backuped right stripe to the left.
	        imagecopy($image, $tmp, $x + $i,  $y, 0, 0, 1, $height);
	 
	    }
	 
	   
	   imagedestroy($tmp);
	    return $image;
	
}

function accesprofile ($selectId, $sessionid=NULL){
global $link;
$acces = false;
		if ($sessionid != ""){
			$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
			
			$result = mysqli_query($link,$query);
			if (!$result) {
				die('Query failed: ' . mysqli_error($link));
			}
			while($row = mysqli_fetch_array($result)){
				$TypeUser = $row["TypeUser"];
				$Language = $row["Language"];
			}
		}else{
			$Language = $_SESSION["Language"];
		}
		
$query = "SELECT ProfileAcces FROM login WHERE Id=$selectId";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){	
		
		$ProfileAcces = $row['ProfileAcces'];	
		//$sessionid = $_SESSION["Id"];
		
		if ($ProfileAcces == "Friends"){
			$result2 = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE ((User1 = '$sessionid' AND  User2 = '$selectId') OR (User1 = '$selectId' AND  User2 = '$sessionid')) AND Type = 'Friend'  ");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$acces = true;
			}
		}
		if ($ProfileAcces == "Members" and ($TypeUser == 'Member' or $TypeUser == 'Admin' or $TypeUser == 'Moderator')){$acces = true;}
		if ($ProfileAcces == "Public"){$acces = true;}
			$result2 = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE ((User1 = '$sessionid' AND  User2 = '$selectId') OR (User1 = '$selectId' AND  User2 = '$sessionid')) AND Type = '2Blocked'  ");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$acces = false;
			}
			$result2 = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' AND  User2 = '$sessionid') AND Type = 'Blocked'  ");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$acces = false;
			}
			if ($selectId == $sessionid){$acces = true;}
			if ($TypeUser == 'Admin'){$acces = true;}
		
	}
	
	
	return $acces;
}
function accesgroup ($selectId, $sessionid){
global $link;
	$acces = false;
		if ($sessionid != ""){
			$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
			
			$result = mysqli_query($link,$query);
			if (!$result) {
				die('Query failed: ' . mysqli_error($link));
			}
			while($row = mysqli_fetch_array($result)){
				$TypeUser = $row["TypeUser"];
				$Language = $row["Language"];
			}
		}else{
			$Language = $_SESSION["Language"];
		}
	//$sessionid = $_SESSION["Id"];
			$result2 = mysqli_query($link,"SELECT Id FROM groupmembers WHERE theUser = '$sessionid' AND theGroup='$selectId' AND Type='Member'");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$acces = true;
			}
	if ($TypeUser == 'Admin'){
		$acces = true;
	}
	return $acces;
}
function getAllsubdocuments ($Parent, $Ids = array()){
	global $link;
	$documentinfo = Array ();
	$documentinfo["basedocument"] = NULL;
	$documentinfo["Ids"] = Array ();
	$documentinfo["docIds"] = NULL;
	//$accesmsg = NULL;
	$Message = "";
	$Parent = intval($Parent);
	if (isset($Ids)){
		
	}else{
		$Ids = array();	
	}
	
	/*if (isset($sessionid)){
		
		$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
		
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$TypeUser = $row["TypeUser"];
			$Language = $row["Language"];
		}
	}else{*/		
		//$TypeUser = $_SESSION['TypeUser'];
		$Language = $_SESSION["Language"];
	//}
	$query = 'SELECT Id, MainId, Parent, Message, Publish, PublishDate, basedocument FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $Language .'  ORDER BY TheOrder';		
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		if ($row["basedocument"] == 1){
			$documentinfo["basedocument"] = $row["MainId"];
		}
		$error = false;
		for($i=0;$i<count($Ids);$i++){				
			if (intval($Ids[$i]) == intval($Parent)){
				$error = true;
			}		
		}
		if ($row["MainId"] == "-1"){
			$Message = "off";
		}else {
			if ($error == false){
			
				$Ids = array_merge($Ids, array($row["MainId"]));
				if ($row["Parent"] != -1){
					$documentinfotmp = getdocumentinfo($row["Parent"], $Ids, $sessionid);
					if (isset($documentinfotmp["basedocument"]) ){
						$documentinfo["basedocument"] = $documentinfotmp["basedocument"];
					}				
					$documentinfo["Ids"] = array_merge($documentinfotmp["Ids"]);
				} else {
					$documentinfo["Ids"] = $Ids;
				}
				
			}else{
				$documentinfo["accesmsg"] = "in a loop";
			}
		}
	}
	/*$query = 'SELECT Id, MainId, Parent, Message, Publish, PublishDate, basedocument FROM groepen WHERE MainId = '.$documentinfo["basedocument"].' AND Language = '. $Language .'  ORDER BY TheOrder';	
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		
	}	*/
	if ($documentinfo["basedocument"] != NULL){
		$documentinfo["docIds"] = fromebasetoalldoc ($documentinfo["basedocument"]);
	}
	return $documentinfo;
}

function fromebasetoalldoc ($basedocument){
	$docIds = Array ();
	global $link;
	$query = 'SELECT MainId, Type, basedocument  FROM groepen WHERE Parent = '.$basedocument;
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$docIds = array_merge($docIds, array($row["MainId"]));
			if ($row["basedocument"] == 1){
				$docIds = array_merge($docIds,fromebasetoalldoc ($row["MainId"]));
			}
		}
		
		return $docIds;
}
function getdocumentinfo ($Parent, $Ids = array(), $sessionid = NULL){
// this function replace accesdocumentMessages, accesdocument and finid
	global $link;
	$documentinfo = Array ();
	$documentinfo["accesmsg"] = NULL;
	$documentinfo["accesdoc"] = NULL;
	$documentinfo["basedocument"] = NULL;
	$documentinfo["Ids"] = Array ();
	//$accesmsg = NULL;
	$Message = "";
	$Parent = intval($Parent);
	if (isset($Ids)){
		
	}else{
		$Ids = array();	
	}
	
	if (isset($sessionid)){
		
		$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
		
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$TypeUser = $row["TypeUser"];
			$Language = $row["Language"];
		}
	}else{		
		$TypeUser = $_SESSION['TypeUser'];
		$Language = $_SESSION["Language"];
	}
	
	$query = 'SELECT Id, MainId, Parent, Message, Publish, PublishDate, basedocument FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $Language .'  ORDER BY TheOrder';
	
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		
		if ($row["basedocument"] == 1){
			$documentinfo["basedocument"] = $row["MainId"];
		}
		if (($row["Message"] == "Parent" or $row["Message"]=="") and $row["Parent"] != "-1"){
			
		}else if($row["Message"] == "No"){
			$documentinfo["accesmsg"] = false;
		}else if($row["Message"] == "Public"){
			$documentinfo["accesmsg"] = true;
		}else if($row["Message"] == "AllMembers"){
			
			$documentinfo["accesmsg"] = false;
			if ($TypeUser == 'Member' or $TypeUser == 'Admin' or $TypeUser == 'Moderator'){
				$documentinfo["accesmsg"] = true;
			}
		}else if($row["Message"] == "Members"){
			$documentinfo["accesmsg"] = false;
			$result2 = mysqli_query($link,"SELECT UserId FROM groepentousers WHERE GroepenMainId=".$row["MainId"]." AND Type='Message'");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				if ($row2["UserId"] == $sessionid){
					$documentinfo["accesmsg"] = true;
				}
			}
		}else if($row["Message"] == "Groups"){
			$documentinfo["accesmsg"] = false;
			$result2 = mysqli_query($link,"SELECT UserGroepenMainId, Type FROM groepentousergroepen WHERE GroepenMainId=".$row["MainId"]." AND Type='Message'");
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$thegroepnaam = "";
				$result3 = mysqli_query($link,"SELECT theUser FROM groupmembers WHERE theGroup=".$row2["UserGroepenMainId"]." AND Type='Member'");
				if (!$result3) {
					die('Query failed: ' . mysqli_error($link));
				}
			
				while($row3 = mysqli_fetch_array($result3)){
					if ($row3["theUser"] == $sessionid){
						$documentinfo["accesmsg"] = true;
					}
				}
			}
		}
		//
		if (($row["Publish"] == "Parent" or $row["Publish"]=="") and $row["Parent"] != "-1"){
				
			}else if($row["Publish"] == "No"){
				$documentinfo["accesdoc"] = false;
			}else if($row["Publish"] == "Public"){
				$documentinfo["accesdoc"] = true;
			}else if($row["Publish"] == "AllMembers"){
				if ($TypeUser == 'Member' or $TypeUser == 'Admin' or $TypeUser == 'Moderator'){
					$documentinfo["accesdoc"] = true;
				}else{
					$documentinfo["accesdoc"] = false;
				}
				
			}else if($row["Publish"] == "Members"){
				$result2 = mysqli_query($link,"SELECT UserId FROM groepentousers WHERE GroepenMainId=".$row["MainId"]." AND Type='Publish'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}
				$documentinfo["accesdoc"] = false;
				while($row2 = mysqli_fetch_array($result2)){
					if ($row2["UserId"] == $sessionid){
						$documentinfo["accesdoc"] = true;
					}
				}
			}else if($row["Publish"] == "Groups"){
				$documentinfo["accesdoc"] = false;
				$result2 = mysqli_query($link,"SELECT UserGroepenMainId, Type FROM groepentousergroepen WHERE GroepenMainId=".$row["MainId"]." AND Type='Publish'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row2 = mysqli_fetch_array($result2)){
					$thegroepnaam = "";
					$result3 = mysqli_query($link,"SELECT theUser FROM groupmembers WHERE theGroup=".$row2["UserGroepenMainId"]." AND Type='Member'");
					if (!$result3) {
						die('Query failed: ' . mysqli_error($link));
					}
				
					while($row3 = mysqli_fetch_array($result3)){
						if (intval($row3["theUser"]) == intval($sessionid)){
						
							$documentinfo["accesdoc"] = true;
						}
					}
				}
			}

		
		include ('timezone.php');
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");

		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
			
		if ($PublishDate > $todays_date){
			
			$documentinfo["accesdoc"] = false;
		}		
		
		//
	if ($row["MainId"] == "-1"){
		$Message = "off";
	}else {
		// check if he is in a loop
		$error = false;
		for($i=0;$i<count($Ids);$i++){				
			if (intval($Ids[$i]) == intval($Parent)){
				$error = true;
			}		
		}
		
			if ($error == false){
			
				$Ids = array_merge($Ids, array($row["MainId"]));
				if ($row["Parent"] != -1){
					$documentinfotmp = getdocumentinfo($row["Parent"], $Ids, $sessionid);
					if (isset($documentinfotmp["basedocument"]) ){
						$documentinfo["basedocument"] = $documentinfotmp["basedocument"];
					}				
					if (isset($documentinfo["accesmsg"]) ){
					}else{
						$documentinfo["accesmsg"] = $documentinfotmp["accesmsg"];
					}
					if (isset($documentinfo["accesdoc"]) ){
					}else{
						$documentinfo["accesdoc"] = $documentinfotmp["accesdoc"];
					}
					$documentinfo["Ids"] = array_merge($documentinfotmp["Ids"]);
				} else {
					$documentinfo["Ids"] = $Ids;
				}
				
			}else{
				$documentinfo["accesmsg"] = "in a loop";
			}
		}
		
	}		


return $documentinfo;
}


function accesdocumentMessages($Parent, $Ids = array(), $sessionid = NULL){
global $link;
		$acces = false;
		$Message = "";
		$Parent = intval($Parent);
		if (isset($Ids)){
			
		}else{
			$Ids = array();	
		}
		
		if ($sessionid != ""){
			$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
			
			$result = mysqli_query($link,$query);
			if (!$result) {
				die('Query failed: ' . mysqli_error($link));
			}
			while($row = mysqli_fetch_array($result)){
				$TypeUser = $row["TypeUser"];
				$Language = $row["Language"];
			}
		}else{
			$Language = $_SESSION["Language"];
		}
		
		$query = 'SELECT Id, MainId, Parent, Message FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $Language .'  ORDER BY TheOrder';
		
		$result = mysqli_query($link,$query);
		if (!$result) {
  			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			if (($row["Message"] == "Parent" or $row["Message"]=="") and $row["Parent"] != "-1"){
				if ($row["MainId"] == "-1"){
					$Message = "off";
				}else {
					// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($Parent)){
						$error = true;
					}		
				}
					if ($error == false){
						$Ids = array_merge($Ids, array($row["MainId"]));
						$acces = accesdocumentMessages($row["Parent"], $Ids, $sessionid);
					}else{
						$acces = "in a loop";
					}
				}
			}else if($row["Message"] == "No"){
				
			}else if($row["Message"] == "Public"){
				$acces = true;
			}else if($row["Message"] == "AllMembers"){
				if ($TypeUser == 'Member' or $TypeUser == 'Admin' or $TypeUser == 'Moderator'){
					$acces = true;
				}
			}else if($row["Message"] == "Members"){
				$result2 = mysqli_query($link,"SELECT UserId FROM groepentousers WHERE GroepenMainId=".$row["MainId"]." AND Type='Message'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row2 = mysqli_fetch_array($result2)){
					if ($row2["UserId"] == $sessionid){
						$acces = true;
					}
				}
			}else if($row["Message"] == "Groups"){
				$result2 = mysqli_query($link,"SELECT UserGroepenMainId, Type FROM groepentousergroepen WHERE GroepenMainId=".$row["MainId"]." AND Type='Message'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row2 = mysqli_fetch_array($result2)){
					$thegroepnaam = "";
					$result3 = mysqli_query($link,"SELECT theUser FROM groupmembers WHERE theGroup=".$row2["UserGroepenMainId"]." AND Type='Member'");
					if (!$result3) {
						die('Query failed: ' . mysqli_error($link));
					}
				
					while($row3 = mysqli_fetch_array($result3)){
						if ($row3["theUser"] == $sessionid){
							$acces = true;
						}
					}
				}
			}
		}		
	
	return $acces;
}
function accesdocument($Parent, $Ids = array(), $sessionid = NULL){
		global $link;
		$acces = false;
		$Message = "";
		$Parent = intval($Parent);
		if (isset($Ids)){
			
		}else{
			$Ids = array();	
		}
		if ($sessionid != ""){
			$query = 'SELECT TypeUser, Language FROM login WHERE Id = '.$sessionid;
			
			$result = mysqli_query($link,$query);
			if (!$result) {
				die('Query failed: ' . mysqli_error($link));
			}
			while($row = mysqli_fetch_array($result)){
				$TypeUser = $row["TypeUser"];
				$Language = $row["Language"];
			}
		}else{
			$Language = $_SESSION["Language"];
			$TypeUser = $_SESSION['TypeUser'];
		}
		$query = 'SELECT Id, MainId, Parent, Publish, PublishDate FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $Language .'  ORDER BY TheOrder';
		
		$result = mysqli_query($link,$query);
		if (!$result) {
  			die('Query failed: ' . mysqli_error($link));
		}
		
		while($row = mysqli_fetch_array($result)){
			
			if (($row["Publish"] == "Parent" or $row["Publish"]=="") and $row["Parent"] != "-1"){
				if ($row["MainId"] == "-1"){
					$Message = "off";
				}else {
					// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($Parent)){
						$error = true;
					}		
				}
					if ($error == false){
						$Ids = array_merge($Ids, array($row["MainId"]));
						$acces = accesdocument($row["Parent"], $Ids,$sessionid);
						
					}else{
						$acces = "in a loop";
					}
				}
			}else if($row["Publish"] == "No"){
				
			}else if($row["Publish"] == "Public"){
				$acces = true;
			}else if($row["Publish"] == "AllMembers"){
				if ($TypeUser == 'Member' or $TypeUser == 'Admin' or $TypeUser == 'Moderator'){
					$acces = true;
				}
				
			}else if($row["Publish"] == "Members"){
				$result2 = mysqli_query($link,"SELECT UserId FROM groepentousers WHERE GroepenMainId=".$row["MainId"]." AND Type='Publish'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row2 = mysqli_fetch_array($result2)){
					if ($row2["UserId"] == $sessionid){
						$acces = true;
					}
				}
			}else if($row["Publish"] == "Groups"){
				$result2 = mysqli_query($link,"SELECT UserGroepenMainId, Type FROM groepentousergroepen WHERE GroepenMainId=".$row["MainId"]." AND Type='Publish'");
				if (!$result2) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row2 = mysqli_fetch_array($result2)){
					$thegroepnaam = "";
					$result3 = mysqli_query($link,"SELECT theUser FROM groupmembers WHERE theGroup=".$row2["UserGroepenMainId"]." AND Type='Member'");
					if (!$result3) {
						die('Query failed: ' . mysqli_error($link));
					}
				
					while($row3 = mysqli_fetch_array($result3)){
						if (intval($row3["theUser"]) == intval($sessionid)){
						
							$acces = true;
						}
					}
				}
			}

		
		include ('timezone.php');
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");

		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
			
		if ($PublishDate > $todays_date){
			
			$acces = false;
		}		
	}
	
	return $acces;
}

function findId($Parent, $Ids){
		global $link;
	if (isset($Ids)){
			
	}else{
		$Ids = array();	
	}
	// check if he is in a loop
	
		$query = 'SELECT Id, MainId, Parent FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $_SESSION['Language'] .'  ORDER BY TheOrder';
		
		$result = mysqli_query($link,$query);
		if (!$result) {
  			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			if ($row["MainId"] == "0"){

			}else{	
				// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($row["Parent"])){
						$error = true;
					}		
					
				}
					if ($error == false){
						$Ids = array_merge(findId($row["Parent"], $Ids), $Ids, array($row["MainId"]));
					}else{
						$Ids = "in a loop";
					}
			}
		}		
	
	return $Ids;
}

function findgroupmemberId($Parent, $Ids){
		global $link;
	if (isset($Ids)){
			
	}else{
		$Ids = array();	
	}
	// check if he is in a loop
	
		$query = 'SELECT Id, MainId, Parent, Naam FROM usergroepen WHERE MainId = '.$Parent.' AND Language = '. $_SESSION['Language'] .'  ORDER BY TheOrder';
		
		$result = mysqli_query($link,$query);
		if (!$result) {
  			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			if ($row["MainId"] == "-1"){

			}else{	
				// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($row["Parent"])){
						$error = true;
					}		
					
				}
					if ($error == false){
						$Ids = array_merge(findgroupmemberId($row["Parent"], $Ids), $Ids, array($row["MainId"]));
					}else{
						$Ids = "in a loop";
					}
			}
		}		
	
	return $Ids;
}

function findMessagesettings($Parent, $Ids = array()){
global $link;
		$Message = "";
		$Parent = intval($Parent);
		if (isset($Ids)){
			
		}else{
			$Ids = array();	
		}
		$query = 'SELECT Id, MainId, Parent, Message FROM groepen WHERE MainId = '.$Parent.' AND Language = '. $_SESSION['Language'] .'  ORDER BY TheOrder';
		
		$result = mysqli_query($link,$query);
		if (!$result) {
  			die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			if ($row["Message"] == "Parent"){
				if ($row["MainId"] == "-1"){
					$Message = "off";
				}else {
					// check if he is in a loop
				$error = false;
				for($i=0;$i<count($Ids);$i++){				
					if (intval($Ids[$i]) == intval($Parent)){
						$error = true;
					}		
				}
					if ($error == false){
						$Ids = array_merge($Ids, array($row["MainId"]));
						$Message = findMessagesettings($row["Parent"], $Ids);
					}else{
						$Message = "in a loop";
					}
				}
			}else {
				$Message = $row["Message"];
			}
		}		
	
	return $Message;
}

function multi_unique($array) {
  $new1 = array();
        foreach ($array as $k=>$na)
            $new[$k] = serialize($na);
		$uniq = array_count_values($new);
		arsort($uniq);
        //$uniq = array_unique($new);
		
        foreach($uniq as $k=>$ser)
			array_push( $new1, unserialize($k));
        return ($new1);
 }

function locateIp($ip){
global $link;
	$d = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
 
	//Use backup server if cannot make a connection
	if (!$d){
		$backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
		$answer = new SimpleXMLElement($backup);
		if (!$backup) return false; // Failed to open connection
	}else{
		$answer = new SimpleXMLElement($d);
	}
 
	$country_code = $answer->CountryCode;
	$country_name = $answer->CountryName;
	$region_name = $answer->RegionName;
	$city = $answer->City;
	$zippostalcode = $answer->ZipPostalCode;
	$latitude = $answer->Latitude;
	$longitude = $answer->Longitude;
	$timezone = $answer->Timezone;
	$gmtoffset = $answer->Gmtoffset;
	$dstoffset = $answer->Dstoffset;
 
	//Return the data as an array
	return array('ip' => $ip, 'country_code' => $country_code, 'country_name' => $country_name, 'region_name' => $region_name, 'city' => $city, 'zippostalcode' => $zippostalcode, 'latitude' => $latitude, 'longitude' => $longitude, 'timezone' => $timezone, 'gmtoffset' => $gmtoffset, 'dstoffset' => $dstoffset);
}
 
//Usage example


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function curPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	 
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	 return $pageURL;
}

function removeFullLinks($thehmtlcode=' '){
 $pageURL = explode("/", curPageURL());
$theurl = "";
 $i=0;
 foreach ($pageURL as $value) {
	$theurl .= $value."/";
	$i++;
	if (sizeof ($pageURL) -1 == $i){
		break;
	}
}
 
 
 $thehmtlcode = str_replace($theurl, "./", $thehmtlcode);

 return $thehmtlcode;
}

function setDefaultLanguage (){
	global $link;
	$_SESSION['newsessionany'] = 10;
	$_SESSION['Themeoverride'] = "";
	$_SESSION['Cookie'] = false;
	$_SESSION['Messages'] = array();
	$_SESSION['Accesfiles2'] = array();
	$_SESSION['Menu'] = "Public";
	$_SESSION['TypeUser'] = "Guest";
	//$_SESSION['Id'] =	-1;
	$query2 = "SELECT DefaultLanguage, Theme FROM system";
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row2 = mysqli_fetch_array($result2)){

		$_SESSION['Language'] = intval($row2["DefaultLanguage"]);
		$_SESSION['Theme']= $row2["Theme"];
	
	}
	if ($_SERVER['SERVER_NAME'] == "www.inequalitymaximum.eu"){
		$_SESSION['Language'] = 8;
	}
	loadplugin ();
}
function loadplugin (){
	$includejs = "";
	$includephp = "";
	$resizejs = "";
	$scrolljs = "";
	$mousemovejs = "";
	$afterphp = "";
	$pluginpost = "";
	$menumember = Array();
	$menuadmin = Array();
	if (file_exists ('./plugins')){
	$root = scandir('./plugins'); 
	/*$query = "SELECT RedirectLogin, RedirectIndex, Redirect404, Redirect400, Redirect401, Redirect403, Redirect500 FROM system";
	$result = mysqli_query($link,$query);
	if (!$result) {
		die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		$_SESSION['error404'] = $row["Redirect404"]  ; 		
	}*/
	foreach($root as $value)
	{ 
		if ($value != ".."){
			if (is_file('./plugins/'.$value.'/include.js')) {
				$includejs .= 'include(\'./plugins/'.$value.'/include.js\');';
			}
			if (is_file('./plugins/'.$value.'/include.php')) {
				$includephp .= 'include(\'./plugins/'.$value.'/include.php\');';
			}
			if (is_file('./plugins/'.$value.'/resize.js')) {
				$resizejs .= 'include(\'./plugins/'.$value.'/resize.js\');';
			}
			if (is_file('./plugins/'.$value.'/onload.js')) {
				$onloadjs .= 'include(\'./plugins/'.$value.'/onload.js\');';
			}
			if (is_file('./plugins/'.$value.'/scroll.js')) {
				$scrolljs .= 'include(\'./plugins/'.$value.'/scroll.js\');';
			}
			if (is_file('./plugins/'.$value.'/mousemove.js')) {
				$mousemovejs .= 'include(\'./plugins/'.$value.'/mousemove.js\');';
			}
			if (is_file('./plugins/'.$value.'/after.php')) {
				$afterphp .= 'include(\'./plugins/'.$value.'/after.php\');';
			}
			if (is_file('./plugins/'.$value.'/menumember.php')) {
				$menumember[$value] = 'include(\'./plugins/'.$value.'/menumember.php\');';
			}
			if (is_file('./plugins/'.$value.'/menuadminajax.js')) {
				$menuadmin[$value] = $value;
			}
		}
	} 

	$root = scandir('./plugin windows'); 
	foreach($root as $value)
	{ 
		if ($value != ".."){
			if (is_file('./plugin windows/'.$value.'/include.js')) {
				$includejs .= 'include(\'./plugin windows/'.$value.'/include.js\');';
			}
			if (is_file('./plugin windows/'.$value.'/include.php')) {
				$includephp .= 'include(\'./plugin windows/'.$value.'/include.php\');';
			}
			if (is_file('./plugin windows/'.$value.'/resize.js')) {
				$resizejs .= 'include(\'./plugin windows/'.$value.'/resize.js\');';
			}
			if (is_file('./plugin windows/'.$value.'/scroll.js')) {
				$scrolljs .= 'include(\'./plugin windows/'.$value.'/scroll.js\');';
			}
			if (is_file('./plugin windows/'.$value.'/mousemove.js')) {
				$mousemovejs .= 'include(\'./plugin windows/'.$value.'/mousemove.js\');';
			}
			if (is_file('./plugin windows/'.$value.'/after.php')) {
				$afterphp .= 'include(\'./plugin windows/'.$value.'/after.php\');';
			}
			
		}
	} 
	
	$root = scandir('./pluginstandalone'); 
	foreach($root as $value)
	{ 
		if ($value != ".."){
			if (is_file('./pluginstandalone/'.$value.'/include.js')) {
				$includejs .= 'include(\'./pluginstandalone/'.$value.'/include.js\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/include.php')) {
				$includephp .= 'include(\'./pluginstandalone/'.$value.'/include.php\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/resize.js')) {
				$resizejs .= 'include(\'./pluginstandalone/'.$value.'/resize.js\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/scroll.js')) {
				$scrolljs .= 'include(\'./pluginstandalone/'.$value.'/scroll.js\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/mousemove.js')) {
				$mousemovejs .= 'include(\'./pluginstandalone/'.$value.'/mousemove.js\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/after.php')) {
				$afterphp .= 'include(\'./pluginstandalone/'.$value.'/after.php\');';
			}
			if (is_file('./pluginstandalone/'.$value.'/onload.js')) {
				$onloadjs .= 'include(\'./pluginstandalone/'.$value.'/onload.js\');';
			}
		}
	} 
	
	$root = scandir('./pluginpost'); 
	foreach($root as $value)
	{ 
		if ($value != ".."){
			if (is_file('./pluginpost/'.$value.'/include.js')) {
				$includejs .= 'include(\'./pluginpost/'.$value.'/include.js\');';
			}
			if (is_file('./pluginpost/'.$value.'/include.php')) {
				$includephp .= 'include(\'./pluginpost/'.$value.'/include.php\');';
			}
			if (is_file('./pluginpost/'.$value.'/resize.js')) {
				$resizejs .= 'include(\'./pluginpost/'.$value.'/resize.js\');';
			}
			if (is_file('./pluginpost/'.$value.'/scroll.js')) {
				$scrolljs .= 'include(\'./pluginpost/'.$value.'/scroll.js\');';
			}
			if (is_file('./pluginpost/'.$value.'/mousemove.js')) {
				$mousemovejs .= 'include(\'./pluginpost/'.$value.'/mousemove.js\');';
			}
			if (is_file('./pluginpost/'.$value.'/after.php')) {
				$afterphp .= 'include(\'./pluginpost/'.$value.'/after.php\');';
			}
			if (is_file('./pluginpost/'.$value.'/index.php')) {
				$pluginpost .= 'include(\'./pluginpost/'.$value.'/index.php\');';
			}
			if (is_file('./pluginpost/'.$value.'/onload.js')) {
				$onloadjs .= 'include(\'./pluginpost/'.$value.'/onload.js\');';
			}
		}
	} 
	
	$_SESSION['includejs'] = $includejs;
	$_SESSION['includephp'] =$includephp;
	$_SESSION['resizejs'] =$resizejs;
	$_SESSION['scroll.js'] =$scrolljs;
	$_SESSION['mousemovejs'] =$mousemovejs;
	$_SESSION['afterphp'] =$afterphp;
	$_SESSION['menumember'] =$menumember;
	$_SESSION['menuadmin'] =$menuadmin;
	$_SESSION['pluginpost'] =$pluginpost;
	$_SESSION['onloadjs'] = $onloadjs;
	}
}
?>
