<?php
// Init session settings


if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
 

$output .= '

<script type="text/javascript" src="nicEdit.js"></script>';
$output .= '
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";

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
$output .= '
<script language="javascript">

function layerActie(divID) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
   } else {
   
      document.getElementById(divID).style.display="none";
   }
}
function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je dit document wilt verwijderen.")

if (answer !=0) { 
	location = "indexadminnew.php?plugin=richtext&type=delete&sectie='.$sectie.'&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexadminnew.php?plugin=richtext&type=new_Language&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexadminnew.php?plugin=richtext&type=delete_Language&sectie='.$sectie.'&Id=\'+'.$MainId.',\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexadminnew.php?plugin=richtext&language_id=\'+veld+\'&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){
		UpdateRichtext();	
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
	Unloadniceditors();	
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

</script>

<script language="javascript">

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
</script>';


if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			
				<td>';
				$output .='	<form action="indexadminnew.php?plugin=richtext&type=save_Language&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';
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

	$result = mysqli_query($link,"SELECT Id, Language FROM richtext WHERE MainId=".$MainId);
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
	$output .= '</select><br><br><div id="buttonlayout">
            <h4><a href="javascript: submitform2()">Save</a></h4>
          </div></form>
	';

	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="save_Language"){
	$output .='saving Language...';
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
		/*
		$result = mysqli_query($link,"SELECT Naam, Message, Parent, Id, targetmainid, theDate, LastSaved, PublishDate, Publish FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$themessage = $row['Message'];
		$MainId = $row['targetmainid'];
		if (($theDate = strtotime($row['theDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$Publish = $row['Publish'];
	}*/
	
	$result = mysqli_query($link,"SELECT Message, Naam, Type, Parent, TheOrder, Id, targetmainid, PublishDate, Publish FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
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
		$Publish = $row['Publish'];
		$DatumTijd = $row['PublishDate'];
		$Type = $row['Type'];
	}
	
	$result = mysqli_query($link,"SELECT MainId, NumCol,ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg,LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, TheDate, Language FROM richtext WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$LargText = $row['LargText'];
		$MainId = $row['MainId'];
		$Langinputid = $row['Language'];
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

	
	mysqli_query($link,"INSERT INTO groepen (Type,Message, MainId, Language, Naam, Parent, TheOrder, targetmainid, theDate, LastSaved, PublishDate, Publish) VALUES ('$Type','$Messagetrue','$MainIdGroup','$newlanguage', '$Naam','$Parent',  '$TheOrder', '$MainId','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$DatumTijd','$Publish')")or ($message = mysqli_error($link));
	//mysqli_query($link,"INSERT INTO richtext (MainId, Language, LargText, TheDate ) VALUES ('$MainId', '$newlanguage','$LargText',  '$DatumTijd' )")or ($message = mysqli_error($link));
	mysqli_query($link,"INSERT INTO richtext ( MainId, Language, Largtext1bg, Largtext2bg, Largtext3bg, Largtext4bg, Largtext5bg, Largtext6bg, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, NumCol,ColWidth,ColHeigth) VALUES ( '$MainId', '$newlanguage','$bg[1]','$bg[2]','$bg[3]','$bg[4]','$bg[5]','$bg[6]','$LargText[1]','$LargText[2]','$LargText[3]','$LargText[4]','$LargText[5]','$LargText[6]','$NumCols','$ColWidth','$ColHeigth')")or  ($message = mysqli_error($link));
		
	$_SESSION['Language'] = $newlanguage;
	}
	}
	
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=richtext&type=select&sectie='.$sectie.'&Id='.$MainIdGroup.'\',\'_self\',\'\',\'true\')", 0);</script>';
	
} else if ($type=="delete_Language"){	
	$output .= 'Deleting Language...';
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
		
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
	}
	$result = mysqli_query($link,"SELECT Id, MainId FROM richtext WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		if ($row['MainId'] == $row['Id']){
			
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM richtext WHERE MainId=".$row['MainId'] );
			if (!$result2) {
    			die('Query failed: ' . mysqli_error($link));
			}
			
			while($row2 = mysqli_fetch_array($result2)){
				$Id = $row2['Id'];

				if ($row2['MainId']	!= $row2['Id'] and $changed == false){
					$oldMainId = $MainId;
					$MainId = $row2['Id'];
					$changed = true;
				}
				mysqli_query($link,"UPDATE richtext SET MainId = '$MainId' WHERE MainId = '$oldMainId '") or ($message = mysqli_error($link));
				mysqli_query($link,"UPDATE groepen SET targetmainid = '$MainId' WHERE MainId = '$MainIdGroup'") or ($message = mysqli_error($link)); 
			}
		
		} 
	}
	mysqli_query($link,"DELETE FROM groepen  WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainIdGroup  )or ($message = mysqli_error($link));
	mysqli_query($link,"DELETE FROM richtext WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId  )or ($message = mysqli_error($link));
	$message = "";
		
		if ($message == ""){	
		$message ="Language deleted";
		
		}

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=richtext&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

}else if ($type=="save"){
	$output .= 'Saving pleas wait...';
	$Id = $_POST["Id"];
	$IdGroup =  intval($_POST["IdGroup"]);
	$Publish =  $_POST["Publish"];
	$Naam = $_POST["Naam"]; 
	$language = intval($_POST["language"] );
	$TheDate = $_POST["TheDate"]; 
	$TheTime = $_POST["TheTime"]; 
	$Parent = intval($_POST["parentid"]);
	$SmallText = $_POST["SmallText"]; 
	$LargText = $_POST["LargText"];
	$DatumTijd = $TheDate ." ". $TheTime;
	$message = "";
	$error = false;
	$Messagetrue = $_POST["Messagetrue"];
	$NumCols = intval($_POST["NumCols"]);
	$ColWidth = intval($_POST["ColWidth"]);
	$ColHeigth = intval($_POST["ColHeigth"]);
	$LargText = array();
	$bg = array();
	
	for ($i=0; $i<$NumCols; $i++){		
		$LargText[$i+1] = addslashes($_POST["LargText".($i+1)]);
		$bg[$i+1] = $_POST["bg".($i+1)];
		if (get_magic_quotes_gpc()) {
		}else{
			$bg[$i+1] = str_replace("\\", "\\\\", $bg[$i+1]);
			$bg[$i+1] = str_replace("'", " ", $bg[$i+1]);
			$bg[$i+1] = str_replace("\"", " ", $bg[$i+1]);
		}
	}
	
	
		
	//$LargText = removeFullLinks($LargText);
	//$SmallText = str_replace("\\", "\\\\", $SmallText);
	//$SmallText = str_replace("'", "\\\'", $SmallText);
	//$LargText = str_replace("\\", "\\\\", $LargText);
	//$LargText = str_replace("'", "\\\'", $LargText);
	if (get_magic_quotes_gpc()) {
	}else{
	$DatumTijd = str_replace("\\", "\\\\", $DatumTijd);
	$DatumTijd = str_replace("'", " ", $DatumTijd);
	$DatumTijd = str_replace("\"", " ", $DatumTijd);
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);	
	$language = str_replace("\\\"", " ", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);
	$Publish = str_replace("\\", "\\\\", $Publish);
	$Publish = str_replace("'", " ", $Publish);
	$Publish = str_replace("\"", " ", $Publish);
	$Messagetrue = str_replace("\\", "\\\\", $Messagetrue);
	$Messagetrue = str_replace("'", " ", $Messagetrue);
	$Messagetrue = str_replace("\"", " ", $Messagetrue);
	}
	
	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){
		mysqli_query($link,"INSERT INTO richtext (MainId, Language, Largtext1bg, Largtext2bg, Largtext3bg, Largtext4bg, Largtext5bg, Largtext6bg, LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6, NumCol,ColWidth,ColHeigth) VALUES ('-1', '$language','$bg[1]','$bg[2]','$bg[3]','$bg[4]','$bg[5]','$bg[6]','$LargText[1]','$LargText[2]','$LargText[3]','$LargText[4]','$LargText[5]','$LargText[6]','$NumCols','$ColWidth','$ColHeigth')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE richtext SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"INSERT INTO groepen (Message, MainId, Naam, TheOrder, Language, Type, Parent, targetmainid, theDate, LastSaved, PublishDate, Publish) VALUES ('$Messagetrue', '-1', '$Naam', '$theorder','$language','richtext','$Parent', '$Id','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$DatumTijd','$Publish')")or  ($message = mysqli_error($link));
		$IdGroup = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE groepen SET MainId = '$IdGroup' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link));
	}else{
		$Id = intval($_POST["Id"]);
		mysqli_query($link,"UPDATE groepen SET Message = '$Messagetrue', Naam = '$Naam', Parent = '$Parent', LastSaved = '".date("Y-m-d H:i:s")."', PublishDate = '$DatumTijd', Publish = '$Publish' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"UPDATE richtext SET Largtext1bg = '$bg[1]',Largtext2bg = '$bg[2]',Largtext3bg = '$bg[3]',Largtext4bg = '$bg[4]',Largtext5bg = '$bg[5]',Largtext6bg = '$bg[6]',LargText = '$LargText[1]',Largtext2 = '$LargText[2]',Largtext3 = '$LargText[3]',Largtext4 = '$LargText[4]',Largtext5 = '$LargText[5]',Largtext6 = '$LargText[6]',NumCol = '$NumCols',ColWidth = '$ColWidth',ColHeigth = '$ColHeigth' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}
	$result = mysqli_query($link,"SELECT MainId FROM groepen WHERE Id=".$IdGroup);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
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
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=richtext&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
	
}else if($type=="delete"){
$output .= 'Pleas wait Deleting...';
$message = "Information deleted";
mysqli_query($link,"DELETE FROM groepentousers WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM groepentousergroepen WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM reply WHERE ParentMainId=$MainId AND ParentType='richtext'")or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM richtext WHERE MainId=$MainId")or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM groepen WHERE targetmainid=$MainId")or ($message = mysqli_error($link));
array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=richtext&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

}else if($type=="select") {

	$found = false;
	$result = mysqli_query($link,"SELECT Naam, Message, Parent, Id, targetmainid, theDate, LastSaved, PublishDate, Publish FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$themessage = $row['Message'];
		$MainId = $row['targetmainid'];
		if (($theDate = strtotime($row['theDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$Publish = $row['Publish'];
	}
	if ($found == true){
	$result = mysqli_query($link,"SELECT Id, Language FROM richtext WHERE MainId=".$MainId);
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
				
	//$output .= $MainId;
	
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
	$output .= '</select></td><td>	';$output .=include "./system/newitem.php";$output .= '</td><td><div id="buttonlayout"><h4><a href="#" onclick=" ConfirmDelete('.$MainId.','.$MainIdGroup.'); return false;">Delete</a></h4></div></td></tr></table>
				</td>
				
			</tr>
			<tr>
				
				<td>';
	
	

	$result = mysqli_query($link,"SELECT Id, NumCol,ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg,LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6 FROM richtext WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$Id = $row['Id'];
		$output .= "Created: ".date('Y-m-j',$theDate)." Last Modified: ".date('Y-m-j',$LastSaved);
		$output .= '<form action="indexadminnew.php?plugin=richtext&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0"><input type="hidden" name="IdGroup" value="'.$IdGroup.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="75" border="0" onChange="changeval();"></td></tr>	
		<tr><td>Type</td><td>Rich Text</td></tr>		
		<tr><td>Publish Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j',$PublishDate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s",$PublishDate).'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish </td><td><select name="Publish" id="Publish" onchange="changepublissettings()">';
			$output .= '<option ';
			if ($Publish == "Parent"){$output .= ' selected ';}
			$output .= 'value="Parent" selected>Take Settings from parent</option>';
			$output .= '<option ';
			if ($Publish == "No"){$output .= ' selected ';}
			$output .= 'value="No">no</option>';
			$output .= '<option ';
			if ($Publish == "Members"){$output .= ' selected ';}
			$output .= 'value="Members">Selected members</option>';
			$output .= '<option ';
			if ($Publish == "Groups"){$output .= ' selected ';}
			$output .= 'value="Groups">Selected groups</option>';
			$output .= '<option ';
			if ($Publish == "AllMembers"){$output .= ' selected ';}
			$output .= 'value="AllMembers">All members</option>';
			$output .= '<option ';
			if ($Publish == "Public"){$output .= ' selected ';}
			$output .= 'value="Public">Public</option>';
			$output .= '</select><br><div id="useroptions"  style="display:none"><div id="usertext"><input type="hidden" name="totalaccesmember" id="totalaccemember" value="0"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesdocument\');return false" /></div><div id="groupoptions" style="display:none"><div id="grouptext" ><input type="hidden" name="totalaccesgroup" id="totalaccesgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesgroup\');return false" /></div></td></tr>';		
		$output .= '<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$Parent.'"><div id="parenttext">';
		if (isset($Parent)){
		$result2 = mysqli_query($link,"SELECT Id, Naam, TheOrder, Parent FROM groepen WHERE MainId=".$Parent." AND Language=". $_SESSION['Language']);
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		
		while($row2 = mysqli_fetch_array($result2)){
			$output .= $row["Parent"].' '.$row2["Naam"];
		}}
		$output .= '</div><input type = "button" value = "Select Parent" onclick="openselectparent(\'parentid\',\'parenttext\');return false" /></td></tr>';
		$output .= '<tr><td>Message</td><td><select name="Messagetrue" id="Messagetrue" onchange="changemessagesettings()">';
		$output .= '<option ';
		if ($themessage == "Parent"){$output .= ' selected ';}
		$output .= 'value="Parent" selected>Take Settings from parent</option>';
		$output .= '<option ';
		if ($themessage == "No"){$output .= ' selected ';}
		$output .= 'value="No">no</option>';
		$output .= '<option ';
		if ($themessage == "Members"){$output .= ' selected ';}
		$output .= 'value="Members">Selected members</option>';
		$output .= '<option ';
		if ($themessage == "Groups"){$output .= ' selected ';}
		$output .= 'value="Groups">Selected groups</option>';
		$output .= '<option ';
		if ($themessage == "AllMembers"){$output .= ' selected ';}
		$output .= 'value="AllMembers">All members</option>';
		$output .= '<option ';
		if ($themessage == "Public"){$output .= ' selected ';}
		$output .= 'value="Public">Public</option>';
		$output .= '</select><br><div id="usermsoptions"  style="display:none"><div id="usermstext"><input type="hidden" name="totalaccesmsmember" id="totalaccesmsmember" value="0"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesmsdocument\');return false" /></div><div id="groupmsoptions" style="display:none"><div id="groupmstext" ><input type="hidden" name="totalaccesmsgroup" id="totalaccesmsgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesmsgroup\');return false" /></div></td></tr>';	
		
		$output .= '<tr><td>Number of Columns</td><td><select name="NumCols" id="NumCols" onchange=UpdateRichtext()>';
		$output .= '<option value="1"';
			if ($row['NumCol'] == 1){$output .= ' selected ';}
			$output .= '>1</option>';
		$output .= '<option value="2"';
			if ($row['NumCol'] == 2){$output .= ' selected ';}
			$output .= '>2</option>';
		$output .= '<option value="3"';
			if ($row['NumCol'] == 3){$output .= ' selected ';}
			$output .= '>3</option>';
		$output .= '<option value="4"';
			if ($row['NumCol'] == 4){$output .= ' selected ';}
			$output .= '>4</option>';
		$output .= '<option value="5"';
			if ($row['NumCol'] == 5){$output .= ' selected ';}
			$output .= '>5</option>';
		$output .= '<option value="6"';
			if ($row['NumCol'] == 6){$output .= ' selected ';}
			$output .= '>6</option>';
		$output .= '</select></td></tr>';
		$output .= '<tr><td>Column width</td><td><input type="text" name="ColWidth" id="ColWidth" value="'.$row['ColWidth'].'" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .= '<tr><td>Column Heigth</td><td><input type="text" name="ColHeigth" id="ColHeigth" value="'.$row['ColHeigth'].'" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .= '
		<tr><td colspan="2">Rich Text</tr>
		<tr><td colspan="2"><div id="Richtextarray"></div>
		<script language="javascript">	
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
					$output .= 'addaccesgroup('.$row2["UserGroepenMainId"].',\''.$thegroepnaam.'\');';
				}else{
					$output .= 'addaccesmsgroup('.$row2["UserGroepenMainId"].',\''.$thegroepnaam.'\');';
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
					$output .= 'addaccesmembers('.$row2["UserId"].',\''.$Profilepic.'\',\''.$theusernaam.'\');';
				}else{
					$output .= 'addaccesmsmembers('.$row2["UserId"].',\''.$Profilepic.'\',\''.$theusernaam.'\');';
				}
			}
			$output .='
			updateaccesgroup (); updateaccesmsgroup ();updateaccesmembers();updateaccesmsmembers();
		
			window.richtext =new Array();
			window.richtext[1] = '.json_encode(mb_convert_encoding($row['LargText'], "UTF-8"),JSON_UNESCAPED_UNICODE).'
			window.richtext[2] = '.json_encode(mb_convert_encoding($row['Largtext2'], "UTF-8"), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE).'
			window.richtext[3] = '.json_encode(mb_convert_encoding($row['Largtext3'], "UTF-8"), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE).'
			window.richtext[4] = '.json_encode(mb_convert_encoding($row['Largtext4'], "UTF-8"), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE).'
			window.richtext[5] = '.json_encode(mb_convert_encoding($row['Largtext5'], "UTF-8"), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE).'
			window.richtext[6] = '.json_encode(mb_convert_encoding($row['Largtext6'], "UTF-8"), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE).'
			window.richtextbg =new Array();
			window.richtextbg[1] = "'.str_replace('"', '\"',$row['Largtext1bg']).'";
			window.richtextbg[2] = "'.str_replace('"', '\"',$row['Largtext2bg']).'";
			window.richtextbg[3] = "'.str_replace('"', '\"',$row['Largtext3bg']).'";
			window.richtextbg[4] = "'.str_replace('"', '\"',$row['Largtext4bg']).'";
			window.richtextbg[5] = "'.str_replace('"', '\"',$row['Largtext5bg']).'";
			window.richtextbg[6] = "'.str_replace('"', '\"',$row['Largtext6bg']).'";
			window.oldNumCols ='.$row['NumCol'].';
			
			
		</script>
		</td></tr>
		
		<tr><td><div id="buttonlayout">
            <h4><a href="javascript: submitform()">Save</a></h4>
          </div>
		  </td><td></td></tr></table>
			
		</form>';
		
		$acces = accesdocumentMessages($MainIdGroup,array(), $_SESSION['Id']);
		if ($acces == true){
		$output .='<h2>Reply\'s</h2>';
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $MainIdGroup;
			$msgtype = "richtext";
		
		$output .= '<br><br>';
		
		
	}

	}
	$output .= '</td>
			</tr>
		</table>';
}
}else if ($type=="new"){
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td>';$output .=include "./system/newitem.php";
$output .= '</td>
			</tr>
			<tr>
				
				<td>';
				$output .= '<form action="indexadminnew.php?plugin=richtext&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="75" border="0" onchange="changeval();"></td></tr>		
		<tr><td>Type</td><td>Rich Text</td></tr>
		<tr><td>Publish Date</td><td><input type="text" name="TheDate" value="'.date('Y-m-j').'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish Time</td><td><input type="text" name="TheTime" value="'.date("H:i:s").'" size="10" border="0" onchange=changeval()></td></tr>
		<tr><td>Publish </td><td><select name="Publish" id="Publish" onchange="changepublissettings()">';
			$output .= '<option value="Parent" selected>Take Settings from parent</option>';
			$output .= '<option value="No">no</option>';
			$output .= '<option value="Members">Selected members</option>';
			$output .= '<option value="Groups">Selected groups</option>';
			$output .= '<option value="AllMembers">All members</option>';
			$output .= '<option value="Public">Public</option>';
			$output .= '</select><br><div id="useroptions"  style="display:none"><div id="usertext"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesdocument\');return false" /></div><div id="groupoptions" style="display:none"><div id="grouptext" ><input type="hidden" name="totalaccesgroup" id="totalaccesgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesgroup\');return false" /></div></td></tr>';	
		$output .= '<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$sectie.'"><div id="parenttext"></div><input type = "button" value = "Select Parent" onclick="openselectparent(\'parentid\',\'parenttext\');return false" />';
			
		$output .='</td></tr>';		
		$output .= '<tr><td>Message</td><td><select name="Messagetrue" id="Messagetrue" onchange="changemessagesettings()">';
			$output .= '<option value="Parent" selected>Take Settings from parent</option>';
			$output .= '<option value="No">no</option>';
			$output .= '<option value="Members">Selected members</option>';
			$output .= '<option value="Groups">Selected groups</option>';
			$output .= '<option value="AllMembers">All members</option>';
			$output .= '<option value="Public">Public</option>';
			$output .= '</select><br><div id="usermsoptions"  style="display:none"><div id="usermstext"></div><input type = "button" value = "Select Users" onClick="opendocumentfriends(\'accesmsdocument\');return false" /></div><div id="groupmsoptions" style="display:none"><div id="groupmstext" ><input type="hidden" name="totalaccesmsgroup" id="totalaccesmsgroup" value="0"></div><input type = "button" value = "Select group" onclick="openusergroupselector(\'accesmsgroup\');return false" /></div></td></tr>';	
			
		//echo'</table></div><div id="Submenuonn"><table>';
		$output .= '<tr><td>Number of Columns</td><td><select name="NumCols" id="NumCols" onchange=UpdateRichtext()>';
		$output .= '<option value="1"';
			
			$output .= '>1</option>';
		$output .= '<option value="2"';
			
			$output .= '>2</option>';
		$output .= '<option value="3"';
			
			$output .= '>3</option>';
		$output .= '<option value="4"';
			
			$output .= '>4</option>';
		$output .= '<option value="5"';
			
			$output .= '>5</option>';
		$output .= '<option value="6"';
			
			$output .= '>6</option>';
		$output .= '</select></td></tr>';		
		$output .= '<tr><td>Column width</td><td><input type="text" name="ColWidth" id="ColWidth" value="700" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .= '<tr><td>Column height</td><td><input type="text" name="ColHeigth" id="ColHeigth" value="20" size="10" border="0" onchange=ChangWidthRichtext()>pixels</td></tr>';
		$output .= '
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
			UpdateRichtext();
			
		</script>
		</table></div><table>';
		$output .= '<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
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
	<tr><td><div id="buttonlayout">
           <h4> <a href="javascript: submitform()">Save</a></h4>
          </div></td><td></td></tr></table>
			
		</form>
			<script type="text/javascript">bkLib.onDomLoaded(function() { window_onload(); });</script>';
				$output .='</td></tr></table>';

}else{
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table><tr><td>';
		
		$output .='</td><td>';$output .=include "./system/newitem.php";
$output .= '</td></tr></table></td>
			</tr>
			<tr>
				
				<td>';
				
				$output .='</td></tr></table>';
}
$MainId = $MainIdGroup;/*
$after .= '<div id="gallerybuttons" name="gallerybuttons" style="position:fixed; left:0px; top:0px; right:0px; bottom:0px; overflow:hidden; display:none; z-index:100;">
<div style="position:absolute; top:0px; right:0px; left:66%; bottom:66%;" onclick="closeeditimg();return false"><a href="#" ></a></div>
<div style="position:absolute; top:33%; right:0px; bottom:33%; left:66%;" onclick="nextimg2();return false"></div>
<div style="position:absolute; bottom:0px; left:33%; right:33%; top:66%;" onclick="play2();return false"></div>
<div style="position:absolute; bottom:0px; left:0px; right:66%; top:66%;" onclick="imgquality2();return false"></div>
<div style="position:absolute; top:33%; left:0px; bottom:33%; right:66%;" onclick="previousimg2();return false"></div>

<div style="position:absolute; top:0px; right:0px;"><a href="#" onclick="closeeditimg();return false"><img src="'.$_SESSION['Theme'].'systemicon/close2.png" ></a></div>
<div style="position:absolute; top:50%; right:0px;"><a href="#" onclick="nextimg2();return false"><img src="'.$_SESSION['Theme'].'systemicon/Next.png" ></a></div>
<div style="position:absolute; bottom:0px; left:50%;"><a href="#" onclick="play2();return false"><img id="playpauze" src="'.$_SESSION['Theme'].'systemicon/Play.png" ></a></div>
<div style="position:absolute; bottom:0px; left:0px;"><a href="#" onclick="imgquality2();return false"><img id="quality" src="'.$_SESSION['Theme'].'systemicon/quality.png" ></a></div>
<div style="position:absolute; top:50%; left:0px;"><a href="#" onclick="previousimg2();return false"><img src="'.$_SESSION['Theme'].'systemicon/Previous.png" ></a></div>
</div>';
$after .='<div name="directory" id="directory"></div> 

$after.= '<div name="friends" id="friends"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Friends</font></b>  <a href="#" onclick="closedocumentfriends();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker6" id="filelinker6" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$after.='<div name="usergroupselector" id="usergroupselector"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Parent selector</font></b><a href="#" onclick="closeusergroupselector();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe frameborder="0" width="100%" height="100%" name="filelinker7" id="filelinker7" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>
<div id="imgcontainer5" name="imgcontainer5" style="overflow:hidden; vertical-align:top; display:none; width:0px; height:0px;"><img src="" id="imgshower2" name="imgshower2"></div>
<div name="editimg" id="editimg">
<div id="imgcontainer2" name="imgcontainer2"  style="overflow:hidden;"><div id="imgcontainer" name="imgcontainer" style="align:left; style="overflow:hidden; vertical-align:top;"><img src="" id="imgshower" name="imgshower"></div></div><div style="position:absolute; left:10px; overflow:hidden; right:10px; bottom:10px; background-color:#000; height:75px" id ="Infoimagebg" name="Infoimagebg"></div><div style="position:absolute; overflow:hidden; left:10px; height:65px; right:10px; bottom:15px; " id ="Infoimage" name="Infoimage"></div>
</div>
<script language="javascript">
	
	document.getElementById(\'imgshower\').onload = function() {
	
	Imageisloaded();
	}
	document.getElementById(\'imgshower2\').onload = function() {
	
	Imageisloaded2();
	}
	resizeframe()
</script>
';*/


}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
