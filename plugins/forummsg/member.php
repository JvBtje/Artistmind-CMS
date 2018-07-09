<?php
$output .= '
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";

</script>'
;
$output .= '<script language="javascript">


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

</script>';


if ($type=="new_Language"){

}else if($type=="edit"){
		$tmpMainidtje = $MainId;
			
			$MainId = intval($_GET["subid"]);
			
			if ($MainId > 0){
				$acces = false;
				$result = mysqli_query($link,"SELECT Id, Bericht, TheDate, ParentMainId,Email, Username, Language, ParentType, UserId, MainId, Stat, Filelist, name FROM reply WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']." AND Stat != 'history'");
				if (!$result) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row = mysqli_fetch_array($result)){
					if (isset($_SESSION["Id"])) {
						$formmsginfo = getdocumentinfo($row["ParentMainId"],array(), $_SESSION["Id"]);
					}else{
						$formmsginfo = getdocumentinfo($row["ParentMainId"],array());
					}
					if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
						$changemessage = "false";
						if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
								$changemessage= "true";
							}
						$query2 = "SELECT Id, UserId, TheDate, MainId FROM reply WHERE Id =".$MainId;
						$result2 = mysqli_query($link,$query2);
						if (!$result2) {
							die('Query failed: ' . mysqli_error($link));
						}
						
						while($row2 = mysqli_fetch_array($result2)){
							$found = true;
							$UserId = $row["UserId"];
							$TheDate = $row["TheDate"];
							
							if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($row["UserId"])) ){
								$changemessage= "true";
							}	
						}
						if ($changemessage == "true"){
							$url = "./indexnew.php?plugin=forummsg&sectie=$sectie&type=select&Id=$tmpMainidtje&subid=$MainId";
							$output .= '<div id="buttonlayout">
							<h4> <a href="'.$url.'">Cancel</a></h4>
							</div>';
							if($row["Stat"] == "normal"){
								$output .= '<div id="buttonlayout">
								<h4> <a href="#" onClick="DeleteMessage('.$row["Id"].');return false;">Delete</a></h4>
								</div><br>';
							} else {
								$output .= '<div id="buttonlayout">
								<h4> <a href="#" onClick="RecoverMessage('.$row["Id"].');return false;">Recover</a></h4>
								</div><br>';
							}
						
						
													
						$output .= '';
							$query5 = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$_SESSION['Id'];
							$result5 = mysqli_query($link,$query5);
								if (!$result5) {
									die('Query failed: ' . mysqli_error($link));
								}

								while($row5 = mysqli_fetch_array($result5)){
									$id = $row5['Id'];
									$Profilepic = $row5['Profilepic'];
									array_push($_SESSION['Accesfiles2'], $Profilepic);
									$output .= '<nowbr><div id="msgnewfilelist" name="msgnewfilelist" style="display:none">'.$row["Filelist"].'</div><a href="Users.php?type=Profile&Id='.$id.'"><img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $row['Username'].' </b></a><br>'.date("Y-m-d H:i:s").'<br><div id="gallerybut"><a href="#" onClick="showfilemanager(\'msgnewfilelist\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a></div></div>';
								}
								
									$output .= 'title: <input type="text" name="msgtitle" id="msgtitle" value="'.$row["name"].'" size="24" border="0" onkeyup="updatemessage2(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');">';
								

								
										$output .= '<textarea id="newmessage" name="newmessage" style="width: 100%; height: 175px;" onkeyup="updatemessage2(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');" >'.$row["Bericht"].'</textarea> <br>
							<div id="previewmessage"></div>';
									$output .= '<a href="#" onclick="postmessage(document.getElementById(\'newmessage\').value,  \''.$row["Id"].'\', \'normal\',document.getElementById(\'msgnewfilelist\').innerHTML,undefined,undefined,undefined,document.getElementById(\'msgtitle\').value );return false;"><div id="buttonlayout"><h4> Post </h4></div></a>';
								
							$output .='</nowbr></div>';
							$after .= '<script>updatemessage(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');</script>';
								$msgview = false;
								$msgpost = false;
								$msgtypeid = $MainId;
								$msgforumid = $tmpMainidtje;
								$msgtype = "forum";
								$msgname = true;
						}
					}else{
						$output .= 'acces denied';
					}
				}	
			}else {
				$output .= 'oops... something whent wrong';
			}
			$MainId= $tmpMainidtje;
}else if($type=="select") {
			$tmpMainidtje = $MainId;
			
			$MainId = intval($_GET["subid"]);
			
			if ($MainId > 0){
				$acces = false;
				$result = mysqli_query($link,"SELECT Id, Bericht, TheDate, ParentMainId,Email, Username, Language, ParentType, UserId, MainId, Stat, Filelist, name FROM reply WHERE id=".$MainId." AND Language=". $_SESSION['Language']);
				if (!$result) {
					die('Query failed: ' . mysqli_error($link));
				}

				while($row = mysqli_fetch_array($result)){
					if (isset($_SESSION["Id"])) {
						$formmsginfo = getdocumentinfo($row["ParentMainId"],array(), $_SESSION["Id"]);
					}else{
						$formmsginfo = getdocumentinfo($row["ParentMainId"],array());
					}
					
					if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
						$changemessage = "false";
						if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator' ) ){
								$changemessage= "true";
							}
						$query2 = "SELECT Id, UserId, TheDate, MainId FROM reply WHERE Id =".$MainId;
						$result2 = mysqli_query($link,$query2);
						if (!$result2) {
							die('Query failed: ' . mysqli_error($link));
						}
						
						while($row2 = mysqli_fetch_array($result2)){
							$found = true;
							$UserId = $row["UserId"];
							$TheDate = $row["TheDate"];
							$MainId = $row["MainId"];
							if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Member' and intval($_SESSION['Id']) == intval($row["UserId"])) ){
								$changemessage= "true";
							}	
						}
						if ($changemessage == "true"){
							
							$url = "./indexnew.php?plugin=forummsg&sectie=$sectie&type=edit&Id=$tmpMainidtje&subid=$MainId";
							$output .= '<div id="buttonlayout">
							<h4> <a href="'.$url.'">Edit</a></h4>
							</div><br>';
						}
						if ($changemessage == "true" or $row["Stat"] == "normal"){
							$query9 = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$UserId;
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
							$Files = explode("<li>",$row["Filelist"]);
							foreach ($Files as $Thefile) {
								$Thefilelength = strlen($Thefile);
								$filetype = substr ($Thefile,0,strlen($Thefile)-5);
								$filetype = explode(".",$filetype);
								
								if (mb_strtolower ($filetype[2]) == "jpg" or mb_strtolower ($filetype[2]) == "png" or mb_strtolower ($filetype[2]) == "jpeg"){
									$imgurl = substr ($Thefile,0,strlen($Thefile)-5);
									array_push($_SESSION['Accesfiles2'], $imgurl);
									
								}
							}
							$output .= '<nowbr><input type="hidden" name="forumname" id="forumname" value="'.$row["name"].'">
										<input type="hidden" name="Bericht" id="Bericht" value="'.$row["Bericht"].'">
										<div name="Filelist" id="Filelist" style="display:none">'.$row["Filelist"].'</div></nowbr>';
							$output .= '<a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$UserId.'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic9.'&maxsize=50&square=1 " align="left">'." <b>". $Username9.' </b></a><br>'.$row['TheDate'].'<br><br>';
							$output .= '<div id="formmessage"></div>';
							$after .= '<script>updatemessage(\'Bericht\', \'Filelist\',-1,\'formmessage\','.$changemessage.',\'forumname\');</script>';
							$msgview = true;
							$msgpost = true;
							$msgtypeid = $MainId;
							$msgtype = "forummsg";
							$msgname = false;
						}
					}else{
						$output .= 'acces denied';
					}
				}	
			}else {
				$output .= 'oops... something whent wrong';
			}
			$MainId= $tmpMainidtje;
}else if ($type=="new"){
			$forumid = intval($_GET["forummainid"]);
			if ($forumid > 0){
				$acces = false;
				if (isset($_SESSION["Id"])) {
					$formmsginfo = getdocumentinfo($forumid,array(), $_SESSION["Id"]);
				}else{
					$formmsginfo = getdocumentinfo($forumid,array());
				}
				
				if ($formmsginfo["accesdoc"] == true and $formmsginfo["accesmsg"] == true){
					$result = mysqli_query($link,"SELECT Naam FROM groepen WHERE MainId=".$forumid." AND Language=". $_SESSION['Language']);
					if (!$result) {
						die('Query failed: ' . mysqli_error($link));
					}

					while($row = mysqli_fetch_array($result)){
						$output .= '<h1>'.$row["Naam"].'</h1>';
					}
					$msgview = false;
					$msgpost = true;
					$msgtypeid = $forumid;
					$msgtype = "forum";
					$msgname = true;
				}else{
					$output .= 'acces denied';
				}
				
			}else {
				$output .= 'oops... something whent wrong';
			}

}else{
	$output .= 'oops... something whent wrong';
}
$MainId = $MainIdGroup;


?>
