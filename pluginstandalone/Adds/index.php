<?php

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){

$type = $_GET["type"]; 

$MainId = intval($_GET["Id"]);
$output .= '
<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">
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
function dofilemanager(link){	
	if (window.elementvar.substr(0,3) == "msg"){
		
		addmsgnewfile(link,window.elementvar)
	}else{
		document.getElementById(window.elementvar).value = link;
	}
	hidefilemanager();
}
function layerActie(divID) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
   } else {
   
      document.getElementById(divID).style.display="none";
   }
}
function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je deze groep wilt verwijderen.")

if (answer !=0) { 
	location = "indexstandalone.php?plugin=Adds&type=delete&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexstandalone.php?plugin=Adds&type=new_Language&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexstandalone.php?plugin=Adds&type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexstandalone.php?plugin=Adds&language_id=\'+veld+\'&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){
			 myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'SmallText\');
}

function changeval(){	
	document.forms["form1"]["changed"].value = "true";
}
function submitform2(){
	document.forms["form1"]["changed"].value = "false";
	document.form1.submit();
}
function submitform(){
	document.forms["form1"]["changed"].value = "false";
	myNicEditor1.removeInstance(\'SmallText\');
	document.form1.submit();
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}
</script>';

// laat een lijst zien

function displayList ($MainId= -1){
	$menuurl ='./pluginstandalone/Adds/loadusermenu.php';
	$menuname = 'Adds';
	include ('submenulayout.php');
}


if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
				$output .='	<form action="indexstandalone.php?plugin=Adds&type=save_Language&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';

	$result = mysqli_query($link,"SELECT Id, Language FROM reclame WHERE MainId=".$MainId);
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
	$newlanguage = $_POST["language"];
	$found = false;
	if ($newlanguage <> ""){
	$result = mysqli_query($link,"SELECT Id FROM reclame WHERE Language =".$newlanguage ." AND MainId=".$MainId );
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
	$result = mysqli_query($link,"SELECT MainId, Naam, TheOrder, Smalltext, TheDate, TheGroup FROM reclame WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$SmallText = $row['Smalltext'];
		//$LargText = $row['LargText'];
		$DatumTijd = $row['TheDate'];
		$StartDatumTijd = $row['Startdate'];
		$MainId = $row['MainId'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$TheGroup = $row['TheGroup'];
	}
	$SmallText= addslashes($SmallText);
	$StartDatumTijd = str_replace("\\", "\\\\", $StartDatumTijd);
	$StartDatumTijd = str_replace("'", " ", $StartDatumTijd);
	$StartDatumTijd = str_replace("\"", " ", $StartDatumTijd);
	$DatumTijd = str_replace("\\", "\\\\", $DatumTijd);
	$DatumTijd = str_replace("'", " ", $DatumTijd);
	$DatumTijd = str_replace("\"", " ", $DatumTijd);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$TheOrder = str_replace("\\", "\\\\", $TheOrder);
	$TheOrder = str_replace("'", " ", $TheOrder);
	$TheOrder = str_replace("\"", " ", $TheOrder);
	$TheGroup = str_replace("\\", "\\\\", $TheGroup);
	$TheGroup = str_replace("'", " ", $TheGroup);
	$TheGroup = str_replace("\"", " ", $TheGroup);
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);
	mysqli_query($link,"INSERT INTO reclame (MainId, Naam, TheOrder, Language, Startdate, Smalltext, TheDate, TheGroup) VALUES ('$MainId', '$Naam','$TheOrder','$newlanguage','$StartDatumTijd', '$SmallText', '$DatumTijd', '$TheGroup')")or ($message = mysqli_error($link));
	$Id = mysqli_insert_id($link);
	$_SESSION['Language'] = $newlanguage;
	}
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .='<script type="text/javascript">refreshingmessage();</script>';
	if ($error == false){
		$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Adds&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	}else{
		$output .= $message;
	}
	//$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Adds&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 2222);</script>';
	//$output .= $message ;
	$output .= '</td>
			</tr>
		</table>';
	} else {
	$output .= 'error new language is not set';
	}
	
} else if ($type=="delete_Language"){
	$result = mysqli_query($link,"SELECT Id, MainId FROM reclame WHERE Id=".$_GET['delete_Language_Id'] );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		if ($row['MainId'] == $row['Id']){
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM reclame WHERE MainId=".$row['MainId'] );
			if (!$result2) {
    			die('Query failed: ' . mysqli_error($link));
			}
			
			while($row2 = mysqli_fetch_array($result2)){
				$Id = $row2['Id'];
				if ($row2['MainId']	!= $row2['Id'] and $changed == false){
					$MainId = $row2['Id'];
					$changed = true;
				}
				mysqli_query($link,"UPDATE reclame SET MainId = '$MainId' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			}
		} 
	}
	$message = "";
		mysqli_query($link,"DELETE FROM reclame WHERE Id=".$_GET['delete_Language_Id'])or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		$_SESSION['Language'] = -1;
		$error = false;
		}
			array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));

	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td></td>
			</tr>
			<tr>
				
				<td>';
		$output .='<script type="text/javascript">refreshingmessage();</script>';
		if ($error == false){
			$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Adds\',\'_self\',\'\',\'true\')", 0);</script>';
		}else{
			$output .= $message;
		}
		$output .= '</td>
			</tr>
		</table>';
		
		
}else if ($type=="save"){
	$Id = $_POST["Id"];
	$Naam = $_POST["Naam"]; 
	$TheOrder = $_POST["TheOrder"]; 
	$language = $_POST["language"]; 
	$TheDate = $_POST["TheDate"]; 
	$TheTime = $_POST["TheTime"]; 
	$StartTheDate = $_POST["StartTheDate"]; 
	$StartTheTime = $_POST["StartTheTime"]; 
	$TheGroup = $_POST["TheGroup"]; 
	$SmallText = $_POST["SmallText"];
	$DatumTijd = $TheDate ." ". $TheTime;
	$StartDatumTijd = $StartTheDate ." ". $StartTheTime;
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
	
	$SmallText= addslashes($SmallText);
	$LargText= addslashes($LargText);
		$SmallText = removeFullLinks($SmallText);
	//$SmallText = str_replace("\\", "\\\\", $SmallText);
	//$SmallText = str_replace("'", "\\\'", $SmallText);
	//$LargText = str_replace("\\", "\\\\", $LargText);
	//$LargText = str_replace("'", "\\\'", $LargText);
	$DatumTijd = str_replace("\\", "\\\\", $DatumTijd);
	$DatumTijd = str_replace("'", " ", $DatumTijd);
	$DatumTijd = str_replace("\"", " ", $DatumTijd);	
	$StartDatumTijd = str_replace("\\", "\\\\", $StartDatumTijd);
	$StartDatumTijd = str_replace("'", " ", $StartDatumTijd);
	$StartDatumTijd = str_replace("\"", " ", $StartDatumTijd);
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$TheOrder = str_replace("\\", "\\\\", $TheOrder);
	$TheOrder = str_replace("'", " ", $TheOrder);
	$TheOrder = str_replace("\"", " ", $TheOrder);
	$TheGroup = str_replace("\\", "\\\\", $TheGroup);
	$TheGroup = str_replace("'", " ", $TheGroup);
	$TheGroup = str_replace("\"", " ", $TheGroup);
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);
		
			
	if ($Id == "new"){
	
		mysqli_query($link,"INSERT INTO reclame ( MainId, Naam, TheOrder, Language, Smalltext, Startdate, TheDate, TheGroup) VALUES ( '-1', '$Naam', '$TheOrder','$language','$SmallText','$StartDatumTijd','$DatumTijd','$TheGroup')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		
		mysqli_query($link,"UPDATE reclame SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE reclame SET Naam = '$Naam', TheOrder = '$TheOrder', Smalltext = '$SmallText', Startdate = '$StartDatumTijd', TheDate = '$DatumTijd', TheGroup = '$TheGroup' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		
	}
	$result = mysqli_query($link,"SELECT MainId FROM reclame WHERE Id=".$Id);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
	}
	if ($message == ""){
		$message="$Naam saved";
	}else{
		$error = true;
	}

	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
	
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .='<script type="text/javascript">refreshingmessage();</script>';
	if ($error == false){
		$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Adds&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	}else{
		$output .= $message;
	}
	

	$output .= '</td>
			</tr>
		</table>';
}else if($type=="delete"){
$message = "Information deleted";
mysqli_query($link,"DELETE FROM reclame WHERE MainId=$MainId")or ($message = mysqli_error($link));

$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><table><tr><td>';
		
		$output .='</td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Adds&type=new"><h4>new</h4></a>
          </div></td>
        </tr>
      </table></td></tr></table></td>
			</tr>
			<tr>
				
				<td>';
				$output .= $message;
	$output .='</td></tr></table>';

}else if($type=="select") {
	$result = mysqli_query($link,"SELECT Id, Language FROM reclame WHERE MainId=".$MainId);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false; 
	while($row = mysqli_fetch_array($result)){
	if ($row['Language'] ==$_SESSION['Language']){$Id = $row['Id'];}
		$Present_Language[count($Present_Language)] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id = ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." OR Id = ".$row['Language'];
		}
	}
	$output .= '		<table  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><table><tr><td>
				<select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				$output .= '<option value="unknow">unknow</option>';

	
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
	$output .= '</select></td><td>
	<div id="buttonlayout">
            <a href="indexstandalone.php?plugin=Adds&type=new"><h4>new</h4></a>
          </div></td><td><div id="buttonlayout">
            <a href="#" onclick=" ConfirmDelete('.$MainId.'); return false;"><h4>Delete</h4></a>
          </div></td></tr></table>
				</td>
				
			</tr>
			<tr>
				
				<td>';
	

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, Startdate, Smalltext, TheDate, TheGroup FROM reclame WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$TheGroup = $row['TheGroup'];
		if (($thedate = strtotime($row['TheDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
					} 
					if (($Startdate = strtotime($row['Startdate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
					} 
		
		$output .= '<form action="indexstandalone.php?plugin=Adds&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="75" border="0" onChange="changeval();"></td></tr>
		<tr><td>Start Date</td><td><input type="text" name="StartTheDate" value="'.date('Y-m-j',$Startdate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Start Time</td><td><input type="text" name="StartTheTime" value="'.date("H:i:s",$Startdate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>End Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j',$thedate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>End Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s",$thedate).'" size="10" border="0" onchange=changeval()></td></tr>
		';
		$output .= '<tr><td colspan="2"><nowbr><div id="nicEditdiv" name="nicEditdiv"><textarea id="SmallText" name="SmallText" style="width: 550px; height: 175px;" >'.$row['Smalltext'].'</textarea></div></nowbr></td></tr>
		
		<tr><td><div id="buttonlayout">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td><td></td></tr></table>
			
		</form><script type="text/javascript">bkLib.onDomLoaded(function() { window_onload(); });</script>';
	}
	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="new"){
$output .= '		<div id="buttonlayout">';
		
		$output .='
            <a href="indexstandalone.php?plugin=Adds&type=new"><h4>new</h4></a>
          </div>';
				$output .= '<form action="indexstandalone.php?plugin=Adds&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="75" border="0" onchange="changeval();"></td></tr>
		<tr><td>Start Date</td><td><input type="text" name="StartTheDate" value="'.date('Y-m-j').'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Start Time</td><td><input type="text" name="StartTheTime" value="'.date("H:i:s").'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>End Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j').'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>End Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s").'" size="10" border="0" onchange=changeval()></td></tr>		
		<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .= '<option value="'.$row2['Id'].'"';
			if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected ';}
			$output .= '>'.$row2['Language'].'</option>';
			}
		$output .= '</select></td></tr>
		';			
		$output .= '<tr><td colspan="2"><nowbr><div id="nicEditdiv" name="nicEditdiv"><textarea id="SmallText" name="SmallText" style="width: 550px; height: 175px;" ></textarea></div></nowbr></td></tr>
		';
		
	$output .= '<tr><td><div id="buttonlayout"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td><td></td></tr></table>
			
		</form>
			<script type="text/javascript">bkLib.onDomLoaded(function() { window_onload(); });</script>';
				

}else{
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table><tr><td>';
		
		$output .='</td><td><div id="buttonlayout">
            <a href="indexstandalone.php?plugin=Adds&type=new"><h4>new</h4></a>
          </div></td></tr></table></td>
			</tr>
			<tr>
				
				<td>';
				
				$output .='</td></tr></table>';
}


}else{
// user is niet ingelogt
	header( 'Location: Login.php' ) ; 
	exit;
}
?>