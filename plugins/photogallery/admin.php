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
function addgalimg(Naam,ImgText,Url,theWidth,theHeight){
		
		tmparray = new Array();
		tmparray.url = Url;
		tmparray.name = Naam;
		tmparray.text = ImgText;
		tmparray.theWidth = theWidth;
		tmparray.theHeight = theHeight;
		return tmparray;
}
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
window.maingalleryimages = new Array();
window.galleryimages = new Array();
window.curgalleryimg = -1;

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
	location = "indexadminnew.php?plugin=photogallery&type=delete&sectie='.$sectie.'&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexadminnew.php?plugin=photogallery&type=new_Language&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexadminnew.php?plugin=photogallery&type=delete_Language&sectie='.$sectie.'&Id=\'+'.$MainId.',\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexadminnew.php?plugin=photogallery&language_id=\'+veld+\'&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){
			 myNicEditor2 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'LargText\');
}

function window_onunload(){

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
	myNicEditor2.removeInstance(\'LargText\');	
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


function selectallimg(){
	totalfiles = parseInt(document.getElementById(\'totalimg\').value);

	for (i=0;i<totalfiles;i++)
	{	
		document.getElementById(\'imageid\'+i).checked = true;
		
	}
}

function deselectallimg(){
	totalfiles = parseInt(document.getElementById(\'totalimg\').value);

	for (i=0;i<totalfiles;i++)
	{	
		document.getElementById(\'imageid\'+i).checked = false;
		
	}
}
function deletemainimg()
{
	
	totalfiles = parseInt(document.getElementById(\'totalimg\').value);
	
	
	
	for (i=totalfiles-1;i>-1;i=i-1)
	{	
		
		if (document.getElementById(\'imageid\'+i).checked == true){
			window.maingalleryimages.splice(i,1); 
			
		}
		
	}
	
	updatemaingallery ()
}

function galleryimgwitch(img1, img2){
	tmp = window.maingalleryimages[img1];
	window.maingalleryimages[img1] = window.maingalleryimages[img2];
	window.maingalleryimages[img2] = tmp;
	updatemaingallery ()
}

function updatemaingallery (){
	txt = "";
	scale = 1 / window.devicePixelRatio;
	ii =0;
	for (i=0;i<window.maingalleryimages.length;i++)
	{
		if (ii < 1){
			
			ii = ii + 1;
		}else{
			ii = 1;
		}
		tumbnailsize =parseInt( document.getElementById("Tumbnailsize").value);
		txt = txt + \'<div align="center" style="display:inline-block;vertical-align:middle;"><a href="#" onClick="selectgallery(window.maingallerryimages);gallerymainimgshow(\\\'\'+i+\'\\\');return false"><img src="./system/imgtumb.php?url=\'+window.maingalleryimages[i].url+\'&maxsize=\'+(tumbnailsize* window.devicePixelRatio)+\'&square=\'+document.getElementById("Tumbnailsquare").value+\'"style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\' ;
		txt = txt +  "<br><div id=\"gallerybut\">";
		if (i==0 && i == window.maingalleryimages.length -1){
			txt = txt + \'\';
		} else if(i==0){
			txt = txt + \'<a href="#" onClick="galleryimgwitch(\\\'\'+i+\'\\\',\\\'\'+(i+1)+\'\\\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/down.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20" ></a>\';
		} else if (i== window.maingalleryimages.length -1){
			txt = txt + \'<a href="#" onClick="galleryimgwitch(\\\'\'+i+\'\\\',\\\'\'+(i-1)+\'\\\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/up.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20"></a>\';
		} else {
			txt = txt + \'<a href="#" onClick="galleryimgwitch(\\\'\'+i+\'\\\',\\\'\'+(i-1)+\'\\\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/up.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20" ></a>\';
			txt = txt + \'<a href="#" onClick="galleryimgwitch(\\\'\'+i+\'\\\',\\\'\'+(i+1)+\'\\\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/down.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20" ></a>\';
		}	
		txt = txt +\'</div><input type="hidden" name="imgtext\'+i+\'" id="imgtext\'+i+\'" value="\'+window.maingalleryimages[i].text+\'"><input type="hidden" name="imgname\'+i+\'" id="imgname\'+i+\'" value="\'+window.maingalleryimages[i].name+\'"><input type="hidden" name="filename\'+i+\'" id="filename\'+i+\'" value="\'+window.maingalleryimages[i].url+\'"><input type="checkbox" name="imageid\'+i+\'" id="imageid\'+i+\'"/></div>\';
	}
	txt = txt +\'<input type="hidden" name="totalimg" id="totalimg" value="\'+window.maingalleryimages.length+\'">\';

	document.getElementById(\'galleryimg\').innerHTML = txt;
}

function gallerymainimgshow(Num){
	window.galleryfunction = "Main";
	window.curgalleryimg = Num;
	
	if (document.getElementById(\'imgshowermain\').src != window.maingalleryimages[Num].url){
		changeOpac(0, "imgcontainermain");
		document.getElementById(\'imgshowermain\').src = "";
		document.getElementById(\'imgshowermain\').src = window.maingalleryimages[Num].url;
	}
	document.getElementById(\'imageNaam\').value =window.maingalleryimages[Num].name;
	document.getElementById(\'imgetext\').value = window.maingalleryimages[Num].text;
	changeOpac(50, "Infoimagebgmain");
	if (document.getElementById(\'Imagedetails\').value == "1"){
		document.getElementById(\'Infoimagebgmain\').style.display = \'block\';
		document.getElementById(\'Infoimagemain\').style.display = \'block\';
	}else {
		document.getElementById(\'Infoimagebgmain\').style.display = \'none\';
		document.getElementById(\'Infoimagemain\').style.display = \'none\';
	}
	myNicEditorimg = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'imgetext\');
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'editimgmain\').style.display = \'block\';
	document.getElementById(\'gallerybuttonsmain\').style.display = \'block\';
}

function submitimage(){
	myNicEditorimg.removeInstance(\'imgetext\');
	window.maingalleryimages[window.curgalleryimg].name=document.getElementById(\'imageNaam\').value ;
	window.maingalleryimages[window.curgalleryimg].text=document.getElementById(\'imgetext\').value  ;
	window.curgalleryimg = -1;
	updatemaingallery ();	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'editimgmain\').style.display = \'none\';
}

function Imagemainisloaded(){
	
	document.getElementById(\'imgshowermain\').width = window.maingalleryimages[window.curgalleryimg].theWidth;
	document.getElementById(\'imgshowermain\').height = window.maingalleryimages[window.curgalleryimg].theHeight;
	
	resizeframe();
	addalphamainimg();	
	
}

function changeOpac(opacity, id) {
	
    var object = document.getElementById(id).style;
    object.opacity = (opacity / 100);
    object.MozOpacity = (opacity / 100);
    object.KhtmlOpacity = (opacity / 100); 	
    object.filter = "alpha(opacity=" + opacity + ")";
}
function addalphamainimg(){
	
	var curalpha = parseFloat(document.getElementById(\'imgcontainermain\').style.opacity);
	curalpha = (curalpha + 0.1)*100;
	changeOpac(curalpha, "imgcontainermain");
	
	if (curalpha < 100){		
		window.timerIDimg=setTimeout("addalphamainimg()",30);
	}
}

function closeeditimgmain(){
	window.curgalleryimg = -1;
	myNicEditorimg.removeInstance(\'imgetext\');
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'editimgmain\').style.display = \'none\';
	document.getElementById(\'gallerybuttonsmain\').style.display = \'none\';
}

/*function addgalimg(Naam,ImgText,Url,theWidth,theHeight){
		
		tmparray = new Array();
		tmparray.url = Url;
		tmparray.name = Naam;
		tmparray.text = ImgText;
		tmparray.theWidth = theWidth;
		tmparray.theHeight = theHeight;
		window.maingalleryimages.push(tmparray);
}*/

function domultifilemanager (link){
	
	if (window.elementvar == "galleryimg"){
	for (var iaddfi=0;iaddfi<link.length;iaddfi++)
	{
		window.maingalleryimages.push(addgalimg(link[iaddfi],"",link[iaddfi]))
	}
	updatemaingallery ();
	hidefilemanager();
	}else if (window.elementvar.substr(0,3) == "msg"){
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
				$output .= '	<form action="indexadminnew.php?plugin=photogallery&type=save_Language&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
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

	$result = mysqli_query($link,"SELECT Id, Language FROM gallery WHERE MainId=".$MainId);
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
	$result = mysqli_query($link,"SELECT MainId, Id, LargText, TheDate, Language, ImageDetail, TumbSize, TumbRows, Tumbnailsquare FROM gallery WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$OldId = $row['Id'];
		
		$LargText = $row['LargText'];
		$DatumTijd = $row['TheDate'];
		$MainId = $row['MainId'];
		$Langinputid = $row['Language'];
		$Imagedetails = $row['ImageDetail'];
		$Tumbnailsize = $row['TumbSize'];
		$Tumbnailrows = $row['TumbRows'];
		$Tumbnailsquare = $row['Tumbnailsquare'];
	}

	$LargText= addslashes($LargText);

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
	mysqli_query($link,"INSERT INTO groepen (LastSaved, theDate, Publish, PublishDate, Message, MainId, Language, Naam, Parent, TheOrder, targetmainid, Type) VALUES ('".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$Publish','$PublishDate','$Messagetrue','$MainIdGroup','$newlanguage', '$Naam','$Parent',  '$TheOrder', '$MainId','photogallery')")or ($message = mysqli_error($link));
	mysqli_query($link,"INSERT INTO gallery ( MainId, Language, LargText, TheDate, ImageDetail, TumbSize, TumbRows, Tumbnailsquare) VALUES ( '$MainId', '$newlanguage','$LargText','$DatumTijd','$Imagedetails','$Tumbnailsize','$Tumbnailrows','$Tumbnailsquare')")or  ($message = mysqli_error($link));
	$Id = mysqli_insert_id($link);
	$result2 = mysqli_query($link,"SELECT Id, GalleryId, Theorder, Naam, ImgText, Url FROM galimg WHERE GalleryId=".$OldId." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$GalleryId = $Id;
			$Theorder = $row2['Theorder'];
			$Naam = $row2['Naam'];
			$ImgText = $row2['ImgText'];
			$Url = $row2['Url'];
			$ImgText = addslashes($ImgText);
			mysqli_query($link,"INSERT INTO galimg (GalleryId, Theorder, Naam, ImgText, Url) VALUES ('$GalleryId','$Theorder', '$Naam','$ImgText',  '$Url')")or ($message = mysqli_error($link));
		}


	$Id = mysqli_insert_id($link);
	$_SESSION['Language'] = $newlanguage;
	}
		
	} else {
	$message ='error new language is not set';
	}
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=photogallery&type=select&sectie='.$sectie.'&Id='.$MainIdGroup.'\',\'_self\',\'\',\'true\')", 0);</script>';
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
		
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
	}

	

	$result = mysqli_query($link,"SELECT Id, MainId FROM gallery WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		if ($row['MainId'] == $row['Id']){
			
			$MainId = $row['MainId'];
			$changed = false;
			$result2 = mysqli_query($link,"SELECT Id, MainId FROM gallery WHERE MainId=".$row['MainId'] );
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
				mysqli_query($link,"UPDATE gallery SET MainId = '$MainId' WHERE MainId = '$oldMainId '") or ($message = mysqli_error($link));
				mysqli_query($link,"UPDATE groepen SET targetmainid = '$MainId' WHERE MainId = '$MainIdGroup'") or ($message = mysqli_error($link)); 
			}
		
		} 
	}
	mysqli_query($link,"DELETE FROM groepen  WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainIdGroup  )or ($message = mysqli_error($link));
	mysqli_query($link,"DELETE FROM gallery WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId  )or ($message = mysqli_error($link));
	
	mysqli_query($link,"DELETE FROM galimg WHERE GalleryId = ".$Id )or ($message = mysqli_error($link));
	$message = "";
		
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=photogallery&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
		
		
}else if ($type=="save"){
	$output .= 'Saving...';
	$Id = $_POST["Id"];
	$IdGroup =  intval($_POST["IdGroup"]);
	$Imagedetails = intval($_POST["Imagedetails"]);
	$Tumbnailsize = intval($_POST["Tumbnailsize"]);
	$Tumbnailrows = intval($_POST["Tumbnailrows"]);
	$Tumbnailsquare = intval($_POST["Tumbnailsquare"]);			
	$Naam = $_POST["Naam"]; 
	$language = intval($_POST["language"] );
	$TheDate = $_POST["TheDate"]; 
	$TheTime = $_POST["TheTime"]; 
	$Parent = intval($_POST["parentid"]);
	$SmallText = $_POST["SmallText"]; 
	$LargText = $_POST["LargText"];
	$DatumTijd = $TheDate ." ". $TheTime;
	$Messagetrue = $_POST["Messagetrue"];
	$Publish = $_POST["Publish"];
	$message = "";
	$error = false;
	
	
	
	$LargText= addslashes($LargText);
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
		mysqli_query($link,"INSERT INTO gallery ( MainId, Language, LargText, TheDate, ImageDetail, TumbSize, TumbRows, Tumbnailsquare) VALUES ( '-1', '$language','$LargText','$DatumTijd','$Imagedetails','$Tumbnailsize','$Tumbnailrows','$Tumbnailsquare')")or  ($message = mysqli_error($link));
		$Id = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE gallery SET MainId = '$Id' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"INSERT INTO groepen (Publish,Message, MainId, Naam, TheOrder, Language, Type, Parent, targetmainid, PublishDate, theDate, LastSaved) VALUES ( '$Publish','$Messagetrue', '-1', '$Naam', '$theorder','$language','photogallery','$Parent', '$Id','$DatumTijd', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')")or  ($message = mysqli_error($link));
		$IdGroup = mysqli_insert_id($link);
		mysqli_query($link,"UPDATE groepen SET MainId = '$IdGroup' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE groepen SET LastSaved = '".date("Y-m-d H:i:s")."' , PublishDate = '$DatumTijd', Publish = '$Publish', Message = '$Messagetrue', Naam = '$Naam',Parent = '$Parent' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
		mysqli_query($link,"UPDATE gallery SET LargText = '$LargText', ImageDetail = '$Imagedetails', TumbSize = '$Tumbnailsize', TumbRows = '$Tumbnailrows', Tumbnailsquare = '$Tumbnailsquare' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
	}
	$result = mysqli_query($link,"SELECT MainId FROM groepen WHERE Id=".$IdGroup);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
	}

	// slaat images op
	mysqli_query($link,"DELETE FROM galimg  WHERE GalleryId=".$Id  )or ($message = mysqli_error($link));
	$totalimg = intval($_POST["totalimg"]);

	for ($i=0; $i<$totalimg;$i++){
		$imgtext = $_POST["imgtext".$i];
		$imgname = $_POST["imgname".$i];
		$url = $_POST["filename".$i];

		$imgtext =addslashes($imgtext);
		$imgname = addslashes($imgname);
		$url= addslashes($url);
		$imgtext = str_replace("'", " ", $imgtext);
		$imgname = str_replace("'", " ", $imgname);
		$url = str_replace("'", " ", $url);

		mysqli_query($link,"INSERT INTO galimg ( GalleryId, Theorder, Naam, ImgText, Url) VALUES ( '$Id', '$i','$imgname','$imgtext','$url')")or  ($message = mysqli_error($link));

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
	$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=photogallery&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
}else if($type=="delete"){
$output .=  'Deleting...';
$message = "Information deleted";
$result = mysqli_query($link,"SELECT Id, MainId FROM gallery WHERE MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
// checkt en veranderd de mainid als hij hetzelfde is als de id die verwijderd wordt zo blijft mainid gelinkt aan een id
	while($row = mysqli_fetch_array($result)){
		mysqli_query($link,"DELETE FROM groepentousergroepen WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM groepentousers WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM galimg WHERE GalleryId = ".$row['Id'] )or ($message = mysqli_error($link));
	}
mysqli_query($link,"DELETE FROM gallery WHERE MainId=$MainId")or ($message = mysqli_error($link));
mysqli_query($link,"DELETE FROM groepen WHERE targetmainid=$MainId")or ($message = mysqli_error($link));

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .=  '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=photogallery&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

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
	$result = mysqli_query($link,"SELECT Id, Language FROM gallery WHERE MainId=".$MainId);
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
	
	

	$result = mysqli_query($link,"SELECT Id, LargText, TheDate, ImageDetail, TumbSize, TumbRows,Tumbnailsquare FROM gallery WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		
		$Id = $row['Id'];
		$output .=  "Created: ".date('Y-m-j',$theDate)." Last Modified: ".date('Y-m-j',$LastSaved);
		
		$output .=  '<form action="indexadminnew.php?plugin=photogallery&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0"><input type="hidden" name="IdGroup" value="'.$IdGroup.'" border="0">
		
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="45" border="0" onChange="changeval();"></td></tr>			
		<tr><td>Type</td><td>Photo Gallery</td></tr>
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
		$output .=  '
		<tr><td colspan="2">Rich Text</tr>
		<tr><td colspan="2"><div id="nicEditdiv" name="nicEditdiv"><textarea id="LargText" name="LargText" style="width: 550px; height: 175px;" >'.$row['LargText'].'</textarea></div></td></tr>
		<tr><td>Show Image Details</td><td><select name="Imagedetails" id="Imagedetails" onchange="updatemaingallery ();">
		<option'; if (intval($row["ImageDetail"]) == 1){$output .=  ' selected ';} $output .= ' value="1">true</option>
		<option'; if (intval($row["ImageDetail"]) == 0){$output .=  ' selected ';} $output .= ' value="0">false</option>
		</select></td></tr>
		<tr><td>Tumbnail is a square</td><td><select name="Tumbnailsquare" id="Tumbnailsquare" onchange="updatemaingallery ();">
		<option'; if (intval($row["Tumbnailsquare"]) == 1){$output .=  ' selected ';} $output .= ' value="1">true</option>
		<option'; if (intval($row["Tumbnailsquare"]) == 0){$output .=  ' selected ';} $output .= ' value="0">false</option>
		</select></td></tr>
		<tr><td>Tumbnail size</td><td><input type="text" name="Tumbnailsize" value="'.$row["TumbSize"].'" id="Tumbnailsize" onchange="updatemaingallery ();"></td></tr>
		
		<tr><td colspan="2"><div id="gallerybut"><a href="#" onClick="showfilemanager(\'galleryimg\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="select all"></a><a href="#" onClick="selectallimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a> <a href="#" onClick="deselectallimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="deselect all"></a> <a href="#" onClick="deletemainimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete files"></a></div></td></tr>
		<tr><td colspan="2"><div id="galleryimg">';
	
		$result2 = mysqli_query($link,"SELECT Id, GalleryId, Theorder, Naam, ImgText, Url FROM galimg WHERE GalleryId=".$Id." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			list($theWidth, $theHeight, $asdfthetype, $asdftheattr) = getimagesize($row2["Url"]);
			$output .=  '<script language="javascript">window.maingalleryimages.push(addgalimg(\''.$row2["Naam"].'\',\''.$row2["ImgText"].'\', \''.$row2["Url"].'\', \''.$theWidth.'\', \''.$theHeight.'\'));</script>';
		}
		$output .=  '<script language="javascript">updatemaingallery ();</script>';
		
		$output .= '</div></td></tr>
		<tr><td><div id="buttonlayout"><h4><a href="javascript: submitform()">Save</a></h4></div>
		  </td><td></td></tr></table>
			
		</form>';
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
				$output .=  '<form action="indexadminnew.php?plugin=photogallery&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="45" border="0" onchange="changeval();"></td></tr>	
		<tr><td>Type</td><td>Photo Gallery</td></tr>	
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
			
		$output .=  '
		<tr><td colspan="2">Large text<br><div id="nicEditdiv" name="nicEditdiv"><textarea id="LargText" name="LargText" style="width: 550px; height: 175px;" ></textarea></div></td></tr>';
		$output .=  '<tr><td>Show Image Details</td><td><select name="Imagedetails" id="Imagedetails" onchange="updatemaingallery ();">
		<option value="1">true</option>
		<option value="0">false</option>
		</select></td></tr>
		<tr><td>Tumbnail is a square</td><td><select name="Tumbnailsquare" id="Tumbnailsquare" onchange="updatemaingallery ();">
		<option value="1">true</option>
		<option value="0">false</option>
		</select></td></tr>
		<tr><td>Tumbnail size</td><td><input type="text"  name="Tumbnailsize" value="75" id="Tumbnailsize" onchange="updatemaingallery ();">
		</td></tr>
		
		<tr><td colspan="2"><div id="gallerybut"><a href="#" onClick="showfilemanager(\'galleryimg\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="select all"></a><a href="#" onClick="selectallimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a> <a href="#" onClick="deselectallimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="deselect all"></a> <a href="#" onClick="deletemainimg();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete files"></a></div></td></tr>
		<tr><td colspan="2"><div id="galleryimg">';
	
		
		
		
		$output .= '</div></td></tr>';
		$output .=  '<script language="javascript">updatemaingallery ();</script>';
	$output .=  '<tr><td><div id="buttonlayout"><h4><a href="javascript: submitform()">Save</a></h4></div></td><td></td></tr></table>
			
		</form>
			<script type="text/javascript">bkLib.onDomLoaded(function() { window_onload(); });</script>';
				$output .= '</td></tr></table>';

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


		   
/*$after .= '<div name="directory" id="directory"></div> <div name="parentselector" id="parentselector"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Parent selector</font></b><a href="#" onclick="closeselectparent();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe frameborder="0" width="100%" height="100%" name="filelinker2" id="filelinker2" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$after .= '<div name="directory" id="directory"></div> <div name="filemanager" id="filemanager"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">File Manager</font></b>  <a href="#" onclick="hidefilemanager();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker" id="filelinker" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$after .= '<div name="friends" id="friends"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Friends</font></b>  <a href="#" onclick="closedocumentfriends();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker6" id="filelinker6" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$after .='<div name="usergroupselector" id="usergroupselector"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Parent selector</font></b><a href="#" onclick="closeusergroupselector();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe frameborder="0" width="100%" height="100%" name="filelinker7" id="filelinker7" onload="resizeFrame()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
*/

}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
