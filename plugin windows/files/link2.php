<?php 

session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<title>artistmind uploader</title>

<style type="text/css">
	body {
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		color:#333;
		background:url(bg.jpg);
	}
</style>

<script type="text/javascript" > 
<?php
echo 'window.rootuploaddir = "./uploads/";';
if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator'){
	echo 'window.rootuploaddir = "./uploads/users/'. $_SESSION['Id'].'/";';
}

?>

window.currentuploaddir = "";
window.pastcopy = 'false';
window.pastfiles = "";
window.pastsource = "";
window.uploadcounter=0;
window.uploadfilearraylist = [];
window.uploadedfilelist=[];
window.uploading = false;
window.xhr = new XMLHttpRequest();




function uploadchange() {
			window.currentdate = new Date(); 
			var input = document.getElementById("file");
			var ul = document.getElementById("uploadlist");
			
			for (var i = 0; i < input.files.length; i++) {
				var tmparray = [];
				tmparray.file = input.files[i];
				tmparray.dir = window.currentuploaddir;
				window.uploadfilearraylist.push(tmparray);
				
			}
			
			builduploadlist();
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
			if (window.uploading == false){
				window.uploading = true;
				sendRequest();
			}else{
				updatetotalload()
			}
		}
		
function uploadchange2() {
			window.currentdate = new Date(); 
			var input = document.getElementById("map");
			var ul = document.getElementById("uploadlist");
			
			for (var i = 0; i < input.files.length; i++) {
				var tmparray = [];
				tmparray.file = input.files[i];
				tmparray.dir = window.currentuploaddir;
				window.uploadfilearraylist.push(tmparray);
				
			}
			
			builduploadlist();
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
			if (window.uploading == false){
				window.uploading = true;
				sendRequest();
			}else{
				updatetotalload()
			}
		}
function updatetotalload(){
	var BYTES_PER_CHUNK = 1048576;
	 uploadedbytes=0;
	 uploadedstring="";
	 queuebytes=0;
	 queuestring="";
	 totalbytes = 0;
	 totalstring = "";
	if ( window.uploadfilearraylist.length !=0){
		uploadedfilebytes = window.uploadfilearraylist[0].file.fileSize||window.uploadfilearraylist[0].file.size;
	}else{
		uploadedfilebytes = 0;
	}
	uploadedfilestring = ""
	if (uploadedfilebytes > 1024 * 1024){
		uploadedfilestring = (Math.round(uploadedfilebytes  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	}else{
                uploadedfilestring = (Math.round( uploadedfilebytes  * 100 / 1024) / 100).toString() + 'KB';
	}
	for (var i = 0; i < window.uploadedfilelist.length; i++) {
		thefilesize = window.uploadedfilelist[i].file.fileSize||window.uploadedfilelist[i].file.size;
		uploadedbytes= uploadedbytes+ thefilesize;
	}
	if (uploadedbytes > 1024 * 1024){
		uploadedstring = (Math.round(uploadedbytes  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	}else{
                uploadedstring = (Math.round(uploadedbytes  * 100 / 1024) / 100).toString() + 'KB';
	}
	for (var i = 1; i < window.uploadfilearraylist.length; i++) {
		thefilesize = window.uploadfilearraylist[i].file.fileSize||window.uploadfilearraylist[i].file.size;
		queuebytes = queuebytes + thefilesize;
	}
	if (queuebytes > 1024 * 1024){
		queuestring = (Math.round(queuebytes  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	}else{
                queuestring = (Math.round(queuebytes  * 100 / 1024) / 100).toString() + 'KB';
	}
	totalbytes = uploadedbytes + queuebytes + uploadedfilebytes;
	if (totalbytes > 1024 * 1024){
		totalstring = (Math.round(totalbytes  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	}else{
                totalstring = (Math.round(totalbytes  * 100 / 1024) / 100).toString() + 'KB';
	}
	document.getElementById("totalupload").innerHTML = "<b>totalfiles:</b> "+ parseInt(window.uploadfilearraylist.length + window.uploadedfilelist.length)+" files "+totalstring+"<br>";
	document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<b>Uploaded:</b> "+ parseInt(window.uploadedfilelist.length)+" files "+uploadedstring+"<br>";
	document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<b>Queue:</b> "+ parseInt(window.uploadfilearraylist.length -1)+" files "+queuestring+"<br>";
	if (window.uploadfilearraylist.length > 0){
		document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<b>status:</b> "+"Uploading... "+ uploadedfilestring+"<br>";
		if (window.uploadcounter*BYTES_PER_CHUNK > uploadedfilebytes){
					var percentloaded2 = uploadedfilebytes;
		}else{
					var percentloaded2 = parseInt(window.uploadcounter*BYTES_PER_CHUNK);
		}
		
		document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<b>Percent:</b> "+ parseInt(((uploadedbytes+percentloaded2) / totalbytes)*100)+" <br>";
		document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<div id=\"uploadbarback\" style=\"height:10px; width:250px;  solid #000;\"><div id=\"uploadbar\" style=\"height:10px; width:"+parseInt(((uploadedbytes+percentloaded2) / totalbytes)*250)+"px; background-color:green;\"></div></div>" +"<br>";
		document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<div id=\"uploadbarback\" style=\"height:10px; width:250px;  solid #000;\"><div id=\"uploadbar\" style=\"height:10px; width:"+parseInt(((percentloaded2) / uploadedfilebytes)*250)+"px; background-color:green;\"></div></div>" +"<br>";
		
	}else{
		document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML +"<b>status:</b> "+"All files are uploaded <br>";
	}
	document.getElementById("totalupload").innerHTML = document.getElementById("totalupload").innerHTML + "<a href=\"#\" onClick=\"cancelalluploads()\">cancel all</a>";
}

function cancelalluploads(){
	window.xhr.abort();
        window.uploadcounter=0;
	window.uploadfilearraylist = [];
	window.uploadedfilelist=[];
	window.uploading = false;
	window.xhr = new XMLHttpRequest();
	document.getElementById("totalupload").innerHTML = "Uploaded aborted by user";
	builduploadlist();
}
function builduploadlist(){
	var ul = document.getElementById("uploadlist");
	while (ul.hasChildNodes()) {
				ul.removeChild(ul.firstChild);
	}
	if ( window.uploadedfilelist.length >0){
	for (var i = 0; i < window.uploadedfilelist.length; i++) {
		var li = document.createElement("li");
		thefilesize = window.uploadedfilelist[i].file.fileSize||window.uploadedfilelist[i].file.size;
		if (thefilesize > 1024 * 1024){
			thefilesize = (Math.round(thefilesize  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
		}else{
                	thefilesize = (Math.round(thefilesize  * 100 / 1024) / 100).toString() + 'KB';
		}
			
		li.innerHTML = window.uploadedfilelist[i].file.name + " " + thefilesize +"<br>Status:Uploaded";
		ul.appendChild(li);				
	}
	}
	
	if (window.uploadfilearraylist.length >0){
	for (var i = 0; i < window.uploadfilearraylist.length; i++) {
		var li = document.createElement("li");
		thefilesize = window.uploadfilearraylist[i].file.fileSize||window.uploadfilearraylist[i].file.size;
		if (thefilesize > 1024 * 1024){
			thefilesize = (Math.round(thefilesize  * 100 / (1024 * 1024)) / 100).toString() + 'MB';
		}else{
                	thefilesize = (Math.round(thefilesize  * 100 / 1024) / 100).toString() + 'KB';
		}
		
		if (i == 0){
			li.innerHTML = window.uploadfilearraylist[i].file.name + " " + thefilesize +'<br>Status:<div id="progressNumber" style="display:inline"></div>' ;
		}else{	
			li.innerHTML = window.uploadfilearraylist[i].file.name + " " + thefilesize +"<br>Status:Queue" ;
		}
		ul.appendChild(li);				
	}}
}

window.BlobBuilder = window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder;

            function sendRequest() {
		window.curuploadedfilename = window.uploadfilearraylist[0].dir + window.uploadfilearraylist[0].file.name;
                document.getElementById('progressNumber').innerHTML = "Upload: 0 % ";
                window.uploadcounter=0;
		uploadFile(window.curuploadedfilename);
		updatetotalload();
            }

            function uploadFile(filename) {
		var blob = window.uploadfilearraylist[0].file;
		var BYTES_PER_CHUNK = 1048576; // 1MB chunk sizes.
                var SIZE = blob.size;
		var start = BYTES_PER_CHUNK * window.uploadcounter;
                var end = BYTES_PER_CHUNK * (window.uploadcounter + 1);
		var blobFile = blob.slice(start, end);
                var fd = new FormData();
               	fd.append("fileToUpload", blobFile);
		
		
                window.xhr = new XMLHttpRequest();
		
             
                window.xhr.addEventListener("load", uploadComplete, false);
                window.xhr.addEventListener("error", uploadFailed, false);
                window.xhr.addEventListener("abort", uploadCanceled, false);
		
                window.xhr.open("POST", "./system/upload2.php?filename="+filename+".upl");
		
                window.xhr.onload = function(e) {
			window.uploadcounter=window.uploadcounter+1;
			if (start < SIZE){
				uploadFile(window.curuploadedfilename);	
				if (window.uploadcounter*BYTES_PER_CHUNK > SIZE){
					var percentloaded2 = SIZE;
				}else{
					var percentloaded2 = parseInt(((window.uploadcounter*BYTES_PER_CHUNK)/SIZE)*100);
				}
				document.getElementById('progressNumber').innerHTML = ''+percentloaded2+' % ';
				updatetotalload();		                  		
			}else{
				window.uploadcounter = 0;								
				document.getElementById('progressNumber').innerHTML = "File uploaded";
				dorenamefileb(window.curuploadedfilename + ".upl", window.curuploadedfilename, -1);
				window.uploadedfilelist.push(window.uploadfilearraylist[0]);
				window.uploadfilearraylist.shift();
				builduploadlist();
				if (window.uploadfilearraylist.length > 0){
					sendRequest();
					//loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
				} else {
					window.uploading = false;
					updatetotalload();
					str = 'loadXMLDoc("./system/loaddir.php?url='+ window.currentuploaddir + '");';
					setTimeout(str, 100);
					
				}
				
			}
                  };
		
                window.xhr.send(fd);
                
            }

           function uploadComplete(evt) {
                /* This event is raised when the server send back a response */
		if (evt.target.responseText != ""){
                	alert(evt.target.responseText);
		}
            }

            function uploadFailed(evt) {
                alert("There was an error attempting to upload the file.");
            }

            function uploadCanceled(evt) {
                window.xhr.abort();
                window.xhr = null;
                //alert("The upload has been canceled by the user or the browser dropped the connection.");
            }


</script>
<LINK HREF="link.css" REL="stylesheet" TYPE="text/css">

</head>
<body>
<div id="fileselector">
<div id="containerback">

</div>
<div id="dirlijst">
    
</div>


<div id="container">
	<h1>Upload file</h1>
    <br /><div id="html5uploader">
	html 5 detected <br>
	<a href="#" onClick="document.getElementById('oldfasionuploader').style.display = 'block';document.getElementById('html5uploader').style.display = 'none';">Switch to basic uploader</a>
	<div id="totalupload"></div>
	




<input type="file" id="file" multiple name="uploads[]"  multiple="" style="visibility:hidden" onChange="uploadchange();">

<table><tr><td><a href="#" onClick="document.getElementById('file').click();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/upload.png" alt="upload file"></a></td><td>
</td></tr></table>
 <div id="uploadlist">

</div>

 </form></div>

<div id="oldfasionuploader">
	<a href="#" onClick="document.getElementById('oldfasionuploader').style.display = 'none';document.getElementById('html5uploader').style.display = 'block';">Switch to html 5 uploader</a>
	<iframe frameborder="0" width="250" height="500"  src="link3.html">your browser does not support iframe</iframe>
</div>
<script type="text/javascript" > 
	var browserIsSupported = !!window.FileReader;
	if (browserIsSupported){
		document.getElementById('oldfasionuploader').style.display = 'none';
	} else {
		document.getElementById('html5uploader').style.display = 'none';
	}
</script>
</div>
<div id="directory">
	
	
</div>

<div id="directorywindow">
	Naam directory <input type="text" name="Directorynaam" id="Directorynaam" value="" size="15" border="0"><br>
	<table><tr><td>
	<table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onClick="createdir2();return false">create directory</a>
          </div></td>
        </tr>
      </table></td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onClick="canceldir();return false">Cancel</a>
          </div></td>
        </tr>
      </table> </td></tr></table>
</div>

<div id="Renamewindow">
	nieuw naam <input type="hidden" name="oldnieuwfilenaam" id="oldnieuwfilenaam" value="" size="15" border="0"><input type="text" name="nieuwfilenaam" id="nieuwfilenaam" value="" size="15" border="0"><br>
<table><tr><td>
	<table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onClick="dorenamefile();return false">oke</a>
          </div></td>
        </tr>
      </table></td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
           <a href="#" onClick="cancelrename();return false">Cancel</a>
          </div></td>
        </tr>
      </table> </td></tr></table>
	 
</div>

<div id="imageresizewindow">
	<input type="hidden" name="imageresizefilenaam" id="imageresizefilenaam" value="" size="15" border="0"><img src="" naam="imageresizetumb" id="imageresizetumb"><br>
<table><tr><td>
	Maximum size in pixels</td><td><input type="text" id="maximgsize" name="maximgsize" value="150" size="30" border="0" ></td></tr><tr><td>
	<table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="#" onClick="doresizeimage();return false">Resize</a> 
          </div></td>
        </tr>
      </table></td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
           <a href="#" onClick="cancelresizeimage();return false">Cancel</a>
          </div></td>
        </tr>
      </table> </td></tr></table>
	  
</div></div>

<script type="text/javascript">

function cutfiles()
{
	totalfiles = parseInt(document.getElementById('totalfiles').value);
	ii = 0;
	params = "command=bogus=bogus&sourcedir="+window.currentuploaddir +"&" ;
	
	for (i=2;i<totalfiles+2;i++)
	{	
		
		if (document.getElementById('fileid'+i).checked == true){
			ii++;
			params = params +'file'+ii+'='+ document.getElementById('filename'+i).value + "&";
		}
		
	}
	window.pastsource = window.currentuploaddir;
	window.pastcopy = 'false';
	window.pastfiles = params + "totalfile="+ii;
	
	
}

function copyfiles()
{
	totalfiles = parseInt(document.getElementById('totalfiles').value);
	ii = 0;
	params = "command=bogus=bogus&sourcedir="+window.currentuploaddir +"&" ;
	
	for (i=2;i<totalfiles+2;i++)
	{	
		
		if (document.getElementById('fileid'+i).checked == true){
			ii++;
			params = params +'file'+ii+'='+ document.getElementById('filename'+i).value + "&";
		}
		
	}
	window.pastsource = window.currentuploaddir;
	window.pastcopy = 'true';
	window.pastfiles = params + "totalfile="+ii;
	
}

function downloadfilesf()
{
	
	totalfiles = parseInt(document.getElementById('totalfiles').value);
	ii = 0;
	params = "command=bogus=bogus&sourcedir="+window.currentuploaddir +"&" ;
	
	for (i=2;i<totalfiles+2;i++)
	{	
		
		if (document.getElementById('fileid'+i).checked == true){
			ii++;
			params = params +'file'+ii+'='+ document.getElementById('filename'+i).value + "&";
		}
		
	}
	params  = params + "totalfile="+ii;
	
	
	document.getElementById('directory').style.display = 'block';
	params = params + "&destinationdir="+window.currentuploaddir+'&pastcopy='+window.pastcopy;
	var xmlhttppast;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppast=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppast=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppast.onreadystatechange=function()
  	{
		if (xmlhttppast.readyState==4 && xmlhttppast.status==200)
   		 {
			window.pastfiles = "";
			alert ('download.zip has been created');
			document.getElementById('directory').style.display = 'none';				
			loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
		}
	 }
	xmlhttppast.open("POST","./system/downloadfiles.php");
	xmlhttppast.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppast.setRequestHeader("Content-length", params.length);
	xmlhttppast.setRequestHeader("Connection", "close");
	xmlhttppast.send(params);
	
}

function pastfilesf()
{
	
	if (window.pastfiles.length ==0){
		alert("Nothing to past");
		exit
	} 

	if (window.pastsource == window.currentuploaddir){
		alert("Destination directory and source directory are the same");
		exit
	}

	
	
	document.getElementById('directory').style.display = 'block';
	
	params = window.pastfiles;
	params = params + "&destinationdir="+window.currentuploaddir+'&pastcopy='+window.pastcopy;
	var xmlhttppast;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppast=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppast=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppast.onreadystatechange=function()
  	{
		if (xmlhttppast.readyState==4 && xmlhttppast.status==200)
   		 {
			window.pastfiles = "";
			
			document.getElementById('directory').style.display = 'none';				
			loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
		}
	 }
	xmlhttppast.open("POST","./system/past.php");
	xmlhttppast.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppast.setRequestHeader("Content-length", params.length);
	xmlhttppast.setRequestHeader("Connection", "close");
	xmlhttppast.send(params);
	
}

function createdir()
{
		document.getElementById('directory').style.display = 'block';
		document.getElementById('directorywindow').style.display = 'block';
}

function canceldir()
{
		document.getElementById('directory').style.display = 'none';
		document.getElementById('directorywindow').style.display = 'none';
}

function createdir2()
{
	dirnaam = document.getElementById('Directorynaam').value;
	dirnaam = dirnaam.replace('\''," ");
	dirnaam = dirnaam.replace('"'," ");
	//dirnaam = dirnaam.replace('\\'," ");
	//dirnaam = dirnaam.replace('/'," ");
	dirnaam = dirnaam.replace('?'," ");
	dirnaam = dirnaam.replace('-'," ");
	params = "command=bogus=bogus&" ;
	params = params + "dirnaam="+dirnaam+"&";
	params = params + "destinationdir="+window.currentuploaddir;

	var xmlhttpcreatedir;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpcreatedir=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpcreatedir=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpcreatedir.onreadystatechange=function()
  	{
		if (xmlhttpcreatedir.readyState==4 && xmlhttpcreatedir.status==200)
   		 {
			document.getElementById('directory').style.display = 'none';
			document.getElementById('directorywindow').style.display = 'none';			
			loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
		}
	 }
	xmlhttpcreatedir.open("POST","./system/createdir.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
	
}

function setdir(url)
{
	window.currentuploaddir = window.currentuploaddir + url+"/";	
	
	loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);	
}
function domultifilemanager(){
	totalfiles = parseInt(document.getElementById('totalfiles').value);
	files = new Array();
	for (i=2;i<totalfiles+2;i++)
	{	
		if (document.getElementById('fileid'+i).checked == true){
			files.push(window.rootuploaddir+window.currentuploaddir + document.getElementById('filename'+i).value);
			
		}
		
	}
	
	parent.domultifilemanager (files);
}

function selectallfiles()
{
	totalfiles = parseInt(document.getElementById('totalfiles').value);

	for (i=2;i<totalfiles+2;i++)
	{	
		document.getElementById('fileid'+i).checked = true;
		
	}
}

function deselectallfiles()
{
	totalfiles = parseInt(document.getElementById('totalfiles').value);

	for (i=2;i<totalfiles+2;i++)
	{	
		document.getElementById('fileid'+i).checked = false;
		
	}
}

function deletefiles()
{
	
	totalfiles = parseInt(document.getElementById('totalfiles').value);
	ii = 0;
	params = "command=bogus=bogus&" ;
	
	for (i=2;i<totalfiles+2;i++)
	{	
		
		if (document.getElementById('fileid'+i).checked == true){
			ii++;
			params = params +'file'+ii+'='+ window.currentuploaddir + document.getElementById('filename'+i).value + "&";
		}
		
	}
	
	params = params + "totalfile="+ii;
	if (confirm("Do you whant to delete files?")) { 
 // do things if OK

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
			
			loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
		}
	 }
	xmlhttpdel.open("POST","./system/delfile.php");
	xmlhttpdel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpdel.setRequestHeader("Content-length", params.length);
	xmlhttpdel.setRequestHeader("Connection", "close");
	xmlhttpdel.send(params);
}
	
}

function updir()
{
	
	counter = 0;
	for (i=window.currentuploaddir.length;i>0;i--)
	{
		if(window.currentuploaddir.substring( i-1 ,i )=="/"){
			counter = counter +1;
			if (counter == 2){
				
				window.currentuploaddir = window.currentuploaddir.substring (0,i);
				
				loadXMLDoc("loaddir.php?url="+ window.currentuploaddir);
				break;
			}
		} 
		if (i == 1){
			
			window.currentuploaddir = "";
		}
	}
	
	loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);	
}
function dorenamefile (){
	dorenamefileb (window.currentuploaddir+document.getElementById('oldnieuwfilenaam').value, window.currentuploaddir+document.getElementById('nieuwfilenaam').value);
}
function dorenamefileb(oldfilename, newfilename, update){

	newfilename = newfilename.replace('\'',"");
	newfilename = newfilename.replace('"',"");
	newfilename = newfilename.replace('<',"");
	newfilename = newfilename.replace('>',"");
	newfilename = newfilename.replace('?',"");
	newfilename = newfilename.replace('-',"");
	params = "command=bogus=bogus&" ;
	params = params + "oldnieuwfilenaam="+oldfilename+"&";
	params = params + "nieuwfilenaam="+newfilename;

	var xmlhttpcreatedir;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpcreatedir=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpcreatedir=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpcreatedir.onreadystatechange=function()
  	{
		if (xmlhttpcreatedir.readyState==4 && xmlhttpcreatedir.status==200)
   		 {		
				
			document.getElementById('directory').style.display = 'none';
			document.getElementById('Renamewindow').style.display = 'none';	
			if (update != -1){
				loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
			}
		}
	 }
	xmlhttpcreatedir.open("POST","./system/rename.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
}

function renamefile(i){
	document.getElementById('oldnieuwfilenaam').value = document.getElementById('filename'+i).value;
	document.getElementById('nieuwfilenaam').value = document.getElementById('filename'+i).value;
	document.getElementById('directory').style.display = 'block';
	document.getElementById('Renamewindow').style.display = 'block';
	
}

function cancelrename(){
	document.getElementById('directory').style.display = 'none';
	document.getElementById('Renamewindow').style.display = 'none';
	
}

function doresizeimage(){
	width= document.getElementById("maximgsize").value;
	params = "command=bogus=bogus&" ;
	params = params + "image="+window.currentuploaddir+document.getElementById('imageresizefilenaam').value+"&";
	params = params + "width="+width;

	var xmlhttpcreatedir;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpcreatedir=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpcreatedir=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpcreatedir.onreadystatechange=function()
  	{
		if (xmlhttpcreatedir.readyState==4 && xmlhttpcreatedir.status==200)
   		 {				
			document.getElementById('directory').style.display = 'none';
			document.getElementById('imageresizewindow').style.display = 'none';			
		}
	 }
	
	xmlhttpcreatedir.open("POST","./system/imageresize.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
	
}

function resizeimage(i){
	document.getElementById('imageresizetumb').src = './system/imgtumb.php?url='+window.rootuploaddir+window.currentuploaddir+document.getElementById('filename'+i).value;
	document.getElementById('imageresizefilenaam').value = document.getElementById('filename'+i).value;
	document.getElementById('directory').style.display = 'block';
	document.getElementById('imageresizewindow').style.display = 'block';
	
}

function cancelresizeimage(){
	document.getElementById('directory').style.display = 'none';
	document.getElementById('imageresizewindow').style.display = 'none';
	
}

function loadXMLDoc(url)
{

var xmlhttp;
var txt,xx,x,i;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	x=xmlhttp.responseXML.documentElement.getElementsByTagName("stat");
	for (i=0;i<x.length;i++)
	{
		if (x[i].firstChild.nodeValue == "Logged out"){
			alert("You can not use this page because you ar not logged in");
		}
	}
    txt="<h1>"+window.rootuploaddir + window.currentuploaddir + '</h1><br>';
	txt= txt + '<a href="#" onClick="loadXMLDoc(\'./system/loaddir.php?url=\'+ window.currentuploaddir);return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/refresh.png" alt="refresh"></a> <a href="#" onClick="selectallfiles();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/selectall.png" alt="select all"></a> <a href="#" onClick="deselectallfiles();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/deselectall.png" alt="deselect all"></a> <a href="#" onClick="deletefiles();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/Delete.png" alt="delete files"></a> <a href="#" onClick="createdir();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/creatdir.png" alt="creat directory"></a> <a href="#" onClick="cutfiles();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/cut.png" alt="cut files"></a> <a href="#" onClick="copyfiles();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/copy.png" alt="copy files"></a> <a href="#" onClick="pastfilesf();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/past.png" alt="past file"></a> <a href="#" onClick="downloadfilesf();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/createzip.png" alt="zip current folder"></a><a href="#" onClick="domultifilemanager();return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/add.png" alt="add"></a><br>';
	txt= txt + '<table border="0"><tr><td></td><td></td><td></td><td></td></tr>';
 	

    x=xmlhttp.responseXML.documentElement.getElementsByTagName("dir");
    if (window.currentuploaddir.length == 0){

	}else{
  		i =1;
		txt= txt + '<tr><td></td><td><a href="#" onClick="updir();return false"> dir</a></td><td><a href="#" onClick="updir();return false">' + x[i].firstChild.nodeValue + "</a></td><td></td></tr>";
		
	}
	 for (i=2;i<x.length;i++)
    	  {
	     	   txt= txt + '<tr><td><input type="hidden" name="filename'+i+'" id="filename'+i+'" value="'+x[i].firstChild.nodeValue+'"><input type="checkbox" name="fileid'+i+'" id="fileid'+i+'"/> </td><td><a href="#" onClick="setdir(\'' + x[i].firstChild.nodeValue + '\');return false"> dir</a></td><td><a href="#" onClick="setdir(\'' + x[i].firstChild.nodeValue + '\');return false">' + x[i].firstChild.nodeValue + '</a></td><td><a href="#" onClick="renamefile('+i+');return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/rename.png" alt="rename"></a></td></tr>';
    	  }
	xlength = x.length;
    x=xmlhttp.responseXML.documentElement.getElementsByTagName("file");
	for (i=0;i<x.length;i++)
      {
	txt =txt + '<tr><td><input type="hidden" name="filename'+(i+xlength)+'" id="filename'+(i+xlength)+'" value="'+x[i].firstChild.nodeValue+'"><input type="checkbox" name="fileid'+(i+xlength)+'" id="fileid'+(i+xlength)+'"/> </td>';
	filetype = x[i].firstChild.nodeValue.substring(x[i].firstChild.nodeValue.length-3 , x[i].firstChild.nodeValue.length);
	filetype = filetype.toLowerCase();
	if ( filetype == "jpg" || filetype == "gif" || filetype == "png"){
 		txt=txt + "<td>"+'<img src="../../system/imgtumb.php?url='+window.rootuploaddir + window.currentuploaddir+x[i].firstChild.nodeValue+'">'+'</td><td><a href="#" onClick="parent.dofilemanager(\''+window.rootuploaddir+window.currentuploaddir+x[i].firstChild.nodeValue+'\');return false">' + x[i].firstChild.nodeValue + '</a></td><td><a href="#" onClick="renamefile('+(i+xlength)+');return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/rename.png" alt="rename"></a></td><td><a href="../../system/fileopen2.php?url='+window.rootuploaddir + window.currentuploaddir+x[i].firstChild.nodeValue+'" target="_new"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/view.png" alt="view file"></td><td><a href="#" onClick="resizeimage('+(i+xlength)+');return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/resize.png" alt="resize image"></a></td></tr>';
	}else{
        	txt=txt + "<td>"+filetype+"</td><td>"+'<a href="#" onClick="parent.dofilemanager(\''+window.rootuploaddir+window.currentuploaddir+x[i].firstChild.nodeValue+'\');return false">' + x[i].firstChild.nodeValue + "</a></td>"+'<td><a href="#" onClick="renamefile('+(i+xlength)+');return false"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/rename.png" alt="rename"></a></td><td><a href="../../system/fileopen2.php?url='+window.rootuploaddir + window.currentuploaddir+x[i].firstChild.nodeValue+'" target="_new"><img src="../../<?php echo $_SESSION['Theme']; ?>iconfilemanager/view.png" alt="view file"></td></tr>';
	}

      }

       txt=txt + '</table><input type="hidden" name="totalfiles" id="totalfiles" value="'+(x.length+xlength-2)+'">total files: '+(x.length+xlength-2)+' waarvan '+(xlength-2)+' directorys';
	
    document.getElementById('dirlijst').innerHTML=txt;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);

</script>

