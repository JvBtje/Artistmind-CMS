<?php
// Init session settings
include("DB.php");
$type = $_GET["type"]; 
$MainId = intval($_GET["Id"]);
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("system/include.php");

session_start();
	$url = curPageURL();
	$myUrl = explode("/", curPageURL());
if ($_SESSION['newsessionany'] != 10 ){

	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}
// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
$_SESSION['Accesfiles2']= array();
// header settings
// header

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
<script type="text/javascript" src="./system/gallery.js"></script>
<script language="javascript">
themeurl = "'.$_SESSION['Theme'].'";



function domultifilemanager (link){
	
	if (window.elementvar.substr(0,3) == "msg"){
		for (i=0;i<link.length;i++)
		{			
			addmsgnewfile(link[i],window.elementvar)			
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
	document.getElementById(\'filelinker\').src = \'./itemenfile.php\';
	
	window.elementvar = elementvar;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'filemanager\').style.display = \'block\';
}
function hidefilemanager(){	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'filemanager\').style.display = \'none\';
}
</script>
<script language="javascript">
window.galleryimages = new Array();

function resizeframe(){	
	
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.scrollWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.scrollHeight || root.clientHeight || body.clientHeight ;

	
	    realWidth = parseInt(realWidth) - 70;
	realHeight =  parseInt(realHeight) - 120;
    document.getElementById("filelinker").style.height = realHeight + \'px\';
    document.getElementById("filelinker").style.width = realWidth + \'px\';
	
	if (window.curgalleryimg != -1){
     	 realWidth = parseInt(realWidth) + 70 ;
	 realHeight =  parseInt(realHeight) + 120;
	
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

function layerActie(divID,ImgId) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
	  document.getElementById(ImgId).src = "./iconen/mapje.png";
   } else {
   
      document.getElementById(divID).style.display="none";
	  document.getElementById(ImgId).src = "./iconen/mapje-dicht.png";
	  
   }
}
function window_onload(){
	
}
function window_onunload(){

}
function changeval(){	
	
}
function submitform(){
	
	
	document.form1.submit();
}
</script>';

include "header.php";
echo '<div id="Middel">';

	
$banner = "";

$found = false;
$acces = false;
if ($type == "select"){
	//echo $MainId;
	$query = "SELECT Id, Bericht, Stat, Username, ParentType, ParentMainId, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE MainId=".$MainId." and (Stat='normal' OR Stat='deleted')";

	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	
	$found = true;
		$msgtype = $row["ParentType"];
		$Bericht = $row["Bericht"];
		$ParentMainId = $row["ParentMainId"];
		//echo $ParentMainId;
		$Stat = $row['Stat'];
		$Bericht = str_replace ('<', "&lt;",$Bericht);
		$Bericht = str_replace('>', "&gt;",$Bericht);
		$MainId = $row['MainId'];
		$Filelist = $row['Filelist'];
		$UserId =  $row['UserId'];
		$TheDate = $row['TheDate'];
		$Username = $row['Username'];
		$Id = $row['Id'];
		if ($MainId != ""){
			if ($msgtype == "submessage"){
				$MainId = $row["ParentMainId"];
				$query2 = "SELECT Id, Bericht, Stat, Username, ParentType, ParentMainId, MainId, UserId, DATE_FORMAT(DATE_SUB(TheDate, INTERVAL '-0 0:00:00' DAY_SECOND),'%Y-%m-%d  %T ')AS TheDate, Filelist FROM reply WHERE  MainId=".$MainId." and (Stat='normal' OR Stat='deleted' )";

				$result2 = mysqli_query($link,$query2);
				if (!$result2) {
				die('Query failed: ' . mysqli_error($link));
				}
				while($row2 = mysqli_fetch_array($result2)){
					$msgtype = $row2["ParentType"];
					$Bericht = $row2["Bericht"];
					$ParentMainId = $row2["ParentMainId"];
					$Stat = $row['Stat'];
					$Bericht = str_replace ('<', "&lt;",$Bericht);
					$Bericht = str_replace('>', "&gt;",$Bericht);
					$MainId = $row2['MainId'];
					$Filelist = $row2['Filelist'];
					$UserId =  $row2['UserId'];
					$TheDate = $row2['TheDate'];
					$Username = $row2['Username'];
					$Id = $row2['Id'];
				}
			}
			switch ($msgtype){
			case "user":
			case "privatemessage":
				$acces = accesprofile ($ParentMainId, $_SESSION["Id"]);	
				if ($row['ParentType'] =="privatemessage"){
				if ((intval($ParentMainId) == intval($_SESSION["Id"]) or intval($UserId) == intval($_SESSION["Id"]))){
				
				}else{
					$acces = false;
				}}
				break;
			case "usergroup":
				$acces = accesgroup ($ParentMainId, $_SESSION["Id"]);
				break;
			case "richtext":
			case "photogallery":
				
				$acces = accesdocumentMessages($ParentMainId,array(), $_SESSION["Id"]);
				break;
		}}
		
	}
}

function ParentMainIdtoUrl($ParentMainId, $ParentType){
	$Url = "";
	$Hyrargie = findId($ParentMainId, array());
		
		if ($ParentType == "richtext"){
			$Url ='<a href="richtext-'.$Hyrargie[0].'-'.$ParentMainId.'- .html">Message at Document</a>';
		}else if ($ParentType == "photogallery"){
			$Url = '<a href="photogallery-'.$Hyrargie[0].'-'.$ParentMainId.'- .html">Message at Document</a>';
		}else if ($ParentType == "form"){
			$Url = '<a href="Form-'.$Hyrargie[0].'-'.$ParentMainId.'- .html">Message at Document</a>';
		}else if ($ParentType == "usergroup"){
			$Url = '<a href="Users.php?type=Group&Id='.$ParentMainId.'">Message at Usergroup</a>';
		}else if ($ParentType == "user"){
			$Url = '<a href="Users.php?type=Profile&Id='.$ParentMainId.'">Message at User profile</a>';
		}else if ($ParentType == "privatemessage"){
			$Url = '<a href="Users.php?type=Messages&Id='.$ParentMainId.'">Private message from user</a>';
		}
		
	return $Url;
}

if ($acces == true and $found == true){

			echo ParentMainIdtoUrl($ParentMainId,$msgtype);
			$msgview = true;
			$msgpost = false;
			$msgtypeid = $MainId;
			$submsgtypeid = $ParentMainId;
			$submsgtype = $msgtype;
			$msgtype = "1message";		
		
		echo '<br><br>';
		
} else if ($acces == false ){
		echo '		<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
}
		
   include "footer.php";

  ?>
</div>
<?php
echo '<div id="gallerybuttons" name="gallerybuttons" style="position:fixed; left:0px; top:0px; right:0px; bottom:0px; overflow:hidden; display:none; z-index:100;">
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

<div name="directory" id="directory" onclick="closeeditimg();return false"></div> 
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
</div>
<div name="filemanager" id="filemanager"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">File Manager</font></b>  <a href="#" onclick="hidefilemanager();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker" id="filelinker" onload="resizeframe()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>
';

echo '<script language="javascript">resizeframe()</script>';
// menu
/*if ($type== "select"){
$result = mysqli_query($link,"SELECT Id, Language FROM news WHERE MainId =".$MainId);
	$Language_Array = array();
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false; 
	while($row = mysqli_fetch_array($result)){
		$Present_Language[count($Present_Language)] = $row['Language'];
	}
}*/


$languase = 1;
include "menu.php";

?>
