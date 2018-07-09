<?php
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){

$type = $_GET["type"]; 
$selectId = intval($_GET["Id"]);
$output .= '

<script language="javascript">
window.userlist = new Array();

themeurl = "'.$_SESSION['Theme'].'";
imgdetail = 0;



function addfriendlist(Id, Username,Profilepic){
		tmparray = new Array();
		tmparray.Id = Id;
		tmparray.Username = Username;
		tmparray.Profilepic = Profilepic;
		window.userlist[Id] = tmparray;
		
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
	
	if (window.elementvar == "Profile"){
		updatefaveico();
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

/*
function resizeframe(){		
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
     	 realWidth = parseInt(realWidth) - 70;
	 realHeight =  parseInt(realHeight) - 120;
       	document.getElementById("filelinker").style.height = realHeight + \'px\';
     	document.getElementById("filelinker").style.width = realWidth + \'px\';
		document.getElementById("filelinker3").style.height = realHeight + \'px\';
     	document.getElementById("filelinker3").style.width = realWidth + \'px\';
		
		//galleryimg
		
 	if (window.curgalleryimg != -1){
		var d= document, root= d.documentElement, body= d.body;
		var realWidth= window.scrollWidth || root.clientWidth || body.clientWidth, 
		realHeight= window.scrollHeight || root.clientHeight || body.clientHeight ;

	
	
     	 realWidth = parseInt(realWidth) ;
		realHeight =  parseInt(realHeight) ;
	
	currW = parseInt(window.galleryimages[window.curgalleryimg].theWidth);
	currH = parseInt(window.galleryimages[window.curgalleryimg].theHeight);
    	maxW = parseInt(realWidth) ;
		maxH =  parseInt(realHeight) ;
	
	
	var ratio ;
	ratio = currW/ currH;
	maxratio = maxW / maxH;
	if(currW > maxW && ratio > maxratio){
		var percent1 = (maxW / currW) ;
		
	}  else if(currH > maxH){
		var percent1 = (maxH / currH) ;
	} else {
		var percent1 = 1 ;
	}

	if (currH < 150){currH = 100}
	if (currW < 150){currW = 100}
	document.getElementById("editimg").style.top = parseInt((realHeight - (currH * percent1)) /2)+ \'px\';
	document.getElementById("editimg").style.bottom = parseInt((realHeight - (currH * percent1)) /2)+ \'px\';
	document.getElementById("editimg").style.left = parseInt((realWidth - (currW * percent1)) /2)+ \'px\';
	document.getElementById("editimg").style.right = parseInt((realWidth - (currW * percent1)) /2)+ \'px\';
	
	
	document.getElementById(\'imgshower\').width =  window.galleryimages[window.curgalleryimg].theWidth * percent1;
	document.getElementById(\'imgshower\').height =  window.galleryimages[window.curgalleryimg].theHeight * percent1;
	
	clearTimeout(window.mousemovetimeout);
	fadeingallerybuttons();
	window.mousemovetimeout = setTimeout(function(){fadeoutgallerybuttons()}, 3000);
	}
}*/

function updatefaveico(){
		document.getElementById(\'faveico\').src = "./system/imgtumb.php?url="+document.getElementById(\'Profile\').value+"&maxsize=100&square=1"; 
}
	
function ConfirmDelete (theId){
answer = confirm("Weet je zeker dat je deze Gebruiker wilt verwijderen. U kunt dan niet meer inloggen")

if (answer !=0) { 
	location = "indexstandalone.php?plugin=Users&type=delete&Id="+ theId ;
} 
}

function dofriends(Id, type){
	document.getElementById(window.parentselectorid).value = Id;
	document.getElementById(window.parentselectortext).innerHTML = text;
	closefriends();
}
function openfriends (type){
	';
	if ($type == "Groupmembers"){
		$output .= 'newpath = \'./plugin windows/friends/Friends.php?stat=Groupmembers&groupid='.$selectId.'\';';
	}else{
		$output .= 'newpath = \'./plugin windows/friends/Friends.php\';';
	}
	
	$output .= '
		
	if (document.getElementById(\'filelinker3\').src.substring(document.getElementById(\'filelinker3\').src.length-10,document.getElementById(\'filelinker3\').src.length) == "blank.html"){
		document.getElementById(\'filelinker3\').src = newpath;
	}
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'friends\').style.display = \'block\';
	window.friendtype = type;
	
}

function closefriends (){
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'friends\').style.display = \'none\';
}

function updatefriendviewlist(Friendid)
{
	ii = 0;
	params = "command=bogus=bogus&" ;
	ii++;
	params = params + "&Acount="+Friendid;
	var xmlhttpfriendlist;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpfriendlist=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpfriendlist=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpfriendlist.onreadystatechange=function()
  	{
		if (xmlhttpfriendlist.readyState==4 && xmlhttpfriendlist.status==200)
   		{		
				
			txt = "";			
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("friendlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br>\'+window.userlist[x[i].firstChild.nodeValue].Username+\'</center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			if (txt == ""){txt = "No friends"}
			document.getElementById(\'friendresult\').innerHTML = txt;
			parent.refreshingmessage();
		}
		
		
	 }
	
	xmlhttpfriendlist.open("POST","./pluginstandalone/Users/friendslist.php");
	xmlhttpfriendlist.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpfriendlist.setRequestHeader("Content-length", params.length);
	xmlhttpfriendlist.setRequestHeader("Connection", "close");
	xmlhttpfriendlist.send(params);
}
function updatefriendlist(Friendid)
{
	ii = 0;
	params = "command=bogus=bogus&" ;
	ii++;
	params = params + "&Acount="+Friendid;
	var xmlhttpfriendlist;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpfriendlist=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpfriendlist=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpfriendlist.onreadystatechange=function()
  	{
		if (xmlhttpfriendlist.readyState==4 && xmlhttpfriendlist.status==200)
   		{		
			
			txt = "";			
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("friendlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br>\'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
					
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'friendresult\').innerHTML = txt;
						
			txt = "";
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("pendinglist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br> \'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'pendingresult\').innerHTML = txt;
						
			txt = "";
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("requestlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br> \'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><a href="#" onClick="dothefriend(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Friend\\\');return false"><div id="gallerybut"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a><a href="#" onClick="dothefriend(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'requestresult\').innerHTML = txt;
						
			txt = "";
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("blockedlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br> \'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'blockedresult\').innerHTML = txt;
			parent.refreshingmessage();
		}
		
		
	 }
	
	xmlhttpfriendlist.open("POST","./pluginstandalone/Users/friendslist.php");
	xmlhttpfriendlist.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpfriendlist.setRequestHeader("Content-length", params.length);
	xmlhttpfriendlist.setRequestHeader("Connection", "close");
	xmlhttpfriendlist.send(params);
	
}
function updategroupmembersviewlist(Friendid)
{
	ii = 0;
	params = "command=bogus=bogus&" ;
	ii++;
	params = params + "&Acount="+Friendid;
	var xmlhttpfriendlist;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpfriendlist=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpfriendlist=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpfriendlist.onreadystatechange=function()
  	{
		if (xmlhttpfriendlist.readyState==4 && xmlhttpfriendlist.status==200)
   		{		
				
			txt = "";			
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("friendlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br>\'+window.userlist[x[i].firstChild.nodeValue].Username+\'</center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			if (txt == ""){txt = "No members"}
			document.getElementById(\'groupmembersresult\').innerHTML = txt;
			parent.refreshingmessage();
		}
		
		
	 }
	
	xmlhttpfriendlist.open("POST","./pluginstandalone/Users/groupmemberlist.php");
	xmlhttpfriendlist.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpfriendlist.setRequestHeader("Content-length", params.length);
	xmlhttpfriendlist.setRequestHeader("Connection", "close");
	xmlhttpfriendlist.send(params);
}
function updategroupmemberslist(Friendid)
{
	';
	if ($_SESSION['TypeUser'] == 'Admin'){
	$output .= '
	ii = 0;
	params = "command=bogus=bogus&" ;
	ii++;
	params = params + "&Acount="+Friendid;
	var xmlhttpfriendlist;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpfriendlist=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpfriendlist=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpfriendlist.onreadystatechange=function()
  	{
		if (xmlhttpfriendlist.readyState==4 && xmlhttpfriendlist.status==200)
   		{	
			//alert (xmlhttpfriendlist.responseText);
			txt = "";			
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("friendlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br>\'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><div id="gallerybut"><a href="#" onClick="dothemember(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
					
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'groupmembersresult\').innerHTML = txt;
						
			txt = "";
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("requestlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br> \'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><a href="#" onClick="dothemember(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Member\\\');return false"><div id="gallerybut"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a><a href="#" onClick="dothemember(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'requestresult\').innerHTML = txt;
						
			txt = "";
			x=xmlhttpfriendlist.responseXML.documentElement.getElementsByTagName("blockedlist");
			
			if (x.length > 0){
				txt = \'<table>\'
				ii = 1
				for (i=0;i<x.length;i++)
				{
					if (ii == 1){
						txt =txt +"<tr>"
					}
					if (window.userlist[x[i].firstChild.nodeValue] instanceof Array){
					txt = txt +\'<td valign="top"><div style="width:110px; "><center><a href="indexstandalone.php?plugin=Users&type=Profile&Id=\'+x[i].firstChild.nodeValue+\'"><img src="./system/imgtumb.php?url=\'+window.userlist[x[i].firstChild.nodeValue].Profilepic+\'&maxsize=100&square=1 " ></a><br> \'+window.userlist[x[i].firstChild.nodeValue].Username+\'<br><div id="gallerybut"><a href="#" onClick="dothemember(\'+window.userlist[x[i].firstChild.nodeValue].Id+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="add"></a></div></center></div></td>\';
					} else {
					txt = txt + \'<td valign="top">Deleted user<br><div id="gallerybut"><a href="#" onClick="dothefriend(\'+x[i].firstChild.nodeValue+\',\\\'Clear\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div></td>\'
					}
					if (ii == 5){
						txt =txt +"</tr>";
						ii=1;	
					}else {
						ii = ii+1;
					}
				}
			
				txt = txt + \'</tr></table>\'
			}
			document.getElementById(\'blockedresult\').innerHTML = txt;
			parent.refreshingmessage();
			
		}
		
		
	 }
	
	xmlhttpfriendlist.open("POST","./pluginstandalone/Users/groupmemberlist.php");
	xmlhttpfriendlist.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpfriendlist.setRequestHeader("Content-length", params.length);
	xmlhttpfriendlist.setRequestHeader("Connection", "close");
	xmlhttpfriendlist.send(params);
	';
	}else{
	$output .= 'updategroupmembersviewlist(Friendid);';
	}
	$output .= '
}
function dothemember(Friendid, friendtype2)
{
	parent.document.getElementById(\'friends\').style.display = \'none\';
	
	ii = 0;
	params = "command=bogus=bogus&" ;
	
	
	ii++;
	params = params + \'friend\'+ii+\'=\'+Friendid+"&";
		
	
	params = params + "Acount="+parent.window.acountid+"&totalfriends="+ii+"&type="+friendtype2;
	


	var xmlhttpdel;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpdel=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpdel=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpdel.onreadystatechange=function()
  	{
		if (xmlhttpdel.readyState==4 && xmlhttpdel.status==200)
   		 {
			
			updategroupmemberslist('.$selectId.');
			window.location.reload();
		}
		
		
	 }
	
	xmlhttpdel.open("POST","./pluginstandalone/Users/dogroupmembers.php?groupid='.$selectId.'");
	xmlhttpdel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpdel.setRequestHeader("Content-length", params.length);
	xmlhttpdel.setRequestHeader("Connection", "close");
	xmlhttpdel.send(params);
}
function dothefriend(Friendid, friendtype2)
{
	parent.document.getElementById(\'friends\').style.display = \'none\';
	openfriend='.$selectId.'
	ii = 0;
	params = "command=bogus=bogus&" ;
	
	
	ii++;
	params = params + \'friend\'+ii+\'=\'+Friendid+"&";
		
	
	params = params + "Acount="+parent.window.acountid+"&totalfriends="+ii+"&type="+friendtype2+"&openfriend="+openfriend;
	


	var xmlhttpdel;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpdel=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpdel=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpdel.onreadystatechange=function()
  	{
		if (xmlhttpdel.readyState==4 && xmlhttpdel.status==200)
   		 {
			parent.updatefriendlist(parent.window.acountid);
			parent.refreshingmessage();
		}
		
	 }
	
	xmlhttpdel.open("POST","./pluginstandalone/Users/dofriends.php");
	xmlhttpdel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpdel.setRequestHeader("Content-length", params.length);
	xmlhttpdel.setRequestHeader("Connection", "close");
	xmlhttpdel.send(params);
}
</script>';

$type = $_GET["type"]; 
$selectId = intval($_GET["Id"]);
// laat een lijst zien

$query = 'SELECT Id, Username, Profilepic FROM login WHERE TypeUser = "Admin" OR TypeUser = "Moderator" OR TypeUser = "Member"';
$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$Profilepic = $row['Profilepic'];
		array_push($_SESSION['Accesfiles2'], $Profilepic);
		
		$output .= '<script type="text/javascript">addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["Username"], "UTF-8"))).','.str_replace("'", "\'",json_encode(mb_convert_encoding($row["Profilepic"], "UTF-8"))).');</script>';
	}
function userheader($selectId,$Group = ""){
	global $link;
	$output = "";
	if ($Group != "Group"){
		$query = "SELECT Username, Profilepic FROM login WHERE Id=$selectId";
		$result = mysqli_query($link,$query);
		if (!$result) {
				die('Query failed: ' . mysqli_error($link));
	}

		while($row = mysqli_fetch_array($result)){
			$Username = $row['Username'];
			$Profilepic = $row['Profilepic'];
		}
	} else {
		$query = "SELECT Naam FROM usergroepen WHERE Id=$selectId";
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$Username = $row['Naam'];
			
		}
	}
$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			';
			
			
			
			$output .='
			<tr>
				
				<td width="70%">';
	if ($Group != "Group"){
				array_push($_SESSION['Accesfiles2'], $Profilepic);
			if (is_file($Profilepic)) {
				$output .= '<h1><img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=100&square=1 " align="middle"> '.$Username.'</h1><br>';
			}else{
				$output .= '<h1> '.$Username.'</h1><br>';
			}
		
		if ($_SESSION['TypeUser'] == 'Admin'){
			$output .= '  <a href="indexstandalone.php?plugin=Users&type=nieuw"><div id="buttonlayout"><h4> New </h4></div></a>';
		}
	
	$output .= '<br><br>';
	$output .= '';
	if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
		$output .= '<a href="indexstandalone.php?plugin=Users&type=select&Id='.$selectId.'"><div id="buttonlayout"><h4> Acount</h4></div></a>';
	}
	$output .= '<a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$selectId.'"><div id="buttonlayout"><h4> Profile </h4></div></a><a href="indexstandalone.php?plugin=Users&type=Messages&Id='.$selectId.'"><div id="buttonlayout"><h4> Messages</h4></div></a><a href="indexstandalone.php?plugin=Users&type=Friends&Id='.$selectId.'"><div id="buttonlayout"><h4> Friends</h4></div></a>
	';
	
	}else{
		$output .= '<h1>'.$Username.'</h1>';
		$output .= '<br><br>';
		$output .= '';
		if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
			$output .= '<a href="indexstandalone.php?plugin=usergroepen&type=select&Id='.$selectId.'">Edit</a>';
		}
		$output .= '<a href="indexstandalone.php?plugin=Users&type=Group&Id='.$selectId.'"><div id="buttonlayout"><h4>Group messages</div></a><a href="indexstandalone.php?plugin=Users&type=Groupmembers&Id='.$selectId.'"><div id="buttonlayout"><h4>Group members</div></a>';
	}
	
	return $output;
}

if ($type=="nieuw"){
	if ($_SESSION['TypeUser'] == 'Admin'){
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table></td>
			</tr>
			<tr>
				
				<td>';
$output .= '<form action="indexstandalone.php?plugin=Users&type=save" method="POST" name="form1" autocomplete="on">
	<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Username </td><td><input type="text" name="Username" value="" size="24" border="0" onchange=changeval()></td></tr>
		<tr><td>Acount type</td><td><select name="Acount" id="Acount" onchange=changeval()><option';
			$output .= ' value="Member">Member</option><option';
			$output .= ' value="Moderator">Moderator</option><option';
			$output .= ' value="Admin">Admin</option>';
			$output .= '</select></td></tr>
		<tr><td>Email</td><td><input type="text" name="Email" value="" size="24" border="0" onchange=changeval()></td></tr>
		<tr><td>Newpassword </td><td><input type="password" name="newpassword" size="24" border="0" onchange=changeval()></td></tr>
			
		<tr><td>Newpassword retype </td><td><input type="password" name="newpassword2" size="24" border="0" onchange=changeval()></td></tr>';
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
		$Nieuwsbrief = "dag";
			$output .='	<tr><td>Newsletter</td><td><select name="Nieuws" id="Nieuws" onchange=changeval()><option';
			if ($Nieuwsbrief == "uit"){$output .= ' selected ';}
			$output .= ' value="uit">off</option><option';
			if ($Nieuwsbrief == "dag"){$output .= ' selected ';}
			$output .= ' value="dag">day</option><option';
			if ($Nieuwsbrief == "week"){$output .= ' selected ';}
			$output .= ' value="week">week</option><option';
			if ($Nieuwsbrief == "maand"){$output .= ' selected ';}
			$output .= ' value="maand">Month</option></select></td></tr>	';
		$output .= '
			<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>change user</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table
		</form>';
	$output .= '</td>
			</tr>
		</table>';
		}else{
			$message = "Acces denied...";
			array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
			$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users\',\'_self\',\'\',\'true\')", 0);</script>';
		}
}elseif ($type=="Group"){
	$output .= userheader($selectId,$type);
	$acces = accesgroup ($selectId, $_SESSION["Id"]);
	
	$query = 'SELECT Type FROM usergroepen WHERE Mainid = '.$selectId.' AND Language='. $_SESSION['Language'];
	$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$output .= 'This is a '.$row["Type"].' group.<br>';
		}
	if ($acces == true){
	
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $selectId;
			$msgtype = "usergroup";
		$output .= '<br><br>';
		
		
		
	}else{
			$msgview = false;
			$msgpost = false;
			$msgtypeid = $selectId;
			$msgtype = "usergroup";
			$output .= 'You are not a member';
			$output .= '<div id="gallerybut"><a href="#" onClick="dothemember('.$_SESSION['Id'].', \'Member\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>';
			
	}
	$output .= '</table>';
}elseif ($type=="Groupmembers"){
	userheader($selectId,'Group');
	$query = 'SELECT Type FROM usergroepen WHERE Mainid = '.$selectId.' AND Language='. $_SESSION['Language'];
	$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$output .= 'This is a '.$row["Type"].' group.<br>';
		}
	if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
	$output .= '<script type="text/javascript">window.acountid = '.$selectId.';</script>';
	$output .= '<h2>Requests </h2>
	<div id="requestresult"></div>';
	$output .= '<h2>Group Members </h2>
	<table><tr><td></td><td colspan="4"><div id="gallerybut"><a href="#" onClick="openfriends(\'Member\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>
	</table><div id="groupmembersresult"></div>';
	
	$output .= '<h2>Blocked </h2>
	<table><tr><td></td><td colspan="4"><div id="gallerybut"><a href="#" onClick="openfriends(\'Blocked\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>
	</table><div id="blockedresult"></div>';
	$output .= '</td>
			</tr>';
		$output .= '<script type="text/javascript">updategroupmemberslist('.$selectId.');</script>';
	}else{
		$acces = accesgroup ($selectId, $_SESSION['Id']);
		if ($acces == true){
			$output .= 'You are a member';
			$output .= '<div id="gallerybut"><a href="#" onClick="dothemember('.$_SESSION['Id'].', \'Clear\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete"></a></div>';
			$output .= '<div id="groupmembersresult"></div></td></tr>';
			$output .= '<script type="text/javascript">updategroupmembersviewlist('.$selectId.');</script>';
		}else{
			$output .= 'You are not a member';
			$output .= '<div id="gallerybut"><a href="#" onClick="dothemember('.$_SESSION['Id'].', \'Member\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>';
			
		}
	}
	$output .= '</table>';


}elseif ($type=="delete"){
	
	$Id = intval($_GET["Id"]);
	if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
		$message = "User deleted";
		mysqli_query($link,"DELETE FROM login WHERE Id=$Id")or die(mysqli_error($link));
	} else {
		$message = "Acces denied.";
	}
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users\',\'_self\',\'\',\'true\')", 0);</script>';
}elseif ($type=="select"){
if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
	$output .= userheader($selectId);
	
			$output .= '	<br><a href="#" onclick=" ConfirmDelete('.$selectId.'); return false;"><h4>Delete this user</h4></a> <br>  ';
         
   	
	$query = "SELECT Id, Username, Nieuws, TypeUser, Email, Language, DATE_FORMAT(DATE_SUB(LastLogin, INTERVAL '-0 0:00:00' DAY_SECOND),'%d/%m/%y - [ %T ]') AS LastLogin FROM login WHERE Id=$selectId";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$datefromdb = $row['LastLogin'];
		$Nieuwsbrief = $row['Nieuws'];
		$Acount = $row['TypeUser'];
		$output .= "id = $id Last login $datefromdb <br> ";
		$Username = $row['Username'];
		$Email = $row['Email'];
		$output .= '<form action="indexstandalone.php?plugin=Users&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$id.'" border="0">
		<tr><td>Username</td><td> <input type="text" name="Username" value="'.$Username.'" size="24" border="0" onchange=changeval()></td></tr>	';
		if ($_SESSION['TypeUser'] == 'Admin'){
		$output .='		
		<tr><td>Acount Type</td><td><select name="Acount" id="Acount" onchange=changeval()><option';
			if ($Acount == "Member"){$output .= ' selected ';}
			$output .= ' value="Member">Member</option><option';
			if ($Acount == "Moderator"){$output .= ' selected ';}
			$output .= ' value="Moderator">Moderator</option><option';
			if ($Acount == "Admin"){$output .= ' selected ';}
			$output .= ' value="Admin">Admin</option></select>	';
			
			}else{
				$output .= '<tr><td>Acount Type</td><td>'.$Acount.'</td></tr>';
			}
			$output .='
		<tr><td>Email</td><td> <input type="text" name="Email" value="'.$Email.'" size="24" border="0" onchange=changeval()></td></tr>	
		<tr><td>Newpassword </td><td><input type="password" name="newpassword" size="24" border="0" onchange=changeval()></td></tr>			
		<tr><td>Newpassword retype </td><td><input type="password" name="newpassword2" size="24" border="0" onchange=changeval()></td></tr>'; 
			$output .= '<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .= '<option value="'.$row2['Id'].'"';
			if ($row['Language'] == $row2['Id'] ){$output .= ' selected ';}
			$output .= '>'.$row2['Language'].'</option>';
			}
		$output .= '</select></td></tr>';
		$output .='		
		<tr><td>Newsletter</td><td><select name="Nieuws" id="Nieuws" onchange=changeval()><option';
			if ($Nieuwsbrief == "uit"){$output .= ' selected ';}
			$output .= ' value="uit">off</option><option';
			if ($Nieuwsbrief == "dag"){$output .= ' selected ';}
			$output .= ' value="dag">day</option><option';
			if ($Nieuwsbrief == "week"){$output .= ' selected ';}
			$output .= ' value="week">week</option><option';
			if ($Nieuwsbrief == "maand"){$output .= ' selected ';}
			$output .= ' value="maand">Month</option></select></td></tr>	';
			
			
		$output .= '<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>change user</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
	}
	$output .= '</td>
			</tr>
		</table>';
		}else{
			$message = "Acces denied...";
			array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
			$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users\',\'_self\',\'\',\'true\')", 0);</script>';
		}
}else if ($type=="save"){
	$Id = $_POST["Id"]; 
	$selectId = $Id;
	$Username = $_POST["Username"];
	$Nieuws = $_POST["Nieuws"];	
	$Email = $_POST["Email"];
	$Password = $_POST["Oldpassword"];
	$newpassword = $_POST["newpassword"];
	$newpassword2 = $_POST["newpassword2"];
	$Acount = $_POST["Acount"];
	$language = intval($_POST["language"] );
	
	
	if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $Id){
	$message = "";
	$error = false;
	$Password = str_replace("'", " ", $Password);
	$Password = str_replace('"', " ", $Password);
	$Password = str_replace("\\", "\\\\", $Password);
	$Nieuws = str_replace("'", " ", $Nieuws);
	$Nieuws = str_replace('"', " ", $Nieuws);
	$Nieuws = str_replace("\\", "\\\\", $Nieuws);
	$Email = str_replace("'", " ", $Email);
	$Email = str_replace('"', " ", $Email);
	$Email = str_replace("\\", "\\\\", $Email);
	$Acount = str_replace("'", " ", $Acount);
	$Acount = str_replace('"', " ", $Acount);
	$Acount = str_replace("\\", "\\\\", $Acount);
	$Username= str_replace("'", " ", $Username);
	$Username= str_replace('"', " ", $Username);
	$Username = str_replace("\\", "\\\\", $Username);
	$newpassword = str_replace("'", " ", $newpassword);
	$newpassword = str_replace('"', " ", $newpassword);
	$newpassword = str_replace("\\", "\\\\", $newpassword);
	$newpassword2= str_replace("'", " ", $newpassword2);
	$newpassword2= str_replace('"', " ", $newpassword2);
	$newpassword2 = str_replace("\\", "\\\\", $newpassword2);
	if ($Id == "new"){
		$systemPassword = "";
	}else{
		$query = "SELECT Password, TypeUser FROM login WHERE Id=$Id";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
	
		while($row = mysqli_fetch_array($result)){
			$systemPassword = $row['Password'];
			$systemtypeuser = $row['TypeUser'];
		}
	}
	if ($_SESSION['TypeUser'] != 'Admin'){
		$Acount = $systemtypeuser;
	}
		if ($newpassword == $newpassword2 and $newpassword != ""){
			$newpassword = md5($newpassword);
			if ($Id == "new"){
				mysqli_query($link,"INSERT INTO login (Nieuws, Language, Username, Password, ErrorLogin, TypeUser, Email, Vertivicate) VALUES ('$Nieuws','$language','$Username', '$newpassword','0','$Acount', '$Email','0')")or ($message = mysqli_error($link));
				$Id = mysqli_insert_id($link);
				if (is_dir('./uploads/users/'.$Id.'/')){
			
				} else {			
					mkdir('./uploads/users/'.$Id.'/', 0700);
				}
			}else{
				mysqli_query($link,"UPDATE login SET Nieuws = '$Nieuws', Language = '$language', Username = '$Username', Password = '$newpassword',TypeUser = '$Acount',Email= '$Email' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			}
			if ($message == ""){
				$message="User saved";
			}else{
				$error = true;
			}
		}else{
			if ($newpassword == $newpassword2 and $Id != "new"){
				mysqli_query($link,"UPDATE login SET Nieuws = '$Nieuws', Language = '$language', Username = '$Username', TypeUser = '$Acount',Email= '$Email' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
				$message="User saved";
			}else{
				$message="New password don't match";
				$error = true;
			}
		}
	} else {
		$message = "Acces denied...";
	}
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table> </td>
			</tr>
			<tr>
				
				<td>';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users&type=select&&Id='.$Id.'\',\'_self\',\'\',\'true\')", 0);</script>';


	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="saveProfile"){
	$Id = intval($_POST["Id"]); 
	$selectId = $Id;
	$Profile = $_POST["Profile"];
	$ProfileAcces = $_POST["ProfileAcces"];
	
	if ($_SESSION['TypeUser'] == 'Admin' or  intval($_SESSION['Id']) == $Id){
		$message = "";
		$error = false;
		$ProfileAcces = str_replace("'", " ", $ProfileAcces);
		$ProfileAcces = str_replace('"', " ", $ProfileAcces);
		$ProfileAcces = str_replace("\\", "\\\\", $ProfileAcces);
		$Profile= str_replace("'", " ", $Profile);
		$Profile= str_replace('"', " ", $Profile);
		$Profile = str_replace("\\", "\\\\", $Profile);
	
		
		mysqli_query($link,"UPDATE login SET ProfileAcces = '$ProfileAcces', Profilepic = '$Profile' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			
		if ($message == ""){
			$message="User saved";
		}else{
			$error = true;
		}
	} else {
		$message = "Acces denied...";
	}
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table> </td>
			</tr>
			<tr>
				
				<td>';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users&type=Profile&&Id='.$Id.'\',\'_self\',\'\',\'true\')", 0);</script>';


	$output .= '</td>
			</tr>
			
		</table>';
}else if ($type=="Friends"){

	$output .= userheader($selectId);
	if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $selectId){
	$output .= '<script type="text/javascript">window.acountid = '.$selectId.';</script>';
	$output .= '<h2>Requests </h2>
	<div id="requestresult"></div>';
	$output .= '<h2>Friends </h2>
	<table><tr><td></td><td colspan="4"><div id="gallerybut"><a href="#" onClick="openfriends(\'Friend\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>
	</table><div id="friendresult"></div>';
	
	$output .= '<h2>Pending </h2>
	<div id="pendingresult"></div>';
	
		$output .= '<h2>Blocked </h2>
	<table><tr><td></td><td colspan="4"><div id="gallerybut"><a href="#" onClick="openfriends(\'Blocked\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>
	</table><div id="blockedresult"></div>';
	$output .= '</td>
			</tr>
		</table>';
		$output .= '<script type="text/javascript">updatefriendlist('.$selectId.');</script>';
	}else{
		$acces = accesprofile ($selectId, $_SESSION["Id"]);
		if ($acces == true){
		$output .= '<div id="friendresult"></div></td></tr>
			</table>';
		$output .= '<script type="text/javascript">updatefriendviewlist('.$selectId.');</script>';
		}else{
			$output .= '<div id="gallerybut"><a href="#" onClick="openfriends(\'Friend\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a> </td></tr>
			</table>';
		}
	}
}else if ($type=="Profile"){
	$output .= userheader($selectId);
	$query = "SELECT Id, ProfileAcces, Profilepic, Email, DATE_FORMAT(DATE_SUB(LastLogin, INTERVAL '-0 0:00:00' DAY_SECOND),'%d/%m/%y - [ %T ]') AS LastLogin FROM login WHERE Id=$selectId";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$Profilepic = $row['Profilepic'];
		$ProfileAcces = $row['ProfileAcces'];
		if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['Id'] == $id){
			$output .= '<form action="indexstandalone.php?plugin=Users&type=saveProfile" method="POST" name="form1" autocomplete="on"><input type="hidden" name="Id" value="'.$id.'" border="0"><table><tr><td>Profile picture<br> <img id="faveico" src=""></td><td><input type="hidden" name="changed" id="changed" value="false"><input type="hidden" id="Profile" name="Profile" value="'.$Profilepic.'" size="30" border="0" onchange="updatefaveico();"><input type = "button" value = "Choose file" onclick="showfilemanager(\'Profile\');" /></td></tr>
			<tr><td>Profile Acces</td><td><select name="ProfileAcces" id="ProfileAcces" onchange=changeval()><option';
			if ($ProfileAcces == "Friends"){$output .= ' selected ';}
			$output .= ' value="Friends">Friends</option><option';
			if ($ProfileAcces == "Members"){$output .= ' selected ';}
			$output .= ' value="Members">Members</option><option';
			if ($ProfileAcces == "Public"){$output .= ' selected ';}
			$output .= ' value="Public">Public</option>';
			$output .= '</select></td></tr>
			
			<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save profile</h4></a>
          </div></td>
        </tr>
      </table></td></tr>
	</table></form>
	<script type="text/javascript">updatefaveico();</script>
	';
		}else{
		// set message options
			$output .= "This profile acces is set to ".$ProfileAcces;
		}
		
		$acces = accesprofile ($id, $_SESSION["Id"]);
		
		if ($acces == true){
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $id;
			$msgtype = "user";
		}else{
			$msgview = false;
			$msgpost = false;
			$msgtypeid = $id;
			$msgtype = "user";
		}
		$output .= '<br><br>';
		
	}
	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="Messages"){
	$output .= userheader($selectId);
	
	$query = "SELECT Id, ProfileAcces, Profilepic, Email, DATE_FORMAT(DATE_SUB(LastLogin, INTERVAL '-0 0:00:00' DAY_SECOND),'%d/%m/%y - [ %T ]') AS LastLogin FROM login WHERE Id=$selectId";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		
	}
	if (intval($id) == intval($_SESSION['Id'])){
		$msgtype = "privatemessage";
		$query = "SELECT Id, Bericht, Stat, Username, MainId, UserId, ParentMainId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate FROM reply WHERE (ParentMainId =".$_SESSION['Id']." OR UserId=".$_SESSION['Id']." ) AND ParentType='$msgtype' AND Language =".$_SESSION['Language']." ORDER BY TheDate DESC ";
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}
		$output .= '<table>';
		$theconUsers = array();
		$converuser = 0;
		while($row = mysqli_fetch_array($result)){
			if (intval($row['UserId']) == intval($_SESSION['Id'])){
				
				$converuser =  $row['ParentMainId'];
			}else{
				
				$converuser = $row['UserId'];
			}
		
			if (!in_array($converuser, $theconUsers)) {
			array_push($theconUsers, $converuser);
			$query = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$converuser;
			$result2 = mysqli_query($link,$query);
			if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
			}
			$found2 = false;
			while($row2 = mysqli_fetch_array($result2)){
				$found2 = true;
				$Username = $row2['Username'];
			
				
				$Profilepic = $row2['Profilepic'];
				array_push($_SESSION['Accesfiles2'], $Profilepic);
			}
			$Yousay = "";
			if ($consuser != intval($row['UserId'])){
				 $Yousay ="You say: ";
			}
			if ($found2 == false){
				$Username = "Deleted user";
				$Profilepic = "";
			}
			if (is_file($Profilepic)) {
				$output .= '<tr><td><a href="indexstandalone.php?plugin=Users&type=Messages&Id='.strval($converuser).'"><img width="50" height="50" src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $Username.' </b></a><br>'.$row['TheDate'].'<br></td>';
			}else{
				$output .= '<tr><td><a href="indexstandalone.php?plugin=Users&type=Messages&Id='.strval($converuser).'">'." <b>". $Username.' </b></a><br>'.$row['TheDate'].'<br></td>';
			}
			
			$output .= '<td><div id="msg">'.$Yousay.$row['Bericht'].'</div><br></td></tr>';
			}
		
		}
		$output .= '</table>';
	}else{
	
		$acces = accesprofile ($id, $_SESSION["Id"]);
		
		if ($acces == true){
			$msgview = true;
			$msgpost = true;
			$msgtypeid = $id;
			$msgtype = "privatemessage";
		}else{
			$msgview = false;
			$msgpost = false;
			$msgtypeid = $id;
			$msgtype = "privatemessage";
		}
		
		$output .= '<br><br>';
		
		
	}
	$output .= '</td>
			</tr>
		</table>';

}else {
	header( 'Location: indexstandalone.php?plugin=Users&type=Profile&&Id='.$_SESSION["Id"] ) ;
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><a href="indexstandalone.php?plugin=Users&type=nieuw"><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table></a> </td>
			</tr>
			<tr>
				<td>';
$output .='
					  
					  </td>
				<td><script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users&type=Profile&&Id='.$_SESSION["Id"].'\',\'_self\',\'\',\'true\')", 0);</script></td>
			</tr>
		</table>';
}

/*
$output .= '<div id="gallerybuttons" name="gallerybuttons" style="position:fixed; left:0px; top:0px; right:0px; bottom:0px; overflow:hidden; display:none; z-index:100;">
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
</div>

<div name="filemanager" id="filemanager"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">File Manager</font></b>  <a href="#" onclick="hidefilemanager();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker" id="filelinker" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$output .= '<div name="friends" id="friends"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">Friends</font></b>  <a href="#" onclick="closefriends();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker3" id="filelinker3" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';
$output .= '<div name="directory" id="directory" onclick="closeeditimg();return false"></div> 
<div id="imgcontainer5" name="imgcontainer5" style="overflow:hidden; vertical-align:top; display:none; width:0px; height:0px;"><img src="" id="imgshower2" name="imgshower2"></div>
<div name="editimg" id="editimg">
<div id="imgcontainer2" name="imgcontainer2"  style="overflow:hidden;"><div id="imgcontainer" name="imgcontainer" style="align:left; style="overflow:hidden; vertical-align:top;"><img src="" id="imgshower" name="imgshower"></div></div><div style="position:absolute; left:10px; overflow:hidden; right:10px; bottom:10px; background-color:#000; height:75px" id ="Infoimagebg" name="Infoimagebg"></div><div style="position:absolute; overflow:hidden; left:10px; height:65px; right:10px; bottom:15px; " id ="Infoimage" name="Infoimage"></div>
<script language="javascript">
	document.getElementById(\'imgshower\').onload = function() {

	Imageisloaded()
	}
	document.getElementById(\'imgshower2\').onload = function() {

	Imageisloaded2();
	}
</script>
</div>';


$output .= '<script language="javascript">resizeframe()</script>';
*/
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>