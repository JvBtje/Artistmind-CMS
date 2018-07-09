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
	
	/*
	if (count($myUrl) < 2){
		if ($found == true){
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<h4><a class="sample_attach" href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$row2['Language'].'</a></h4>';		
			}else{
				$Language_Array[count($Language_Array)] =  '<h4><a class="sample_attach" href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$row2['Language'].'</a></h4>';
			if ($_SESSION['Language'] == $row2['Id']){$CurLang = $row2['Language'];}
			}
		}else{
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<h5><a class="sample_attach" href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$row2['Language'].'</a></h5>';	
			}else{
				$Language_Array[count($Language_Array)] =  '<h5><a class="sample_attach" href="'.$theurl2.'lang-'.$row2['Id'].'.html">'.$row2['Language'].'</a></h5>';
			}
		}
	} else {
		if ($found == true){
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<h4><a class="sample_attach" href="'.$myUrl[0].'?language_id='.$row2['Id'].'"><img src="iconen/info.png" alt="" width="14" height="14" align="absmiddle" border="0"/>'.$row2['Language'].'</a></h4>';		
			}else{
				$Language_Array[count($Language_Array)] =  '<h4><a class="sample_attach" href="'.$myUrl[0].'?language_id='.$row2['Id'].'&type=select&Id='.$MainId.'"><img src="iconen/info.png" alt="" width="14" height="14" align="absmiddle" border="0"/>'.$row2['Language'].'</a></h4>';
			if ($_SESSION['Language'] == $row2['Id']){$CurLang = $row2['Language'];}
			}
		}else{
			if($MainId == ""){
				$Language_Array[count($Language_Array)] =  '<h5><a class="sample_attach" href="'.$myUrl[0].'?language_id='.$row2['Id'].'"><img src="iconen/info.png" alt="" width="14" height="14" align="absmiddle" border="0"/>'.$row2['Language'].'</a></h5>';	
			}else{
				$Language_Array[count($Language_Array)] =  '<h5><a class="sample_attach" href="'.$myUrl[0].'?language_id='.$row2['Id'].'&type=select&Id='.$MainId.'"><img src="iconen/info.png" alt="" width="14" height="14" align="absmiddle" border="0"/>'.$row2['Language'].'</a></h5>';
			}
		}
	}*/
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

	  
	  if ($_SESSION['TypeUser'] == 'Admin'){

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

		echo'
      			<td>
		        <div  id="'.$Id.$Naam.'_parent" ><div id="menubut"><h4><a href="#">'.$Naam.'</a></h4></div></div>
         		</td>';
				echo '<script type="text/javascript">window.divnamesarray.push("'.$Id.$Naam.'_parent");</script>';
			$submenu .= '<div id="'.$Id.$Naam.'_child" style="position:absolute;">';
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
		$submenu .= "<table id=\"subMainmenu\"><tr  height = \"$ColHeigth\">";
		for ($i=0; $i<$NumCols; $i++){	
			$submenu .= "<td background=\"".$bg[$i+1]."\" width = \"$ColWidth\">".$LargText[$i+1]."</td>";
		}
		$submenu .= '</tr></table></div>
	<script type="text/javascript">at_attach("'.$Id.$Naam.'_parent", "'.$Id.$Naam.'_child", "hover", "y", "pointer","");</script>';

		} else {
			echo'
      			<td>
		        <div  id="'.$Id.$Naam.'_parent" style="text-align:left;"><div id="menubut"><h4><a href="./'.$Url.'" target="'.$Window.'">'.$Naam.'</a></h4></div></div>
         		</td>';
				echo '<script type="text/javascript">window.divnamesarray.push("'.$Id.$Naam.'_parent");</script>';
		}
	}
  
	echo '<td width ="1%">';



/* echo '  <div  id="taal_parent" align="center"><table border="0" cellpadding="4" cellspacing="0">
        <tr>
          <td ><div align="center">
            <h4>'.$CurLang.'</h4></a>
          </div></td>
        </tr>
      </table></div>*/

 

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


echo '<div id="mobilmenu">
<center>
<table><tr><td><a href="#" onclick="mobilemenuswitch(\'menuajax2\');return false;"><img src="'.$_SESSION['Theme'].'banner/mobilebut.png"></td><td><img src="'.$_SESSION['Theme'].'banner/mobilelogo.png"></td><td ><div id="mobilsubmenubut"><a href="#" onclick="mobilemenuswitch(\'menuajax3\');return false;"><img src="'.$_SESSION['Theme'].'banner/mobilebut.png"></a></div></td></tr></table> 
</center>';
echo '</div>';
		
echo '<div id="artistmindfloatmenu">';

	echo '
</div>';

echo $submenu;

?>

</body>