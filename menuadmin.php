<?php

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
	//include("system/include.php");
	$CurLang = 'Language';
	//$myUrl =array();
	//$myUrl[0] = "hallo niks";
	$myUrl = curPageURL();
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		if (strpos($myUrl,'?')== false){
			$Language_Array[count($Language_Array)] =  '<h4><a href="'.$myUrl.'?language_id='.$row2['Id'].'">'.$row2['Language'].'</a></h5>';	
		}else{
			$Language_Array[count($Language_Array)] =  '<h4><a href="'.$myUrl.'&language_id='.$row2['Id'].'">'.$row2['Language'].'</a></h5>';
		}
		
	
	}

echo '<div id="menuback"></div><div id="artistmindmenu">
';
echo '
  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
	<td >
	

                  <div  id="Menustyle" style="text-align:left; top:-6px; position:relative;"><div id="menubut"><h4><img src="./system/systemicon/menubut.png"></h4></div>
          </div>
      </td>
      	   <td >
                  <div  id="Main_Parent" style="text-align:left;"><div id="menubut"><h4>Main</h4></div>
          </div>
      </td>
	  <td >
           <div  id="Group_Parent"  style="text-align:left;"> <div id="menubut"><h4>Secties</h4></div>
          </div></td>
  <td >
           <div  id="Themes_Parent" style="text-align:left;" ><div id="menubut"> <h4>Themes</h4></div>
          </div></td>
	     <td ><div  id="taal_parentb" style="text-align:left;" ><div id="menubut">
            <h4>'.$CurLang.'</h4>
          </div></div></td>
            <td ><div  id="logout" style="text-align:left;" ><div id="menubut">
            <a href="Logout.html"><h4>Log out</h4></a>
          </div></div></td>
   </tr></table>
</div>
';

echo'
	<div id="Menustyle_child" style="position:absolute;"><h4 align="left">
		<Table id="subMainmenu" ><tr><td>';
		
		echo '
		<script type="text/javascript">
		function MainMenuswitch2(item1)
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
		echo '<a href="#" onclick="MainMenuswitch2(\'Admin\');return false;">Admin Menu</a><br>';
		echo '<a href="#" onclick="MainMenuswitch2(\'Member\');return false;">Member Menu</a><br>';
 		echo '<a href="#" onclick="MainMenuswitch2(\'Public\');return false;">Public Menu</a><br>';
	echo '</h4></td>
	</tr></table></div>
	<script type="text/javascript">at_attach("Menustyle", "Menustyle_child", "hover", "y", "pointer","");</script>
	<div id="Main_child" style="position:absolute;"><Table id="subMainmenu" ><tr><td><h4 align="left">
		Main Options<br>';
		if (!isset($_SESSION['stpmenu'])){
			$stpmenu = Array();
			$i = 0;
			$root = scandir('./pluginstandalone'); 
			foreach($root as $value)
			{ 
				if (is_file('./pluginstandalone/'.$value.'/stpmenu.php')) {
					include('./pluginstandalone/'.$value.'/stpmenu.php');
					$stpmenu[$i]= Array();
					$stpmenu[$i]["Type"] = $stptype;
					$stpmenu[$i]["Url"] = $stpurl;
					$stpmenu[$i]["Name"] = $stpname;
					$stpmenu[$i]["Item"] = $stpusermenu;
					$i++;
				}
			} 
			
		$_SESSION['stpmenu'] = $stpmenu;
		}
		$Optionshtml = "";
		$Languagehtml = "";
		foreach ($_SESSION['stpmenu'] as $stpmenu) {
			if ($stpmenu["Type"] == "Options"){
				$Optionshtml .='<a href="'.$stpmenu["Url"].'">'.$stpmenu["Name"].'</a><br>';
			}else{
				$Languagehtml .='<a href="'.$stpmenu["Url"].'">'.$stpmenu["Name"].'</a><br>';
			}
		}
		echo $Optionshtml;
	echo '</h4></td><td><h4 align="left">
	Language Options<br>';
	echo $Languagehtml;
	echo '</h4></td>
	</tr></table></div>
	<script type="text/javascript">at_attach("Main_Parent", "Main_child", "hover", "y", "pointer","");</script>';
	echo '<div id="Themes_child"style="position:absolute;"><Table id="subMainmenu"><tr><td><h4 align="left">';
		echo '<a href="themes.php">Select Theme</a><br>';
		include $_SESSION['Theme']."thisThemeMenu.php";
	echo '</h4></td>
	</tr></table></div>
	<script type="text/javascript">at_attach("Themes_Parent", "Themes_child", "hover", "y", "pointer","");</script>';
	
	echo '<div id="Group_child" style="position:absolute;">';
	$td2 = "";
	$td3 = "";
	$td4 = "";
	$td5 = "";
	$td6 = "";
	$i = 2;
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
		switch ($i)
		{
			case 2:
				$td2 .= '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
 				break;
			case 3:
				$td3 .= '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
				break;
			case 4:
				$td4 .= '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
				break;
			case 5:
				$td5 .= '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
				break;
			case 6:
				$td6 .= '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
				break;
		}
		$i++;
		if($i==7){
			$i=2;
		}
			
	}
	echo'<Table id="subMainmenu"><tr><td><h4>Sectie Algemeen</h4>';
		echo '<a href="sectieedit.php">Sectie\'s</a><br>'; 
		echo '<a href="lostitems.php">Lost Items</a>';
	echo '</td><td><h4>Sectie</h4>'.$td2.'</td><td><h4><br> </h4>'.$td3.'</td><td><h4><br> </h4>'.$td4.'</td><td><h4><br> </h4>'.$td5.'</td><td><h4><br> </h4>'.$td6.'</td>
	</tr></table></div>
	<script type="text/javascript">at_attach("Group_Parent", "Group_child", "hover", "y", "pointer","");</script>';

echo '<div id="taal_childb" style="position:absolute;"><Table id="subMainmenu"><tr><td><h4 align="left">';
foreach ($Language_Array as $value) {
	echo $value;
	
}	echo '
</h4></td>
	</tr></table></div></div></table>
<script type="text/javascript">at_attach("taal_parentb", "taal_childb", "hover", "y", "pointer","");</script>';

/////////////////
// mobile menu///
////////////////
echo '<div id="mobilmenu"></div>
<script type="text/javascript">
scale = 1 / window.devicePixelRatio;

outputmobmenu = \'<center><table><tr><td><a href="#" onclick="mobilemenuswitch(\\\'menuajax2\\\');return false;"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'banner/mobilebut.png&maxsize=\'+(47*window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></td><td><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'banner/mobilelogo.png&maxsize=\'+(177*window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></td><td ><div id="mobilsubmenubut"><a href="#" onclick="mobilemenuswitch(\\\'menuajax3\\\');return false;"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'banner/mobilebut.png&maxsize=\'+(47*window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a></div></td></tr></table></center>\';
mobilebackground = \'./system/imgtumb.php?url='.$_SESSION['Theme'].'background/mobilemenuback.png&maxsize=\'+(85*window.devicePixelRatio)+\'&square=0\'
document.getElementById(\'mobilmenu\').style.backgroundImage="url("+mobilebackground+")";
document.getElementById(\'mobilmenu\').style.backgroundSize="17px,85px";
 
document.getElementById(\'mobilmenu\').innerHTML = outputmobmenu;
</script>
';
	echo '<div id="menuslider2b" name="menuslider2b" style="top:0px; position:absolute;display:block;width:100%;" >';
	echo '<div id="menuslidertop2" name="menuslidertop2"></div>';	
	echo '<div id="menuajax2" name="menuajax2" > ';	
 if ($_SESSION['TypeUser'] == 'Admin'){echo '<div  id="parentmobadminmobmenu" style="padding:5px;"><a href="#" onClick="layerActiesubmenumob(\'adminmobmenu\');return false"><div id="menubutmob"><h4><img src="./system/systemicon/menubut.png"></h4></a></div></div>';}
    echo '<div id="subMainmenumobadminmobmenu" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';
		echo '<a href="#" onclick="MainMenuswitch2(\'Admin\');return false;">Admin Menu</a><br>';
		echo '<a href="#" onclick="MainMenuswitch2(\'Member\');return false;">Member Menu</a><br>';
 		echo '<a href="#" onclick="MainMenuswitch2(\'Public\');return false;">Public Menu</a><br></div></div>';
	  
	  echo '<div  id="parentmob'.$Id.'" style="padding:5px;"> <a href="#" onClick="layerActiesubmenumob(\'mainmenu\');return false"><div id="menubutmob"><h4><img id="menuimgmobmainmenu" class="pijlrechts" width="20" height="20" border="0">Main</h4></div></a></div>
	  <div id="subMainmenumobmainmenu" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';
	   echo '<h4>';
	   $Optionshtml = "";
		$Languagehtml = "";
		foreach ($_SESSION['stpmenu'] as $stpmenu) {
			if ($stpmenu["Type"] == "Options"){
				$Optionshtml .='<a href="'.$stpmenu["Url"].'">'.$stpmenu["Name"].'</a><br>';
			}else{
				$Languagehtml .='<a href="'.$stpmenu["Url"].'">'.$stpmenu["Name"].'</a><br>';
			}
		}
		echo $Optionshtml;
		echo '</h4>';
		echo '<h4>
	Language Options<br>';
	echo $Languagehtml;
	echo '</h4>';
		echo ' </div></div>';
       echo '<div  id="parentmob'.$Id.'" style="padding:5px;"> <a href="#" onClick="layerActiesubmenumob(\'sectie\');return false"><div id="menubutmob"><h4><img id="menuimgmobsectie" class="pijlrechts" width="20" height="20" border="0">Sectie</h4></div></a></div>
	  <div id="subMainmenumobsectie" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';
	  echo'
	   <h4>';
		echo '<a href="sectieedit.php">Sectie\'s</a><br>';
		echo '<a href="lostitems.php">Lost Items</a>';
		echo '</h4><h4>';
		$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
				echo '<a href="indexadminnew.php?plugin=groep&sectie='.$row["MainId"].'">'.$row["Naam"].'</a><br>';
		}
	  echo'</h4>
	   </div></div>';
          echo '<div  id="parentmob'.$Id.'" style="padding:5px;"> <a href="#" onClick="layerActiesubmenumob(\'theme\');return false"><div id="menubutmob"><h4><img id="menuimgmobtheme" class="pijlrechts" width="20" height="20" border="0">theme</h4></div></a></div>
	  <div id="subMainmenumobtheme" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';echo'
		   <h4 >';
		echo '<a href="themes.php">Select Theme</a><br>';
		include $_SESSION['Theme']."thisThemeMenu.php";
	echo '</h4>
		  </div></div>';
        echo '<div  id="parentmob'.$Id.'" style="padding:5px;"> <a href="#" onClick="layerActiesubmenumob(\'language\');return false"><div id="menubutmob"><h4><img id="menuimgmoblanguage" class="pijlrechts" width="20" height="20" border="0">language</h4></div></a></div>
	  <div id="subMainmenumoblanguage" style= "display:none;overflow:hidden;"><div id="subMainmenumob">';echo'
		 
	   <h4 >';
foreach ($Language_Array as $value) {
	echo $value;
	
}	echo '
</h4>
	   </div></div>
            <div  id="_parentmob'.$Id.'" style="padding:5px;"><div id="menubutmob"><h4><img id="bol" src="" class="bol" width="20" height="20" border="0"><a href="Logout.html">Log out</a></h4></div></div>
          ';

	echo '</div>';
	echo '<div id="menusliderbottom2" name="menusliderbottom2"></div></div>';
echo '<script type="text/javascript"> 
   if (!document.getElementById(\'menuajax\')==true){
		document.getElementById(\'mobilsubmenubut\').style.display = "none";
   }
</script>';
echo '</body>';
}	  

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
