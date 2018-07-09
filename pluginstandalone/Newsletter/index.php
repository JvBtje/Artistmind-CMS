<?php
// Init session settings
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
 $output .= '
 <script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">
var myNicEditor1;
var myNicEditor2;
var myNicEditor3;
var myNicEditor4;

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexstandalone.php?plugin=Newsletter&type=new_Language\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexstandalone.php?plugin=Newsletter&type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexstandalone.php?plugin=Newsletter&language_id=\'+veld,\'_self\',\'\',\'true\');
	} 
	
 }
function addArea2() {
	myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\', thehtml : \'hallo\'}).panelInstance(\'Text1\',\'test\',\'hallo wereld\');
}
function removeArea2() {
	myNicEditor1.removeInstance(\'Text1\');	
}


function window_onload(){
			 myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'NieuwsbriefHeadding\');
			 myNicEditor2 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Nieuwsbrieffooter\');
			 myNicEditor3 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Welkomtekstmessage\');
			 myNicEditor4 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Afmeldtekstmessage\');
}


function changeval(){
	document.forms["form1"]["changed"].value = "true";
}

function submitform2(){
document.form1.submit();
}

function submitform(){

	document.forms["form1"]["changed"].value = "false";	
	myNicEditor1.removeInstance(\'NieuwsbriefHeadding\');	
	myNicEditor2.removeInstance(\'Nieuwsbrieffooter\');	
	myNicEditor3.removeInstance(\'Welkomtekstmessage\');	
	myNicEditor4.removeInstance(\'Afmeldtekstmessage\');	
	document.form1.submit();
}
function dofilemanager(link){
	document.getElementById(window.elementvar).value = link;	
	hidefilemanager();
}

function showfilemanager(elementvar){
	document.getElementById(\'filelinker\').src = \'./itemenfile.php\';
	window.elementvar = elementvar;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'filemanager\').style.display = \'block\';
}
function hidefilemanager(){	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'filemanager\').style.display = \'none\';
}
function resizeFrame(){		
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
     	 realWidth = parseInt(realWidth) - 70;
	 realHeight =  parseInt(realHeight) - 120;
       	document.getElementById("filelinker").style.height = realHeight + \'px\';
     	document.getElementById("filelinker").style.width = realWidth + \'px\';
  setTimeout(\'resizeFrame()\', 999);
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { submitform()}
}}
</script>';

$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien

if ($type=="new_Language"){
		 $output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td> </td>
			</tr>
			<tr>
				<td width="33%">';
	// ouput user selectie
	
	
	 $output .= '</td>
				<td>';
				 $output .='	<form action="indexstandalone.php?plugin=Newsletter&type=save_Language" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';
				$result = mysqli_query($link,"SELECT Id, Language FROM nieuwsbrief");
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
	if ($_SESSION['Language'] == $row2['Id']){ $output .= ' selected ';}
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
	$result = mysqli_query($link,"SELECT Id FROM nieuwsbrief WHERE Language =".$newlanguage);
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
	$result = mysqli_query($link,"SELECT Id, MainId, Nieuwsbriefnaam, Language, NieuwsbriefHeadding, Nieuwsbrieffooter, Aanmeldtekst, AfmeldTekst, Welkomtekstmessage, Afmeldtekstmessage FROM nieuwsbrief WHERE Language =".$_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	$MainId = $row["MainId"];
	$Nieuwsbriefnaam = $row["Nieuwsbriefnaam"];
	$NieuwsbriefHeadding = $row["NieuwsbriefHeadding"]; 
	$Nieuwsbrieffooter = $row["Nieuwsbrieffooter"]; 
	$Aanmeldtekst = $row["Aanmeldtekst"]; 
	$AfmeldTekst = $row["AfmeldTekst"]; 
	$Welkomtekstmessage = $row["Welkomtekstmessage"]; 
	$Afmeldtekstmessage = $row["Afmeldtekstmessage"];  
	$Langinputid = $row['Language'];
	}

// Voor zoekt iso6931 codes op voor vertaling
	

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

	mysqli_query($link,"INSERT INTO nieuwsbrief (MainId, Nieuwsbriefnaam, NieuwsbriefHeadding, Nieuwsbrieffooter,Language, Aanmeldtekst, AfmeldTekst, Welkomtekstmessage, Afmeldtekstmessage) VALUES ('$MainId', '$Nieuwsbriefnaam','$NieuwsbriefHeadding','$Nieuwsbrieffooter','$newlanguage','$Aanmeldtekst','$AfmeldTekst','$Welkomtekstmessage','$Afmeldtekstmessage')")or ($message = mysqli_error($link));
	$_SESSION['Language'] = $newlanguage;
	}
		 $output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td> </td>
			</tr>
			<tr>
				<td width="30%">';
	// ouput user selectie
	
	
	 $output .= '</td>
				<td>';
	 $output .= $message ;
	 $output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Newsletter\',\'_self\',\'\',\'true\')", 2222);</script>';
	 $output .= '</td>
			</tr>
		</table>';
	}  else {
	 $output .= 'error new language is not set';
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	 $output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Newsletter\',\'_self\',\'\',\'true\')", 0);</script>';
} else if ($type=="delete_Language"){
	//if ($_SESSION['Language'] != "" and $_SESSION['Language'] != -1 and $_GET['delete_Language_Id'] == $_SESSION['Language']){
	$message = "";
		mysqli_query($link,"DELETE FROM nieuwsbrief WHERE Id=".intval($_GET['delete_Language_Id']))or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	 $output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Newsletter\',\'_self\',\'\',\'true\')", 0);</script>';
}else if ($type=="save"){
	$Id = intval($_POST["Id"]);
	
	$Nieuwsbriefnaam = $_POST["Nieuwsbriefnaam"];
	$NieuwsbriefHeadding = $_POST["NieuwsbriefHeadding"]; 
	$Nieuwsbrieffooter = $_POST["Nieuwsbrieffooter"]; 
	$Aanmeldtekst = $_POST["Aanmeldtekst"]; 
	$AfmeldTekst = $_POST["AfmeldTekst"]; 
	$Welkomtekstmessage = $_POST["Welkomtekstmessage"]; 
	$Afmeldtekstmessage = $_POST["Afmeldtekstmessage"]; 
	
	
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
	
		
	 $output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Newsletter\',\'_self\',\'\',\'true\')", 2222);</script>';		

	mysqli_query($link,"UPDATE nieuwsbrief SET Nieuwsbriefnaam = '$Nieuwsbriefnaam',NieuwsbriefHeadding = '$NieuwsbriefHeadding',Nieuwsbrieffooter = '$Nieuwsbrieffooter',Aanmeldtekst = '$Aanmeldtekst',AfmeldTekst = '$AfmeldTekst ',Welkomtekstmessage = '$Welkomtekstmessage', Afmeldtekstmessage = '$Afmeldtekstmessage' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="Newsletter saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	 $output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Newsletter\',\'_self\',\'\',\'true\')", 0);</script>';
}else {
$result = mysqli_query($link,"SELECT Id FROM nieuwsbrief WHERE Language =".$_SESSION['Language'] );
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
				
	$result = mysqli_query($link,"SELECT Id, Language FROM nieuwsbrief");
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
	if ($_SESSION['Language'] == $row2['Id']){ $output .= ' selected '; $foundLanguage = true;}
	 $output .= '>'.$row2['Language'].'</option>';
	}
	
	if ( $foundLanguage == true){ $output .= '<option value="new">new</option>';}else if ($_SESSION['Language']==""){$_SESSION['Language'] = -1;}
	if (count($Present_Language) > 1 and $foundLanguage == true){ $output .= '<option value="delete">Delete current</option>';}
	 $output .= '</select>
				</td>
			</tr>
			<tr>
				<td width="30%" valign="top">';
	// ouput user selectie
	
 $output .= '</td>
				<td>';

	$query = "SELECT Id, MainId, Nieuwsbriefnaam, NieuwsbriefHeadding, Nieuwsbrieffooter, Aanmeldtekst, AfmeldTekst, Welkomtekstmessage, Afmeldtekstmessage FROM nieuwsbrief WHERE Language =".$_SESSION['Language'];
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
		<form action="indexstandalone.php?plugin=Newsletter&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Newsletter name </td><td><input type="text" id="Nieuwsbriefnaam" name="Nieuwsbriefnaam" value="'.$row['Nieuwsbriefnaam'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr colspan="2"><td>Newsletter Heading</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="NieuwsbriefHeadding" name="NieuwsbriefHeadding" style="width: 550px; height: 100px;" >'.$row['NieuwsbriefHeadding'].'</textarea></div></td></tr>
		<tr colspan="2"><td>Newsletter footer</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="Nieuwsbrieffooter" name="Nieuwsbrieffooter" style="width: 550px; height: 100px;" >'.$row['Nieuwsbrieffooter'].'</textarea></div></td></tr>
		<tr colspan="2"><td>Welkom message</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="Welkomtekstmessage" name="Welkomtekstmessage" style="width: 550px; height: 100px;" >'.$row['Welkomtekstmessage'].'</textarea></div></td></tr>
		<tr colspan="2"><td>Unsubscribe message</td></tr><tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="Afmeldtekstmessage" name="Afmeldtekstmessage" style="width: 550px; height: 100px;" >'.$row['Afmeldtekstmessage'].'</textarea></div></td></tr>
		<tr><td>Subscribe</td><td><input type="text" id="Aanmeldtekst" name="Aanmeldtekst" value="'.$row['Aanmeldtekst'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Unsubscribe</td><td><input type="text" id="AfmeldTekst" name="AfmeldTekst" value="'.$row['AfmeldTekst'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td><div id="buttonlayout">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td><td></td></tr></table>
			

		</form></div>
				<script type="text/javascript">		



		</script>';
		
	}
	 $output .= '</td>
			</tr>
		</table>';
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
