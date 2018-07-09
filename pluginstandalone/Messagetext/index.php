<?php
// Init session settings
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
  
$output .= '
<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">
var myNicEditor1,myNicEditor2,myNicEditor3,myNicEditor4;

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexstandalone.php?plugin=MessageText&type=new_Language\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexstandalone.php?plugin=MessageText&type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexstandalone.php?plugin=MessageText&language_id=\'+veld,\'_self\',\'\',\'true\');
	} 
	
 }
function addArea2() {
	//myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\', thehtml : \'hallo\'}).panelInstance(\'Text1\',\'test\',\'hallo wereld\');
}
function removeArea2() {
	//myNicEditor1.removeInstance(\'Text1\');	
}


function window_onload2(){
			 myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'introreply\');
			 myNicEditor2 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Nomailtext\');
			 myNicEditor3 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'somebodyrespondtext\');
			 myNicEditor4 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'messageplaced\');
}


function changeval(){
	document.forms["form1"]["changed"].value = "true";
}

function submitform2(){
document.form1.submit();
}

function submitform(){

	document.forms["form1"]["changed"].value = "false";	
	myNicEditor1.removeInstance(\'introreply\');	
	myNicEditor2.removeInstance(\'Nomailtext\');	
	myNicEditor3.removeInstance(\'somebodyrespondtext\');	
	myNicEditor4.removeInstance(\'messageplaced\');	
	document.form1.submit();
}
function dofilemanager(link){
	document.getElementById(window.elementvar).value = link;	
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

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { submitform()}
}}
</script>';

$myUrl = explode("?", curPageURL());



if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
				$output .='	<form action="indexstandalone.php?plugin=MessageText&type=save_Language" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';
				$result = mysqli_query($link,"SELECT Id, Language FROM messagetext");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	while($row = mysqli_fetch_array($result)){
		$Present_Language[$Present_Language.sizeof] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id != ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." AND Id != ".$row['Language'];
		}
	}
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$output .= '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected ';}
	$output .= '>'.$row2['Language'].'</option>';
	}
	$output .= '</select><br><br><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform2()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></form>
	';

	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="save_Language"){
	$newlanguage = intval($_POST["language"]);
	$found = false;
	if ($newlanguage <> ""){
	$result = mysqli_query($link,"SELECT Id FROM messagetext WHERE Language =".$newlanguage);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$found = true;
	}
	if ($found == true){
		$message = "Language already exist";
	}else{
		$message = "Language is created";
	$result =  mysqli_query($link,"SELECT Id, Replystext, Reply, Noreplyfound, introreply, Usernametext, emailtext, secretcodetext, insertsecretcodetext, informmetext, messagetext, messagebuttontext, Nomailtext, somebodyrespondtext, messageplaced, nomessagefound, emailisempty, messageisempty, usernameisempty, wrongsecretcode FROM messagetext WHERE Language =".$_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	$Id = intval($row["Id"]);
	$Replystext= $row["Replystext"];
	$Reply= $row["Reply"];
	$Noreplyfound= $row["Noreplyfound"];
	$introreply= $row["introreply"];
	$Usernametext= $row["Usernametext"];
	$emailtext= $row["emailtext"];
	$secretcodetext= $row["secretcodetext"];
	$insertsecretcodetext= $row["insertsecretcodetext"];
	$informmetext= $row["informmetext"];
	$messagetext= $row["messagetext"];
	$messagebuttontext= $row["messagebuttontext"];
	$Nomailtext= $row["Nomailtext"];
	$somebodyrespondtext= $row["somebodyrespondtext"];
	$messageplaced= $row["messageplaced"];
	$nomessagefound= $row["nomessagefound"];
	$emailisempty= $row["emailisempty"];
	$messageisempty= $row["messageisempty"];
	$usernameisempty= $row["usernameisempty"];
	$wrongsecretcode= $row["wrongsecretcode"];	

	}

// Voor zoekt iso6931 codes op voor vertaling
	
	
	$Replystext= addslashes($Replystext);
	$Reply= addslashes($Reply);
	$Noreplyfound= addslashes($Noreplyfound);
	$introreply= addslashes($introreply);
	$Usernametext= addslashes($Usernametext);
	$emailtext= addslashes($emailtext);
	$secretcodetext= addslashes($secretcodetext);
	$insertsecretcodetext= addslashes($insertsecretcodetext);
	$informmetext=addslashes($informmetext);
	$messagetext= addslashes($messagetext);
	$messagebuttontext= addslashes($messagebuttontext);
	$Nomailtext= addslashes($Nomailtext);
	$somebodyrespondtext= addslashes($somebodyrespondtext);
	$messageplaced= addslashes($messageplaced);
	$nomessagefound= addslashes($nomessagefound);
	$emailisempty= addslashes($emailisempty);
	$messageisempty= addslashes($messageisempty);
	$usernameisempty= addslashes($usernameisempty);
	$wrongsecretcode= addslashes($wrongsecretcode);

	mysqli_query($link,"INSERT INTO messagetext (Language, Replystext, Reply, Noreplyfound, introreply, Usernametext, emailtext, secretcodetext, insertsecretcodetext, informmetext, messagetext, messagebuttontext, Nomailtext, somebodyrespondtext, messageplaced, nomessagefound, emailisempty, messageisempty, usernameisempty, wrongsecretcode) VALUES ('$newlanguage', '$Replystext', '$Reply', '$Noreplyfound', '$introreply', '$Usernametext', '$emailtext', '$secretcodetext', '$insertsecretcodetext', '$informmetext', '$messagetext', '$messagebuttontext', '$Nomailtext', '$somebodyrespondtext', '$messageplaced', '$nomessagefound', '$emailisempty', '$messageisempty', '$usernameisempty', '$wrongsecretcode')")or ($message = mysqli_error($link));
	$_SESSION['Language'] = $newlanguage;
	}

	} else {
	$output .= 'error new language is not set';
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=MessageText\',\'_self\',\'\',\'true\')", 0);</script>';
} else if ($type=="delete_Language"){
	//if ($_SESSION['Language'] != "" and $_SESSION['Language'] != -1 and $_GET['delete_Language_Id'] == $_SESSION['Language']){
	$message = "";
		mysqli_query($link,"DELETE FROM messagetext WHERE Id=".intval($_GET['delete_Language_Id']))or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=MessageText\',\'_self\',\'\',\'true\')", 0);</script>';
}else if ($type=="save"){
	$Id = intval($_POST["Id"]);
	$Replystext= $_POST["Replystext"];
	$Reply= $_POST["Reply"];
	$Noreplyfound= $_POST["Noreplyfound"];
	$introreply= $_POST["introreply"];
	$Usernametext= $_POST["Usernametext"];
	$emailtext= $_POST["emailtext"];
	$secretcodetext= $_POST["secretcodetext"];
	$insertsecretcodetext= $_POST["insertsecretcodetext"];
	$informmetext= $_POST["informmetext"];
	$messagetext= $_POST["messagetext"];
	$messagebuttontext= $_POST["messagebuttontext"];
	$Nomailtext= $_POST["Nomailtext"];
	$somebodyrespondtext= $_POST["somebodyrespondtext"];
	$messageplaced= $_POST["messageplaced"];
	$nomessagefound= $_POST["nomessagefound"];
	$emailisempty= $_POST["emailisempty"];
	$messageisempty= $_POST["messageisempty"];
	$usernameisempty= $_POST["usernameisempty"];
	$wrongsecretcode= $_POST["wrongsecretcode"];	
	
	$Replystext= addslashes($Replystext);
	$Reply= addslashes($Reply);
	$Noreplyfound= addslashes($Noreplyfound);
	$introreply= addslashes($introreply);
	$Usernametext= addslashes($Usernametext);
	$emailtext= addslashes($emailtext);
	$secretcodetext= addslashes($secretcodetext);
	$insertsecretcodetext= addslashes($insertsecretcodetext);
	$informmetext=addslashes($informmetext);
	$messagetext= addslashes($messagetext);
	$messagebuttontext= addslashes($messagebuttontext);
	$Nomailtext= addslashes($Nomailtext);
	$somebodyrespondtext= addslashes($somebodyrespondtext);
	$messageplaced= addslashes($messageplaced);
	$nomessagefound= addslashes($nomessagefound);
	$emailisempty= addslashes($emailisempty);
	$messageisempty= addslashes($messageisempty);
	$usernameisempty= addslashes($usernameisempty);
	$wrongsecretcode= addslashes($wrongsecretcode);
	/*
	$Nieuwsbriefnaam = str_replace("\\", "\\\\", $Nieuwsbriefnaam);
	$Nieuwsbriefnaam = str_replace('"', " ", $Nieuwsbriefnaam);
	$Nieuwsbriefnaam = str_replace("'", " ", $Nieuwsbriefnaam);
	$Aanmeldtekst = str_replace("\\", "\\\\", $Aanmeldtekst);
	$Aanmeldtekst = str_replace('"', " ", $Aanmeldtekst);
	$Aanmeldtekst = str_replace("'", " ", $Aanmeldtekst);
	$AfmeldTekst = str_replace("\\", "\\\\", $AfmeldTekst);
	$AfmeldTekst = str_replace('"', " ", $AfmeldTekst);
	$AfmeldTekst = str_replace("'", " ", $AfmeldTekst);
	$NieuwsbriefHeadding= addslashes($NieuwsbriefHeadding);
	$Nieuwsbrieffooter= addslashes($Nieuwsbrieffooter);
	$Welkomtekstmessage= addslashes($Welkomtekstmessage);
	$Afmeldtekstmessage= addslashes($Afmeldtekstmessage);
	*/
	
	$message = "";
	$error = false;
	if ($Id == "new"){
		$systemPassword = "";
	}else{
		$query = "SELECT Password FROM login WHERE Id=$Id";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
	
		while($row = mysqli_fetch_array($result)){
			$systemPassword = $row['Password'];
		}
	}
	
		
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=MessageText\',\'_self\',\'\',\'true\')", 2222);</script>';		
	mysqli_query($link,"UPDATE messagetext SET
	Replystext= '$Replystext',
	Reply= '$Reply',
	Noreplyfound= '$Noreplyfound',
	introreply= '$introreply',
	Usernametext= '$Usernametext',
	emailtext= '$emailtext',
	secretcodetext= '$secretcodetext',
	insertsecretcodetext= '$insertsecretcodetext',
	informmetext='$informmetext',
	messagetext= '$messagetext',
	messagebuttontext= '$messagebuttontext',
	Nomailtext= '$Nomailtext',
	somebodyrespondtext= '$somebodyrespondtext',
	messageplaced= '$messageplaced',
	nomessagefound= '$nomessagefound',
	emailisempty= '$emailisempty',
	messageisempty= '$messageisempty',
	usernameisempty= '$usernameisempty',
	wrongsecretcode= '$wrongsecretcode' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	//mysqli_query($link,"UPDATE Nieuwsbrief SET Nieuwsbriefnaam = '$Nieuwsbriefnaam',NieuwsbriefHeadding = '$NieuwsbriefHeadding',Nieuwsbrieffooter = '$Nieuwsbrieffooter',Aanmeldtekst = '$Aanmeldtekst',AfmeldTekst = '$AfmeldTekst ',Welkomtekstmessage = '$Welkomtekstmessage', Afmeldtekstmessage = '$Afmeldtekstmessage' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="message text saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=MessageText\',\'_self\',\'\',\'true\')", 0);</script>';
}else {
$result = mysqli_query($link,"SELECT Id FROM messagetext WHERE Language =".$_SESSION['Language'] );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Id = -1;
	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
	}
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				
	$result = mysqli_query($link,"SELECT Id, Language FROM messagetext");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false; 
	while($row = mysqli_fetch_array($result)){
		$Present_Language[count($Present_Language)] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id = ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." OR Id = ".$row['Language'];
		}
	}
	
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$output .= '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected '; $foundLanguage = true;}
	$output .= '>'.$row2['Language'].'</option>';
	}
	
	if ( $foundLanguage == true){$output .= '<option value="new">new</option>';}else if ($_SESSION['Language']==""){$_SESSION['Language'] = -1;}
	if (count($Present_Language) > 1 and $foundLanguage == true){$output .= '<option value="delete">Delete current</option>';}
	$output .= '</select>
				</td>
			</tr>
			<tr>
			
				<td>';

	$query = "SELECT Id, Replystext, Reply, Noreplyfound, introreply, Usernametext, emailtext, secretcodetext, insertsecretcodetext, informmetext, messagetext, messagebuttontext, Nomailtext, somebodyrespondtext, messageplaced, nomessagefound, emailisempty, messageisempty, usernameisempty, wrongsecretcode FROM messagetext WHERE Language =".$_SESSION['Language'];
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Text1 = $row['Text1'];
		$Text2 = $row['Text2'];
		$Text3 = $row['Text3'];
		
		$output .= '
		
		<div id="contain">
		<form action="indexstandalone.php?plugin=MessageText&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>A heading for the reply\'s </td><td><input type="text" id="Replystext" name="Replystext" value="'.$row['Replystext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text when there is no reply</td><td><input type="text" id="Noreplyfound" name="Noreplyfound" value="'.$row['Noreplyfound'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>A heading for inserting a reply</td><td><input type="text" id="Reply" name="Reply" value="'.$row['Reply'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr colspan="2"><td>Introduction for the reply</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="introreply" name="introreply" style="width: 550px; height: 100px;" >'.$row['introreply'].'</textarea></div></td></tr>
		<tr><td>Text before insert of the Username</td><td><input type="text" id="Usernametext" name="Usernametext" value="'.$row['Usernametext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text before insert of the email</td><td><input type="text" id="emailtext" name="emailtext" value="'.$row['emailtext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text before the secret code</td><td><input type="text" id="secretcodetext" name="secretcodetext" value="'.$row['secretcodetext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text before the insert of the secret code</td><td><input type="text" id="insertsecretcodetext" name="insertsecretcodetext" value="'.$row['insertsecretcodetext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text before the inform me checkbox</td><td><input type="text" id="informmetext" name="informmetext" value="'.$row['informmetext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text before the messagebox</td><td><input type="text" id="messagetext" name="messagetext" value="'.$row['messagetext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Text for the insert message button</td><td><input type="text" id="messagebuttontext" name="messagebuttontext" value="'.$row['messagebuttontext'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr colspan="2"><td>Message if sombody don\'t whant email anymore</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="Nomailtext" name="Nomailtext" style="width: 550px; height: 100px;" >'.$row['Nomailtext'].'</textarea></div></td></tr>
		<tr colspan="2"><td>Message if sombody respond on that persons message</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="somebodyrespondtext" name="somebodyrespondtext" style="width: 550px; height: 100px;" >'.$row['somebodyrespondtext'].'</textarea></div></td></tr>
		<tr colspan="2"><td>Message when the message is placed</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="messageplaced" name="messageplaced" style="width: 550px; height: 100px;" >'.$row['messageplaced'].'</textarea></div></td></tr>
		<tr><td>Message when there are no message\'s</td><td><input type="text" id="nomessagefound" name="nomessagefound" value="'.$row['nomessagefound'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message when email is empty</td><td><input type="text" id="emailisempty" name="emailisempty" value="'.$row['emailisempty'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message when message is empty</td><td><input type="text" id="messageisempty" name="messageisempty" value="'.$row['messageisempty'].'" size="30" border="0" onchange="changeval();"></td></tr>		
		<tr><td>Error message when username is empty</td><td><input type="text" id="usernameisempty" name="usernameisempty" value="'.$row['usernameisempty'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message when secret code is wrong</td><td><input type="text" id="wrongsecretcode" name="wrongsecretcode" value="'.$row['wrongsecretcode'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td><div id="buttonlayout">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td><td></td></tr></table>
			

		</form></div>';
		
	}
	$output .= '</td>
			</tr>
		</table><script>//window_onload2();</script>';
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
