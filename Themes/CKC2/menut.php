<?php
	//include("system/include.php");
	$CurLang = 'Language';
	$myUrl = explode("?", $url);
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$found = false;
	if (isset($Present_Language)) {
	if(is_array($Present_Language)){
		foreach ($Present_Language as $value) {
			if ($row2['Id'] == $value){
				$found = true;
			}
		}
	}}
	$theurl = explode('lang-', $myUrl[0]);
	//echo $theurl[0];
	$theurl = explode('-', $theurl[0]);
	$theurl2 ="";
	
	for ($i=0; $i < count($theurl) -1; $i++){
		$theurl2 .= $theurl[$i].'-'; 
	}

	$vlag = "";
	if ($row2['Id']	== "7"){
		$vlag ='<img src="Themes/CKC2/iconen/vlag%20Nederland.png">';
	} else if ($row2['Id']	== "8") {
		$vlag ='<img src="Themes/CKC2/iconen/vlag%20Engels.png">';
	}
	//echo 'themyurlcount='.count($myUrl);
	if (count($myUrl) < 2){
		if (count($theurl) < 2){
			$Language_Array[count($Language_Array)] =  '<a href="'.$myUrl[0].'?language_id='.$row2['Id'].'">'.$vlag.'</a>';	
		}else{
		if ($found == true){
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<a href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$vlag.'</a>';		
			}else{
				$Language_Array[count($Language_Array)] =  '<a href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$vlag.'</a>';
			if ($_SESSION['Language'] == $row2['Id']){$CurLang = $row2['Language'];}
			}
		}else{
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<a href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$vlag.'</a>';	
			}else{
				$Language_Array[count($Language_Array)] =  '<a href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$vlag.'</a>';
			}
		}
		}
	} else {
	$myUrllijst = explode("&", $myUrl[1]);
	if (substr($myUrllijst[0],0,12) == "language_id="){
		$myUrllijst2 = array_shift($myUrllijst);
		$myUrl[1] = implode ("&",  $myUrllijst );
	}
		if ($found == true){
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<a href="'.$myUrl[0].'?language_id='.$row2['Id'].'&'.$myUrl[1].'">'.$vlag.'</a>';		
			}else{
				$Language_Array[count($Language_Array)] =  '<a href="'.$myUrl[0].'?language_id='.$row2['Id'].'&'.$myUrl[1].'">'.$vlag.'</a>';
			if ($_SESSION['Language'] == $row2['Id']){$CurLang = $row2['Language'];}
			}
		}else{
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<a href="'.$myUrl[0].'?language_id='.$row2['Id'].'&'.$myUrl[1].'">'.$vlag.'</a>';	
			}else{
				$Language_Array[count($Language_Array)] =  '<a href="'.$myUrl[0].'?language_id='.$row2['Id'].'&'.$myUrl[1].'">'.$vlag.'</a>';
			}
		}
	}
}
	

	
echo '<div id="menuback"> <br></div> ';
if ($_SESSION['TypeUser'] == 'Admin'){
echo '
 <div id="Menustyle_child" style="position:absolute;"><h4 align="left">
		<Table id="subMainmenu" width="150"><tr><td>';
		
		echo '
		<script type="text/javascript">
		function MainMenuswitch(item1)
{
	
	params = "Menu="+item1 ;
	
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
				location.reload()
		}
	 }
	xmlhttpcreatedir.open("POST","./system/changemenu.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
	
	
}
</script>';
		echo '<a href="#" onclick="MainMenuswitch(\'Admin\');return false;">Admin Menu</a><br>';
		echo '<a href="#" onclick="MainMenuswitch(\'Member\');return false;">Member Menu</a><br>';
 		echo '<a href="#" onclick="MainMenuswitch(\'Public\');return false;">Public Menu</a><br>';
	echo '</h4></td>
	</tr></table></div>';
}
echo '<div id="artistmindmenu">';
$submenu = "";
$submenu2 = "";
$floatmenu = "";
$mobilemenu = "";
echo '<table width="100%" height="34" align="right" id="table"><tr>';
if ($_SESSION['TypeUser'] == 'Admin'){
echo'
<td ><div  id="Menustyle" style="text-align:left; top:-6px; position:relative;"><div id="menubut"><h4><img src="./system/systemicon/menubut.png"></h4></div>

          </div>
      </td>
      <td>
	 
	<script type="text/javascript">at_attach("Menustyle", "Menustyle_child", "hover", "y", "pointer","");</script>';
	}
	$mobilemenu .= ''; if ($_SESSION['TypeUser'] == 'Admin'){$mobilemenu .=  '<div  id="parentmobadminmobmenu" style="padding:5px;"><a href="#" onClick="layerActiesubmenumob(\'adminmobmenu\');return false"><div id="menubutmob"><h4><img src="./system/systemicon/menubut.png"></h4></a></div></div>';}
	$floatmenu .= '<table width="100%" height="34" align="right"><tr><td >'; if ($_SESSION['TypeUser'] == 'Admin'){$floatmenu .=  '<div  id="Menustyle_fixed" style="text-align:left; top:-6px; position:relative;"><div id="menubut"><h4><img src="./system/systemicon/menubut.png"></h4></div></div>';}
        $floatmenu .= '  
      </td>
      <td>';
	  
	  if ($_SESSION['TypeUser'] == 'Admin'){
	  $mobilemenu .= '<div id="subMainmenumobadminmobmenu" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';
	  $floatmenu .= '
	  <div id="Menustyle_child_fixed" style="position:fixed;"><h4 align="left">
		<Table id="subMainmenu" width="150"><tr><td>';
		$floatmenu .= '<a href="#" onclick="MainMenuswitch(\'Admin\');return false;">Admin Menu</a><br>';
		$floatmenu .= '<a href="#" onclick="MainMenuswitch(\'Member\');return false;">Member Menu</a><br>';
 		$floatmenu .= '<a href="#" onclick="MainMenuswitch(\'Public\');return false;">Public Menu</a><br>';
		$mobilemenu .= '<a href="#" onclick="MainMenuswitch(\'Admin\');return false;"><h4>Admin Menu</h4></a><br>';
		$mobilemenu .= '<a href="#" onclick="MainMenuswitch(\'Member\');return false;"><h4>Member Menu</h4></a><br>';
 		$mobilemenu .= '<a href="#" onclick="MainMenuswitch(\'Public\');return false;"><h4>Public Menu</h4></a><br></div></div>';
	$floatmenu .= '</h4></td>
	</tr></table></div>
	<script type="text/javascript">at_attach("Menustyle_fixed", "Menustyle_child_fixed", "hover", "y", "pointer","");</script>';
	
	}
  $result = mysqli_query($link,"SELECT Id, HasSubMenu, NumCol, ColWidth,ColHeigth, Largtext1bg, Largtext2bg, Largtext3bg,Largtext4bg,Largtext5bg, Largtext6bg,LargText, Largtext2, Largtext3,Largtext4,Largtext5, Largtext6,Naam, TheOrder, Url,Window FROM menu WHERE Language=". $_SESSION['Language']." ORDER BY TheOrder");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	echo '<script type="text/javascript">window.divnamesarray = [];</script>'; 
	
	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Naam = $row['Naam'];
		$TheOrder = $row['TheOrder'];
		$Url = $row['Url'];
		$Window =$row['Window'];
		if ($row['HasSubMenu'] == 1){
		$mobilemenu .= '
      			
		        <div  id="parentmob'.$Id.'" style="padding:5px;"> <div id="menubutmob"><h4><a href="#" onClick="layerActiesubmenumob(\''.$row["Id"].'\');return false"><img id="menuimgmob'.$row["Id"].'" class="pijlrechts" width="20" height="20" border="0">'.$Naam.'</h4></div></a></div>
         		';	
		$floatmenu .= '
      			<td>
		        <div  id="'.$Id.'float'.$Naam.'_parent" ><div id="menubut"><h4><a href="#">'.$Naam.'</a></h4></div></div>
         		</td>';	
		echo'
      			<td>
		        <div  id="'.$Id.$Naam.'_parent" ><div id="menubut"><h4><a href="#">'.$Naam.'</a></h4></div></div>
         		</td>';
				echo '<script type="text/javascript">window.divnamesarray.push("'.$Id.$Naam.'_parent");</script>';
				$submenu2 .='<div id="'.$Id.'float'.$Naam.'_child" style="position:fixed;">';
			$submenu .= '<div id="'.$Id.$Naam.'_child" style="position:absolute;">';
			$mobilemenu .= '<div id="'.$Id.$Naam.'_childmob" style="position:relative;">';
		$NumCols = intval($row['NumCol']);
		$ColWidth = intval($row["ColWidth"]);
		$ColHeigth = intval($row["ColHeigth"]);
		
		$LargText = array();	
		$LargText[1] = $row['LargText'];
		$LargText[2] = $row['Largtext2'];
		$LargText[3] = $row['Largtext3'];
		$LargText[4] = $row['Largtext4'];
		$LargText[5] = $row['Largtext5'];
		$LargText[6] = $row['Largtext6'];
		
		$bg = array();	
		$bg[1] = $row['Largtext1bg'];
		$bg[2] = $row['Largtext2bg'];
		$bg[3] = $row['Largtext3bg'];
		$bg[4] = $row['Largtext4bg'];
		$bg[5] = $row['Largtext5bg'];
		$bg[6] = $row['Largtext6bg'];
		$submenu2 .= "<table id=\"subMainmenu\"><tr  height = \"$ColHeigth\">";
		$submenu .= "<table id=\"subMainmenu\"><tr  height = \"$ColHeigth\">";
		$mobilemenu .= '<div id="subMainmenumob'.$row["Id"].'" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';
		for ($i=0; $i<$NumCols; $i++){	
			$submenu2 .=	"<td background=\"".$bg[$i+1]."\" width = \"$ColWidth\">".$LargText[$i+1]."</td>";
			$submenu .= "<td background=\"".$bg[$i+1]."\" width = \"$ColWidth\">".$LargText[$i+1]."</td>";
			$mobilemenu .= '<h4>'.$LargText[$i+1].'</H4>';
		}
		$submenu2 .='</tr></table></div>
		<script type="text/javascript">at_attach("'.$Id.'float'.$Naam.'_parent", "'.$Id.'float'.$Naam.'_child", "hover", "y", "pointer","");</script>';
		$submenu .= '</tr></table></div>
	<script type="text/javascript">at_attach("'.$Id.$Naam.'_parent", "'.$Id.$Naam.'_child", "hover", "y", "pointer","");</script>';
	$mobilemenu .= '</div></div></div>';
		} else {
			$mobilemenu .=   '<div  id="_parentmob'.$Id.'" style="padding:5px;"><div id="menubutmob"><h4><a href="./'.$Url.'" target="'.$Window.'"><img id="bol" src="" class="bol" width="20" height="20" border="0">'.$Naam.'</a></h4></div></div>';
			$floatmenu = $floatmenu.'
      			<td>
		        <div  id="'.$Id.$Naam.'_parent" style="text-align:left;"><div id="menubut"><h4><a href="./'.$Url.'" target="'.$Window.'">'.$Naam.'</a></h4></div></div>
         		</td>';	
			echo'
      			<td>
		        <div  id="'.$Id.$Naam.'_parent" style="text-align:left;"><div id="menubut"><h4><a href="./'.$Url.'" target="'.$Window.'">'.$Naam.'</a></h4></div></div>
         		</td>';
				echo '<script type="text/javascript">window.divnamesarray.push("'.$Id.$Naam.'_parent");</script>';
		}
	}
   
	echo '<td width ="1%">';
   	foreach ($Language_Array as $value) {
	echo '	<td>
		        <div  id="taal_parent" style="text-align:left;"><div id="menubut" style="text-align:left; top:-12px; position:relative;"><a href="#">'.$value.'</a></div></div>
         		</td>';
	$floatmenu = $floatmenu.'<td>
		        <div  id="taal_parent" style="text-align:left;"><div id="menubut"style="text-align:left; top:-6px; position:relative;"><a href="#">'.$value.'</a></div></div>
         		</td>';
				$mobilemenu .=   '<div  id="taal_parent" style="text-align:left;padding:5px;display:inline-block;"><a href="#">'.$value.'</a></div>';
	}


/* echo '  <div  id="taal_parent" align="center"><table border="0" cellpadding="4" cellspacing="0">
        <tr>
          <td ><div align="center">
            <h4>'.$CurLang.'</h4></a>
          </div></td>
        </tr>
      </table></div>*/

 
$floatmenu .=' </td></tr></table>';
 echo '
</td></tr></table>';





/*echo '<div id="taal_child"><h4 align="left">';


foreach ($Language_Array as $value) {
	echo $value;
	
}*/
	echo '
</div>';
echo '<script language="javascript">
function fadesubmenuheightmob(divid, targetheight){

	window.timerIDmenuheight=clearTimeout(window.timerIDmenuheight);
	thediv = document.getElementById(divid)
	if (targetheight == -1){	
		var sOriginalOverflow = thediv.style.overflow;
		var sOriginalHeight = thediv.style.height;		
		thediv.style.overflow = "";
		thediv.style.height = "";		
		targetheight = thediv.offsetHeight ;
		thediv.style.height = sOriginalHeight;
		thediv.style.overflow = sOriginalOverflow;
	}	
	
	if (parseFloat(thediv.style.height) > targetheight -1 && parseFloat(thediv.style.height) < targetheight +1){			
			thediv.style.height = "";	
			if (targetheight == 0){
				thediv.style.display="none";
			}			
	}else{
		//alert (parseFloat(thediv.style.height)+" "+targetheight)
		if (targetheight > parseFloat(thediv.style.height)){
			var newheight =  (((targetheight - parseFloat(thediv.style.height))/2)+parseFloat(thediv.style.height))
		}else{
			var newheight =  parseFloat(thediv.style.height) - (((parseFloat(thediv.style.height) - targetheight )/2))
		}
		
		thediv.style.height = newheight + "px"
		window.timerIDmenuheight = setTimeout("fadesubmenuheightmob(\'"+divid+"\',"+targetheight+")",30);
				
	}
}
function layerActiesubmenumob(ID) {
	
   if (document.getElementById("subMainmenumob"+ID).style.display=="none") {
		document.getElementById("subMainmenumob"+ID).style.height =  document.getElementById("subMainmenumob"+ID).offsetHeight + "px"	
		document.getElementById("subMainmenumob"+ID).style.display="block";
		if (document.getElementById("menuimgmob"+ID)){
			document.getElementById("menuimgmob"+ID).src="'. $_SESSION['Theme'].'systemicon/down.png"; 
		}
		fadesubmenuheightmob ("subMainmenumob"+ID,-1)
   } else {
		if (document.getElementById("menuimgmob"+ID)){
			document.getElementById("menuimgmob"+ID).src= "'. $_SESSION['Theme'].'systemicon/pijl rechts.png"
		}
		document.getElementById("subMainmenumob"+ID).style.height =  document.getElementById("subMainmenumob"+ID).offsetHeight + "px"
		fadesubmenuheightmob ("subMainmenumob"+ID,0)
	  
   }
}
function mobilemenuswitch(divID) {
	
   if (document.getElementById(divID).style.display=="inherit") {
	document.getElementById(divID).style.display="none";    
	  
   } else {   
	document.getElementById(divID).style.display="inherit";
     
	  
   }
   if (divID == "menuajax2"){
   if (document.getElementById(\'menuajax3\')){
		document.getElementById("menuajax3").style.display="none";
	}
	slidemenu(document.getElementById(\'menuslidertop2\'),document.getElementById(\'menusliderbottom2\'),document.getElementById(\'footer\'),document.getElementById(\'menuslider2b\'),document.getElementById(\'menuslider2b\'));
   }
   if (divID == "menuajax3"){
		document.getElementById("menuajax2").style.display="none";
		slidemenu(document.getElementById(\'menuslidertop\'),document.getElementById(\'menusliderbottom\'),document.getElementById(\'footer\'),document.getElementById(\'menuslider\'),document.getElementById(\'menuslider\'));
   }
}</script>';
echo $submenu;

echo '<div id="mobilmenu">
<center>
<table><tr><td><a href="#" onclick="mobilemenuswitch(\'menuajax2\');return false;"><img src="'.$_SESSION['Theme'].'banner/mobilebut.png"></td><td><img src="'.$_SESSION['Theme'].'/banner/mobilelogo.png"></td><td ><div id="mobilsubmenubut"><a href="#" onclick="mobilemenuswitch(\'menuajax3\');return false;"><img src="'.$_SESSION['Theme'].'/banner/mobilebut.png"></a></div></td></tr></table> 
</center>';
echo '</div>';
		
echo '<div id="artistmindfloatmenu">';
echo $floatmenu;
	echo '
</div>';
echo $submenu2;
echo '<div id="menusliderstill2">';
	echo '<div id="menuslider2b" name="menuslider2b" style="top:0px; position:absolute;display:block;width:100%;" >';
	echo '<div id="menuslidertop2" name="menuslidertop2"></div>';	
	echo '<div id="menuajax2" name="menuajax2" >';	
	echo $mobilemenu;
	echo '</div>';
	echo '<div id="menusliderbottom2" name="menusliderbottom2"></div></div></div>';
echo '<script type="text/javascript"> 
   if (!document.getElementById(\'menuajax\')==true){
		document.getElementById(\'mobilsubmenubut\').style.display = "none";
   }
</script>';

?>

<script type="text/javascript">



function viewPortHeight() {
    var de = document.documentElement;
	
    if(!!window.innerWidth)
    { return window.innerHeight; }
    else if( de && !isNaN(de.clientHeight) )
    { return de.clientHeight; }

    return 0;
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

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

function floatingmenu(){	
	elm = document.getElementById('artistmindmenu');
	elm2 = document.getElementById('artistmindfloatmenu');
	var vpH = viewPortHeight(), // Viewport Height
	st = scrollY(), // Scroll Top
	y = posY(elm);
	
	if ( y < (st) ){
		elm2.style.visibility = "visible"
	}else{
		elm2.style.visibility = "hidden"
	}
	
}
	 floatingmenu();
	</script>
	

<script type="text/javascript"> 
function startmenufadein(){	
	window.timerIDartistmindmenubfade = [];
	window.timerIDimg=setTimeout("addalphamenub()",550);
	for(i=0; i<window.divnamesarray.length; i++) {	
		
		window.timerIDartistmindmenubfade[i]=setTimeout("addalphamenuc("+i+")",parseInt(600+(i*100)));
	} 
}
function addalphamenub(){
	window.timerIDartistmindmenufade=clearTimeout(window.timerIDartistmindmenufade);
	var curalpha = parseFloat( document.getElementById('artistmindmenu').style.opacity);
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/16) + parseFloat(curalpha))*100
	changeOpacybody(curalpha, "artistmindmenu");
	
	if (parseInt(curalpha) < 99){		
		window.timerIDimg=setTimeout("addalphamenub()",30);
	}else{		
		curalpha = 100;
		changeOpacybody(curalpha, "artistmindmenu");		
		window.timerIDartistmindmenufade=clearTimeout(window.timerIDartistmindmenufade);
			
	}
}
function addalphamenuc(i){

	window.timerIDartistmindmenubfade[i]=clearTimeout(window.timerIDartistmindmenubfade[i]);
	var curalpha = parseFloat( document.getElementById(window.divnamesarray[i]).style.opacity);
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/16) + parseFloat(curalpha))*100
	changeOpacybody(curalpha, window.divnamesarray[i]);
	
	if (parseInt(curalpha) < 99){		
		window.timerIDartistmindmenubfade[i]=setTimeout("addalphamenuc("+i+")",30);
	}else{		
		curalpha = 100;
		changeOpacybody(curalpha, window.divnamesarray[i]);		
		window.timerIDartistmindmenubfade[i](window.timerIDartistmindmenubfade[i]);	
	}
}

changeOpacybody(0, "artistmindmenu");
startmenufadein()

for(i=0; i<window.divnamesarray.length; i++) {
	
	changeOpacybody(0, window.divnamesarray[i]);	
} 
</script>
</body>