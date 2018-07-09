<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

include('../DB.php');
include('include.php');
include ('timezone.php');

$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
$acces = false;
$msgtypeid = $_POST["msgtypeid"];
$msgtype = $_POST["msgtype"];
$msgnumber = intval($_POST["msgnumber"]);
$amount = intval($_POST["amount"]);
$msguserid = $_SESSION['Id'];

if ($amount == 0){
	$amount = 10;
}

$msgtypeid = str_replace("'", " ", $msgtypeid);
$msgtypeid = str_replace('"', " ", $msgtypeid);
$msgtypeid = str_replace("\\", "\\\\", $msgtypeid);
$msgnumber = str_replace("'", " ", $msgnumber);
$msgnumber = str_replace('"', " ", $msgnumber);
$msgnumber = str_replace("\\", "\\\\", $msgnumber);
$msgtype = str_replace("'", " ", $msgtype);
$msgtype = str_replace('"', " ", $msgtype);
$msgtype = str_replace("\\", "\\\\", $msgtype);

if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
	$query = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$_SESSION['Id'];
	$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$sesid = $row['Id'];
			$sesusername = $row['Username'];
			$sesProfilepic = $row['Profilepic'];
			array_push($_SESSION['Accesfiles2'], $sesProfilepic);			
		}
}

if ($_SESSION['newsession'] == false ){ 
if ($msgtypeid != ""){
	switch ($msgtype){
	case "user":
	case "privatemessage":
	$acces = accesprofile ($msgtypeid, $_SESSION["Id"]);
	if ($row['ParentType'] =="privatemessage"){
	if ((intval($ParentMainId) == intval($_SESSION["Id"]) or intval($UserId) == intval($_SESSION["Id"]))){
	
	}else{
		$acces = false;
	}}
	
		break;
	case "usergroup":
		$acces = accesgroup ($msgtypeid, $_SESSION["Id"]);
		break;
	case "richtext":
	case "photogallery":
		$acces = accesdocumentMessages($msgtypeid,array(), $_SESSION["Id"]);
	break;
	case "forummsg";
		$result = mysqli_query($link,"SELECT ParentMainId FROM reply WHERE id=".$msgtypeid." AND Language=". $_SESSION['Language']);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$formmsginfo = getdocumentinfo($row["ParentMainId"],array());
			if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
				$acces = true;
			}
		}
	break;
	case "1message":
	$MainId = $msgtypeid;
	$query = "SELECT Id, Bericht, Stat, Username, ParentType, ParentMainId, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  (Stat='normal' OR Stat='Deleted' ) AND MainId=".$MainId." ";

	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	$found = true;
		$msgtype2 = $row["ParentType"];
		$Bericht = $row["Bericht"];
		$ParentMainId = $row["ParentMainId"];
		$Stat = $row['Stat'];
		$Bericht = str_replace ('<', "&lt;",$Bericht);
		$Bericht = str_replace('>', "&gt;",$Bericht);
		//$Bericht = textWrap($Bericht);
		$MainId = $row['MainId'];
		$Filelist = $row['Filelist'];
		$UserId =  $row['UserId'];
		$TheDate = $row['TheDate'];
		$Username = $row['Username'];
		$Id = $row['Id'];
		if ($MainId != ""){
			if ($msgtype2 == "submessage"){
				$MainId = $row["ParentMainId"];
				$msgtypeid = $row["ParentMainId"];
				$query2 = "SELECT Id, Bericht, Stat, Username, ParentType, ParentMainId, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  (Stat='normal' OR Stat='Deleted' ) AND MainId=".$MainId." ";

				$result2 = mysqli_query($link,$query2);
				if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
				}
				while($row2 = mysqli_fetch_array($result2)){
					$msgtype2 = $row2["ParentType"];
					$Bericht = $row2["Bericht"];
					$ParentMainId = $row2["ParentMainId"];
					$Stat = $row['Stat'];
					$Bericht = str_replace ('<', "&lt;",$Bericht);
					$Bericht = str_replace('>', "&gt;",$Bericht);
					$MainId = $row2['MainId'];
					$Filelist = $row2['Filelist'];
					$UserId =  $row2['UserId'];
					$TheDate = $row2['TheDate'];
					$Username = $row2['Username'];
					$Id = $row2['Id'];
				}
			}
			switch ($msgtype2){
			case "user":
			case "privatemessage":
				$acces = accesprofile ($ParentMainId, $_SESSION["Id"]);
				if ($row['ParentType'] =="privatemessage"){
				if ((intval($ParentMainId) == intval($_SESSION["Id"]) or intval($UserId) == intval($_SESSION["Id"]))){
				
				}else{
					$acces = false;
				}}	
							
				break;
			case "usergroup":
				$acces = accesgroup ($ParentMainId, $_SESSION["Id"]);
				break;
			case "richtext":
			case "photogallery":			
				$acces = accesdocumentMessages($ParentMainId,array(), $_SESSION["Id"]);
				break;
		}}
		

	}
	}}
}

if ($acces == true){
	switch ($msgtype){
		case "user":
		case "usergroup":
		case "richtext":
		case "photogallery":
		case "forummsg":
		$query = "SELECT Id, Bericht, Stat, Username, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE ParentMainId =".$msgtypeid." AND ParentType='$msgtype' AND Language =".$_SESSION['Language']." ORDER BY TheDate DESC LIMIT $msgnumber,$amount";
		break;
		case "privatemessage":		
		$query = "SELECT Id, Bericht, Stat, Username, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE (( UserId=".$msgtypeid." AND ParentMainId =".$_SESSION['Id']." ) OR ( ParentMainId =".$msgtypeid." AND UserId=".$_SESSION['Id']." )) AND ParentType='$msgtype' AND Language =".$_SESSION['Language']." ORDER BY TheDate DESC LIMIT $msgnumber,$amount";
		break;
		case "1message":
		$query = "SELECT Id, Bericht, Stat, Username, ParentType, ParentMainId, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  (Stat='normal' OR Stat='Deleted' ) AND MainId=".$msgtypeid." ";
		break;
	}
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$found = 0;
	$i = 0;
	
	while($row = mysqli_fetch_array($result)){
		
		$found++;
		$Stat = $row['Stat'];
		$Bericht = $row['Bericht'];
		$Bericht = str_replace ('<', "&lt;",$Bericht);
		$Bericht = str_replace('>', "&gt;",$Bericht);
		//$Bericht = textWrap($Bericht);
		$MainId = $row['MainId'];
		$Filelist = $row['Filelist'];
		
		if ($row['UserId'] == -1){
					echo '<div id="messagelayout">';

				echo ''.$row['Username'].' as guest <br>'.$row['TheDate'].'';
				echo '<div id="msg'.$msgnumber.'">'.$Bericht.'</div></div>';
		}else{
			$query = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$row['UserId'];
			$result2 = mysqli_query($link,$query);
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}
			$found2 = false;
			while($row2 = mysqli_fetch_array($result2)){
				$found2 = true;
				$Username = $row2['Username'];
			
				
				$Profilepic = $row2['Profilepic'];
				array_push($_SESSION['Accesfiles2'], $Profilepic);
			}
			if ($found2 == false){
				$Username = "Deleted user";
				$Profilepic = "";
			}
			if ($row['UserId'] == $msguserid or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
			
			 switch ($Stat){
				case "normal":
				// normaal berichtbr
				echo '<div id="messagelayout" ><div id="gallerybut">';
				echo '<a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $Username.' </b></a>';
				echo ''.$row['TheDate'].'
				<a href="#" onClick="Enablechangemsg('.($msgnumber+$i).');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/rename.png" alt="edit message"></a><a href="#" onClick="showfilemanager(\'msgfilelist'.($msgnumber+$i).'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a><a href="#" onClick="DeleteMessage('.$row['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete message"></a></div><div id="msgfilelist'.($msgnumber+$i).'" style="display:none">'.$Filelist.'</div><div id="msg'.($msgnumber+$i).'">'.$Bericht.'</div><div id="editmsgdiv'.($msgnumber+$i).'" style="display:none;"><textarea id="editmsg'.($msgnumber+$i).'" name="editmsg'.($msgnumber+$i).'" style="width: 350px; height: 175px;" onkeyup="updatemessage2(\'editmsg'.($msgnumber+$i).'\',\'msgfilelist'.($msgnumber+$i).'\','.($msgnumber+$i).',\'previewmessage'.($msgnumber+$i).'\',true);prettyPrint();" >'.$Bericht.'</textarea><br><div id="previewmessage'.($msgnumber+$i).'"></div>
				<a href="#" onclick="postmessage(document.getElementById(\'editmsg'.($msgnumber+$i).'\').value,  \''.$row["Id"].'\', \'normal\',document.getElementById(\'msgfilelist'.($msgnumber+$i).'\').innerHTML);return false;"><div id="buttonlayout"><h4> Post </h4></div></a></div>';
				// history
				$query3 = "SELECT Id, Bericht, Stat, Username, MainId, UserId,Filelist, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ') AS TheDate FROM reply WHERE MainId ='$MainId' AND Language =".$_SESSION['Language']." AND Stat = 'history' ORDER BY TheDate DESC";
				$result3 = mysqli_query($link,$query3);
				if (!$result) {
					die('Query failed: ' . mysqli_error($link));
				}
				$hisfound = false;
				$hisnum = 0;
				
				$txt = '<div id="historymsg'.($msgnumber+$i).'" style="display:none;">';
				while($row3 = mysqli_fetch_array($result3)){
					$hisfound = true;
					$hBericht = $row3['Bericht'];
					$hBericht = str_replace ('<', "&lt;",$hBericht);
					$hBericht = str_replace('>', "&gt;",$hBericht);
					//$hBericht = textWrap($hBericht);
					$hBericht = '<div id="msg'.($msgnumber+$i).'hs'.$hisnum.'">'.$hBericht.'</div>';
					$hBericht = $hBericht.'<div id="msgfilelist'.($msgnumber+$i).'hs'.$hisnum.'" style="display:none">'.$row3['Filelist'].'</div>';
					$txt = $txt.'<div id="historymsg">'.$hBericht.'</div>___________________<br>';
					$hisnum++;
					
				}
				$txt = $txt.'</div>';
				
				if ($hisfound == true){
					echo '<a href="#" onclick="openhistory(\'historymsg'.($msgnumber+$i).'\'); return false">This message has a history</a>'. $txt;
					
				}
				
				//echo '<div style="width:100%; background-color: yellow;"><br></div>';
				$subnum = 0;
				// submessage
				$query8 = "SELECT Id, Bericht, Stat, Username, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE ParentMainId =".$MainId." AND ParentType='submessage' AND Language =".$_SESSION['Language']." ORDER BY TheDate ";
				$result8 = mysqli_query($link,$query8);
				if (!$result8) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row8 = mysqli_fetch_array($result8)){
				
					$found++;
					//$i++;tr
					
					$Stat8 = $row8['Stat'];
					$Bericht8 = $row8['Bericht'];
					$Bericht8 = str_replace ('<', "&lt;",$Bericht8);
					$Bericht8 = str_replace('>', "&gt;",$Bericht8);
					//$Bericht8 = textWrap($Bericht8);
					$MainId8 = $row8['MainId'];
					$Filelist8 = $row8['Filelist'];
					$query9 = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$row8['UserId'];
					$result9 = mysqli_query($link,$query9);
					if (!$result9) {
						die('Query failed: ' . mysqli_error($link));
					}
					$found9 = false;
						while($row9 = mysqli_fetch_array($result9)){
					$found9 = true;
						$Username9 = $row9['Username'];
			
				
						$Profilepic9 = $row9['Profilepic'];
						array_push($_SESSION['Accesfiles2'], $Profilepic9);
					}
					if ($found2 == false){
						$Username9 = "Deleted user";
						$Profilepic9 = "";
					}
					
					if ($row8['UserId'] == $msguserid or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
					switch ($Stat8){
					
					case "normal":
					$subnum++;
					echo '<div id="submessagelayout"><div id="gallerybut"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a>';
					echo ''.$row8['TheDate'].'
					<a href="#" onClick="Enablechangemsg(\''.($msgnumber+$i).'submsg'.$subnum.'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/rename.png" alt="edit message"></a>
					<a href="#" onClick="showfilemanager(\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a>
					<a href="#" onClick="DeleteMessage('.$row8['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete message"></a></div>
					<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div>
					<div id="msg'.($msgnumber+$i).'submsg'.$subnum.'" >'.$Bericht8.'</div>
					<div id="editmsgdiv'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none;">
					<textarea id="editmsg'.($msgnumber+$i).'submsg'.$subnum.'" name="editmsg'.($msgnumber+$i).'submsg'.$subnum.'" style="width: 100%; height: 175px;" onkeyup="updatemessage2(\'editmsg'.($msgnumber+$i).'submsg'.$subnum.'\',\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\','.($msgnumber+$i).',\'previewmessage'.($msgnumber+$i).'submsg'.$subnum.'\',true);" >'.$Bericht8.'</textarea>
					<br><div id="previewmessage'.($msgnumber+$i).'submsg'.$subnum.'"></div>
					<a href="#" onclick="postmessage(document.getElementById(\'editmsg'.($msgnumber+$i).'submsg'.$subnum.'\').value,  \''.$row8["Id"].'\', \'submessage'.$MainId.'\',document.getElementById(\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\').innerHTML);return false;"><div id="buttonlayout"><h4> Post </h4></div></a></div>';
					
					// history of submessage
					
					$query3 = "SELECT Id, Bericht, Stat, Username, MainId, UserId,Filelist, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ') AS TheDate FROM reply WHERE MainId ='$MainId8' AND Language =".$_SESSION['Language']." AND Stat = 'history' ORDER BY TheDate DESC";
					$result3 = mysqli_query($link,$query3);
					if (!$result) {
						die('Query failed: ' . mysqli_error($link));
					}
					$hisfound = false;
					$hisnum = 0;
				
					$txt = '<div id="historymsg'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none;">';
					while($row3 = mysqli_fetch_array($result3)){
						//$i++;
						$hisfound = true;
						$hBericht = $row3['Bericht'];
						$hBericht = str_replace ('<', "&lt;",$hBericht);
						$hBericht = str_replace('>', "&gt;",$hBericht);
						//$hBericht = textWrap($hBericht);
						$hBericht = '<div id="msg'.($msgnumber+$i).'submsg'.$subnum.'hs'.$hisnum.'">'.$hBericht.'</div>';
						$hBericht = $hBericht.'<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'hs'.$hisnum.'" style="display:none">'.$row3['Filelist'].'</div>';
						$txt = $txt.'<div id="historymsg">'.$hBericht.'</div>___________________<br>';
						$hisnum++;
						
					}
					$txt = $txt.'</div>';
				
					if ($hisfound == true){
						echo '<a href="#" onclick="openhistory(\'historymsg'.($msgnumber+$i).'submsg'.$subnum.'\'); return false">This message has a history</a>'. $txt;
					
					}
					echo '</div>';
					break;
					case "deleted":
					$subnum++;
					echo '<div id="submessagelayout"><div id="gallerybut"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a>';
					echo '<div id="errormsg">'.$row8['TheDate'].'
					<a href="#" onClick="RecoverMessage('.$row8['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="recover message"></a></div><div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div><div id="msg'.($msgnumber+$i).'submsg'.$subnum.'">'.$Bericht8.'</div></div><br></div>';
					
					break;
					
					}
					
					//echo '</div>';
					
					} else {
											switch ($Stat8){
					case "normal":
						$subnum++;
						echo '<div id="submessagelayout"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a><br>'.$row8['TheDate'].'<br>';
						echo '<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div><div id="msg'.($msgnumber+$i).'submsg'.$subnum.'" >'.$Bericht8.'</div><br></div>';
						break;
						}
						
					}
					
				}
				// new submessagetr
				if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
					echo '<div id="submessagelayout"> <div id="gallerybut"><div id="msgnewfilelist'.($msgnumber+$i).'" name="msgnewfilelist'.($msgnumber+$i).'" style="display:none"></div><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$sesid.'"><img src="./system/imgtumb.php?url='.$sesProfilepic.'&maxsize=50&square=1 " align="left">'." <b>". $sesusername.' </b></a>'.date("Y-m-d H:i:s").'<a href="#" onClick="showfilemanager(\'msgnewfilelist'.($msgnumber+$i).'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a></div>';
					echo '<textarea id="newmessage'.($msgnumber+$i).'" name="newmessage'.($msgnumber+$i).'" style="width: 100%; height: 50px;" onkeyup="updatemessage2(\'newmessage'.($msgnumber+$i).'\', \'msgnewfilelist'.($msgnumber+$i).'\',-1,\'previewnewmessage'.($msgnumber+$i).'\',true);" ></textarea> <br>
					<div id="previewnewmessage'.($msgnumber+$i).'"></div>
					<a href="#" onclick="postmessage(document.getElementById(\'newmessage'.($msgnumber+$i).'\').value,  \'newsub'.$MainId.'\', \'normal\',document.getElementById(\'msgnewfilelist'.($msgnumber+$i).'\').innerHTML );return false;"><div id="buttonlayout"><h4> Post </h4></div></a></div>';
				}
				echo '</div>';
				break;
				case "deleted":
				echo '<div id="messagelayout"><div id="gallerybut">';
				echo '<div id="errormsg"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $Username.' </b></a><br>'.$row['TheDate'].'<br>
				<a href="#" onClick="RecoverMessage('.$row['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="recover message"></a></div></div>';
				echo '<div id="msgfilelist'.($msgnumber+$i).'" style="display:none">'.$Filelist.'</div><div id="errormsg"><div id="msg'.($msgnumber+$i).'">'.$Bericht.'</div></div><br>';
				echo '</div>';
				break;
				}
			}else{
			 switch ($Stat){
				case "normal":
				$filelist =  explode("<li>", $Filelist);
				for($ii = 0; $ii < count($filelist); $ii++) {
					$imgname =  substr($filelist[$ii] , 0, -5 );
	
					array_push($_SESSION['Accesfiles2'], $imgname);
				}

				echo '<div id="messagelayout">';
				echo '<a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $Username.' </b></a>';
				echo ''.$row['TheDate'].'<br><div id="msgfilelist'.($msgnumber+$i).'" style="display:none">'.$Filelist.'</div><div id="msg'.($msgnumber+$i).'">'.$Bericht.'</div><br>';
$subnum = 0;
				// submessage
				$query8 = "SELECT Id, Bericht, Stat, Username, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE ParentMainId =".$MainId." AND ParentType='submessage' AND Language =".$_SESSION['Language']." ORDER BY TheDate ";
				$result8 = mysqli_query($link,$query8);
				if (!$result8) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row8 = mysqli_fetch_array($result8)){
					$found++;
					//$i++;
					
					$Stat8 = $row8['Stat'];
					$Bericht8 = $row8['Bericht'];
					$Bericht8 = str_replace ('<', "&lt;",$Bericht8);
					$Bericht8 = str_replace('>', "&gt;",$Bericht8);
					//$Bericht8 = textWrap($Bericht8);
					$MainId8 = $row8['MainId'];
					$Filelist8 = $row8['Filelist'];
					$query9 = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$row8['UserId'];
					$result9 = mysqli_query($link,$query9);
					if (!$result9) {
						die('Query failed: ' . mysqli_error($link));
					}
					$found9 = false;
						while($row9 = mysqli_fetch_array($result9)){
					$found9 = true;
						$Username9 = $row9['Username'];
			
				
						$Profilepic9 = $row9['Profilepic'];
						array_push($_SESSION['Accesfiles2'], $Profilepic9);
					}
					if ($found2 == false){
						$Username9 = "Deleted user";
						$Profilepic9 = "";
					}
					if ($row8['UserId'] == $msguserid or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
					switch ($Stat8){
					case "normal":
					$subnum++;
					echo '<div id="submessagelayout"><div id="gallerybut"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a>';
					echo ''.$row8['TheDate'].'
					<a href="#" onClick="Enablechangemsg(\''.($msgnumber+$i).'submsg'.$subnum.'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/rename.png" alt="edit message"></a>
					<a href="#" onClick="showfilemanager(\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a>
					<a href="#" onClick="DeleteMessage('.$row8['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete message"></a></div>
					<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div>
					<div id="msg'.($msgnumber+$i).'submsg'.$subnum.'" >'.$Bericht8.'</div>
					<div id="editmsgdiv'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none;">
					<textarea id="editmsg'.($msgnumber+$i).'submsg'.$subnum.'" name="editmsg'.($msgnumber+$i).'submsg'.$subnum.'" style="width: 100%; height: 175px;" onkeyup="updatemessage2(\'editmsg'.($msgnumber+$i).'submsg'.$subnum.'\',\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\','.($msgnumber+$i).',\'previewmessage'.($msgnumber+$i).'submsg'.$subnum.'\',true);prettyPrint();" >'.$Bericht8.'</textarea>
					<br><div id="previewmessage'.($msgnumber+$i).'submsg'.$subnum.'"></div>
					<a href="#" onclick="postmessage(document.getElementById(\'editmsg'.($msgnumber+$i).'submsg'.$subnum.'\').value,  \''.$row8["Id"].'\', \'submessage'.$MainId.'\',document.getElementById(\'msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'\').innerHTML);return false;"><div id="buttonlayout"><h4> Post </h4></div> </a></div><br>';
					// history of submessagetd
					$query3 = "SELECT Id, Bericht, Stat, Username, MainId, UserId,Filelist, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ') AS TheDate FROM reply WHERE MainId ='$MainId8' AND Language =".$_SESSION['Language']." AND Stat = 'history' ORDER BY TheDate DESC";
					$result3 = mysqli_query($link,$query3);
					if (!$result) {
						die('Query failed: ' . mysqli_error($link));
					}
					$hisfound = false;
					$hisnum = 0;
				
					$txt = '<div id="historymsg'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none;">';
					while($row3 = mysqli_fetch_array($result3)){
						//$i++;
						$hisfound = true;
						$hBericht = $row3['Bericht'];
						$hBericht = str_replace ('<', "&lt;",$hBericht);
						$hBericht = str_replace('>', "&gt;",$hBericht);
						//$hBericht = textWrap($hBericht);
						$hBericht = '<div id="msg'.($msgnumber+$i).'submsg'.$subnum.'hs'.$hisnum.'">'.$hBericht.'</div>';
						$hBericht = $hBericht.'<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'hs'.$hisnum.'" style="display:none">'.$row3['Filelist'].'</div>';
						$txt = $txt.'<div id="historymsg">'.$hBericht.'</div>___________________<br>';
						$hisnum++;
					
					}
					$txt = $txt.'</div>';
				
					if ($hisfound == true){
						echo '<a href="#" onclick="openhistory(\'historymsg'.($msgnumber+$i).'submsg'.$subnum.'\'); return false">This message has a history</a>'. $txt;
					
					}
					echo '</div>';//echo '</div>';
					break;
					case "deleted":
					$subnum++;
					echo '<div id="submessagelayout"><div id="gallerybut"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a>';
					echo '<div id="errormsg">'.$row8['TheDate'].'
					<a href="#" onClick="RecoverMessage('.$row8['Id'].');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="recover message"></a></div><div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div><div id="msg'.($msgnumber+$i).'submsg'.$subnum.'">'.$Bericht8.'</div></div><br>';
					echo '</div>';
					break;
					}
					} else {
					switch ($Stat8){
					case "normal":
						$subnum++;
						echo '<div id="submessagelayout"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$row8['UserId'].'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a><br>'.$row8['TheDate'].'<br>';
						echo '<div id="msgfilelist'.($msgnumber+$i).'submsg'.$subnum.'" style="display:none">'.$Filelist8.'</div><div id="msg'.($msgnumber+$i).'submsg'.$subnum.'" >'.$Bericht8.'</div><br>';
						echo '</div>';
						break;
						}
					}
				}
				// new submessage
				if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
					echo '<div id="submessagelayout"> <div id="gallerybut"><div id="msgnewfilelist'.($msgnumber+$i).'" name="msgnewfilelist'.($msgnumber+$i).'" style="display:none"></div><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$sesid.'"><img src="./system/imgtumb.php?url='.$sesProfilepic.'&maxsize=50&square=1 " align="left">'." <b>". $sesusername.' </b></a>'.date("Y-m-d H:i:s").'<a href="#" onClick="showfilemanager(\'msgnewfilelist'.($msgnumber+$i).'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a></div>';
					echo '<textarea id="newmessage'.($msgnumber+$i).'" name="newmessage'.($msgnumber+$i).'" style="width:100%; height: 50px;" onkeyup="updatemessage2(\'newmessage'.($msgnumber+$i).'\', \'msgnewfilelist'.($msgnumber+$i).'\',-1,\'previewnewmessage'.($msgnumber+$i).'\',true);prettyPrint();" ></textarea> <br>
					<div id="previewnewmessage'.($msgnumber+$i).'"></div>
					<a href="#" onclick="postmessage(document.getElementById(\'newmessage'.($msgnumber+$i).'\').value,  \'newsub'.$MainId.'\', \'normal\',document.getElementById(\'msgnewfilelist'.($msgnumber+$i).'\').innerHTML );return false;"><div id="buttonlayout"><h4> Post </h4></div></a>';
					echo '</div>';
				}
				echo '</div>';
				break;
				case "deleted":
				echo '';
				echo '<div id="msg'.($msgnumber+$i).'"></div><br>';
				break;
				}
				
			}
			
		}
		$i++;
	}
	if ($found < 10){
		echo '<div id="theend">no more messages</div>';
	}
	
}else{
	echo 'acces denied';
}

mysqli_close ($link);

?>
