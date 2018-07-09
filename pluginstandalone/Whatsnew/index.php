<?php
// Init session settings
$MainId = intval($_GET["Id"]);
$output .= '

<script src="./system/jquery-3.2.1.min.js"></script>
';
$output .= '

<script language="javascript">
function window_onload2(){
	loaddocuments(0);
	loadmessagewhatsnew(0);
}
themeurl = "'.$_SESSION['Theme'].'";
imgdetail = 0;


</script>'
;
$output .='


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

function resizeframe(){		
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
		
     	 realWidth = parseInt(realWidth) - 70;
	 realHeight =  parseInt(realHeight) - 120;
        document.getElementById("filelinker").style.height = realHeight + \'px\';
     	document.getElementById("filelinker").style.width = realWidth + \'px\';
		//document.getElementById("filelinker3").style.height = realHeight + \'px\';
     	//document.getElementById("filelinker3").style.width = realWidth + \'px\';
		
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
</script>


<script language="javascript">
window.msgtype="";
window.msgtypeid=0;
window.thedocuments = 0;
window.themessage = 0;
window.msgloading = false; 
window.docloading = false;
window.documentendreached = false;
window.msgendreached =false;
window.msgnewgalleryimg = new Array();
window.jaar ='.date("Y").';
window.maand = '.date("n").';
window.dag = '.date("d").';
window.uur = '.date("H").';
window.minut = '.date("i").';
window.seconde = '.date("s").';

function postmessage(message,  msgid, stat, filelist, msgtypeid, msgtype)
{	
	
	ajaxObj=new Object();
	ajaxObj.msgtypeid = msgtypeid;
	ajaxObj.msgtype = msgtype;
	ajaxObj.message = message;
	ajaxObj.filelist = filelist;
	ajaxObj.msgid = msgid;
	ajaxObj.stat = stat;
	
	paramsasstring = $.param(ajaxObj);
	//document.getElementById(\'newmessage\').value="";
	//document.getElementById(\'previewmessage\').innerHTML = "";
	//document.getElementById(\'msgnewfilelist\').innerHTML = "";
	var xmlhttppostmessage;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage.onreadystatechange=function()
  	{
		
		var i =0;
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {
		//alert (xmlhttppostmessage.responseText);
				x=xmlhttppostmessage.responseXML.documentElement.getElementsByTagName("stat")[0].firstChild.nodeValue;
				
				if (x == "message saved"){
					amount = window.themessage
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessagewhatsnew(window.themessage,amount)", 5);	
					
				}else{
					alert (x);
				}
		}
		refreshingmessage();
	 }
	
	xmlhttppostmessage.open("POST","./system/messagepost.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
}

function addmsgnewfile(inputfile, inputfilelist){
	
	document.getElementById(inputfilelist).innerHTML = document.getElementById(inputfilelist).innerHTML +"<li>"+ inputfile+"</li>";
	
	if (inputfilelist == "msgnewfilelist"){
		
		updatemessage(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true);		
		//prettyPrint();
	}else{
		msgnum = inputfilelist.split("msgfilelist");
		msgnum = msgnum[1];
		updatemessage(\'editmsg\'+msgnum,\'msgfilelist\'+msgnum,msgnum,\'previewmessage\'+msgnum,true)
		
		//prettyPrint();
	}
}

function DeleteMessage (theId, msgtypeid, msgtype){
	answer = confirm("Weet je zeker dat je dit bericht wilt verwijderen")

if (answer !=0) { 
	
	ajaxObj=new Object();
	ajaxObj.msgid = theId;
	
	paramsasstring = $.param(ajaxObj);
	//document.getElementById(\'newmessage\').value="";
	//document.getElementById(\'previewmessage\').innerHTML = "";
	var xmlhttppostmessage;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage.onreadystatechange=function()
  	{
		
		var i =0;
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {
		//alert (xmlhttppostmessage.responseText);
				x=xmlhttppostmessage.responseXML.documentElement.getElementsByTagName("stat")[0].firstChild.nodeValue;
				
				if (x == "message saved"){
					amount = window.themessage
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessagewhatsnew(window.themessage,amount)", 5);					
				}else{
					alert (x);
				}
		}
	 }
	
	xmlhttppostmessage.open("POST","./system/messagedelete.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
} 
}

function Enablechangemsg (msgnumber){
	document.getElementById("editmsgdiv"+msgnumber).style.display = \'block\';
	document.getElementById("msg"+msgnumber).style.display = \'none\';
	updatemessage(\'editmsg\'+msgnumber,\'msgfilelist\'+msgnumber,msgnumber,\'previewmessage\'+msgnumber,true)
	
}

function RecoverMessage (theId, msgtypeid, msgtype){
	answer = confirm("Weet je zeker dat je dit bericht wilt recoveren")

if (answer !=0) { 
	ajaxObj=new Object();
	ajaxObj.msgid = theId;
	ajaxObj.msgtype = msgtype;
	
	paramsasstring = $.param(ajaxObj);
	//document.getElementById(\'newmessage\').value="";
	//document.getElementById(\'previewmessage\').innerHTML = "";
	var xmlhttppostmessage;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage.onreadystatechange=function()
  	{
		
		var i =0;
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {
		//alert (xmlhttppostmessage.responseText);
				x=xmlhttppostmessage.responseXML.documentElement.getElementsByTagName("stat")[0].firstChild.nodeValue;
				
				if (x == "message saved"){
					amount = window.themessage 
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessagewhatsnew(window.themessage,amount)", 5);					
				}else{
					alert (x);
				}
		}
	 }
	
	xmlhttppostmessage.open("POST","./system/messagerecover.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
} 
}




function viewPortHeight() {
    var de = document.documentElement;

    if(!!window.innerWidth)
    { return window.innerHeight; }
    else if( de && !isNaN(de.clientHeight) )
    { return de.clientHeight; }

    return 0;
}

function scrollY() {
    if( window.pageYOffset ) { return window.pageYOffset; }
    return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
}

function checkvisible( elm ) {
    var vpH = viewPortHeight(), // Viewport Height
        st = scrollY(), // Scroll Top
        y = posY(elm);
	if ( y < (vpH + st) && y >st){
		return true
	} else {
		return false
	}
    //return (y > (vpH + st));
}

function checkisheigher( elm ) {
    var vpH = viewPortHeight(), // Viewport Height
        st = scrollY(), // Scroll Top
        y = posY(elm);
	if ( y < (vpH + st) ){
		return true
	} else {
		return false
	}
    //return (y > (vpH + st));
}

function openhistory(id){
	if (document.getElementById(id).style.display == "block"){
		document.getElementById(id).style.display = "none"
	}else{
		document.getElementById(id).style.display = "block"
	}
}

function createmsggallery(filelist){
	thegallery = new Array();

	if (filelist.length > 0){
		filelist = filelist.split("<li>");
		
		
		for (var i=1; i<filelist.length; i++){
			
			filelist[i] = filelist[i].substr(0,filelist[i].length-5)
			filename = filelist[i].split("/")
			filename = filename[filename.length-1]
			filetype = filename.split(".")
			filetype = filetype[filetype.length-1]
			
			switch (filetype){
				case "jpg":
				case "jpeg":
				case "png":
				case "gif":
					
					thegallery.push(addgalimg(filename,\'\', filelist[i], \'0\', \'0\'));
				break;
				default:
				break;
			}
		}		
	}
	return thegallery;
}

function updatemessage2(themessage, filelistname, gallery, outputmsg,edit){
	
	clearTimeout(window.updatertimer);
	window.updatertimer = setTimeout("updatemessage(\'"+themessage+"\', \'"+filelistname+"\', "+gallery+", \'"+outputmsg+"\',"+edit+")", 1000);
}

function updatemessage(themessage, filelistname, gallery, outputmsg, edit){	
	if (!edit){
		edit = false;
	}
	
	window.updatingmsg = true
	if (document.getElementById(filelistname)){
		filelist = document.getElementById(filelistname).innerHTML;
	}else{
		filelist="";
	}
	
	if (document.getElementById(themessage).value){
		str = document.getElementById(themessage).value;
	}else if(document.getElementById(themessage).innerHTML){
		str = document.getElementById(themessage).innerHTML;
	}else{
		str="";
	}
	str = str.replace(/<wbr>/gi, "%wbr%");
	str = str.replace(/</gi, "&lt;");
	str = str.replace(/>/gi, "&gt;");
	str = str.replace(/\(/gi, "&#40;");
	str = str.replace(/\)/gi, "&#41;");
	str = str.replace(/\n/gi,"<br />");
	
	str = str.replace(/&lt;code&gt;/gi, "<pre class=\"prettyprint\">");
	str = str.replace(/&lt;\/code&gt;/gi, "</pre>");
	str = str.replace(/(\b(https?:\\/\\/|ftp:\\/\\/|file:\\/\\/|www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,\'<a href="$1" target="_blank">$1</a>\');
	str = str.replace(/((\\.\\/)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,"<a href=\'$1\' target=\'_blank\'>$1</a>");  
	str = str.replace(/(\b(www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,"http://$1"); 
	str = str.replace(/http:\\/\\/http:\\/\\//gi,"http://"); 
	str = str.replace(/https:\\/\\/http:\\/\\//gi,"https://"); 
	str = str.replace(/ftp:\\/\\/http:\\/\\//gi,"ftp://"); 
	str = str.replace(/file:\\/\\/http:\\/\\//gi,"file://"); 
	str = str.replace(/%wbr%/gi, "<wbr>");
	
	str2 = str.split(\'<a href="\');
	for (var i=1; i<str2.length; i++){
		str2[i] = str2[i].split(\'" target="_blank">\');
		str2[i][0] = str2[i][0].replace(/<wbr>/gi, "");
		str2[i] = str2[i].join(\'" target="_blank">\');
		i++;
	}
	str2 = str2.join(\'<a href="\');
	str = str2;
	
	if (filelist.length > 0){
		
		window.msgnewgalleryimg[gallery] = createmsggallery(filelist);
		
		galleryid = 0;
		
		filelist = filelist.split("<li>");
		str = str + "<br> "+(filelist.length-1)+\' files:<br>\';
		ii = 0
		
		for (var i=1; i<filelist.length; i++){
			//alert ("hallo")
			if (ii < 3){			
				ii = ii + 1;
			}else{
				
				ii = 1;
			}
			
			filelist[i] = filelist[i].substr(0,filelist[i].length-5)
			filename = filelist[i].split("/")
			filename = filename[filename.length-1]
			filetype = filename.split(".")
			filetype = filetype[filetype.length-1]
			
			
			
			switch (filetype.toLowerCase()){
				case "jpg":
				case "jpeg":
				case "png":
				case "gif":
					strtmp =  \'<div style="vertical-align:middle;text-align:center; display:inline-block;width:100px;margin:10px;"><a href="#" onClick="selectgallery(window.msgnewgalleryimg[\'+gallery+\']);galleryimgshow(\'+(galleryid)+\');return false"><img src="./system/imgtumb.php?url=\'+filelist[i]+\'&maxsize=100&square=1" align="middle"></a><br>\'
					strtmp = strtmp +\' <a href="./system/fileopen2.php?url=\'+filelist[i]+\'" target="_blank">\'+filename + \'</a><br>\'
					if (edit == true){
						strtmp = strtmp +\'<div id="gallerybut"><a href="#" onClick="document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML=deletemsgfile(document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML,\'+i+\'); updatemessage(\\\'\'+themessage+\'\\\', \\\'\'+filelistname+\'\\\',\'+gallery+\',\\\'\'+outputmsg+\'\\\',true);return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete message"></a></div> \'
					}
					str = str+strtmp+"</div>"
					
					galleryid++
				break;
				default:
					filename = \'<div style="vertical-align:middle;text-align:center; width:100px; display:inline-block;overflow:hidden;margin:10px"><a href="./system/fileopen2.php?url=\'+filelist[i]+\'" target="_blank">\'+filename + \'</a> \'
					if (edit == true){
						filename = filename+\'<br><div id="gallerybut"><a href="#" onClick="document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML=deletemsgfile(document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML,\'+i+\'); updatemessage(\\\'\'+themessage+\'\\\', \\\'\'+filelistname+\'\\\',\'+gallery+\',\\\'\'+outputmsg+\'\\\',true);return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/delete.png" alt="delete message"></a></div> \'
					}
					str = str+filename+"</div>"
				break;
			}
		}
		
		
	}	
	str = textWrap (str);
	document.getElementById(outputmsg).innerHTML = str;

}

function loaddocuments(documentsnumber)
{	
	//alert (window.msgloading)
	if (window.docloading == false && window.documentendreached == false){
	
	if (checkisheigher(document.getElementById(\'documentscroller2\'))){
	
	window.docloading = true;
	
	ajaxObj=new Object();
	ajaxObj.msgnumber = documentsnumber;
	ajaxObj.msgjaar = window.jaar;
	ajaxObj.msgmaand = window.maand;
	
	paramsasstring = $.param(ajaxObj);
	
	
	var xmlhttppostmessage2;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage2=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage2=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage2.onreadystatechange=function()
  	{
		
		if (xmlhttppostmessage2.readyState==4 && xmlhttppostmessage2.status==200)
   		 {
			
			window.docloading = false;
			if (xmlhttppostmessage2.responseText == "the end"){
				window.documentendreached = true;
				//alert ("theend")
				document.getElementById(\'showdocuments\').innerHTML = document.getElementById(\'showdocuments\').innerHTML.substr(0,document.getElementById(\'showdocuments\').innerHTML.length-8) +  "<tr><td></td><td>No more documents</td></tr></table>";
			}else if (xmlhttppostmessage2.responseText == "acces denied"){
				document.getElementById(\'showdocuments\').innerHTML = document.getElementById(\'showdocuments\').innerHTML.substr(0,document.getElementById(\'showdocuments\').innerHTML.length-8) +  "<tr><td></td><td>Acces denied</td></tr></table>";
				window.documentendreached = true;
				
			}else{
				
				if (window.thedocuments == 0){
					window.last10msg = xmlhttppostmessage2.responseText
				}
				
				document.getElementById(\'showdocuments\').innerHTML = document.getElementById(\'showdocuments\').innerHTML.substr(0,document.getElementById(\'showdocuments\').innerHTML.length-8) + textWrap (xmlhttppostmessage2.responseText) + "</table>";
				
				for (var i=0;i<10;i++)
				{ 
				
					if (document.getElementById(\'theenddoc\')){
						window.documentendreached = true;
						
						break;
					}
					
				
						msgwindow = "msg"+window.thedocuments	
						msgfilelist = "msgfilelist"+window.thedocuments
	
						if (document.getElementById(msgwindow)){
							
							
							var ii = 0;
							update = true
							while (update == true)
								{
								msgwindow2 = "msg"+window.thedocuments+"hs"+ii
								msgfilelist2 = "msgfilelist"+window.thedocuments+"hs"+ii
								if (document.getElementById(msgwindow2)){
									
								}else{
									update = false
								}
								ii = ii + 1;
								
							}
							
					
						
						}
						window.thedocuments = window.thedocuments+1;
				}
					
				window.docloading = false;
				
				window.msgtimer = setTimeout("loaddocuments(window.thedocuments)", 5);
				
				
				
			}
			
			window.docloading = false;	
			
		}
	 }
	
	xmlhttppostmessage2.open("POST","./pluginstandalone/Whatsnew/documentload.php");
	xmlhttppostmessage2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage2.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage2.setRequestHeader("Connection", "close");
	xmlhttppostmessage2.send(paramsasstring);
	
	}else{
		clearTimeout(window.msgtimer2); 
		window.msgtimer2 = setTimeout("loaddocuments(window.thedocuments)", 1000);
	}
	}else{
		clearTimeout(window.msgtimer2); 
		window.msgtimer2 = setTimeout("loaddocuments(window.thedocuments)", 1000);
	}
	
}

function loadmessagewhatsnew(msgnumber, theamount)
{	
	
	if (window.msgloading == false && window.msgendreached == false){
	
	if (checkisheigher(document.getElementById(\'msgscroller\')) || window.themessage == 0){
	
	window.msgloading = true;
	
	ajaxObj=new Object();
	ajaxObj.msgnumber = msgnumber;
	ajaxObj.msgjaar = window.jaar;
	ajaxObj.msgmaand = window.maand;
	ajaxObj.amount = theamount;
	window.theamount = theamount;
	
	paramsasstring = $.param(ajaxObj);

	var xmlhttppostmessage;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage.onreadystatechange=function()
  	{
		
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {
			
			window.msgloading = false;
			if (xmlhttppostmessage.responseText == "the end"){
				
				window.msgendreached = true;
				
				document.getElementById(\'themessages\').innerHTML = document.getElementById(\'themessages\').innerHTML.substr(0,document.getElementById(\'themessages\').innerHTML.length-8) +  "<tr><td></td><td>No more messages</td></tr></table>";
			}else if (xmlhttppostmessage.responseText == "acces denied"){
				
				document.getElementById(\'themessages\').innerHTML = document.getElementById(\'themessages\').innerHTML.substr(0,document.getElementById(\'themessages\').innerHTML.length-8) +  "<tr><td></td><td>Acces denied</td></tr></table>";
				window.msgendreached = true;
			}else{
				if (window.themessage == 0){
					
					window.last10msg = xmlhttppostmessage.responseText
				}
				
				if (window.themessage == 0){
					
					document.getElementById(\'themessages\').innerHTML = "<table>" + xmlhttppostmessage.responseText + "</table>";					
				}else{
					document.getElementById(\'themessages\').innerHTML = document.getElementById(\'themessages\').innerHTML.substr(0,document.getElementById(\'themessages\').innerHTML.length-8) + xmlhttppostmessage.responseText + "</table>";
				}
				theamount = window.theamount;
				if (typeof theamount == \'undefined\'){
					theamount =10;
				}
				
				for (var i=0;i<theamount;i++)
				{ 
					if (document.getElementById(\'theend\')){
						window.msgendreached = true;
						//break;
					}
					
				
						msgwindow = "msg"+window.themessage	
						msgfilelist = "msgfilelist"+window.themessage
					
						if (document.getElementById(msgwindow)){
							
							updatemessage(msgwindow, msgfilelist, window.themessage, msgwindow)
							var ii = 0;
							update = true
							while (update == true)
								{
								msgwindow2 = "msg"+window.themessage+"hs"+ii
								msgfilelist2 = "msgfilelist"+window.themessage+"hs"+ii
								if (document.getElementById(msgwindow2)){
									updatemessage(msgwindow2, msgfilelist2, window.thehismessage, msgwindow2)
								}else{
									update = false
									
								}
								ii = ii + 1;								
							}
							
							var ii = 1;
							update = true
							while (update == true)
								{
								msgwindow2 = "msg"+window.themessage+"submsg"+ii
								msgfilelist2 = "msgfilelist"+window.themessage+"submsg"+ii
								if (document.getElementById(msgwindow2)){
									updatemessage(msgwindow2, msgfilelist2, window.thehismessage, msgwindow2)
									var iii = 0;
									update2 = true
									while (update2 == true)
									{
										msgwindow2 = "msg"+window.themessage+"submsg"+ii+"hs"+iii
										msgfilelist2 = "msgfilelist"+window.themessage+"submsg"+ii+"hs"+iii
										if (document.getElementById(msgwindow2)){
											updatemessage(msgwindow2, msgfilelist2, window.thehismessage, msgwindow2)
										}else{
											update2 = false									
										}
									iii = iii + 1;								
									}
								}else{
									update = false
									//alert (ii)
								}
								ii = ii + 1;								
							}
						
						} else {
							
							
						}
						window.themessage = window.themessage+1;
				}
				
				//prettyPrint();
								
				window.msgloading = false;
				
				window.msgtimer = setTimeout("loadmessagewhatsnew(window.themessage)", 5);
				
				
				
			}
			window.msgloading = false;	
			
		}
	 }
	
	xmlhttppostmessage.open("POST","./pluginstandalone/Whatsnew/messageloadwhatnew.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
	}else{
		clearTimeout(window.msgtimer3); 
		window.msgtimer3 = setTimeout("loadmessagewhatsnew(window.themessage)", 1000);
	}
	}else{
		clearTimeout(window.msgtimer3); 
		window.msgtimer3 = setTimeout("loadmessagewhatsnew(window.themessage)", 1000);
	}

}

function updatemessage2(themessage, filelistname, gallery, outputmsg,edit){
	
	clearTimeout(window.updatertimer);
	window.updatertimer = setTimeout("updatemessage(\'"+themessage+"\', \'"+filelistname+"\', "+gallery+", \'"+outputmsg+"\',"+edit+")", 1000);
}

function updatdate(){
	window.jaar = document.getElementById("Jaar").value;
	window.maand = document.getElementById("Maand").value;
	document.getElementById(\'themessages\').innerHTML = "<table></table>";
	document.getElementById(\'showdocuments\').innerHTML = "<table></table>";
	window.thedocuments = 0;
	window.themessage = 0;
	window.msgloading = false; 
	window.documentendreached = false;
	window.msgendreached =false;
	window.msgnewgalleryimg = new Array();
	loaddocuments(0);
	loadmessagewhatsnew(0);
}


</script>';
$output .=  '

<script language="javascript">
function layerActie(divID,ImgId) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
	  document.getElementById(ImgId).src = "./iconen/mapje.png";
   } else {
   
      document.getElementById(divID).style.display="none";
	  document.getElementById(ImgId).src = "./iconen/mapje-dicht.png";
	  
   }
}

function changeval(){	
	
}

function submitform(){
	
		document.formzoek.submit();
    	
}
</script>';

$output .= '<h1>What\'s new</h1>';

$output .=  '<form name="formzoek"  action="indexstandalone.php" method="GET" name="Users" accept-charset="UTF8"><input type="hidden" name="plugin" value="Search" border="0"><input type="hidden" name="type" value="" border="0">Search <input type="text" name="Searchstring" id ="Searchstring" value=\''.$SearchString.'\'size="24" border="0"> Sectie <select name="Sectie" size="1">
				<option '; if($Sectie == "Alles"){$output .= ' selected ';} $output .= ' value="">Alles</option>';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$acces = accesdocument($row["Id"], $Ids = array(), $_SESSION["Id"]);
				
		if ($acces == true){
			$output .=  '<option '; if($Sectie == $row['MainId']){$output .= ' selected ';} $output .= ' value="'.$row['MainId'].'">'.$row['Naam'].'</option>';
		}
	}
				
				$output .=  '
			</select><div id="buttonlayout">
            <h4><a href="javascript: submitform()">Search</a></h4>
          </div>
			
			
			
			</form>';
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){

}else{
		$output .= '<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
}
$output .= '<table ><tr><td>';
$output .= '<select name="Jaar" id="Jaar" onchange="updatdate()">';
for ($i = intval(date("Y")); $i > 1970; $i--){
	$output .= '<option '; if (date("Y") == $i){$output .= ' selected ';} $output .='value="'.$i.'">'.$i.'</option>';
}
$output .= '</select></td><td>
<select name="Maand" id="Maand" onchange="updatdate()">
	<option '; if (date('n') == 1){$output .= ' selected ';} $output .='value="1">Januarie</option>
	<option '; if (date('n') == 2){$output .= ' selected ';} $output .=' value="2">Februarie</option>
	<option '; if (date('n') == 3){$output .= ' selected ';} $output .=' value="3">Maart</option>
	<option '; if (date('n') == 4){$output .= ' selected ';} $output .=' value="4">April</option>
	<option '; if (date('n') == 5){$output .= ' selected ';} $output .=' value="5">Mei</option>
	<option '; if (date('n') == 6){$output .= ' selected ';} $output .=' value="6">Juni</option>
	<option '; if (date('n') == 7){$output .= ' selected ';} $output .=' value="7">Juli</option>
	<option '; if (date('n') == 8){$output .= ' selected ';} $output .=' value="8">Augustus</option>
	<option '; if (date('n') == 9){$output .= ' selected ';} $output .=' value="9">September</option>
	<option '; if (date('n') == 10){$output .= ' selected ';} $output .=' value="10">Oktober</option>
	<option '; if (date('n') == 11){$output .= ' selected ';} $output .=' value="11">November</option>
	<option '; if (date('n') == 12){$output .= ' selected ';} $output .=' value="12">December</option>
	</select></td></tr></table>';
$output .= '<table><tr><td width="50%"><div id="showdocuments"><table></table>';

	
$output .= '</div><div id="documentscroller2" style="bottom:0px; width:100px;"></div></td><td width="50%"><div id="themessages"><table></table>';

$output .= '</div><div id="msgscroller" style="bottom:0px; width:100px;"></div></td></tr></table>';




?>
