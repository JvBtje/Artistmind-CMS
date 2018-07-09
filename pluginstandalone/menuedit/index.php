<?php
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
 
// header
$type = $_GET["type"]; 

$MainId = intval($_GET["Id"]);
$output .=  '<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">

function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je dit menu itiem wilt verwijderen.")

if (answer !=0) { 
	location = "indexstandalone.php?plugin=menuedit&type=delete&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexstandalone.php?plugin=menuedit&type=new_Language&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexstandalone.php?plugin=menuedit&type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexstandalone.php?plugin=menuedit&language_id=\'+veld+\'&type=select&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }
function selectFile(page, parameter) {
		showfilemanager(parameter);	
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

function window_onload(){
	Submenuchange();
}

function changeval(){	
	document.forms["form1"]["changed"].value = "true";
}

function submitform(){
	document.forms["form1"]["changed"].value = "false";
	Unloadniceditors();
	document.form1.submit();
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}
function Loadniceditors(){
	window.myNicEditors = new Array();
	for (i=0; i<parseInt(document.getElementById(\'NumCols\').value); i++){
		
		window.myNicEditors[i+1]= new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'LargText\'+(i+1));
	}
}

function Unloadniceditors(){
	for (i=0; i<parseInt(window.oldNumCols); i++){
		
		window.myNicEditors[i+1].removeInstance(\'LargText\'+(i+1));
		window.richtext[i+1] = document.getElementById(\'LargText\'+(i+1)).value;
		window.richtextbg[i+1] = document.getElementById(\'bg\'+(i+1)).value;
	}
}

function ChangWidthRichtext(){	
	if (typeof(window.myNicEditors) != "undefined"){
		Unloadniceditors();
		changeval();
	}
	
	for (i=0; i<parseInt(document.getElementById(\'NumCols\').value); i++){
		document.getElementById(\'LargText\'+(i+1)).style.width=document.getElementById(\'ColWidth\').value+"px";
		document.getElementById(\'LargText\'+(i+1)).style.height=document.getElementById(\'ColHeigth\').value+"px";
	}
	Loadniceditors();
	
}
function UpdateRichtext(richtext){
	
	if (typeof(window.myNicEditors) != "undefined"){
		Unloadniceditors();
		changeval();
	}
	
	htmlis = "<table><tr>";
	
	
	for (i=0; i<parseInt(document.getElementById(\'NumCols\').value); i++){
		
		htmlis = htmlis +\'<td width = "\'+document.getElementById(\'ColWidth\').value+\'"><nowbr><div id="nicEditdiv" name="nicEditdiv"><textarea id="LargText\'+(i+1)+\'" name="LargText\'+(i+1)+\'" style="width: \'+document.getElementById(\'ColWidth\').value+\'px; height: \'+document.getElementById(\'ColHeigth\').value+\'px;" >\'+window.richtext[i+1]+\'</textarea></div></nowbr><br>\';
		htmlis = htmlis +\'Background <input type="text" id="bg\'+(i+1)+\'" name="bg\'+(i+1)+\'" value="\'+window.richtextbg[i+1]+\'" size="10" border="0"  onchange="changeval();"><input type = "button" value = "Choose file" onclick="selectFile(\\\'listFiles.php\\\',\\\'bg\'+(i+1)+\'\\\');" /></td>\';
	}
	document.getElementById("Richtextarray").innerHTML = htmlis +"</tr></table>";
	window.oldNumCols =parseInt(document.getElementById(\'NumCols\').value);
	Loadniceditors();
	
	
}
function Submenuchange(){
	if (typeof(window.myNicEditors) != "undefined"){
		Unloadniceditors();
	}
	
	if (document.getElementById(\'HasSubMenu\').checked == true){
		document.getElementById(\'Submenuoff\').style.display = \'none\';
		document.getElementById(\'Submenuonn\').style.display = \'block\';
	}else{
		document.getElementById(\'Submenuoff\').style.display = \'block\';
		document.getElementById(\'Submenuonn\').style.display = \'none\';
	}

	UpdateRichtext();
}
</script>';

// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
// header settings
$banner = "";


// laat een lijst zien




if ($type=="new_Language"){
		$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				<td>';
				$output .= '	<form action="indexstandalone.php?plugin=menuedit&type=save_Language&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';

	$result = mysqli_query($link,"SELECT Id, Language FROM menu WHERE MainId=".$MainId);
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
	$output .=  '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .=  ' selected ';}
	$output .=  '>'.$row2['Language'].'</option>';
	}
	$output .=  '</select><br><br><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></form>
	';

	$output .=  '</td>
			</tr>
		</table>';
}else if ($type=="save_Language"){
	$newlanguage = $_POST["language"];
	$found = false;
	if ($newlanguage <> ""){
	$result = mysqli_query($link,"SELECT Id FROM menu WHERE Language =".$newlanguage ." AND MainId=".$MainId );
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
	$result = mysqli_query($link,"SELECT HasSubMenu, NumCol, ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg,LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, Naam, TheOrder, MainId, Url, Window FROM menu WHERE  MainId=".$MainId." AND Language=". $_SESSION['Language'] );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$Url = $row['Url'];
		$Window = $row['Window'];
		$HasSubMenu = intval($row["HasSubMenu"]);
		$NumCols = intval($row["NumCol"]);
		$ColWidth = intval($row["ColWidth"]);
		$ColHeigth = intval($row["ColHeigth"]);
		$LargText = array();
		$bg = array();
	
				
		$LargText[1] = addslashes($row["LargText"]);
		$LargText[2] = addslashes($row["Largtext2"]);
		$LargText[3] = addslashes($row["Largtext3"]);
		$LargText[4] = addslashes($row["Largtext4"]);
		$LargText[5] = addslashes($row["Largtext5"]);
		$LargText[6] = addslashes($row["Largtext6"]);
		$bg[1] = $row["Largtext1bg"];
		$bg[1] = str_replace("\\", "\\\\", $bg[1]);
		$bg[1] = str_replace("'", " ", $bg[1]);
		$bg[1] = str_replace("\"", " ", $bg[1]);
		$bg[2] = $row["Largtext2bg"];
		$bg[2] = str_replace("\\", "\\\\", $bg[2]);
		$bg[2] = str_replace("'", " ", $bg[2]);
		$bg[2] = str_replace("\"", " ", $bg[2]);
		$bg[3] = $row["Largtext3bg"];
		$bg[3] = str_replace("\\", "\\\\", $bg[3]);
		$bg[3] = str_replace("'", " ", $bg[3]);
		$bg[3] = str_replace("\"", " ", $bg[3]);
		$bg[4] = $row["Largtext4bg"];
		$bg[4] = str_replace("\\", "\\\\", $bg[4]);
		$bg[4] = str_replace("'", " ", $bg[4]);
		$bg[4] = str_replace("\"", " ", $bg[4]);
		$bg[5] = $row["Largtext5bg"];
		$bg[5] = str_replace("\\", "\\\\", $bg[5]);
		$bg[5] = str_replace("'", " ", $bg[5]);
		$bg[5] = str_replace("\"", " ", $bg[5]);
		$bg[6] = $row["Largtext6bg"];
		$bg[6] = str_replace("\\", "\\\\", $bg[6]);
		$bg[6] = str_replace("'", " ", $bg[6]);
		$bg[6] = str_replace("\"", " ", $bg[6]);
	}
	$Url = str_replace("\\", "\\\\", $Url);
	$Url = str_replace("'", " ", $Url);
	$Url = str_replace("\"", " ", $Url);
	$MainId = str_replace("\\", "\\\\", $MainId);
	$MainId = str_replace("'", " ", $MainId);
	$MainId = str_replace("\"", " ", $MainId);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$TheOrder = str_replace("\\", "\\\\", $TheOrder);
	$TheOrder = str_replace("'", " ", $TheOrder);
	$TheOrder = str_replace("\"", " ", $TheOrder);
	
		

	// checkt of theorder id al bestaat
	$result = mysqli_query($link,"SELECT Naam, TheOrder, MainId, Url, Window FROM menu WHERE  TheOrder=".$TheOrder." AND Language=". $newlanguage );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		// zoja geeft een nieuwe
		$result2 = mysqli_query($link,"SELECT TheOrder FROM menu ORDER BY TheOrder LIMIT 0,1");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$TheOrder= intval($row2["TheOrder"]) -1 ;	
		}
	}


	mysqli_query($link,"INSERT INTO menu (MainId,HasSubMenu, Largtext1bg, Largtext2bg, Largtext3bg, Largtext4bg, Largtext5bg, Largtext6bg, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, NumCol,ColWidth,ColHeigth, Naam, TheOrder, Language, Url, Window) VALUES ('$MainId','$HasSubMenu','$bg[1]','$bg[2]','$bg[3]','$bg[4]','$bg[5]','$bg[6]','$LargText[1]','$LargText[2]','$LargText[3]','$LargText[4]','$LargText[5]','$LargText[6]','$NumCols','$ColWidth','$ColHeigth','$Naam','$TheOrder','$newlanguage','$Url','$Window')")or ($message = mysqli_error($link));
	$Id = mysqli_insert_id($link);
	$_SESSION['Language'] = $newlanguage;
	}

	} else {
	$message = 'error new language is not set';
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=menuedit&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	
} else if ($type=="delete_Language"){
	$result = mysqli_query($link,"SELECT Id, MainId FROM menu WHERE Id=".$_GET['delete_Language_Id'] );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		if ($row['MainId'] == $row['Id']){
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM menu WHERE MainId=".$row['MainId'] );
			if (!$result2) {
    			die('Query failed: ' . mysqli_error($link));
			}
			
			while($row2 = mysqli_fetch_array($result2)){
				$Id = $row2['Id'];
				if ($row2['MainId']	!= $row2['Id'] and $changed == false){
					$MainId = $row2['Id'];
					$changed = true;
				}
				mysqli_query($link,"UPDATE menu SET MainId = '$MainId' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			}
		} 
	}
	$message = "";
		mysqli_query($link,"DELETE FROM menu WHERE Id=".$_GET['delete_Language_Id'])or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		
		}

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=menuedit&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
		
		
}else if ($type=="save"){
	$Id = $_POST["Id"];
	$Naam = $_POST["Naam"]; 
	$Url = $_POST["Url"]; 
	$Window = $_POST["Window"]; 
	$TheOrder = $_POST["TheOrder"]; 
	$language = $_POST["language"]; 

	$message = "";
	$error = false;
	$NumCols = intval($_POST["NumCols"]);
	$ColWidth = intval($_POST["ColWidth"]);
	$ColHeigth = intval($_POST["ColHeigth"]);
	$LargText = array();
	$bg = array();
	
	for ($i=0; $i<$NumCols; $i++){		
		$LargText[$i+1] = addslashes($_POST["LargText".($i+1)]);
		$bg[$i+1] = $_POST["bg".($i+1)];
		$bg[$i+1] = str_replace("\\", "\\\\", $bg[$i+1]);
		$bg[$i+1] = str_replace("'", " ", $bg[$i+1]);
		$bg[$i+1] = str_replace("\"", " ", $bg[$i+1]);
	}

	if(isset($_POST["HasSubMenu"])){ 
		$HasSubMenu = 1;
	}
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$TheOrder = str_replace("\\", "\\\\", $TheOrder);
	$TheOrder = str_replace("'", " ", $TheOrder);
	$TheOrder = str_replace("\"", " ", $TheOrder);
	$Url = str_replace("\\", "\\\\", $Url);
	$Url = str_replace("'", " ", $Url);
	$Url = str_replace("\"", " ", $Url);
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);

	$result = mysqli_query($link,"SELECT TheOrder FROM menu ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){
		mysqli_query($link,"INSERT INTO menu ( HasSubMenu, TheOrder, MainId, Naam,  Language, Url, Window, Largtext1bg, Largtext2bg, Largtext3bg, Largtext4bg, Largtext5bg, Largtext6bg, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6,NumCol,ColWidth,ColHeigth) VALUES ( '$HasSubMenu','$theorder', '-1', '$Naam', '$language','$Url','$Window','$bg[1]','$bg[2]','$bg[3]','$bg[4]','$bg[5]','$bg[6]','$LargText[1]','$LargText[2]','$LargText[3]','$LargText[4]','$LargText[5]','$LargText[6]','$NumCols','$ColWidth','$ColHeigth')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE menu SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE menu SET HasSubMenu='$HasSubMenu', Naam = '$Naam', Url = '$Url', Window='$Window', Largtext1bg = '$bg[1]',Largtext2bg = '$bg[2]',Largtext3bg = '$bg[3]',Largtext4bg = '$bg[4]',Largtext5bg = '$bg[5]',Largtext6bg = '$bg[6]',LargText = '$LargText[1]',Largtext2 = '$LargText[2]',Largtext3 = '$LargText[3]',Largtext4 = '$LargText[4]',Largtext5 = '$LargText[5]',Largtext6 = '$LargText[6]',NumCol = '$NumCols',ColWidth = '$ColWidth',ColHeigth = '$ColHeigth'WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		
	}
	$result = mysqli_query($link,"SELECT MainId FROM menu WHERE Id=".$Id);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
	}

	if ($message == ""){
		$message="Menu saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=menuedit&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	
}else if($type=="delete"){
$message = "Menu itiem deleted";
mysqli_query($link,"DELETE FROM menu WHERE MainId=$MainId")or ($message = mysqli_error($link));

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=menuedit&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

}else if($type=="select") {
$result = mysqli_query($link,"SELECT Id, Language FROM menu WHERE MainId=".$MainId);
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
	
	$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><table><tr><td>
				<select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				
	
	
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$output .=  '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .=  ' selected '; $foundLanguage = true;}
	$output .=  '>'.$row2['Language'].'</option>';
	}
	
	if ( $foundLanguage == true){$output .=  '<option value="new">new</option>';}else if ($_SESSION['Language']==""){$_SESSION['Language'] = -1;}
	if (count($Present_Language) > 1 and $foundLanguage == true){$output .=  '<option value="delete">Delete current</option>';}
	$output .=  '</select></td><td><div id="buttonlayout"><a href="indexstandalone.php?plugin=menuedit&type=new"><h4>new</h4></a></div></td><td><div id="buttonlayout"><a href="#" onclick=" ConfirmDelete('.$MainId.'); return false;"><h4>Delete</h4></a></div></td></tr></table></td>
				
			</tr>
			<tr>
				
				<td>';
	

	$result = mysqli_query($link,"SELECT Id, HasSubMenu, NumCol,ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg,LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, Naam, TheOrder, Url,Window FROM menu WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$Url = $row['Url'];
		
		$output .=  '<form action="indexstandalone.php?plugin=menuedit&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="75" border="0" onChange="changeval();"></td></tr>
		<tr><td>Sub Menu</td><td><input type="checkbox" name="HasSubMenu" id="HasSubMenu"'; if ($row['HasSubMenu'] == 1){$output .=  ' checked ';} $output .= ' border="0" onChange="Submenuchange();"></td></tr>		
		</table><div id="Submenuoff"><table>
				<tr><td>Url</td><td><input type="text" name="Url" id="Url" value="'.$Url.'" size="50" border="0" onchange=changeval()><input type = "button" value = "Choose file" onclick="selectFile(\'listFiles.php\',\'Url\');" /></td></tr>
		
		<tr><td>Window</td><td><select name="Window" id="Window" onchange=changeval()>		
		<option value="_self"'; if ($row['Window'] == "_self"){$output .=  ' selected ';}$output .= '>_self</option>
		<option value="_blank"'; if ($row['Window'] == "_blank"){$output .=  ' selected ';}$output .= '>_blank</option>
		<option value="_parent"'; if ($row['Window'] == "_parent"){$output .=  ' selected ';}$output .= '>_parent</option>
		<option value="_top"'; if ($row['Window'] == "_top"){$output .=  ' selected ';}$output .= '>_top</option>
				</select></td></tr></table></div>';
		$output .=  '<div id="Submenuonn"><table><tr><td>Number of Columns</td><td><select name="NumCols" id="NumCols" onchange=UpdateRichtext()>';
		$output .=  '<option value="1"';
			if ($row['NumCol'] == 1){$output .=  ' selected ';}
			$output .=  '>1</option>';
		$output .=  '<option value="2"';
			if ($row['NumCol'] == 2){$output .=  ' selected ';}
			$output .=  '>2</option>';
		$output .=  '<option value="3"';
			if ($row['NumCol'] == 3){$output .=  ' selected ';}
			$output .=  '>3</option>';
		$output .=  '<option value="4"';
			if ($row['NumCol'] == 4){$output .=  ' selected ';}
			$output .=  '>4</option>';
		$output .=  '<option value="5"';
			if ($row['NumCol'] == 5){$output .=  ' selected ';}
			$output .=  '>5</option>';
		$output .=  '<option value="6"';
			if ($row['NumCol'] == 6){$output .=  ' selected ';}
			$output .=  '>6</option>';
		$output .=  '</select></td></tr>';
		$output .=  '<tr><td>Column width</td><td><input type="text" name="ColWidth" id="ColWidth" value="'.$row['ColWidth'].'" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .=  '<tr><td>Column Heigth</td><td><input type="text" name="ColHeigth" id="ColHeigth" value="'.$row['ColHeigth'].'" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .=  '
		<tr><td colspan="2">Rich Text</tr>
		<tr><td colspan="2"><div id="Richtextarray"></div>
		<script language="javascript">			
			window.richtext =new Array();
			window.richtext[1] = "'.str_replace('"', '\"',$row['LargText']).'";
			window.richtext[2] = "'.str_replace('"', '\"',$row['Largtext2']).'";
			window.richtext[3] = "'.str_replace('"', '\"',$row['Largtext3']).'";
			window.richtext[4] = "'.str_replace('"', '\"',$row['Largtext4']).'";
			window.richtext[5] = "'.str_replace('"', '\"',$row['Largtext5']).'";
			window.richtext[6] = "'.str_replace('"', '\"',$row['Largtext6']).'";
			window.richtextbg =new Array();
			window.richtextbg[1] = "'.str_replace('"', '\"',$row['Largtext1bg']).'";
			window.richtextbg[2] = "'.str_replace('"', '\"',$row['Largtext2bg']).'";
			window.richtextbg[3] = "'.str_replace('"', '\"',$row['Largtext3bg']).'";
			window.richtextbg[4] = "'.str_replace('"', '\"',$row['Largtext4bg']).'";
			window.richtextbg[5] = "'.str_replace('"', '\"',$row['Largtext5bg']).'";
			window.richtextbg[6] = "'.str_replace('"', '\"',$row['Largtext6bg']).'";
			window.oldNumCols ='.$row['NumCol'].';
			//UpdateRichtext();
			Submenuchange();
		</script>
		</td></tr></table></div><table>	
		<tr><td><div id="buttonlayout"><a href="javascript: submitform()"><h4>Save</h4></a></div></td><td></td></tr></table>
			
		</form>';
	}
	$output .=  '</td>
			</tr>
		</table>';
}else if ($type=="new"){
$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><div id="buttonlayout">
            <a href="indexstandalone.php?plugin=menuedit&type=new"><h4>new</h4></a></div></td>
			</tr>
			<tr>
				
				<td>';
				$output .=  '<form action="indexstandalone.php?plugin=menuedit&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="75" border="0" onchange="changeval();"></td></tr>
		<tr><td>Sub Menu</td><td><input type="checkbox" name="HasSubMenu" id="HasSubMenu" border="0" onChange="Submenuchange();"></td></tr>			
		</table><div id="Submenuoff"><table>
		<tr><td>Url</td><td><input type="text" name="Url" id="Url" value="" size="50" border="0" onchange=changeval()><input type = "button" value = "Choose file" onclick="selectFile(\'listFiles.php\',\'Url\');" /></td></tr>
		<tr><td>Window</td><td><select name="Window" id="Window" onchange=changeval()>		
		<option value="_self">_self</option>
		<option value="_blank">_blank</option>
		<option value="_parent">_parent</option>
		<option value="_top">_top</option>
				</select></td></tr>';
		$output .=  '</table></div><div id="Submenuonn"><table>';
		$output .=  '<tr><td>Number of Columns</td><td><select name="NumCols" id="NumCols" onchange=UpdateRichtext()>';
		$output .=  '<option value="1"';
			
			$output .=  '>1</option>';
		$output .=  '<option value="2"';
			
			$output .=  '>2</option>';
		$output .=  '<option value="3"';
			
			$output .=  '>3</option>';
		$output .=  '<option value="4"';
			
			$output .=  '>4</option>';
		$output .= '<option value="5"';
			
			$output .=  '>5</option>';
		$output .=  '<option value="6"';
			
			$output .=  '>6</option>';
		$output .=  '</select></td></tr>';		
		$output .=  '<tr><td>Column width</td><td><input type="text" name="ColWidth" id="ColWidth" value="700" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .=  '<tr><td>Column height</td><td><input type="text" name="ColHeigth" id="ColHeigth" value="20" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .=  '
		<tr><td colspan="2">Rich Text</tr>
		<tr><td colspan="2"><div id="Richtextarray"></div>
		<script language="javascript">			
			window.richtext =new Array();
			window.richtext[1] = "";
			window.richtext[2] = "";
			window.richtext[3] = "";
			window.richtext[4] = "";
			window.richtext[5] = "";
			window.richtext[6] = "";
			window.richtextbg =new Array();
			window.richtextbg[1] = "";
			window.richtextbg[2] = "";
			window.richtextbg[3] = "";
			window.richtextbg[4] = "";
			window.richtextbg[5] = "";
			window.richtextbg[6] = "";
			window.oldNumCols =1;
			//UpdateRichtext();
			
		</script></table></div><table>			
		<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .=  '<option value="'.$row2['Id'].'"';
			if ($_SESSION['Language'] == $row2['Id']){$output .=  ' selected ';}
			$output .=  '>'.$row2['Language'].'</option>';
			}
		$output .=  '</select>';
	$output .=  '</td></tr>
		<tr><td><div id="buttonlayout"><a href="javascript: submitform()"><h4>Save</h4></a></div></td><td></td></tr></table>		
		</form>';
				$output .= '</td></tr></table>';

}else{
$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table><tr><td>';
		
		$output .= '</td><td><div id="buttonlayout"><a href="indexstandalone.php?plugin=menuedit&type=new"><h4>new</h4></a></div></td></tr></table>';
				
				$output .= '</td></tr></table>';
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>