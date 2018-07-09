<?php

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){

$output .= '


<script type="text/javascript" src="nicEdit.js"></script>';

$output .='
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";
window.accesmembers = new Array();
window.accesgroups = new Array();
window.accesmsmembers = new Array();
window.accesmsgroups = new Array();
window.friendtype = false;

function addaccesmembers(id,imgurl,name){
	found = false;
	for (i=0;i<window.accesmembers.length;i++)
	{
		if (window.accesmembers[i].id == id){
			found = true;
		}
		
	}
	if (found == true){
		addmessage(name+ " already exist");
		
	}else{
		tmparray = new Array();
		tmparray.id = id;
		tmparray.imgurl = imgurl;
		tmparray.name = name;	
		window.accesmembers.push(tmparray);
	}
}

function addaccesmsmembers(id,imgurl,name){
	found = false;
	for (i=0;i<window.accesmsmembers.length;i++)
	{
		if (window.accesmsmembers[i].id == id){
			found = true;
		}
		
	}
	if (found == true){
		addmessage(name+ " already exist");
		
	}else{
		tmparray = new Array();
		tmparray.id = id;
		tmparray.imgurl = imgurl;
		tmparray.name = name;	
		window.accesmsmembers.push(tmparray);
	}
	
}

function addaccesgroup(id,name){
	found = false;
	for (i=0;i<window.accesgroups.length;i++)
	{
		if (window.accesgroups[i].id == id){
			found = true;
		}
		
	}
	if (found == true){
		addmessage(name+ " already exist");
		
	}else{
		tmparray = new Array();
		tmparray.id = id;
		tmparray.name = name;	
		window.accesgroups.push(tmparray);
	}
}

function addaccesmsgroup(id,name){
	found = false;
	for (i=0;i<window.accesmsgroups.length;i++)
	{
		if (window.accesmsgroups[i].id == id){
			found = true;
		}
		
	}
	if (found == true){
		addmessage(name+ " already exist");
		
	}else{
		tmparray = new Array();
		tmparray.id = id;
		tmparray.name = name;	
		window.accesmsgroups.push(tmparray);
	}
}

function delaccesmember (id){

found = false;
	for (i=0;i<window.accesmembers.length;i++)
	{
		if (window.accesmembers[i].id == id){
			
			found = true;
			window.accesmembers.splice(i, 1);
		}
	}
	
	if (found == false){
		addmessage(" can\'t delete this user");		
	}else{
		updateaccesmembers ()
	}
	
}

function delaccesmsmember (id){

found = false;
	for (i=0;i<window.accesmsmembers.length;i++)
	{
		if (window.accesmsmembers[i].id == id){
			
			found = true;
			window.accesmsmembers.splice(i, 1);
		}
	}
	
	if (found == false){
		addmessage(" can\'t delete this user");		
	}else{
		updateaccesmsmembers ()
	}
	
}

function delaccesgroup (id){

found = false;
	for (i=0;i<window.accesgroups.length;i++)
	{
		if (window.accesgroups[i].id == id){
			
			found = true;
			window.accesgroups.splice(i, 1);
		}
	}
	
	if (found == false){
		addmessage(" can\'t delete this group");		
	}else{
		updateaccesgroup ()
	}
	
}

function delaccesmsgroup (id){

found = false;
	for (i=0;i<window.accesmsgroups.length;i++)
	{
		if (window.accesmsgroups[i].id == id){
			
			found = true;
			window.accesmsgroups.splice(i, 1);
		}
	}
	
	if (found == false){
		addmessage(" can\'t delete this group");		
	}else{
		updateaccesmsgroup ()
	}
	
}

function updateaccesgroup (){
	
	window.curpage = 1;
	pages = 1;
	ii = 1
	txt = \'<table>\'
	
	for (i=1;i<window.accesgroups.length+1;i++)
	{
		if (ii == 1){
			txt =txt +"<tr>"
		}
		
		txt = txt +\'<td valign="top"><div style="width:110px; "><input type="hidden" name="accesgroup\'+i+\'" id="accesgroup\'+i+\'" value="\'+window.accesgroups[i-1].id+\'"><center> \'+window.accesgroups[i-1].name+\'<br><a href="#" onClick="delaccesgroup(\'+window.accesgroups[i-1].id+\');return false"><div id="friendaddbtn"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></div></center></div></td>\';
		
		if (ii == 5){
			txt =txt +"</tr>";
			ii=1;	
		}else {
			ii = ii+1;
		}
			
	}
	
	txt = txt + \'</table><input type="hidden" name="totalaccesgroup" id="totalaccesgroup" value="\'+window.accesgroups.length+\'">\';
	
	document.getElementById(\'grouptext\').innerHTML = txt;
	
}

function updateaccesmsgroup (){
	
	window.curpage = 1;
	pages = 1;
	ii = 1
	txt = \'<table>\'
	
	for (i=1;i<window.accesmsgroups.length+1;i++)
	{
		if (ii == 1){
			txt =txt +"<tr>"
		}
		
		txt = txt +\'<td valign="top"><div style="width:110px; "><input type="hidden" name="accesmsgroup\'+i+\'" id="accesmsgroup\'+i+\'" value="\'+window.accesmsgroups[i-1].id+\'"><center> \'+window.accesmsgroups[i-1].name+\'<br><a href="#" onClick="delaccesmsgroup(\'+window.accesmsgroups[i-1].id+\');return false"><div id="friendaddbtn"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></div></center></div></td>\';
		
		if (ii == 5){
			txt =txt +"</tr>";
			ii=1;	
		}else {
			ii = ii+1;
		}
			
	}
	
	txt = txt + \'</table><input type="hidden" name="totalaccesmsgroup" id="totalaccesmsgroup" value="\'+window.accesmsgroups.length+\'">\';
	
	document.getElementById(\'groupmstext\').innerHTML = txt;
	
}

function updateaccesmembers (){
	
	window.curpage = 1;
	pages = 1;
	ii = 1
	txt = \'<table>\'
	
	for (i=1;i<window.accesmembers.length+1;i++)
	{
		if (ii == 1){
			txt =txt +"<tr>"
		}
		
		txt = txt +\'<td valign="top"><div style="width:110px; "><input type="hidden" name="accesmember\'+i+\'" id="accesmember\'+i+\'" value="\'+window.accesmembers[i-1].id+\'"><center><img src="./system/imgtumb.php?url=\'+window.accesmembers[i-1].imgurl+\'&maxsize=100&square=1 " ><br> \'+window.accesmembers[i-1].name+\'<br><a href="#" onClick="delaccesmember(\'+window.accesmembers[i-1].id+\');return false"><div id="friendaddbtn"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></div></center></div></td>\';
		
		if (ii == 5){
			txt =txt +"</tr>";
			ii=1;	
		}else {
			ii = ii+1;
		}
			
	}
	
	txt = txt + \'</table><input type="hidden" name="totalaccesmember" id="totalaccesmember" value="\'+window.accesmembers.length+\'">\';
	
	document.getElementById(\'usertext\').innerHTML = txt;
	
}

function updateaccesmsmembers (){
	
	window.curpage = 1;
	pages = 1;
	ii = 1
	txt = \'<table>\'
	
	for (i=1;i<window.accesmsmembers.length+1;i++)
	{
		if (ii == 1){
			txt =txt +"<tr>"
		}
		
		txt = txt +\'<td valign="top"><div style="width:110px; "><input type="hidden" name="accesmsmember\'+i+\'" id="accesmsmember\'+i+\'" value="\'+window.accesmsmembers[i-1].id+\'"><center><img src="./system/imgtumb.php?url=\'+window.accesmsmembers[i-1].imgurl+\'&maxsize=100&square=1 " ><br> \'+window.accesmsmembers[i-1].name+\'<br><a href="#" onClick="delaccesmsmember(\'+window.accesmsmembers[i-1].id+\');return false"><div id="friendaddbtn"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></div></center></div></td>\';
		
		if (ii == 5){
			txt =txt +"</tr>";
			ii=1;	
		}else {
			ii = ii+1;
		}
			
	}
	
	txt = txt + \'</table><input type="hidden" name="totalaccesmsmember" id="totalaccesmsmember" value="\'+window.accesmsmembers.length+\'">\';
	
	document.getElementById(\'usermstext\').innerHTML = txt;
}

function dodocumentgroup(id, name){

	closeusergroupselector();
	
	if (window.friendtype == "accesgroup"){
		addaccesgroup(id,name);
		updateaccesgroup ();
	}else if (window.friendtype == "accesmsgroup"){
		addaccesmsgroup(id,name);
		updateaccesmsgroup ();
	}	
}

function dodocumentfriends(id, imgurl, name){
	closedocumentfriends();
	
	if (window.friendtype == "accesdocument"){
		addaccesmembers(id,imgurl,name);
		updateaccesmembers ();
	}else if (window.friendtype == "accesmsdocument"){
		addaccesmsmembers(id,imgurl,name);
		updateaccesmsmembers ();
	}	
}

function opendocumentfriends (type){
	
	newpath = \'./plugin windows/friends/Friendsdocuments.php\';
	if (document.getElementById(\'filelinker6\').src.substring(document.getElementById(\'filelinker6\').src.length-10,document.getElementById(\'filelinker6\').src.length) == "blank.html"){
		document.getElementById(\'filelinker6\').src = newpath;
	}
	
	document.getElementById(\'directory\').style.display = \'block\';	
	document.getElementById(\'friendsdoc\').style.display = \'block\';
	window.friendtype = type;
}

function closedocumentfriends (){
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'friendsdoc\').style.display = \'none\';
}

function openusergroupselector (type){
	newpath = \'./plugin windows/friends/selectusergroependocument.php\';
	if (document.getElementById(\'filelinker7\').src.substring(document.getElementById(\'filelinker7\').src.length-10,document.getElementById(\'filelinker7\').src.length) == "blank.html"){
		document.getElementById(\'filelinker7\').src = newpath;
	}
	
	window.friendtype = type;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'usergroupselector\').style.display = \'block\';
}

function closeusergroupselector (){
	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'usergroupselector\').style.display = \'none\';
}
</script>
<script language="javascript">

function changepublissettings(){
	document.getElementById("useroptions").style.display = "none"
	document.getElementById("groupoptions").style.display = "none"
	
	if (document.getElementById("Publish").value == "Members"){	
		document.getElementById("useroptions").style.display = "block"
	}
	if (document.getElementById("Publish").value == "Groups"){	
		document.getElementById("groupoptions").style.display = "block"
	}
}

function changemessagesettings(){
	document.getElementById("usermsoptions").style.display = "none"
	document.getElementById("groupmsoptions").style.display = "none"
	
	if (document.getElementById("Messagetrue").value == "Members"){	
		document.getElementById("usermsoptions").style.display = "block"
	}
	if (document.getElementById("Messagetrue").value == "Groups"){	
		document.getElementById("groupmsoptions").style.display = "block"
	}
}</script>'
;
$output .='
<script language="javascript">

function layerActie(divID) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
   } else {
   
      document.getElementById(divID).style.display="none";
   }
}
function ConfirmDelete (theId,theidgroup){
answer = confirm("Weet je zeker dat je deze embedder wilt verwijderen.")

if (answer !=0) { 
	location = "indexadminnew.php?plugin=embedder&type=delete&sectie='.$sectie.'&Id=" + theidgroup 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexadminnew.php?plugin=embedder&type=new_Language&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexadminnew.php?plugin=embedder&type=delete_Language&sectie='.$sectie.'&Id=\'+'.$MainId.',\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexadminnew.php?plugin=embedder&language_id=\'+veld+\'&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){
	loadslider( \'main\');
}

function window_onunload(){

}

function changeval(){	
	importslides();
	document.forms["form1"]["changed"].value = "true";
}
function submitform2(){
	document.forms["form1"]["changed"].value = "false";
	document.form1.submit();
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
function openselectparent (id, text){
	newpath = \'./plugin windows/parentselector/selectparent.php\';
	if (document.getElementById(\'filelinker2\').src.substring(document.getElementById(\'filelinker2\').src.length-10,document.getElementById(\'filelinker2\').src.length) == "blank.html"){
		document.getElementById(\'filelinker2\').src = newpath;
	}
	window.parentselectorid = id;
	window.parentselectortext = text;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'parentselector\').style.display = \'block\';
}

function closeselectparent (){
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'parentselector\').style.display = \'none\';
}

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
	if (window.elementvar == "galleryimg"){
		window.maingalleryimages.push(addgalimg(link,"",link))
		updatemaingallery ();
	}else if (window.elementvar.substr(0,3) == "msg"){		
		addmsgnewfile(link,window.elementvar)
	}else{
		document.getElementById(window.elementvar).value = link;
	}
	hidefilemanager();
	importslides();
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
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
				$output .= '	<form action="indexadminnew.php?plugin=embedder&type=save_Language&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';
	$output .=  "SELECT Naam, Parent, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language'];
	$result = mysqli_query($link,"SELECT Naam, Parent, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
	}

	$result = mysqli_query($link,"SELECT Id, Language FROM groepen WHERE MainId=".$MainIdGroup);
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
	if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected ';}
	$output .=  '>'.$row2['Language'].'</option>';
	}
	$output .=  '</select><br><br><div id="buttonlayout"><h4><a href="javascript: submitform2()">Save</a></h4></div></form>
	';

	$output .=  '</td>
			</tr>
		</table>';
}else if ($type=="save_Language"){
	$newlanguage = $_POST["language"];
	$found = false;
	if ($newlanguage <> ""){
	$result = mysqli_query($link,"SELECT Id FROM groepen WHERE Language =".$newlanguage ." AND MainId=".$MainId );
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
	$result = mysqli_query($link,"SELECT Publish, PublishDate, Message, Naam, Parent, TheOrder, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
		$TheOrder = $row['TheOrder'];
		$Messagetrue = $row["Message"];
		$Publish = $row["Publish"];
		$PublishDate= $row["PublishDate"];
	}

	// checkt of theorder id al bestaat voor de nieuw language
	$result = mysqli_query($link,"SELECT TheOrder FROM groepen WHERE  TheOrder=".$TheOrder." AND Language=". $newlanguage );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		// zoja geeft een nieuwe
		$result2 = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$TheOrder= intval($row2["TheOrder"]) -1 ;	
		}
	}
	mysqli_query($link,"INSERT INTO groepen (LastSaved, theDate, Publish, PublishDate, Message, MainId, Language, Naam, Parent, TheOrder, targetmainid, Type) VALUES ('".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$Publish','$PublishDate','$Messagetrue','$MainIdGroup','$newlanguage', '$Naam','$Parent',  '$TheOrder', '$MainId','embedder')")or ($message = mysqli_error($link));
	//mysqli_query($link,"INSERT INTO gallery ( MainId, Language, LargText, TheDate, ImageDetail, TumbSize, TumbRows, Tumbnailsquare) VALUES ( '$MainId', '$newlanguage','$LargText','$DatumTijd','$Imagedetails','$Tumbnailsize','$Tumbnailrows','$Tumbnailsquare')")or  ($message = mysqli_error($link));
	$Id = mysqli_insert_id($link);
	$result2 = mysqli_query($link,"SELECT Id, Tag FROM embedder WHERE EmbedderId=".$IdGroup);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			
			$Tag = $row2['Tag'];
			mysqli_query($link,"INSERT INTO embedder (EmbedderId, Tag) VALUES ($Id, '$Tag')")or  ($message = mysqli_error($link));
		}


	$Id = mysqli_insert_id($link);
	$_SESSION['Language'] = $newlanguage;
	}
		
	} else {
	$message ='error new language is not set';
	}
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=embedder&type=select&sectie='.$sectie.'&Id='.$MainIdGroup.'\',\'_self\',\'\',\'true\')", 0);</script>';
} else if ($type=="delete_Language"){	
	
	$result = mysqli_query($link,"SELECT Id, MainId, targetmainid FROM groepen WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		$oldMainId = $MainId;
		if ($row['MainId'] == $row['Id']){
			
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM groepen WHERE MainId=".$row['MainId'] );
			if (!$result2) {
    			die('Query failed: ' . mysqli_error($link));
			}
			
			while($row2 = mysqli_fetch_array($result2)){
				$Id = $row2['Id'];

				if ($row2['MainId']	!= $row2['Id'] and $changed == false){
					$MainId = $row2['Id'];
					$changed = true;
				}
				mysqli_query($link,"UPDATE groepen SET MainId = '$MainId' WHERE MainId = '$oldMainId'") or ($message = mysqli_error($link));
				  
			}
		
		} 
		$IdGroup =$row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
	}

	$message = "";

	mysqli_query($link,"DELETE FROM groepen  WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainIdGroup  )or ($message = mysqli_error($link));
	mysqli_query($link,"DELETE FROM embedder WHERE Language = ".$_SESSION['Language']." AND EmbedderId=".$MainId  )or ($message = mysqli_error($link));
	
	
	
		
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=embedder&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
		
		
}else if ($type=="save"){
	$output .= 'Saving...';
	$Id = $_POST["Id"];
	$IdGroup =  intval($_POST["IdGroup"]);			
	$Naam = $_POST["Naam"]; 
	$language = intval($_POST["language"] );
	$TheDate = $_POST["TheDate"]; 
	$TheTime = $_POST["TheTime"]; 
	$Parent = intval($_POST["parentid"]);
	$DatumTijd = $TheDate ." ". $TheTime;
	$Messagetrue = $_POST["Messagetrue"];
	$Publish = $_POST["Publish"];
	$Tag = $_POST["Tag"];
	$message = "";
	$error = false;
	
	
	
	$Tag= addslashes($Tag);
	//$LargText = removeFullLinks($LargText);
	//$SmallText = str_replace("\\", "\\\\", $SmallText);
	//$SmallText = str_replace("'", "\\\'", $SmallText);
	//$LargText = str_replace("\\", "\\\\", $LargText);
	//$LargText = str_replace("'", "\\\'", $LargText);
	$DatumTijd = str_replace("\\", "\\\\", $DatumTijd);
	$DatumTijd = str_replace("'", " ", $DatumTijd);
	$DatumTijd = str_replace("\"", " ", $DatumTijd);
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);	
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);
	$Publish = str_replace("\\", "\\\\", $Publish);
	$Publish = str_replace("'", " ", $Publish);
	$Publish = str_replace("\"", " ", $Publish);
	$Messagetrue = str_replace("\\", "\\\\", $Messagetrue);
	$Messagetrue = str_replace("'", " ", $Messagetrue);
	$Messagetrue = str_replace("\"", " ", $Messagetrue);
	

	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){ 
		mysqli_query($link,"INSERT INTO embedder (EmbedderId, Tag) VALUES ('-1', '$Tag')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);		
		mysqli_query($link,"INSERT INTO groepen (Publish,Message, MainId, Naam, TheOrder, Language, Type, Parent, targetmainid, PublishDate, theDate, LastSaved) VALUES ( '$Publish','$Messagetrue', '-1', '$Naam', '$theorder','$language','embedder','$Parent', '$Id','$DatumTijd', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')")or  ($message = mysqli_error($link));
		$IdGroup = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE embedder SET EmbedderId = '$IdGroup' WHERE Id = '$Id'") or ($message = mysqli_error($link));
		mysqli_query($link,"UPDATE groepen SET MainId = '$IdGroup' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE groepen SET LastSaved = '".date("Y-m-d H:i:s")."' , PublishDate = '$DatumTijd', Publish = '$Publish', Message = '$Messagetrue', Naam = '$Naam',Parent = '$Parent' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"UPDATE embedder SET Tag = '$Tag' WHERE EmbedderId = '$Id'") or ($message = mysqli_error($link)); 
	}
	$result = mysqli_query($link,"SELECT MainId, Id FROM groepen WHERE Id=".$IdGroup);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
		$Id = $row['Id'];
	}

	
mysqli_query($link,"DELETE FROM groepentousergroepen WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
	$totalaccesgroup = intval($_POST["totalaccesgroup"]);
	for ($i=1; $i<$totalaccesgroup+1;$i++){
		$accesgroup = intval($_POST["accesgroup".$i]);
		mysqli_query($link,"INSERT INTO groepentousergroepen (GroepenMainId, UserGroepenMainId, Type) VALUES ( '$MainId', '$accesgroup','Publish')")or  ($message = mysqli_error($link));
	}
	
	$totalaccesmsgroup = intval($_POST["totalaccesmsgroup"]);
	
	for ($i=1; $i<$totalaccesmsgroup+1;$i++){
		$accesgroup = intval($_POST["accesmsgroup".$i]);		
		mysqli_query($link,"INSERT INTO groepentousergroepen (GroepenMainId, UserGroepenMainId, Type) VALUES ( '$MainId', '$accesgroup','Message')")or  ($message = mysqli_error($link));
	}
	
	mysqli_query($link,"DELETE FROM groepentousers WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
	$totalaccesmember = intval($_POST["totalaccesmember"]);
	for ($i=1; $i<$totalaccesmember+1;$i++){
		$accesmember = intval($_POST["accesmember".$i]);
		mysqli_query($link,"INSERT INTO groepentousers (GroepenMainId, UserId, Type) VALUES ( '$MainId', '$accesmember','Publish')")or  ($message = mysqli_error($link));
	}
	
	$totalaccesmsmember = intval($_POST["totalaccesmsmember"]);
	
	for ($i=1; $i<$totalaccesmsmember+1;$i++){
		$accesmember = intval($_POST["accesmsmember".$i]);		
		mysqli_query($link,"INSERT INTO groepentousers (GroepenMainId, UserId, Type) VALUES ( '$MainId', '$accesmember','Message')")or  ($message = mysqli_error($link));
	}
	if ($message == ""){
		$message="$Naam saved";
	}else{
		$error = true;
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=embedder&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
}else if($type=="delete"){
$output .=  'Deleting...';
$message = "Information deleted";
$result = mysqli_query($link,"SELECT Id, MainId FROM groepen WHERE MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		mysqli_query($link,"DELETE FROM groepentousergroepen WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM groepentousers WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM embedder WHERE EmbedderId = ".$MainId )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM groepen WHERE MainId=$MainId")or ($message = mysqli_error($link));
	}



array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=embedder&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

}else if($type=="select") {

	$found = false;
	$result = mysqli_query($link,"SELECT Publish, Naam, Message,theDate, LastSaved, PublishDate, Parent, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$Publish = $row['Publish'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$themessage = $row['Message'];
		$MainId = $row['targetmainid'];
		if (($theDate = strtotime($row['theDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
	}
	if ($found == true){
	$result = mysqli_query($link,"SELECT Id, Language FROM groepen WHERE MainId=".$MainIdGroup);
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
				
	$output .=  $MainId;
	
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
	$output .=  '</select></td><td>';$output .= include "./system/newitem.php";
$output .=  '</td><td><div id="buttonlayout"><h4><a href="#" onclick=" ConfirmDelete('.$MainId.','.$MainIdGroup.'); return false;">Delete</a></h4></div></td></tr></table>
				</td>
				
			</tr>
			<tr>
				<td>';
	
	

		$output .=  "Created: ".date('Y-m-j',$theDate)." Last Modified: ".date('Y-m-j',$LastSaved);
		
		$output .=  '<form action="indexadminnew.php?plugin=embedder&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0"><input type="hidden" name="IdGroup" value="'.$IdGroup.'" border="0">
		
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="45" border="0" onChange="changeval();"></td></tr>			
		<tr><td>Type</td><td>Slide Show</td></tr>
		<tr><td>Publish Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j',$PublishDate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s",$PublishDate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish </td><td><select name="Publish" id="Publish" onchange="changepublissettings()">';
			$output .=  '<option ';
			if ($Publish == "Parent"){$output .=  ' selected ';}
			$output .=  'value="Parent" selected>Take Settings from parent</option>';
			$output .=  '<option ';
			if ($Publish == "No"){$output .=  ' selected ';}
			$output .=  'value="No">no</option>';
			$output .=  '<option ';
			if ($Publish == "Members"){$output .=  ' selected ';}
			$output .=  'value="Members">Selected members</option>';
			$output .=  '<option ';
			if ($Publish == "Groups"){$output .=  ' selected ';}
			$output .=  'value="Groups">Selected groups</option>';
			$output .=  '<option ';
			if ($Publish == "AllMembers"){$output .=  ' selected ';}
			$output .=  'value="AllMembers">All members</option>';
			$output .=  '<option ';
			if ($Publish == "Public"){$output .=  ' selected ';}
			$output .=  'value="Public">Public</option>';
			$output .=  '</select><br><div id="useroptions"  style="display:none"><div id="usertext"><input type="hidden" name="totalaccesmember" id="totalaccemember" value="0"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesdocument\');return false" /></div><div id="groupoptions" style="display:none"><div id="grouptext" ><input type="hidden" name="totalaccesgroup" id="totalaccesgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesgroup\');return false" /></div></td></tr>';			
		$output .=  '<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$Parent.'"><div id="parenttext">';
		if (isset($Parent)){
		$result2 = mysqli_query($link,"SELECT Id, Naam, TheOrder, Parent FROM groepen WHERE MainId=".$Parent." AND Language=". $_SESSION['Language']);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		
		while($row2 = mysqli_fetch_array($result2)){
			$output .=  $row["Parent"].' '.$row2["Naam"];
		}}
		$output .=  '</div><input type = "button" value = "Select Parent" onclick="openselectparent(\'parentid\',\'parenttext\');return false" /></td></tr>';
		$output .=  '<tr><td>Message</td><td><select name="Messagetrue" id="Messagetrue" onchange="changemessagesettings()">';
		$output .=  '<option ';
		if ($themessage == "Parent"){$output .=  ' selected ';}
		$output .=  'value="Parent" selected>Take Settings from parent</option>';
		$output .=  '<option ';
		if ($themessage == "No"){$output .=  ' selected ';}
		$output .=  'value="No">no</option>';
		$output .=  '<option ';
		if ($themessage == "Members"){$output .=  ' selected ';}
		$output .=  'value="Members">Selected members</option>';
		$output .=  '<option ';
		if ($themessage == "Groups"){$output .=  ' selected ';}
		$output .=  'value="Groups">Selected groups</option>';
		$output .=  '<option ';
		if ($themessage == "AllMembers"){$output .=  ' selected ';}
		$output .=  'value="AllMembers">All members</option>';
		$output .=  '<option ';
		if ($themessage == "Public"){$output .=  ' selected ';}
		$output .=  'value="Public">Public</option>';
		$output .=  '</select><br><div id="usermsoptions"  style="display:none"><div id="usermstext"><input type="hidden" name="totalaccesmsmember" id="totalaccesmsmember" value="0"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesmsdocument\');return false" /></div><div id="groupmsoptions" style="display:none"><div id="groupmstext" ><input type="hidden" name="totalaccesmsgroup" id="totalaccesmsgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesmsgroup\');return false" /></div></td></tr>';	
		$result2 = mysqli_query($link,"SELECT Id, Tag FROM embedder WHERE EmbedderId=".$IdGroup);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .= '<tr><td>Embed Tage</td><td><textarea id="Tag" name="Tag" style="width: 350px; height: 175px;" onChange="loadtag();" >'.$row2["Tag"].'</textarea></td></tr>';
		}
		$output .= '</table>';
		$output .=  '<div id="embedder0"></div><div id="sliderwidth0" style="left:0px; right:0px;"></div>';
		
	$output .=  '<div id="buttonlayout"><h4><a href="javascript: submitform()">Save</a></h4></div>
			
		</form>
			
			<script type="text/javascript">
			function loadtag(){
				
				createembedder(0, document.getElementById("Tag").value,"embedder0")
			}
			createembedder(0, document.getElementById("Tag").value,"embedder0");</script>
		
		';
		$output .= '<script language="javascript">	
			changepublissettings();	
			changemessagesettings();
			';
			$result2 = mysqli_query($link,"SELECT UserGroepenMainId, Type FROM groepentousergroepen WHERE GroepenMainId=".$MainIdGroup);
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$thegroepnaam = "";
				$result3 = mysqli_query($link,"SELECT Naam FROM usergroepen WHERE MainId=".$row2["UserGroepenMainId"]." AND Language=". $_SESSION['Language']);
				if (!$result3) {
					die('Query failed: ' . mysqli_error($link));
				}
				
				while($row3 = mysqli_fetch_array($result3)){
					$thegroepnaam =  $row3["Naam"];
				}
				if ($row2["Type"] == "Publish"){
					$output .=  'addaccesgroup('.$row2["UserGroepenMainId"].',\''.$thegroepnaam.'\');';
				}else{
					$output .=  'addaccesmsgroup('.$row2["UserGroepenMainId"].',\''.$thegroepnaam.'\');';
				}
			}
			$result2 = mysqli_query($link,"SELECT UserId, Type FROM groepentousers WHERE GroepenMainId=".$MainIdGroup);
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}

			while($row2 = mysqli_fetch_array($result2)){
				$theusernaam = "";
				$Profilepic = "";
				$result3 = mysqli_query($link,"SELECT Username, Profilepic FROM login WHERE Id=".$row2["UserId"]);
				if (!$result3) {
					die('Query failed: ' . mysqli_error($link));
				}
				
				while($row3 = mysqli_fetch_array($result3)){
					$theusernaam =  $row3["Username"];
					$Profilepic = $row3["Profilepic"];
				}
				if ($row2["Type"] == "Publish"){
					$output .=  'addaccesmembers('.$row2["UserId"].',\''.$Profilepic.'\',\''.$theusernaam.'\');';
				}else{
					$output .=  'addaccesmsmembers('.$row2["UserId"].',\''.$Profilepic.'\',\''.$theusernaam.'\');';
				}
			}
			$output .= '
			updateaccesgroup (); updateaccesmsgroup ();updateaccesmembers();updateaccesmsmembers();
			</script>';
		$acces = accesdocumentMessages($MainIdGroup,array(), $_SESSION['Id']);
		if ($acces == true){
		$output .='<h2>Reply\'s</h2>';
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroup;
			$msgtype = "photogallery";
		
		$output .= '<br><br>';
		
	
	
	}
	
	$output .= '</td>
			</tr>
		</table>';
}
}else if ($type=="new"){
$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td>';$output .= include "./system/newitem.php";
$output .=  '</td>
			</tr>
			<tr>
				
				<td>';
				$output .=  '<form action="indexadminnew.php?plugin=embedder&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="45" border="0" onchange="changeval();"></td></tr>	
		<tr><td>Type</td><td>Embedder</td></tr>	
		<tr><td>Publish Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j').'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s").'" size="10" border="0" onchange=changeval()></td></tr>	
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
		$output .=  '</select></td></tr>';
		$output .=  '<td>Publish </td><td><select name="Publish" id="Publish" onchange="changepublissettings()">';
			$output .=  '<option value="Parent" selected>Take Settings from parent</option>';
			$output .=  '<option value="No">no</option>';
			$output .=  '<option value="Members">Selected members</option>';
			$output .=  '<option value="Groups">Selected groups</option>';
			$output .=  '<option value="AllMembers">All members</option>';
			$output .=  '<option value="Public">Public</option>';
			$output .=  '</select><br><div id="useroptions"  style="display:none"><div id="usertext"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesdocument\');return false" /></div><div id="groupoptions" style="display:none"><div id="grouptext" ><input type="hidden" name="totalaccesgroup" id="totalaccesgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesgroup\');return false" /></div></td></tr>';	
		$output .=  '<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$sectie.'"><div id="parenttext"></div><input type = "button" value = "Select Parent" onclick="openselectparent(\'parentid\',\'parenttext\');return false" />';
			
		$output .= '</td></tr>';
				$output .=  '<tr><td>Message</td><td><select name="Messagetrue" id="Messagetrue" onchange="changemessagesettings()">';
			$output .=  '<option value="Parent" selected>Take Settings from parent</option>';
			$output .=  '<option value="No">no</option>';
			$output .=  '<option value="Members">Selected members</option>';
			$output .=  '<option value="Groups">Selected groups</option>';
			$output .=  '<option value="AllMembers">All members</option>';
			$output .=  '<option value="Public">Public</option>';
			$output .=  '</select><br><div id="usermsoptions"  style="display:none"><div id="usermstext"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesmsdocument\');return false" /></div><div id="groupmsoptions" style="display:none"><div id="groupmstext" ><input type="hidden" name="totalaccesmsgroup" id="totalaccesmsgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesmsgroup\');return false" /></div></td></tr>';	
			
		$output .= '<tr><td>Embed Tage</td><td><textarea id="Tag" name="Tag" style="width: 350px; height: 175px;" onChange="loadtag();" ></textarea></td></tr>';
		$output .= '</table>';
		$output .=  '<div id="embedder0"></div><div id="sliderwidth0" style="left:0px; right:0px;"></div>';
		
	$output .=  '<div id="buttonlayout"><h4><a href="javascript: submitform()">Save</a></h4></div></td><td></td></tr></table>
			
		</form>
			<script type="text/javascript">bkLib.onDomLoaded(function() { window_onload(); });</script>
			<script type="text/javascript">
			function loadtag(){
				
				createembedder(0, document.getElementById("Tag").value,"embedder0")
			}
			createembedder(0, document.getElementById("Tag").value,"embedder0");</script>';
			

}else{
$output .=  '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table><tr><td>';
		
		$output .= '</td><td>';$output .= include "./system/newitem.php";
$output .=  '</td></tr></table></td>
			</tr>
			<tr>
				
				<td>';
				
				$output .= '</td></tr></table>';
}
$MainId = $MainIdGroup; 


		   

}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
