<?php


if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){

$output .= '
<script type="text/javascript" src="nicEdit.js"></script>

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
}</script>

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
</script>

<script language="javascript">

window.formelements = new Array();
window.curformelement = -1;
function layerActie(divID) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
   } else {
   
      document.getElementById(divID).style.display="none";
   }
}
function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je deze form wilt verwijderen (vergeet niet eerst de formdata te verwijderen!)?")

if (answer !=0) { 
	location = "indexadminnew.php?plugin=form&type=delete&sectie='.$sectie.'&Id=" + theId 
} 
}

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'indexadminnew.php?plugin=form&type=new_Language&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'indexadminnew.php?plugin=form&type=delete_Language&sectie='.$sectie.'&Id=\'+'.$MainId.',\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'indexadminnew.php?plugin=form&language_id=\'+veld+\'&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\');
	} 
	
 }

function window_onload(){
			
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}

function changeval(){	
	document.forms["form1"]["changed"].value = "true";
}
function submitform2(){

	document.form1.submit();
}



function addslashes(str) {
str=str.replace(/"/g,\'&quot;\');
return str;
}



function submitform(){
	
	document.forms["form1"]["changed"].value = "false";
	txt = "";	
	txt = txt +\'<input type="hidden" name="Numberformelements" value="\'+window.formelements.length+\'" />\';
	for (i=0;i<window.formelements.length;i++)
	{
	
	window.formelements[i].Name = addslashes(window.formelements[i].Name);
	window.formelements[i].theValue = addslashes(window.formelements[i].theValue);
	window.formelements[i].Type = addslashes(window.formelements[i].Type);
	//window.formelements[i].checked = addslashes(window.formelements[i].checked);
	window.formelements[i].text = addslashes(window.formelements[i].text);
	//window.formelements[i].rules = addslashes(window.formelements[i].rules);
	window.formelements[i].errormsg = addslashes(window.formelements[i].errormsg);

	
	txt = txt +\'<input type="hidden" name="formName\'+i+\'" value="\'+window.formelements[i].Name+\'" />\';
	txt = txt +\'<input type="hidden" name="formtheValue\'+i+\'" value="\'+window.formelements[i].theValue+\'" />\';
	txt = txt +\'<input type="hidden" name="formType\'+i+\'" value="\'+window.formelements[i].Type+\'" />\';
	txt = txt +\'<input type="hidden" name="formchecked\'+i+\'" value="\'+window.formelements[i].checked+\'" />\';
	txt = txt +\'<input type="hidden" name="formtext\'+i+\'" value="\'+window.formelements[i].text+\'" />\';
	txt = txt +\'<input type="hidden" name="formrules\'+i+\'" value="\'+window.formelements[i].rules+\'" />\';
	txt = txt +\'<input type="hidden" name="formerrormsg\'+i+\'" value="\'+window.formelements[i].errormsg+\'" />\';
	}	
	
	document.getElementById(\'formelements\').innerHTML = txt;
	document.form1.submit();
}



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

function openformresult(){	
	newpath = \'./plugin%20windows/form/formresult.php?theForm='.$MainId.'\'
	newpathlength = newpath.length
	if ("."+document.getElementById(\'filelinker4\').src.substring(document.getElementById(\'filelinker4\').src.length-newpathlength+1,document.getElementById(\'filelinker4\').src.length) != newpath){
		document.getElementById(\'filelinker4\').src = newpath;		
	}
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'resultform2\').style.display = \'block\';
}

function closeformresult(){
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'resultform2\').style.display = \'none\';
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
function formswitch(element1, element2){
	tmp = window.formelements[element1];
	window.formelements[element1] = window.formelements[element2];
	window.formelements[element2] = tmp;
	updateform ();
}
function selectformitems(){
	totalfiles = parseInt(window.formelements.length);

	for (i=0;i<totalfiles;i++)
	{	
		document.getElementById(\'formelementcheckbox\'+i).checked = true;
		
	}
}

function deselectformitems(){
	totalfiles = parseInt(window.formelements.length);

	for (i=0;i<totalfiles;i++)
	{	
		document.getElementById(\'formelementcheckbox\'+i).checked = false;
		
	}
}
function deleteform(){
	totalfiles = parseInt(window.formelements.length);

	for (i=totalfiles-1;i>-1;i=i-1)
	{	
		if (document.getElementById(\'formelementcheckbox\'+i).checked == true){
			window.formelements.splice(i, 1); 
			
		}
		
	}
	updateform ();
}

function checkform(startpunt){
	alles = false;
	if (typeof startpunt == \'undefined\'){
		alles = true;
		startpunt = window.formelements.length-1;
		
	}
	
	error = false;
	for (i=startpunt;i>-1;i--)
	{
		
		if (window.formelements[i].Type == "nextpage" && startpunt != i && alles != true){
			
			i = -1;
		}else{
			value ="";
			if (window.formelements[i].Type == "radio"){
					value = getCheckedValue(document.getElementsByName(window.formelements[i].Name));
			}else if (window.formelements[i].Type == "checkbox"){
					if (document.getElementById(window.formelements[i].Name).checked == true){
						value = document.getElementById(window.formelements[i].Name).value;
					}else{
						value="";
					}
			}else if(window.formelements[i].Type == "recieveremail"){
					
			}else{
					if (window.formelements[i].Name != ""){
						value = document.getElementById(window.formelements[i].Name).value;
					}
			}
			
			switch(window.formelements[i].rules){
			case "0":
				break;
			case "1":
				
				if (value.length > 0){
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "2":
				
				if (value.length == 10){
					line1 = value.charAt(2);
					line2 = value.charAt(5);
					if (line1 == "-" && line2 == "-"){
						dag = value.substr(0,2);
						maand = value.substr(3,2);
						jaar = value.substr(6,4);
						if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
						}else{
							error = true;
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
						}
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "3":
				
				if (value.length == 8){
					line1 = value.charAt(2);
					line2 = value.charAt(5);
					if (line1 == ":" && line2 == ":"){
						dag = value.substr(0,2);
						maand = value.substr(3,2);
						jaar = value.substr(6,2);
						if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
						}else{
							error = true;
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
						}
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "4":
				
				if (value.length > 0){
					newarray = value.split("@");
					if (newarray.length == 2){
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				
				break;
			case "5":
				
				
				if (value.length > 8){
					http = value.substr(0,4);
					if (http == "http"){
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				
				break;
		}

	}}
	return error;
}
function updateform (){
	txt = "<table>";
	
	for (i=0;i<window.formelements.length;i++)
	{
			
		txt = txt+"<tr><td>";
		if (i==0 && i == window.formelements.length -1){
			txt = txt + \'<input type="checkbox" name="formelementcheckbox\'+i+\'" id="formelementcheckbox\'+i+\'" value="" />\';
		} else if(i==0){
			txt = txt + \'<input type="checkbox" name="formelementcheckbox\'+i+\'" id="formelementcheckbox\'+i+\'" value="" /><a href="#" onClick="formswitch(\\\'\'+i+\'\\\',\\\'\'+(i+1)+\'\\\');return false"><img src="'.$_SESSION['Theme'].'systemicon/down.png"></a>\';
		} else if (i== window.formelements.length -1){
			txt = txt + \'<input type="checkbox" name="formelementcheckbox\'+i+\'" id="formelementcheckbox\'+i+\'" value="" /><a href="#" onClick="formswitch(\\\'\'+i+\'\\\',\\\'\'+(i-1)+\'\\\');return false"><img src="'.$_SESSION['Theme'].'systemicon/up.png"></a>\';
		} else {
			txt = txt + \'<input type="checkbox" name="formelementcheckbox\'+i+\'" id="formelementcheckbox\'+i+\'" value="" /><a href="#" onClick="formswitch(\\\'\'+i+\'\\\',\\\'\'+(i-1)+\'\\\');return false"><img src="'.$_SESSION['Theme'].'systemicon/up.png"></a>\';
			txt = txt + \'<a href="#" onClick="formswitch(\\\'\'+i+\'\\\',\\\'\'+(i+1)+\'\\\');return false"><img src="'.$_SESSION['Theme'].'systemicon/down.png"></a>\';
		}

		switch(window.formelements[i].Type){
		case "richtext":
			txt = txt +\'</td><td colspan="3">\'+ window.formelements[i].text+\'\';
		break;
		case "text":
			txt = txt +\'</td><td>\'+ window.formelements[i].text+\'</td><td> <input type="text" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "hidden":
			txt = txt +\'</td><td>Hidden value:\'+window.formelements[i].Name+\' = </td><td>\'+window.formelements[i].theValue+\' <input type="hidden" name="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" />\';
			break;
		case "radio":
			if (window.formelements[i].checked == true){
				ischecked= "checked";
			}else{
				ischecked= "";
			}
			txt = txt +\'</td><td>\'+ window.formelements[i].text+\'</td><td> <input type="radio" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" \'+ischecked+\' value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "checkbox":
			if (window.formelements[i].checked == true){
				ischecked= "checked";
			}else{
				ischecked= "";
			}
			txt = txt +\'</td><td>\'+ window.formelements[i].text+\'</td><td> <input type="checkbox" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" \'+ischecked+\' value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "textarea":
			txt = txt +\'</td><td colspan="2">\'+ window.formelements[i].text+\'<br><textarea id="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" name="\'+window.formelements[i].Name+\'" style="width: 350px; height: 175px;" >\'+window.formelements[i].theValue+\'</textarea></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div> \';
			break;
		case "recieveremail":
			txt = txt +\'</td><td>Email where the form is send to:\'+window.formelements[i].Name+\' = </td><td>\'+window.formelements[i].theValue+\' <input type="hidden" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td>\';
			break;
		case "nextpage":
			txt = txt +\'</td><td colspan="3"><br><a href="#" onClick="checkform(\'+i+\');return false">\'+ window.formelements[i].text+\'</a><br><hr> \';
			break;
		case "submitbutton":
			txt = txt +\'</td><td colspan="3"><br><a href="#" onClick="checkform();return false">\'+ window.formelements[i].text+\'</a><br> \';
			break;
		case "Vertivicationcode":';
			$_SESSION['SystemImgPas'] = md5( rand(100, 999));
			$output .= '
			txt = txt +\'</td><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr><tr><td></td><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"></td><td>\';
			
			break;
		case "applyeremail":
			txt = txt +\'</td><td>\'+ window.formelements[i].text+\'</td><td> <input type="text" id="\'+window.formelements[i].Name+\'" name="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		}		
		txt = txt+\'</td><td><div id="gallerybut"><a href="#" onClick="formedit(\'+i+\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/rename.png" alt="add"></a></div></td></tr>\';
	}
	txt = txt +\'</table>totalformelements:\'+window.formelements.length;
	document.getElementById(\'formelements\').innerHTML = txt;
}
function addformelement(Name,theValue,Type,checked,text,rules,errormsg,formeditid){
	errormsgb ="";
	error = false;
	
	switch (Type)
		{
		case "applyeremail": 
		case "text":
		case "hidden":
		case "radio":
		case "checkbox":
		case "textarea":
			chars = Name.split(\' \');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are space charachter(s) in the Name";				
			}
			chars = Name.split(\'"\');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are \" charachter(s) in the Name";				
			}
			chars = Name.split(\'\\\'\');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are \' charachter(s) in the Name";				
			}
			chars = Name.split(\'[\');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are [ charachter(s) in the Name";				
			}
			chars = Name.split(\']\');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are ] charachter(s) in the Name";				
			}
			chars = Name.split(\'.\');
			if (chars.length > 1){
				error= true;
				errormsgb = "Error: There are . charachter(s) in the Name";				
			}
			break;
		}

	if (formeditid == -1){
		
		if (Type == "Vertivicationcode"){
			for (i=0;i<window.formelements.length;i++)
			{
				if (window.formelements[i].Type=="Vertivicationcode"){
					error= true;
					errormsgb ="You can only add 1 vertivication code";
				}
			}
		}
		if (error == true){
			alert(errormsgb);
		}else{
			tmparray = new Array();
			tmparray.Name = Name;
			tmparray.theValue = theValue;
			tmparray.Type = Type;
			tmparray.checked = checked;
			tmparray.text = text;
			tmparray.rules = rules;
			tmparray.errormsg = errormsg;
			window.formelements.push(tmparray);
		}
	}else{
		if (error == true){
			alert(errormsgb);
		}else{
			window.formelements[formeditid].Name = Name;
			window.formelements[formeditid].theValue = theValue;
			window.formelements[formeditid].Type = Type;
			window.formelements[formeditid].checked = checked;
			window.formelements[formeditid].text = text;
			window.formelements[formeditid].rules = rules;
			window.formelements[formeditid].errormsg = errormsg;
		}
	}
	return error;
}

function formedit(Num){
	window.formeditid=-1;
	
	document.getElementById("richtextb").value = "";
		
	document.getElementById("textName").value = "";		
	document.getElementById("texttheValue").value = "";
	document.getElementById("texttext").value = "";
	setCheckedValue(document.getElementsByName("textrule"), 0)	
	document.getElementById("texterrormsg").value = "";
		
	document.getElementById("hiddenName").value = "";		
	document.getElementById("hiddentheValue").value = "";		
	document.getElementById("radioName").value = "";		
	document.getElementById("radiochecked").value = "";	
	document.getElementById("radiochecked").checked = false;	
	document.getElementById("radiotheValue").value = "";		
	document.getElementById("radiotext").value = "";
	setCheckedValue(document.getElementsByName("radiorule"), 0)	
	document.getElementById("radioerrormsg").value = "";
			
	document.getElementById("checkboxName").value = "";		
	document.getElementById("checkboxchecked").value = "";	
	document.getElementById("checkboxchecked").checked = false;	
	document.getElementById("checkboxtheValue").value = "";		
	document.getElementById("checkboxtext").value = "";
	setCheckedValue(document.getElementsByName("checkboxrule"), 0)	
	document.getElementById("checkboxerrormsg").value = "";
		
	document.getElementById("textareaName").value = "";		
	document.getElementById("textareatheValue").value = "";		
	document.getElementById("textareatext").value = "";
	setCheckedValue(document.getElementsByName("textarearule"), 0)	
	document.getElementById("textareaerrormsg").value = "";
		
	document.getElementById("recieveremailName").value = "";		
	document.getElementById("recieveremailtheValue").value = "";
		
	document.getElementById("buttonnaam").value = "";
		
	document.getElementById("subbuttonnaam").value = "";

	document.getElementById("applyeremailtext").value= "";
	document.getElementById("applyeremailtheValue").value= "";
	document.getElementById("applyeremailName").value= "";
	setCheckedValue(document.getElementsByName("applyeremailrule"), 0)	
	document.getElementById("applyeremailerrormsg").value = "";
	
	
	if (typeof Num != \'undefined\'){
	
	window.formeditid = Num;
	document.forms["theformedit"]["typeform"].value = window.formelements[Num].Type
	switch (window.formelements[Num].Type)
	{
	case "richtext":
		document.getElementById("richtextb").value = window.formelements[Num].text;
		break;
	case "text":
		document.getElementById("textName").value=window.formelements[Num].Name;
		document.getElementById("texttheValue").value=window.formelements[Num].theValue;
		document.getElementById("texttext").value = window.formelements[Num].text;
		setCheckedValue(document.getElementsByName("textrule"), window.formelements[Num].rules)	
		document.getElementById("texterrormsg").value = window.formelements[Num].errormsg;
		break;
	case "hidden":
		document.getElementById("hiddenName").value=window.formelements[Num].Name;
		document.getElementById("hiddentheValue").value=window.formelements[Num].theValue;
		break;
	case "radio":
		document.getElementById("radioName").value=window.formelements[Num].Name;
		document.getElementById("radiotheValue").value=window.formelements[Num].theValue;
		if (window.formelements[Num].checked == 1){
			document.getElementById("radiochecked").checked= true;
		}else{
			document.getElementById("radiochecked").checked= false;
		}
		document.getElementById("radiotext").value=window.formelements[Num].text;
		setCheckedValue(document.getElementsByName("radiorule"), window.formelements[Num].rules)	
		document.getElementById("radioerrormsg").value = window.formelements[Num].errormsg;
		break;
	case "checkbox":
		document.getElementById("checkboxName").value=window.formelements[Num].Name;
		document.getElementById("checkboxtheValue").value=window.formelements[Num].theValue;
		if (window.formelements[Num].checked == 1){
			document.getElementById("checkboxchecked").checked=true;
		}else{
			document.getElementById("checkboxchecked").checked=false;
		}
		document.getElementById("checkboxtext").value=window.formelements[Num].text;
		setCheckedValue(document.getElementsByName("checkboxrule"), window.formelements[Num].rules)	
		document.getElementById("checkboxerrormsg").value = window.formelements[Num].errormsg;
		break;
	case "textarea":
		document.getElementById("textareaName").value=window.formelements[Num].Name;
		document.getElementById("textareatheValue").value=window.formelements[Num].theValue;
		document.getElementById("textareatext").value=window.formelements[Num].text;
		setCheckedValue(document.getElementsByName("textarearule"), window.formelements[Num].rules)	
		document.getElementById("textareaerrormsg").value = window.formelements[Num].errormsg;
		break;
	case "recieveremail":
		document.getElementById("recieveremailName").value=window.formelements[Num].Name;
		document.getElementById("recieveremailtheValue").value=window.formelements[Num].theValue;
		break;
	case "nextpage":
		document.getElementById("buttonnaam").value=window.formelements[Num].text;
		break;
	case "submitbutton":
		document.getElementById("subbuttonnaam").value=window.formelements[Num].text;
		break;
	case "applyeremail":
		document.getElementById("applyeremailName").value=window.formelements[Num].Name;
		theValue= document.getElementById("applyeremailtheValue").value=window.formelements[Num].theValue;
		text= document.getElementById("applyeremailtext").value = window.formelements[Num].text;
		setCheckedValue(document.getElementsByName("applyeremailrule"), window.formelements[Num].rules)	
		document.getElementById("applyeremailerrormsg").value = window.formelements[Num].errormsg;
		break;
	}
	
	}
	
	myNicEditor2 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'richtextb\');
	
	updateformedit();
	
	document.getElementById(\'editform\').style.display = \'block\';
}
function closeeditform(){
	myNicEditor2.removeInstance(\'richtextb\');
	document.getElementById(\'editform\').style.display = \'none\';
}
</script>';



if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td> </td>
			</tr>
			<tr>
				
				<td>';
				$output .='	<form action="indexadminnew.php?plugin=form&type=save_Language&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on">
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
		//$MainId = $row['targetmainid'];
	}

	$result = mysqli_query($link,"SELECT Id, Language FROM groepen WHERE MainId=".$MainId);
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
	$IdGroupnew = mysqli_insert_id($link);
	$i = 0;
	$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
		$Name = $row2["Name"];
		$theValue = $row2["theValue"];
		$Type = $row2["Type"];
		$checked = $row2["checked"];
		$text = $row2["text"];
		$formrules = $row2["formrules"];
		$errormsg = $row2["errormsg"];
		
		$Name =addslashes($Name);
		$theValue =addslashes($theValue);
		$Type =addslashes($Type);
		$checked = intval($checked);
		$text =addslashes($text);
		$formrules = intval($formrules);
		$errormsg =addslashes($errormsg);
		
		mysqli_query($link,"INSERT INTO formfield ( FormId, Theorder, Name, theValue, Type, checked, text, formrules, errormsg) VALUES ( '$IdGroupnew', '$i','$Name','$theValue','$Type','$checked','$text','$formrules','$errormsg')")or  ($message = mysqli_error($link));
		$i++;
		}

	$_SESSION['Language'] = $newlanguage;
	}
	
	} else {
	$message = 'error new language is not set';
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=form&type=select&sectie='.$sectie.'&Id='.$MainIdGroup.'\',\'_self\',\'\',\'true\')", 0);</script>';
} else if ($type=="delete_Language"){	
	
	$result = mysqli_query($link,"SELECT Id, MainId, targetmainid FROM groepen WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainId );
		if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$IdGroup = $row['Id'];
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

	

	
	mysqli_query($link,"DELETE FROM groepen  WHERE Language = ".$_SESSION['Language']." AND MainId=".$MainIdGroup  )or ($message = mysqli_error($link));
	mysqli_query($link,"DELETE FROM formfield  WHERE FormId=".$IdGroup  )or ($message = mysqli_error($link));
	$message = "";
		
		if ($message == ""){	
		$message ="Language deleted";
		
		}
array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=form&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';
		
		
}else if ($type=="save"){
	$Id = $_POST["Id"];
	$IdGroup =  intval($_POST["IdGroup"]);
	$Publish =  $_POST["Publish"];
	$Naam = $_POST["Naam"]; 
	$language = intval($_POST["language"] );
	$TheDate = $_POST["TheDate"]; 
	$TheTime = $_POST["TheTime"]; 
	$Parent = intval($_POST["parentid"]);
	$DatumTijd = $TheDate ." ". $TheTime;
	
	
	$message = "";
	$error = false;
	
	
	
	$LargText= addslashes($LargText);
		
	$DatumTijd = str_replace("\\", "\\\\", $DatumTijd);
	$DatumTijd = str_replace("'", " ", $DatumTijd);
	$DatumTijd = str_replace("\"", " ", $DatumTijd);
	$Id = str_replace("\\", "\\\\", $Id);
	$Id = str_replace("'", " ", $Id);
	$Id = str_replace("\"", " ", $Id);
	$Naam = str_replace("\\", "\\\\", $Naam);
	$Naam = str_replace("'", " ", $Naam);
	$Naam = str_replace("\"", " ", $Naam);
	$Ordering = str_replace("\\", "\\\\", $Ordering);
	$Ordering = str_replace("'", " ", $Ordering);
	$Ordering = str_replace("\"", " ", $Ordering);	
	$language = str_replace("\\", "\\\\", $language);
	$language = str_replace("'", " ", $language);
	$language = str_replace("\"", " ", $language);
	$Publish = str_replace("\\", "\\\\", $Publish);
	$Publish = str_replace("'", " ", $Publish);
	$Publish = str_replace("\"", " ", $Publish);

	if ($Id != 'new'){
	$result = mysqli_query($link,"SELECT MainId, Parent FROM groepen WHERE Id=$Id AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		if (intval($row["MainId"])==$Parent){
			$Parent = $row["Parent"];
		}
		
	}}

	$result = mysqli_query($link,"SELECT TheOrder FROM groepen ORDER BY TheOrder LIMIT 0,1");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theorder= intval($row["TheOrder"]) -1 ;	
	}	
			
	if ($Id == "new"){
		mysqli_query($link,"INSERT INTO groepen (theDate, LastSaved, PublishDate, Publish, MainId, Naam, TheOrder, Language, Type, Parent, targetmainid) VALUES ( '".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$DatumTijd','$Publish', '-1', '$Naam', '$theorder','$language','form','$Parent', '$Id')")or  ($message = mysqli_error($link));
		$IdGroup = mysqli_insert_id($link);
		$Id = $IdGroup;
		mysqli_query($link,"UPDATE groepen SET MainId = '$IdGroup' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
	}else{
		mysqli_query($link,"UPDATE groepen SET Message = '$Messagetrue', Naam = '$Naam', Parent = '$Parent', LastSaved = '".date("Y-m-d H:i:s")."', PublishDate = '$DatumTijd', Publish = '$Publish' WHERE Id = '$IdGroup'") or ($message = mysqli_error($link)); 
	}
	$result = mysqli_query($link,"SELECT MainId FROM groepen WHERE Id=".$IdGroup);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		$MainId = $row['MainId'];
	}
	mysqli_query($link,"DELETE FROM formfield  WHERE FormId=".$IdGroup  )or ($message = mysqli_error($link));
	$totalformfield = intval($_POST["Numberformelements"]);

	for ($i=0; $i<$totalformfield;$i++){
		$Name = $_POST["formName".$i];
		$theValue = $_POST["formtheValue".$i];
		$Type = $_POST["formType".$i];
		$checked = $_POST["formchecked".$i];
		$text = $_POST["formtext".$i];
		$formrules = $_POST["formrules".$i];
		$errormsg = $_POST["formerrormsg".$i];
		
		$Name =addslashes($Name);
		$theValue =addslashes($theValue);
		$Type =addslashes($Type);
		$checked = intval($checked);
		$text =addslashes($text);
		$formrules = intval($formrules);
		$errormsg =addslashes($errormsg);
		
		mysqli_query($link,"INSERT INTO formfield ( FormId, Theorder, Name, theValue, Type, checked, text, formrules, errormsg) VALUES ( '$IdGroup', '$i','$Name','$theValue','$Type','$checked','$text','$formrules','$errormsg')")or  ($message = mysqli_error($link));

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
		$message="form saved";
	}else{
		$error = true;
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=form&type=select&sectie='.$sectie.'&Id='.$MainId.'\',\'_self\',\'\',\'true\')", 0);</script>';
}else if($type=="delete"){
$message = "Information deleted";

$result = mysqli_query($link,"SELECT Id FROM groepen WHERE MainId=".$MainId);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){;
		$IdGroup = $row['Id'];
		//mysqli_query($link,"DELETE FROM formapplayment WHERE theGroup=".$MainId  )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM groepentousers WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM groepentousergroepen WHERE GroepenMainId=".$MainId."" )or ($message = mysqli_error($link));
		mysqli_query($link,"DELETE FROM formfield  WHERE FormId=".$IdGroup  )or ($message = mysqli_error($link));
		
	}
	mysqli_query($link,"DELETE FROM groepen  WHERE MainId=".$MainId  )or ($message = mysqli_error($link));

array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
$output .= '<script type="text/javascript">setTimeout("window.open(\'indexadminnew.php?plugin=form&sectie='.$sectie.'\',\'_self\',\'\',\'true\')", 0);</script>';

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
		$output .= "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		$output .= "De string ($str) is niet geldig";
		} 
		$Publish = $row['Publish'];
	}
	
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false;

$result = mysqli_query($link,"SELECT Naam, Parent, Id, targetmainid, Language FROM groepen WHERE MainId=".$MainIdGroup);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	 

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
	
	if ($found == true){
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
	$output .= '</select></td><td>';$output .=include "./system/newitem.php";$output .= '</td><td><div id="buttonlayout"><h4><a href="#" onclick=" ConfirmDelete('.$MainIdGroup.'); return false;">Delete</a></h4>
          </div></td><td><div id="buttonlayout"><h4><a href="#" onclick="openformresult(); return false;">View result</a></h4></div></td></tr></table>
				</td>
				
			</tr>
			<tr>
				
				<td>';
	$output .= "Created: ".date('Y-m-j',$theDate)." Last Modified: ".date('Y-m-j',$LastSaved);
	$output .= '<form action="indexadminnew.php?plugin=form&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">';
	
	$output .='<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0"><input type="hidden" name="IdGroup" value="'.$IdGroup.'" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="'.$Naam.'" size="45" border="0" onChange="changeval();"></td></tr>	
				
		<tr><td>Type</td><td>Form</td></tr>		
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
		

	
		
		$output .= '<tr><td colspan="2"><div id="gallerybut"><a href="#" onClick="formedit();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> <a href="#" onClick="deleteform();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete files"></a><a href="#" onClick="selectformitems(\'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a><a href="#" onClick="deselectformitems(\'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="select all"></a></div></td></tr>';
		$output .= '<tr><td colspan="2"><div id="formelements">';
	
		
		
		
		$output .='</div></td></tr>';
		$output .= '<script language="javascript">';
$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$output .= 'addformelement(\''.str_replace("'", "\'", $row2["Name"]).'\',\''.str_replace("'", "\'", $row2["theValue"]).'\',\''.str_replace("'", "\'", $row2["Type"]).'\',\''.str_replace("'", "\'", $row2["checked"]).'\',\''.str_replace("'", "\'", $row2["text"]).'\',\''.str_replace("'", "\'", $row2["formrules"]).'\',\''.str_replace("'", "\'", $row2["errormsg"]).'\',-1);';
		}
		

		$output .='updateform ();</script>';
		$output .= '<script language="javascript">	
			
			changepublissettings();	
			
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
			$output .= '
			updateaccesgroup (); updateaccesmembers();
		
			</script>';
	
		$output .='
		<tr><td><div id="buttonlayout">
            <h4><a href="javascript: submitform()">Save</a></h4>
          </div></td><td></td></tr></table>
			
		</form>';

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
				$output .= '<form action="indexadminnew.php?plugin=form&type=save&sectie='.$sectie.'" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Naam</td><td><input type="text" name="Naam" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Type</td><td>Form</td></tr>
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
			$output .= '
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
		$output .= '</select></td></tr>';
		$output .= '<tr><td>Parent</td><td><input type="hidden" name="parentid" id="parentid" value="'.$sectie.'"><div id="parenttext"></div><input type = "button" value = "Select Parent" onclick="openselectparent(\'parentid\',\'parenttext\');return false" />';
		$output .= '<tr><td colspan="2"><div id="gallerybut"><a href="#" onClick="formedit();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> <a href="#" onClick="deleteform();return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete files"></a><a href="#" onClick="selectformitems(\'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a><a href="#" onClick="deselectformitems(\'\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="select all"></a></div></td></tr>';
		$output .= '<tr><td colspan="2"><div id="formelements">';
	
		
		
		
		$output .='</div></td></tr>';
		$output .= '<script language="javascript">updateform ();</script>';
		$output .='</td></tr></table>';
				$output .='<div id="buttonlayout">
            <h4><a href="javascript: submitform()">Save</a></h4>
          </div>
			
		</form>';
			
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

$after .= '<div name="directory" id="directory"></div> <div name="editform" id="editform" ><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Form element editor</font></b><a href="#" onclick="closeeditform();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td>
		<form name="theformedit" id="theformedit" style="overflow:scroll; top:0px; bottom:0px;"><table>
		<tr><td>Type</td><td><select name="typeform" id="typeform" onchange=updateformedit()>
		<option value="richtext">Richt Text</option>
		<option value="text">Text</option>
		<option value="hidden">Hidden</option>
		<option value="radio">Radio button</option>
		<option value="checkbox">Checkbox</option>
		<option value="textarea">Text Area</option>
		<option value="nextpage">Next Page</option>
		<option value="recieveremail">email where a copy of the form is send to</option>
		<option value="applyeremail">email where a copy of the form is send to for applyer</option>
		<option value="Vertivicationcode">Vertivicationcode to prevent a computer apply to the form</option>
		<option value="submitbutton">Submit button to submit the form into the database</option>';
//		<option value="valuecheck">Check the form for a value in past form</option>
//		<option value="dropdownlist">text area</option>	
$after .=  '		</select></td></tr></table>
		<div id="richtext"><table>
		<tr><td>richtext</td><td><textarea id="richtextb" name="richtextb" style="width: 750px; height: 175px;" ></textarea></td></tr>
		</table></div>
		<div id="textoption"><table>
		<tr><td>Naam</td><td><input type="text" id="textName" name="textName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Default value</td><td><input type="text" id="texttheValue" name="texttheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>text</td><td><input type="text" id="texttext" name="texttext" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2"><b>Rules</b></td><td></td></tr>
		<tr><td>No rules</td><td><input type="radio" id="textrulenorule" name="textrule" checked value="0" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a value</td><td><input type="radio" id="textrulevalue" name="textrule" value="1" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a date dd-mm-yyyy</td><td><input type="radio" id="textruledate" name="textrule" value="2" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a time hh:mm:ss</td><td><input type="radio" id="textruletime" name="textrule" value="3" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a email</td><td><input type="radio" id="textruleemail" name="textrule" value="4" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a website</td><td><input type="radio" id="textrulewebsite" name="textrule" value="5" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message</td><td><input type="text" id="texterrormsg" name="texterrormsg" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="hiddenoption"><table>
		<tr><td>Naam</td><td><input type="text" id="hiddenName" name="hiddenName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Value</td><td><input type="text" id="hiddentheValue" name="hiddentheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="radiodoption"><table>
		<tr><td>Naam</td><td><input type="text" id="radioName" name="radioName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>checked</td><td><input type="checkbox" id="radiochecked" name="radiochecked" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Value</td><td><input type="text" id="radiotheValue" name="radiotheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>text</td><td><input type="text" id="radiotext" name="radiotext" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2"><b>Rules</b></td><td></td></tr>
		<tr><td>No rules</td><td><input type="radio" id="radiorulenorule" name="radiorule" checked value="0" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a value</td><td><input type="radio" id="radiorulevalue" name="radiorule" value="1" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message</td><td><input type="text" id="radioerrormsg" name="radioerrormsg" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="checkboxdoption"><table>
		<tr><td>Naam</td><td><input type="text" id="checkboxName" name="checkboxName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>checked</td><td><input type="checkbox" id="checkboxchecked" name="checkboxchecked" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Value</td><td><input type="text" id="checkboxtheValue" name="checkboxtheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>text</td><td><input type="text" id="checkboxtext" name="checkboxtext" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2"><b>Rules</b></td><td></td></tr>
		<tr><td>No rules</td><td><input type="radio" id="checkboxrulenorule" name="checkboxrule" checked value="0" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a value</td><td><input type="radio" id="checkboxrulevalue" name="checkboxrule" value="1" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message</td><td><input type="text" id="checkboxerrormsg" name="checkboxerrormsg" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="textareadoption"><table>
		<tr><td>Naam</td><td><input type="text" id="textareaName" name="textareaName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Default value</td><td><input type="text" id="textareatheValue" name="textareatheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>text</td><td><input type="text" id="textareatext" name="textareatext" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2"><b>Rules</b></td><td></td></tr>
		<tr><td>No rules</td><td><input type="radio" id="textarearulenorule" name="textarearule" checked value="0" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a value</td><td><input type="radio" id="textarearulevalue" name="textarearule" value="1" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message</td><td><input type="text" id="textareaerrormsg" name="textareaerrormsg" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="recieveremailoption"><table>
		<tr><td>Naam</td><td><input type="text" id="recieveremailName" name="recieveremailName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>E mail</td><td><input type="text" id="recieveremailtheValue" name="recieveremailtheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="applyeremailoption"><table>
		<tr><td>Naam</td><td><input type="text" id="applyeremailName" name="applyeremailName" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>E mail</td><td><input type="text" id="applyeremailtheValue" name="applyeremailtheValue" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>text</td><td><input type="text" id="applyeremailtext" name="applyeremailtext" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2"><b>Rules</b></td><td></td></tr>
		<tr><td>No rules</td><td><input type="radio" id="applyeremailrulenorule" name="applyeremailrule" checked value="0" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Must have a email</td><td><input type="radio" id="applyeremailruleemail" name="applyeremailrule" value="4" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td>Error message</td><td><input type="text" id="applyeremailerrormsg" name="applyeremailerrormsg" value="" size="50" border="0" onchange="changeval();"></td></tr>
		</table></div>
		<div id="Vertivicationcodeoption">
		Adds a vertivication code to the form...
		</div>
		<div id="nextpage"><table>
		<tr><td>text</td><td><input type="text" id="buttonnaam" name="buttonnaam" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2">Add a page to the form</td><td>
		</table></div>
		<div id="submitbutton"><table>
		<tr><td>text</td><td><input type="text" id="subbuttonnaam" name="subbuttonnaam" value="" size="50" border="0" onchange="changeval();"></td></tr>
		<tr><td colspan="2">Submit the form into the database</td><td>
		</table></div>
		<a href="#" onClick="addthisformelement();return false"><h4>Save</h4></a>
</form></table></div>
<script language="javascript">
function updateformedit(){
		
	
	
		document.getElementById("richtext").style.display="none";
		document.getElementById("nextpage").style.display="none";
		document.getElementById("textoption").style.display="none";
		document.getElementById("hiddenoption").style.display="none";
		document.getElementById("radiodoption").style.display="none";
		document.getElementById("checkboxdoption").style.display="none";
		document.getElementById("textareadoption").style.display="none";
		document.getElementById("recieveremailoption").style.display="none";
		document.getElementById("submitbutton").style.display="none";
		document.getElementById("Vertivicationcodeoption").style.display="none";
		document.getElementById("applyeremailoption").style.display="none";
	
	switch (document.forms["theformedit"]["typeform"].value)
	{
	case "Vertivicationcode":
		document.getElementById("Vertivicationcodeoption").style.display="block";
		break;
	case "applyeremail":
		document.getElementById("applyeremailoption").style.display="block";
		break;
	case "richtext":
		document.getElementById("richtext").style.display="block";
		break;
	case "text":
		document.getElementById("textoption").style.display="block";
		break;
	case "hidden":
		document.getElementById("hiddenoption").style.display="block";
		break;
	case "radio":
		document.getElementById("radiodoption").style.display="block";
		break;
	case "checkbox":
		document.getElementById("checkboxdoption").style.display="block";
		break;
	case "textarea":
		document.getElementById("textareadoption").style.display="block";
		break;
	case "recieveremail":
		document.getElementById("recieveremailoption").style.display="block";
		break;
	case "nextpage":
		document.getElementById("nextpage").style.display="block";
		break;
	case "submitbutton":
		document.getElementById("submitbutton").style.display="block";
		break;
	}
}
function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function setCheckedValue(radioObj, newValue) {
	if(!radioObj)
		return;
	var radioLength = radioObj.length;
	if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}

function addthisformelement(){	
	changeval();
	Type= document.forms["theformedit"]["typeform"].value;
	myNicEditor2.removeInstance(\'richtextb\');
	Name = "";
	theValue= "";
	ischecked= 0;
	text= "";
	rules="0";
	errormsg="";

	switch (Type)
	{
	case "Vertivicationcode":
		break;
	case "applyeremail":
		Name = document.getElementById("applyeremailName").value;
		theValue= document.getElementById("applyeremailtheValue").value;
		text= document.getElementById("applyeremailtext").value;
		rules=getCheckedValue(document.getElementsByName("applyeremailrule"));
		errormsg=document.getElementById("applyeremailerrormsg").value;
		break;
	case "richtext":
		
		text= document.getElementById("richtextb").value;
		break;
	case "text":
		Name = document.getElementById("textName").value;
		theValue= document.getElementById("texttheValue").value;
		text= document.getElementById("texttext").value;
		rules=getCheckedValue(document.getElementsByName("textrule"));
		errormsg=document.getElementById("texterrormsg").value;
		break;
	case "hidden":
		Name = document.getElementById("hiddenName").value;
		theValue= document.getElementById("hiddentheValue").value;
		break;
	case "radio":
		Name = document.getElementById("radioName").value;
		theValue= document.getElementById("radiotheValue").value;
		if (document.getElementById("radiochecked").checked == true){
			ischecked= 1;
		}else{
			ischecked= 0;
		}
		text= document.getElementById("radiotext").value;
		rules=getCheckedValue(document.getElementsByName("radiorule"));
		errormsg=document.getElementById("radioerrormsg").value;
		break;
	case "checkbox":
		Name = document.getElementById("checkboxName").value;
		theValue= document.getElementById("checkboxtheValue").value;
		if (document.getElementById("checkboxchecked").checked == true){
			ischecked= 1;
		}else{
			ischecked= 0;
		}
		text= document.getElementById("checkboxtext").value;
		rules=getCheckedValue(document.getElementsByName("checkboxrule"));
		errormsg=document.getElementById("checkboxerrormsg").value;
		break;
	case "textarea":
		Name = document.getElementById("textareaName").value;
		theValue= document.getElementById("textareatheValue").value;
		text= document.getElementById("textareatext").value;
		rules=getCheckedValue(document.getElementsByName("textarearule"));
		errormsg=document.getElementById("textareaerrormsg").value;
		break;
	case "recieveremail":
		Name = document.getElementById("recieveremailName").value;
		theValue= document.getElementById("recieveremailtheValue").value;
		break;
	case "nextpage":
		text= document.getElementById("buttonnaam").value;
		break;
	case "submitbutton":
		text= document.getElementById("subbuttonnaam").value;
		break;
	}
	
	error = addformelement(Name,theValue,Type,ischecked,text,rules,errormsg,window.formeditid);
	if (error == false){
		closeeditform();
	}
	updateform ();
	
}

updateformedit();

</script>

';
$after .=  '<div name="resultform2" id="resultform2" style="display:none;"><div name="subwindows" id="subwindows"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Form Result</font></b>  <a href="#" onclick="closeformresult();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker4" id="filelinker4" onload="resizeFrame()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div></div>';

}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
