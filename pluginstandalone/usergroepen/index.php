<?php
// Init session settings

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
 header("Cache-control: private"); 
// header
$type = $_GET["type"]; 
if (isset($_GET["sectie"])){
	$sectie = intval($_GET["sectie"]);
}

$MainId = intval($_GET["Id"]);
$output .= '
<script language="javascript">
function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je deze groep wilt verwijderen.")

if (answer !=0) { 
	location = "indexstandalone.php?plugin=usergroepen&type=delete&Id=" + theId + "&sectie='.$sectie.'";
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexstandalone.php?plugin=usergroepen&type=new_Language&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexstandalone.php?plugin=usergroepen&type=delete_Language&sectie='.$sectie.'&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexstandalone.php?plugin=usergroepen&language_id=\'+veld+\'&sectie='.$sectie.'&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){

}

function changeval(){	
	document.forms["form1"]["changed"].value = "true";
}

function submitform(){
	document.forms["form1"]["changed"].value = "false";
	document.form1.submit();
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}

function doselectparent(Id, text){
	document.getElementById(window.parentselectorid).value = Id;
	document.getElementById(window.parentselectortext).innerHTML = text;
	closeselectparent();
}
function openselectuserparent (id, text){
	document.getElementById(\'filelinker2\').src = \'./system/selectuserparent.php\';
	window.parentselectorid = id;
	window.parentselectortext = text;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'parentuserselector\').style.display = \'block\';
}

function closeselectparent (){
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'parentuserselector\').style.display = \'none\';
}
function resizeFrame(){		
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
     	 realWidth = parseInt(realWidth) - 70;
	 realHeight =  parseInt(realHeight) - 120;
    
	document.getElementById("filelinker2").style.height = realHeight + \'px\';
 	document.getElementById("filelinker2").style.width = realWidth + \'px\';
    //setTimeout(\'resizeFrame()\', 999);
}
</script>';





if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
				$output .='	<form action="indexstandalone.php?plugin=usergroepen&type=save_Language&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';

	$result = mysqli_query($link,"SELECT Id, Language FROM usergroepen WHERE MainId=".$MainId);
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
            <a href="javascript: submitform()"><h4>Save</h4></a>
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
	$result = mysqli_query($link,"SELECT Id FROM usergroepen WHERE Language =".$newlanguage ." AND MainId=".$MainId );
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
	$result = mysqli_query($link,"SELECT Naam, Type, TheOrder, MainId, Language, Parent FROM usergroepen WHERE  MainId=".$MainId." AND Language=". $_SESSION['Language'] );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Parent = $row['Parent'];
		$MainId = $row['MainId'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$Langinputid = $row['Language'];
		$type = $row["Type"];
	}

// Voor zoekt iso6931 codes op voor vertaling
	$result2 = mysqli_query($link,"SELECT Id, iso6392code, Language FROM language WHERE Id =".$Langinputid) or die("fout bij uitvoeren van query");
	$myflds2 = mysqli_num_fields($result2);

	while($row2 = mysqli_fetch_array($result2)){
		$langinput = $row2['iso6392code'];
		$langinputid = $row2['Id'];
  		$langerror = 'The source language is '. $row2['Language'];
		//$langerror = translate( $langerror, $destLang = $langouput, $srcLang = 'en' ) ;
		$output .= $langerror;
		break;
		}
	
	$result2 = mysqli_query($link,"SELECT Id, iso6392code, Language FROM language WHERE Id =".$newlanguage) or die("fout bij uitvoeren van query");
	$myflds2 = mysqli_num_fields($result2);

	while($row2 = mysqli_fetch_array($result2)){
		$langouput = $row2['iso6392code'];
		$langouputid = $row2['Id'];
  		$langerror = 'The source language is '. $row2['Language'];
		//$langerror = translate( $langerror, $destLang = $langouput, $srcLang = $langinput ) ;
		$output .= $langerror;
		break;
		}

	$MainId = str_replace("\\", "\\\\", $MainId);
	$MainId = str_replace("'", " ", $MainId);
	$MainId = str_replace("\"", " ", $MainId);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	//$Naam = translate( $Naam, $destLang = $langouput, $srcLang = $langinput ) ;
	$TheOrder = str_replace("\\", "\\\\", $TheOrder);
	$TheOrder = str_replace("'", " ", $TheOrder);
	$TheOrder = str_replace("\"", " ", $TheOrder);

	// checkt of theorder id al bestaat
	$result = mysqli_query($link,"SELECT TheOrder FROM usergroepen WHERE  TheOrder=".$TheOrder." AND Language=". $newlanguage );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		// zoja geeft een nieuwe
		$result2 = mysqli_query($link,"SELECT TheOrder FROM usergroepen ORDER BY TheOrder LIMIT 0,1");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$TheOrder= intval($row2["TheOrder"]) -1 ;	
		}
	}

	mysqli_query($link,"INSERT INTO usergroepen (Type, MainId, Naam, TheOrder, Language, Parent) VALUES ('$type','$MainId', '$Naam','$TheOrder','$newlanguage',$Parent)")or ($message = mysqli_error($link));
	$Id = mysqli_insert_id($link);
	$_SESSION['Language'] = $newlanguage;
	}
		
	} else {
	$message = 'error new language is not set';
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=usergroepen&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	
} else if ($type=="delete_Language"){
	$result = mysqli_query($link,"SELECT Id, MainId FROM usergroepen WHERE Id=".$_GET['delete_Language_Id'] );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		if ($row['MainId'] == $row['Id']){
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM usergroepen WHERE MainId=".$row['MainId'] );
			if (!$result2) {
    			die('Query failed: ' . mysqli_error($link));
			}
			
			while($row2 = mysqli_fetch_array($result2)){
				$Id = $row2['Id'];
				if ($row2['MainId']	!= $row2['Id'] and $changed == false){
					$MainId = $row2['Id'];
					$changed = true;
				}
				mysqli_query($link,"UPDATE usergroepen SET MainId = '$MainId' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			}
		} 
	}
	$message = "";
		mysqli_query($link,"DELETE FROM usergroepen WHERE Id=".$_GET['delete_Language_Id'])or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	
array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=usergroepen&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
		
		
}else if ($type=="save"){
	$Id = $_POST["Id"];
	$Naam = $_POST["Naam"]; 
	$Parent = intval($_POST["parentid"]);
	$language = $_POST["language"]; 
	$Messagetrue = $_POST["Messagetrue"];
	$type = $_POST["Type"];
	$message = "";
	$error = false;
	
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$type = str_replace("\\", "\\\\", $type);
	$type = str_replace("'", " ", $type);
	$type = str_replace("\"", " ", $type);
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);

	
	
	$result = mysqli_query($link,"SELECT TheOrder FROM usergroepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){
		mysqli_query($link,"INSERT INTO usergroepen (MainId, Naam, TheOrder, Language, Type, Parent) VALUES ('-1', '$Naam', '$theorder','$language','$type','$Parent')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE usergroepen SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE usergroepen SET Type = '$type', Naam = '$Naam', Parent = '$Parent' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		
	}
	$result = mysqli_query($link,"SELECT MainId FROM usergroepen WHERE Id=".$Id);
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
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=usergroepen&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	

	
}else if($type=="delete"){
$output .='Deleting...';
$message = "Group deleted";
mysqli_query($link,"DELETE FROM groupmembers WHERE theGroup=$MainId")or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM usergroepen WHERE MainId=$MainId")or ($message = mysqli_error($link));

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=usergroepen&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
}else if($type=="select") {
$result = mysqli_query($link,"SELECT Id, Language FROM usergroepen WHERE MainId=".$MainId);
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
	
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><table><tr><td>
				<select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				
	
	
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
	$output .= '</select></td><td><a href="indexstandalone.php?plugin=usergroepen&type=new">New</a>';
	
	$output .= '</td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onclick=" ConfirmDelete('.$MainId.'); return false;"><h4>Delete</h4></a>
          </div></td>
        </tr>
      </table></td></tr></table>
				</td>
				
			</tr>
			<tr>
				
				<td>';
	

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, Type, Parent FROM usergroepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$type = $row['Type'];
		$output .= '<form action="indexstandalone.php?plugin=usergroepen&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="75" border="0" onChange="changeval();"></td></tr>			
		<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$row['Parent'].'"><div id="parenttext">';
		
		$result2 = mysqli_query($link,"SELECT Id, Naam, TheOrder, Parent FROM usergroepen WHERE MainId=".$row['Parent']." AND Language=". $_SESSION['Language']);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$output .= $row["Parent"].' '.$row2["Naam"];
		}
		$output .= '</div><input type = "button" value = "Select Parent" onclick="openselectuserparent(\'parentid\',\'parenttext\');return false" /></td></tr>';
		$output .= '<tr><td>Type</td><td><select name="Type" id="Type" onchange=changeval()>
		<option'; if ($type == "Open"){$output .= ' selected ';} $output .=' value="Open">Open</option>
		<option';
			if ($type == "Closed"){$output .= ' selected ';} $output .=' value="Closed">Closed</option></select></td></tr>
		
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
	}
	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="new"){
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><a href="indexstandalone.php?plugin=usergroepen&type=new">New</a>';
$output .= '</td>
			</tr>
			<tr>
				
				<td>';
				$output .= '<form action="indexstandalone.php?plugin=usergroepen&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Name</td><td><input type="text" name="Naam" value="" size="75" border="0" onchange="changeval();"></td></tr>			
		<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value=""><div id="parenttext"></div><input type = "button" value = "Select Parent" onclick="openselectuserparent(\'parentid\',\'parenttext\');return false" />';
		
		$output .='</td></tr>	';
		$output .= '<tr><td>Type</td><td><select name="Type" id="Type" onchange=changeval()><option value="Open">Open</option><option value="Closed">Closed</option></select></td></tr>
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
		$output .= '</select>';
	$output .= '</td></tr>
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
				$output .='</td></tr></table>';

}else{
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><a href="indexstandalone.php?plugin=usergroepen&type=new">New</a>';
$output .= '</td>
			</tr>
			<tr>
				
				<td>';
				
				$output .='</td></tr></table>';
}

}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
