<?php



$output .= '

<script language="javascript">
window.updatertimer =setTimeout("",0);
window.updatingmsg = false;
window.msgnewgalleryimg = new Array();';
	$output .= '
	window.msgtypeid = '.$msgtypeid.';
	window.msgtype = "'.$msgtype.'";
	window.submsgtype = "'.$submsgtype.'";
	window.submsgtypeid = "'.$submsgtypeid.'";';

$output .= '
window.msgloading = false;
window.msgendreached = false;
window.themessage = 0;
window.thehismessage = -2;
window.last10msg = "";
imgdetail = 0;

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
			
			switch (filetype.toLowerCase()){
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


function deletemsgfile (filelist, filenum){
	newfilelist = "";
	
	if (filelist.length > 0){
		filelist = filelist.split("<li>");
		
		for (var i=1; i<filelist.length; i++){
			if (i != filenum){
				newfilelist = newfilelist + "<li>"+filelist[i]
			}
		}		
	}
	return newfilelist
}
function updatemessage2(themessage, filelistname, gallery, outputmsg,edit, name=""){
	
	clearTimeout(window.updatertimer);
	window.updatertimer = setTimeout("updatemessage(\'"+themessage+"\', \'"+filelistname+"\', "+gallery+", \'"+outputmsg+"\',"+edit+",\'"+name+"\')", 1000);
}

function updatemessage(themessage, filelistname, gallery, outputmsg, edit, name=""){	
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
	thename="";
	thename2="";
	
	if (name !=""){ 
		if (document.getElementById(name).value){
			thename = document.getElementById(name).value;
			thename2="msgtitle";
		}else if(document.getElementById(name).innerHTML){
			thename = document.getElementById(name).innerHTML;
			thename2="msgtitle";
		}
	}
	
	//connectiontype = str.substring(connectiontype.length-6,connectiontype.length-1);
	
	//alert(connectiontype);
	thename = thename.replace(/</gi, "&lt;");
	thename = thename.replace(/>/gi, "&gt;");
	thename = thename.replace(/\(/gi, "&#40;");
	thename = thename.replace(/\)/gi, "&#41;");
	thename = thename.replace(/\n/gi,"<br />");
	
	str = str.replace(/<wbr>/gi, "%wbr%");
	str = str.replace(/</gi, "&lt;");
	str = str.replace(/>/gi, "&gt;");
	str = str.replace(/\(/gi, "&#40;");
	str = str.replace(/\)/gi, "&#41;");
	str = str.replace(/\n/gi,"<br />");
	
	str = str.replace(/&lt;code&gt;/gi, "<pre class=\"prettyprint\">");
	str = str.replace(/&lt;\/code&gt;/gi, "</pre>");
	str = str.replace(/(\b(https:\\/\\/|http:\\/\\/|ftp:\\/\\/|file:\\/\\/|www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,\'<a href="$1" target="_blank">$1</a>\');
	str = str.replace(/((\\.\\/)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,"<a href=\'$1\' target=\'_blank\'>$1</a>");  	
	if (location.protocol == \'https:\'){
		str = str.replace(/(\b(www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,"https://$1");		
	}else{
		str = str.replace(/(\b(www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\\/%=~_|])/ig,"http://$1"); 		
	}
	str = str.replace(/https:\\/\\/https:\\/\\//gi,"https://");
	str = str.replace(/http:\\/\\/http:\\/\\//gi,"http://"); 
	str = str.replace(/ftp:\\/\\/ftp:\\/\\//gi,"ftp://"); 
	str = str.replace(/file:\\/\\/file:\\/\\//gi,"file://"); 
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
						strtmp = strtmp +\'<div id="gallerybut"><a href="#" onClick="document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML=deletemsgfile(document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML,\'+i+\'); updatemessage(\\\'\'+themessage+\'\\\', \\\'\'+filelistname+\'\\\',\'+gallery+\',\\\'\'+outputmsg+\'\\\',true,\\\'\'+thename2+\'\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete message"></a></div> \'
					}
					str = str+strtmp+"</div>"
					
					galleryid++
				break;
				default:
					filename = \'<div style="vertical-align:middle;text-align:center; width:100px; display:inline-block;overflow:hidden;margin:10px"><a href="./system/fileopen2.php?url=\'+filelist[i]+\'" target="_blank">\'+filename + \'</a> \'
					if (edit == true){
						filename = filename+\'<br><div id="gallerybut"><a href="#" onClick="document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML=deletemsgfile(document.getElementById(\\\'\'+filelistname+\'\\\').innerHTML,\'+i+\'); updatemessage(\\\'\'+themessage+\'\\\', \\\'\'+filelistname+\'\\\',\'+gallery+\',\\\'\'+outputmsg+\'\\\',true,\\\'\'+thename2+\'\\\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="delete message"></a></div> \'
					}
					str = str+filename+"</div>"
				break;
			}
		}
		
		
	}	
	str = textWrap (str);
	document.getElementById(outputmsg).innerHTML = \'<h1>\'+thename+\'</h1>\'+str;

}

function Enablechangemsg (msgnumber){
	document.getElementById("editmsgdiv"+msgnumber).style.display = \'block\';
	document.getElementById("msg"+msgnumber).style.display = \'none\';
	updatemessage(\'editmsg\'+msgnumber,\'msgfilelist\'+msgnumber,msgnumber,\'previewmessage\'+msgnumber,true)
	
}

function DeleteMessage (theId){
	answer = confirm("Weet je zeker dat je dit bericht wilt verwijderen")

if (answer !=0) { 
	ajaxObj=new Object();
	ajaxObj.msgid = theId;
	if (window.msgtype == "1message"){
		ajaxObj.msgtypeid = window.submsgtypeid 
		ajaxObj.msgtype = window.submsgtype;
	}else{
		ajaxObj.msgtypeid = window.msgtypeid;
		ajaxObj.msgtype = window.msgtype;
	}

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
					var msgtype = \''.$msgtype.'\';
					var msgid = \''.$msgtypeid.'\';
					var sectie = \''.$sectie.'\';
				if (x == "message saved"){
					amount = window.themessage
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessage(window.themessage,amount)", 5);	
					if (msgtype == "forum"){
						location.reload(); 
					}					
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
function RecoverMessage (theId){
	answer = confirm("Weet je zeker dat je dit bericht wilt recoveren")

if (answer !=0) { 
	ajaxObj=new Object();
	ajaxObj.msgid = theId;
	if (window.msgtype == "1message"){
		ajaxObj.msgtypeid = window.submsgtypeid 
		ajaxObj.msgtype = window.submsgtype;
	}else{
		ajaxObj.msgtypeid = window.msgtypeid;
		ajaxObj.msgtype = window.msgtype;
	}
	
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
					var msgtype = \''.$msgtype.'\';
					var msgid = \''.$msgtypeid.'\';
					var sectie = \''.$sectie.'\';
		
				if (x == "message saved"){
					amount = window.themessage
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessage(window.themessage,amount)", 5);
					if (msgtype == "forum"){
						location.reload(); 
					}					
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

function postmessage(message, msgid, stat, filelist, gebruikersnaam, email, secretcode,msgtitle="")
{		
	ajaxObj=new Object();
	
	if (window.msgtype == "1message"){
		ajaxObj.msgtypeid = window.submsgtypeid 
		ajaxObj.msgtype = window.submsgtype;
	}else{
		ajaxObj.msgtypeid = window.msgtypeid;
		ajaxObj.msgtype = window.msgtype;
	}
	ajaxObj.message = message;
	ajaxObj.gebruikersnaam = gebruikersnaam;
	ajaxObj.filelist = filelist;
	ajaxObj.email = email;
	ajaxObj.secretcode = secretcode;
	ajaxObj.msgid = msgid;
	ajaxObj.stat = stat;
	ajaxObj.msgtitle = msgtitle;
	
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
				var msgtype = \''.$msgtype.'\';
				var msgid = \''.$msgtypeid.'\';
				var sectie = \''.$sectie.'\';
				var MainId = \''.$MainId.'\';
				if (x == "message saved"){
		
					amount = window.themessage
					window.msgloading = false;
					window.msgendreached = false;
					window.themessage = 0;
					//document.getElementById(\'themessages\').innerHTML = \'<table cellspacing="10"></table>\';
					window.msgtimer = setTimeout("loadmessage(window.themessage,amount)", 5);
					//if (msgid == "new" && msgtype != "forum"){
						document.getElementById(\'newmessage\').value="";
						document.getElementById(\'previewmessage\').innerHTML = "";
						document.getElementById(\'msgnewfilelist\').innerHTML = "";
					//}
					
				}else{
					alert (x);
				}
				if (msgtype == "forum"){
					if (msgid == "new"){
						setTimeout("window.open(\'forum-"+sectie+"-"+msgid+"-undefined.html\',\'_self\',\'\',\'true\')", 0);
					}else{
						setTimeout("window.open(\'forum-"+sectie+"-';if(isset($tmpMainidtje)){$output .=$tmpMainidtje;}$output .='-undefined.html\',\'_self\',\'\',\'true\')", 0);
					}
				}else{
					refreshingmessage();
				}
		}
		 
	 }
	
	xmlhttppostmessage.open("POST","./system/messagepost.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
	
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

function openhistory(id){
	if (document.getElementById(id).style.display == "block"){
		document.getElementById(id).style.display = "none"
	}else{
		document.getElementById(id).style.display = "block"
	}
}
/*function checknewmsg()
{
	clearTimeout(window.msgtimer2)
	msgnumber = 0;
	
	if (checkvisible(document.getElementById(\'msgscrollernew\'))){
	
	//window.msgloading = true;
	
	ajaxObj=new Object();
	ajaxObj.msgnumber = msgnumber;
	ajaxObj.msgtypeid = window.msgtypeid;
	ajaxObj.msgtype = window.msgtype;
	
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
			//alert (xmlhttppostmessage.responseText);
			
			if (xmlhttppostmessage.responseText == "the end"){
				window.msgendreached = true;
				document.getElementById(\'themessages\').innerHTML = document.getElementById(\'themessages\').innerHTML.substr(0,document.getElementById(\'themessages\').innerHTML.length-8) +  "<tr><td></td><td>No more message</td></tr></table>";
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
				
			//	alert (xmlhttppostmessage.responseText)
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
				
				window.msgtimer = setTimeout("loadmessage(window.themessage)", 5);
				}
				
			}
			clearTimeout(window.msgtimer2)
			window.msgtimer2 = setTimeout("checknewmsg()", 1000);
			window.msgloading = false;	
			
		
	 }
	
	xmlhttppostmessage.open("POST","./system/messageload.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
	}else{
		window.msgtimer2 = setTimeout("checknewmsg()", 1000);
	}
}*/


function loadmessage(msgnumber, theamount)
{	
	
	if (window.msgloading == false && window.msgendreached == false && ((window.msgtype == "1message" && window.themessage == 0)||window.msgtype != "1message")){
	
	if (checkvisible(document.getElementById(\'msgscroller\')) || window.themessage == 0){
	window.msgloading = true;
	
	ajaxObj=new Object();
	ajaxObj.msgnumber = msgnumber;
	ajaxObj.amount = theamount;
	ajaxObj.msgtypeid = window.msgtypeid;
	ajaxObj.msgtype = window.msgtype;
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
	
	xmlhttppostmessage.onreadystatechange = function()
  	{
		
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {
			
			
			if (xmlhttppostmessage.responseText == "the end"){
				window.msgendreached = true;
				document.getElementById(\'themessages\').innerHTML = document.getElementById(\'themessages\').innerHTML.substr(0,document.getElementById(\'themessages\').innerHTML.length-8) +  "<tr><td></td><td>No more message</td></tr></table>";
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
				
			//	alert (xmlhttppostmessage.responseText)
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
				
				window.msgtimer = setTimeout("loadmessage(window.themessage)", 5);
				
				
				
			}
			window.msgloading = false;	
			
		}
	 }
	
	xmlhttppostmessage.open("POST","./system/messageload.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
	}
	}
}
function addmsgnewfile(inputfile, inputfilelist){
	
	document.getElementById(inputfilelist).innerHTML = document.getElementById(inputfilelist).innerHTML +"<li>"+ inputfile+"</li>";
	
	newmsg = inputfilelist.substring(0, 14);
	if (inputfilelist == "msgnewfilelist"){
		if (document.getElementById(\'msgtitle\')){;
		updatemessage(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');	
		}else{
			updatemessage(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true);	
		}			
		//prettyPrint();
	}else if(newmsg == "msgnewfilelist"){
		msgnum = inputfilelist.split("msgnewfilelist");
		msgnum = msgnum[1];
		updatemessage(\'newmessage\'+msgnum, \'msgnewfilelist\'+msgnum,-1,\'previewnewmessage\'+msgnum,true);
	}else{
		msgnum = inputfilelist.split("msgfilelist");
		msgnum = msgnum[1];
		updatemessage(\'editmsg\'+msgnum,\'msgfilelist\'+msgnum,msgnum,\'previewmessage\'+msgnum,true)
		
		//prettyPrint();
	}
	
}
</script>';

if ($msgpost == true){
	if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
	$output .= '';
	$query = 'SELECT Id, Username, Profilepic FROM login WHERE Id ='.$_SESSION['Id'];
	$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$id = $row['Id'];
			$Profilepic = $row['Profilepic'];
			array_push($_SESSION['Accesfiles2'], $Profilepic);
			$output .= '<div id="msgnewfilelist" name="msgnewfilelist" style="display:none"></div><a href="Users.php?type=Profile&Id='.$id.'"><img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="left">'." <b>". $row['Username'].' </b></a><br>'.date("Y-m-d H:i:s").'<br><div id="gallerybut"><a href="#" onClick="showfilemanager(\'msgnewfilelist\');return false"><img src="'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add file"></a></div></div>';
		}
		if($msgname == true){
			$output .= 'title: <input type="text" name="msgtitle" id="msgtitle" size="24" border="0" onkeyup="updatemessage2(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');">';
		}

		if($msgname == true){
				$output .= '<textarea id="newmessage" name="newmessage" style="width: 100%; height: 175px;" onkeyup="updatemessage2(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true,\'msgtitle\');" ></textarea> <br>
	<div id="previewmessage"></div>';
			$output .= '<a href="#" onclick="postmessage(document.getElementById(\'newmessage\').value,  \'new\', \'normal\',document.getElementById(\'msgnewfilelist\').innerHTML,undefined,undefined,undefined,document.getElementById(\'msgtitle\').value );return false;"><div id="buttonlayout"><h4> Post </h4></div></a>';
		}else{
				$output .= '<textarea id="newmessage" name="newmessage" style="width: 100%; height: 175px;" onkeyup="updatemessage2(\'newmessage\', \'msgnewfilelist\',-1,\'previewmessage\',true);" ></textarea> <br>
	<div id="previewmessage"></div>';
			$output .= '<a href="#" onclick="postmessage(document.getElementById(\'newmessage\').value,  \'new\', \'normal\',document.getElementById(\'msgnewfilelist\').innerHTML );return false;"><div id="buttonlayout"><h4> Post </h4></div></a>';
		}
	$output .='</div>';
	}else{
	$output .= '<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
	}
	
}


if ($msgview == true){
$output .= '<div id="msgscrollernew" style="height:100px width:100%"></div>
<div id="themessages"><table cellspacing="10"></table></div><div id="msgscroller" style="height:100px; width:100%;"></div>
<script language="javascript">
	
	window.themessage = 0;
	
	loadmessage(window.themessage);
	window.msgtimer2 = setTimeout("checknewmsg()", 100);
	
	</script>';
	
}



?>
