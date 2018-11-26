<?php
	$Maandgeleden	=	mktime(0, 0, 0, date("m")-1  , date("d"), date("Y"));
	$Weekgeleden = mktime(0,0,0, date("m"), date("d")-7, date("Y"));
	$daggeleden= mktime(0,0,0, date("m"), date("d")-1, date("Y"));
	
//	if ("Nieuwsbriefwachttijd" == "week"){
		$Nieuwsbriefwachttijd =$daggeleden;
//	} else {
//		$Nieuwsbriefwachttijd =$daggeleden;
//	}
	//$_SESSION['oldTypeUser'] = $_SESSION['TypeUser'];
	//$_SESSION['oldUsername'] =	$_SESSION['Username'];
	//$_SESSION['oldId'] = $_SESSION['Id'] ;	
		
$result29 = mysqli_query($link,"SELECT NieuwsDate, Id, Username, TypeUser, ErrorLogin, Language, Email, Nieuws FROM login WHERE NieuwsDate<='".date("Y-m-d H:i:s", $Nieuwsbriefwachttijd)."'") or die ('Query failed: ' . mysqli_error($link));
	while($row29 = mysqli_fetch_array($result29)){
	//$_SESSION['TypeUser'] = $row29["TypeUser"];
	//$_SESSION['Username'] =	$row29["Username"];
	//$_SESSION['Id'] =	$row29["Id"];
	$message = "";
	$UserId = $row29["Id"];

	$Nieuws = $row29["Nieuws"];
	if ($Nieuws == "dag"){
		$Nieuwsbriefwachttijd =$daggeleden;
	} else if ($Nieuws == "week") {
		$Nieuwsbriefwachttijd =$Weekgeleden;
	}else{
		$Nieuwsbriefwachttijd =$Maandgeleden;
	}
	//echo $row2["Username"].$row2["NieuwsDate"];
	$to = $row29['Email'];
	if (($NieuwsDate = strtotime($row29['NieuwsDate'])) === false) {
    	echo "De string () is niet geldig";
		mysqli_query($link,"UPDATE login SET NieuwsDate = '".date("Y-m-d H:i:s")."' WHERE Id=$UserId") or die(mysqli_error($link)); 
	} 
	
	$query = "SELECT Id, submitemail, submitreplyemail, submitsenderemail, Nieuwsbrief, Nieuwsbriefwachttijd FROM system WHERE Id=1";
		$result = mysqli_query($link,$query);
		if (!$result) {
   		 	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			//$Nieuwsbriefwachttijd = $row["Nieuwsbriefwachttijd"];
			$Nieuwsbrief =intval($row["Nieuwsbrief"]);
			$headers  = 'MIME-Version: 1.0' . "\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\n";
			$headers .= 'From: '.$row["submitsenderemail"]."\n" .
    			'Reply-To: '.$row["submitreplyemail"]. "\n" .
    			'X-Mailer: PHP/' . phpversion();
		}


	//echo $NieuwsDate.' '.$Nieuwsbriefwachttijd;
	if($NieuwsDate <= $Nieuwsbriefwachttijd and $Nieuws !="uit"){
	$idsfound = Array ();	
	$found = false;
	$documents = 0;
	$documentslinks = "";
	$messagelinks = "";
	$curpage = explode("?", curPageURL());
	$curpage = $curpage[0];
	$curpage = explode("/", $curpage);
	array_pop($curpage);
	$curpage = implode ("/", $curpage);
	$msgincom = 0;
	$privatemsg = 0;
	$importentmsg = 0;
		//$message .='date '.$NieuwsDate;
		 
		 $message .='date'.date('Y-m-j').'';
		$Id =  $row29['Id'];
		$query9 = "SELECT Id, MainId, Nieuwsbriefnaam, NieuwsbriefHeadding, Nieuwsbrieffooter, Aanmeldtekst, AfmeldTekst, Welkomtekstmessage, Afmeldtekstmessage FROM nieuwsbrief WHERE Language =".$row29["Language"];
	$result9 = mysqli_query($link,$query9);
	if (!$result9) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row9 = mysqli_fetch_array($result9)){
		$message .= "<h1>".$row9["Nieuwsbriefnaam"]."</h1><br>";
		$message .= "".$row9["NieuwsbriefHeadding"]."<br>";
		$subject = $row9["NieuwsbriefHeadding"];
		
		
		$result = mysqli_query($link,"SELECT Naam, MainId, Type, targetmainid FROM groepen WHERE (Language = ".$row29["Language"]." AND PublishDate >= '".date("Y-m-d H:i:s",$NieuwsDate)."') ORDER BY PublishDate DESC ") or die ('Query failed: ' . mysqli_error($link));
		//echo "SELECT Naam, MainId, Type, targetmainid FROM groepen WHERE (Language = ".$_SESSION['Language']." AND PublishDate > '".date("Y-m-d H:i:s",$NieuwsDate)."') AND ( Type = 'form' OR Type = 'photogallery' OR Type = 'richtext' ) ORDER BY PublishDate DESC ";
	while($row = mysqli_fetch_array($result)){
	$documentinfo = getdocumentinfo($row['MainId'], array(), $UserId);
	$acces = $documentinfo["accesdoc"];
	$Hyrargie = $documentinfo["Ids"];
	$Naam = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$row['Naam']);
	//echo $PageId[$i][Id];
	//print_r ($documentinfo);
	$Sectie = $Hyrargie[count($Hyrargie)-1];
		if ($acces == true){
			if (is_file('./plugins/'.$row["Type"].'/search.php')) {
				if ($documentinfo["basedocument"] == null){
					if (!in_array($documentinfo["basedocument"], $idsfound)){
						$Naam2 = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$row['Naam']);
						$url = $curpage.'/'.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html';
						$returntext = "";
						$returntextb="";
						if (is_file('./plugins/'.$row["Type"].'/whatisthetext.php')) {
							include './plugins/'.$row["Type"].'/whatisthetext.php';
						}else{
							$returntext = "";
						}
						$returntext = substr(strip_tags($returntext),0,300);
						$documentslinks .= '<br><h3><a href="'.$url.'">'.$row['Naam'].'</a></h3>'.$returntext.'<h3><a href="'.$url.'">Meer</a></h3>';			
							
						$documents++;
						$found = true;
						array_push($idsfound, $row['MainId']);
					}
				}else{
					if (!in_array($documentinfo["basedocument"], $idsfound)){
						$resultasdf = mysqli_query($link,"SELECT Naam, MainId, Type, targetmainid FROM groepen WHERE MainId = '".$documentinfo["basedocument"]."' and Language = '".$row29["Language"]."'") or die ('Query failed: ' . mysqli_error($link));
			//echo "SELECT Naam, MainId, Type, targetmainid FROM groepen WHERE (Language = ".$_SESSION['Language']." AND PublishDate > '".date("Y-m-d H:i:s",$NieuwsDate)."') AND ( Type = 'form' OR Type = 'photogallery' OR Type = 'richtext' ) ORDER BY PublishDate DESC ";
						while($rowasdf = mysqli_fetch_array($resultasdf)){
							$row['MainId'] = $rowasdf['MainId'];
							$row['Type'] = $rowasdf['Type'];
							$row['Id'] = $rowasdf['Id'];
							$row['tragetmainid'] = $rowasdf['tragetmainid'];
							$Naam2 = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),$rowasdf['Naam']);
							$url = $curpage.'/'.$rowasdf['Type'].'-'.$Sectie.'-'.$rowasdf['MainId'].'-'.$Naam2.'.html';
							$returntext = "";
							$returntextb="";
							if (is_file('./plugins/'.$rowasdf["Type"].'/whatisthetext.php')) {
								include './plugins/'.$rowasdf["Type"].'/whatisthetext.php';
							}else{
								$returntext = "";
							}
							$returntext = substr(strip_tags($returntext),0,300);
							$documentslinks .= '<br><h3><a href="'.$url.'">'.$rowasdf['Naam'].'</a></h3>'.$returntext.'<h3><a href="'.$url.'">Meer</a></h3>';				
								
							$documents++;
							$found = true;
							array_push($idsfound, $row['MainId']);
						}
					}
				}
			}
		}
	}
	
	$message .= "New Documents: $documents <br>";
	
	$query = "SELECT Id, Bericht, Stat, Username, MainId, ParentType, UserId,ParentMainId, TheDate, Filelist FROM reply WHERE Language =".$row29["Language"]."  AND TheDate >=  '".date("Y-m-d H:i:s",$NieuwsDate)."' ORDER BY TheDate DESC ";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	//$found = 0;
	$i = 0;
	
	while($row = mysqli_fetch_array($result)){
	$msgtypeid = $row['ParentMainId'];
	
	$acces = false;
	if ($msgtypeid != "" and intval($msgtypeid) != 0){
	$msgtype = $row['ParentType'];
	switch ($row['ParentType']){
	case "submessage":
	$query2 = "SELECT Id, Bericht, Stat, Username, MainId, ParentType, UserId,ParentMainId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  MainId=$msgtypeid AND Stat='normal' ";	
	//echo $query2;
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row2 = mysqli_fetch_array($result2)){
		$msgtypeid2 = $row2['ParentMainId'];
		//echo $row2['ParentType'];
		switch ($row2['ParentType']){
			case "user":
			case "privatemessage":
				$acces = accesprofile ($msgtypeid2, $UserId);
				break;
			case "usergroup":
				$acces = accesgroup ($msgtypeid2, $UserId);
				break;
			case "richtext":
			case "photogallery":
				$acces = accesdocumentMessages($msgtypeid2,array(), $UserId);
			break;			
		}
		$themsg = $row['Bericht'];
	}
	break;
	case "user":
	case "privatemessage":
		$acces = accesprofile ($msgtypeid, $UserId);
		break;
	case "usergroup":
		$acces = accesgroup ($msgtypeid, $UserId);
		break;
	case "richtext":
	case "photogallery":
		$acces = accesdocumentMessages($msgtypeid,array(), $UserId);
	break;
	}
	}
	if ($row['ParentType'] =="privatemessage" and intval($row['ParentMainId']) != intval($UserId) ){
			$acces = false;
	}
		
	if ($acces == true){
	//echo 'Ihaveacces';
	if ($UserId != $row["UserId"]){
	$found = true;
	switch ($row['ParentType']){
	case "submessage":
		$msgincom++;
		$isuserinmessage = false;
		$query4 = "SELECT Id, Bericht, Stat, Username, MainId, ParentType, UserId,ParentMainId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  MainId=".intval($row['ParentMainId'])." AND Stat='normal' ";
		$result4 = mysqli_query($link,$query4);
		if (!$result4) {
			die('Query failed: ' . mysqli_error($link));
		}
	
		while($row4 = mysqli_fetch_array($result4)){
			if (intval($row4["UserId"]) == intval($UserId)){
				$isuserinmessage = true;
			}
			$query3 = "SELECT Id, Bericht, Stat, Username, MainId, ParentType, UserId,ParentMainId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  ParentMainId=".intval($row4['ParentMainId'])." AND Stat='normal' ";
			$result3 = mysqli_query($link,$query2);
			if (!$result3) {
				die('Query failed: ' . mysqli_error($link));
			}
		
			while($row3 = mysqli_fetch_array($result3)){
				if (intval($row3["UserId"]) == intval($UserId)){
					$isuserinmessage = true;
				}
			}
		}
		if ($isuserinmessage == true){
			$importentmsg++;
			$messagelinks .= '<br><a href="'.$curpage.'/messageview.php?Id='.$msgtypeid.'&type=select">'.$themsg.'</a>';
		}
		break;
	case "user":
		$msgincom++;
		if(intval($row['ParentMainId']) == intval($UserId) ){
			$importentmsg++;
			$messagelinks .= '<br><a href="'.$curpage.'/Users.php?type=Profile&Id='.$msgtypeid.'&type=select">'.$themsg.'</a>';
		}
		break;
	case "privatemessage":
		$privatemsg++;
		break;
	case "usergroup":
		$msgincom++;
		break;
	case "richtext":
	case "photogallery":
		$msgincom++;
	break;
	}}
	}
	
	}
$message .= "New private message: $privatemsg <br>";
	$message .= "New messages: $msgincom <br>";
	$message .= "importend: $importentmsg <br>";
	$message .= "<br>".$row9["Nieuwsbrieffooter"]."<br><br>";
	$message .= 'New Documents:<br>'.$documentslinks;
	$message .= '<br>Importend messages:<br>'.$messagelinks ;
	//echo $to.' '.$subject.' '.$message;
		if ($found == true){	
			//echo $to.' '.$subject.' '.$message;
			//echo $found;
			mail($to, $subject, $message.'</body></html>' , $headers);
			//echo $to.' '.$subject.' '.$message;
		}
	mysqli_query($link,"UPDATE login SET NieuwsDate = '".date("Y-m-d H:i:s")."' WHERE Id=$UserId") or die(mysqli_error($link)); 
		}	}
		}
	
//$_SESSION['TypeUser'] = $_SESSION['oldTypeUser'];
//$_SESSION['Username'] =	$_SESSION['oldUsername'];
//$_SESSION['Id'] = $_SESSION['oldId'] ;

?> 