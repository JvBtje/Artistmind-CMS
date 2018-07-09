<?php session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include('../../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
$type = $_GET["type"]; 
$MainId = $_GET["Id"];
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
?>
<style type="text/css">
	img {border:0px}
	body {
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		color:#333;
		background:url(bg.jpg);
	}
</style>
<script language="javascript">
window.formelements = new Array();
window.propertys = new Array();
window.Language = new Array();
window.orderby = "";

function ConfirmDelete (theId){
	Mainids = new Array();
	theId = "";
	realfirst = true;
	var item_processor = function(item) {
		
      		first = true;
		for (i=0;i<window.propertys.length;i++)
		{
			if (item[window.propertys[i]] instanceof Array){
				if (first == true){
					first = false;
					if (document.getElementById('formresultfileid'+item[window.propertys[i]].MainId).checked == true){
						
						Mainids.push(item[window.propertys[i]].MainId);
					}
				}
			}		
		}
		
	}
	
	new_list = window.formelements.map(item_processor);
	for (i=0;i<Mainids.length;i++){
		if (realfirst == true){
			realfirst = false;
			theId =  " WHERE MainId ="+Mainids[i];
		}else{
			theId =  theId + " OR MainId ="+Mainids[i];
		}
	}

	if (Mainids.length > 0){
		answer = confirm("Weet je zeker dat je deze form data wilt verwijderen.")

		if (answer !=0) { 
			location = "formresult.php?type=delete&Id=" + theId 
		} 

	}else{
		alert("cannot delete, nothing selected");
	}
}

function printthis(url){
	window.open(url+"&OrderBy="+window.orderby,'_blank');
}

function downloadthis(url){
	window.open(url,'_blank');
}

function addLanguage(Id, Language){
	tmparray = new Array();
	tmparray.Id = Id;
	tmparray.Language = Language;
	window.Language[Id] = new Array();
	window.Language[Id] = tmparray;
}

function sortby(property){
	window.orderby = property;
	window.formelements.sort(function(obj1, obj2) {
	// Ascending: first age less than the previous
	if (obj1[property] instanceof Array && obj2[property] instanceof Array){
		if(obj1[property].theValue<obj2[property].theValue) return -1;
		if(obj1[property].theValue>obj2[property].theValue) return 1;
	}else{
		if (obj1[property] instanceof Array) return -1;
		if (obj2[property] instanceof Array) return 1;
	}
	})
	updateform();
}
function sortby2(property){
	window.orderby = property;
	window.formelements.sort(function(obj1, obj2) {
	for (i=0;i<window.propertys.length;i++){
		if (obj1[window.propertys[i]] instanceof Array){
			if (property == "Id"){itema = obj1[window.propertys[i]].MainId;}
			if (property == "Date"){itema = obj1[window.propertys[i]].theDate;}
			if (property == "Language"){itema = window.Language[obj1[window.propertys[i]].Language].Language;}
		}
	}
	for (i=0;i<window.propertys.length;i++){
		if (obj2[window.propertys[i]] instanceof Array){
			if (property == "Id"){itemb = obj2[window.propertys[i]].MainId;}
			if (property == "Date"){itemb = obj2[window.propertys[i]].theDate;}
			if (property == "Language"){itemb = window.Language[obj2[window.propertys[i]].Language].Language;}
		}
	}
	

	
	if(itema<itemb) return -1;
	if(itema>itemb) return 1;
	
	})
	
	
	updateform();
}
function selectall()
{
	var item_processor = function(item) {
      		first = true;
		for (i=0;i<window.propertys.length;i++)
		{
			if (item[window.propertys[i]] instanceof Array){
				if (first == true){
					first = false;
					document.getElementById('formresultfileid'+item[window.propertys[i]].MainId).checked = true;
				}
			}		
		}
		
	}
	new_list = window.formelements.map(item_processor);
}

function deselectall()
{
	var item_processor = function(item) {
      		first = true;
		for (i=0;i<window.propertys.length;i++)
		{
			if (item[window.propertys[i]] instanceof Array){
				if (first == true){
					first = false;
					document.getElementById('formresultfileid'+item[window.propertys[i]].MainId).checked = false;
				}
			}		
		}
		
	}
	new_list = window.formelements.map(item_processor);
}
function updateform (){
	window.curpage = 1;
	pages = 1;
	txt = '<table><tr><td></td><td><a href="#" onClick="sortby2(\'Id\');return false">Id</a></td><td><a href="#" onClick="sortby2(\'Date\');return false">Date</a></td><td><a href="#" onClick="sortby2(\'Language\');return false">Language</a></td>';
	
	for (i=0;i<window.propertys.length;i++)
	{
		txt = txt +'<td><a href="#" onClick="sortby(\''+window.propertys[i]+'\');return false">'+window.propertys[i]+'</a></td>';		
	}
	txt = txt +'</tr>';
	
	var item_processor = function(item) {
      		tmptxt = "";	
		first = true;
		for (i=0;i<window.propertys.length;i++)
		{
			if (item[window.propertys[i]] instanceof Array){
				if (first == true){
					first = false
					txt = txt +'<tr><td><input type="checkbox" name="formresultfileid'+item[window.propertys[i]].MainId+'" id="formresultfileid'+item[window.propertys[i]].MainId+'"/></td><td><a href="formresult.php?type=select&Id='+item[window.propertys[i]].MainId+'">'+item[window.propertys[i]].MainId+'</a></td><td>'+item[window.propertys[i]].theDate+'</td><td>'+window.Language[item[window.propertys[i]].Language].Language+'</td>'+tmptxt;
				}
			 	txt = txt + '<td>'+item[window.propertys[i]].theValue+'</td>';
			}else{
				if (first == true){
					tmptxt = tmptxt +'<td>-</td>';
				}else{
					txt = txt +'<td>-</td>';
				}
			}		
		}
		txt = txt +'</tr>';
	}
	new_list = window.formelements.map(item_processor);

	txt = txt + '</table>';
	document.getElementById('formresultouput').innerHTML = txt;
	
}
function updateform2 (){
	
	window.curpage = 1;
	pages = 1;
	txt = "<table>";
	
	var item_processor = function(item) {
      		tmptxt = "";	
		first = true;
		for (i=0;i<window.propertys.length;i++)
		{
			if (item[window.propertys[i]] instanceof Array){
				
				if (first == true){
					first = false
					  txt = txt +'<tr><td>Id</td><td><input type="hidden" id="MainId" name="MainId" value="'+item[window.propertys[i]].MainId+'" size="50" border="0" onchange="changeval();">'+item[window.propertys[i]].MainId+'</td></tr><tr><td>Date<div id="errormsg" style="display:none;">Error:Not a valid Date</div></td><td><input type="text" id="theDate" name="theDate" value="'+item[window.propertys[i]].theDate+'" size="50" border="0" onchange="changeval();"></td></tr>';
						txt = txt +'<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
					var item_processor2 = function(item2) {
						
						txt = txt +'<option value="'+item2.Id+'"';
					if (item2.Id== item[window.propertys[i]].Language){txt = txt + ' selected ';}
						txt = txt + '>'+item2.Language+'</option>';
						
						//txt = txt +'+window.Language[item[window.propertys[i]].Language].Language;
					}
					new_list2 = window.Language.map(item_processor2);
					txt = txt +'</select></td></tr>';	
					//txt = txt +'<tr><td><input type="checkbox" name="formresultfileid'+item[window.propertys[i]].MainId+'" id="formresultfileid'+item[window.propertys[i]].MainId+'"/></td></tr><tr><td><a href="formresult.php?type=select&Id='+item[window.propertys[i]].MainId+'">'+item[window.propertys[i]].MainId+'</a></td></tr><tr><td>'+item[window.propertys[i]].theDate+'</td></tr><tr><td>'+window.Language[item[window.propertys[i]].Language].Language+'</td></tr>';
				}
			 	txt = txt + '<tr><td>'+window.propertys[i]+'</td><td><input type="text" id="'+window.propertys[i]+'" name="'+window.propertys[i]+'" value="'+item[window.propertys[i]].theValue+'" size="50" border="0" onchange="changeval();"></td></tr>';
			}		
		}
	}
	new_list = window.formelements.map(item_processor);

	txt = txt + '</table>';
	document.getElementById('formresultouput').innerHTML = txt;
	
	
}
function submitform(){	
	error = false;
	value = document.getElementById("StartDate").value;
	if (value.length != 0){
		if (value.length == 10){
			line1 = value.charAt(2);
			line2 = value.charAt(5);
			if (line1 == "-" && line2 == "-"){
				dag = value.substr(0,2);
				maand = value.substr(3,2);
				jaar = value.substr(6,4);
				if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
					document.getElementById("StartDateerrormsg").style.display = "none";
				}else{
					error = true;
					document.getElementById("StartDateerrormsg").style.display = "block";
				}
			}else{
				error = true;
				document.getElementById("StartDateerrormsg").style.display = "block";
			}
		}else{
			error = true;
			document.getElementById("StartDateerrormsg").style.display = "block";
		}
	}
	value = document.getElementById("EndDate").value;
	if (value.length != 0){
		if (value.length == 10){
			line1 = value.charAt(2);
			line2 = value.charAt(5);
			if (line1 == "-" && line2 == "-"){
				dag = value.substr(0,2);
				maand = value.substr(3,2);
				jaar = value.substr(6,4);
				if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
					document.getElementById("EndDateerrormsg").style.display = "none";
				}else{
					error = true;
					document.getElementById("EndDateerrormsg").style.display = "block";
				}
			}else{
				error = true;
				document.getElementById("EndDateerrormsg").style.display = "block";
			}
		}else{
			error = true;
			document.getElementById("EndDateerrormsg").style.display = "block";
		}
	}
	if (error == false){document.formzoek.submit();}
}
function submitform2(){	
	error = false;
	value = document.getElementById("theDate").value;
	
		if (value.length == 19){
			line1 = value.charAt(4);
			line2 = value.charAt(7);
			line3 = value.charAt(10);
			line4 = value.charAt(13);
			line5 = value.charAt(16);
			if (line1 == "-" && line2 == "-" && line3 == " " && line4 == ":" && line5 == ":"){
				dag = value.substr(8,2);
				maand = value.substr(5,2);
				jaar = value.substr(0,4);
				if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
					document.getElementById("errormsg").style.display = "none";
				}else{
					error = true;
					document.getElementById("errormsg").style.display = "block";
				}
			}else{
				error = true;
				document.getElementById("errormsg").style.display = "block";
			}
		}else{
			
			error = true;
			document.getElementById("errormsg").style.display = "block";
		}
	
	
	if (error == false){
		
		document.formsave.submit();}
}
function addformelement(MainId, Name,theValue,theGroup,Language,theDate,formeditid){
	if (formeditid == -1){
		tmparray = new Array();
		tmparray.MainId = MainId;
		tmparray.Name = Name;
		tmparray.theValue = theValue;
		tmparray.theGroup = theGroup;
		tmparray.Language = Language;
		tmparray.theDate = theDate;
 		
        	if (window.formelements[MainId] instanceof Array){
			window.formelements[MainId][Name] = new Array();
			window.formelements[MainId][Name] = tmparray;
			
		}else{		
			window.formelements[MainId] = new Array();
			window.formelements[MainId][Name] = new Array();
			window.formelements[MainId][Name] = tmparray;
		}	
		
		found = false;
 		for(var i=0; i< window.propertys.length; i++) {
        		if (window.propertys[i] == Name){
				found = true;	
			} ;
   		}
		
		if (found == false){
			window.propertys.push(Name);
		}
		
				
	}else{

//		window.formelements[formeditid].Name = Name;
//		window.formelements[formeditid].theValue = theValue;
//		window.formelements[formeditid].Type = Type;
//		window.formelements[formeditid].checked = checked;
//		window.formelements[formeditid].text = text;
//		window.formelements[formeditid].rules = rules;
//		window.formelements[formeditid].errormsg = errormsg;
	}
}
</script>
<?php
if($type == ""){
	$SearchString = $_GET["Searchstring"]; 
	//if (isset($_GET["theForm"])){		
		$theForm = $_GET["theForm"];
	//}
	//if (isset($_GET["theLanguage"])){		
		$theLanguage = $_GET["theLanguage"];
	//}
	//if (isset($_GET["StartDate"])){		
		$StartDate = $_GET["StartDate"];
	//}
	//if (isset($_GET["EndDate"])){		
		$EndDate = $_GET["EndDate"];
	//}
	
	$SearchString = str_replace("'", " ", $SearchString);
	$SearchString = str_replace('"', " ", $SearchString);
	$SearchString = str_replace(',', " ", $SearchString);
	$SearchString = str_replace('\\', " ", $SearchString);
	$theForm = str_replace("'", " ", $theForm);
	$theForm = str_replace('"', " ", $theForm);
	$theForm = str_replace(',', " ", $theForm);
	$theForm = str_replace('\\', " ", $theForm);
	$theLanguage = str_replace("'", " ", $theLanguage);
	$theLanguage = str_replace('"', " ", $theLanguage);
	$theLanguage = str_replace(',', " ", $theLanguage);
	$theLanguage = str_replace('\\', " ", $theLanguage);
	$StartDate = str_replace("'", " ", $StartDate);
	$StartDate = str_replace('"', " ", $StartDate);
	$StartDate = str_replace(',', " ", $StartDate);
	$StartDate = str_replace('\\', " ", $StartDate);
	$EndDate = str_replace("'", " ", $EndDate);
	$EndDate = str_replace('"', " ", $EndDate);
	$EndDate = str_replace(',', " ", $EndDate);
	$EndDate = str_replace('\\', " ", $EndDate);

	echo '<script language="javascript">';
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo 'addLanguage(\''.str_replace("'", "\'", $row2["Id"]).'\',\''.str_replace("'", "\'", $row2["Language"]).'\');';
	}
	echo '</script>';
	
	echo '<form name="formzoek"  action="formresult.php" method="GET" ><table><tr><td><input type="hidden" name="type" value="" border="0">Search</td><td> <input type="text" name="Searchstring" id ="Searchstring" value="'.$SearchString.'" size="24" border="0"> </td></tr><tr><td>Form </td><td><select name="theForm" size="1">
				<option '; if($Sectie == "All"){echo' selected ';} echo' value="">All</option>';
	$result2 = mysqli_query($link,"SELECT MainId, Naam, Parent, TheOrder, Type, Id, targetmainid FROM groepen WHERE Type = 'form' AND Language=". $_SESSION['Language']);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo '<option '; if($theForm == $row2['MainId']){echo' selected ';} echo' value="'.$row2['MainId'].'">'.$row2['Naam'].'</option>';
	}
	
				
				echo '
			</select></td></tr><tr><td>Language </td><td><select name="theLanguage" size="1">
				<option '; if($Sectie == "All"){echo' selected ';} echo' value="">All</option>';
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo '<option '; if($theLanguage == $row2['Id']){echo' selected ';} echo' value="'.$row2['Id'].'">'.$row2['Language'].'</option>';
	}
	
				
				echo '
			</select></td></tr>
	<tr><td>Start Date <div id="StartDateerrormsg" style="display:none;"><div id="errormsg">Error:Not a valid Date</div></div></td><td><input type="text" name="StartDate" id ="StartDate" value="'.$StartDate.'" size="24" border="0"> </td><td>End Date <div id="EndDateerrormsg" style="display:none;"><div id="errormsg">Not a valid Date</div></div></td><td> <input type="text" name="EndDate" id ="EndDate" value="'.$EndDate.'" size="24" border="0"> </td></tr>
	<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Zoeken</h4></a>
          </div></td>
        </tr>
      </table></td></tr></table></form>';
	echo'<a href="#" onClick="selectall();return false"><img src="../.'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a><a href="#" onClick="deselectall();return false"><img src="../.'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="zip current folder"></a><a href="#" onclick=" ConfirmDelete(); return false;"><img src="../.'.$_SESSION['Theme'].'/iconfilemanager/Delete.png" alt="zip current folder"></a><a href="#" onClick="printthis(\'formresultprint.php?type=&Searchstring='.$SearchString.'&theForm='.$theForm.'&theLanguage='.$theLanguage.'&StartDate='.$StartDate.'&EndDate='.$EndDate.'\');return false" ><img src="../.'.$_SESSION['Theme'].'/iconfilemanager/print.png" ></a><a href="#" onClick="downloadthis(\'formresultdownload.php?type=&Searchstring='.$SearchString.'&theForm='.$theForm.'&theLanguage='.$theLanguage.'&StartDate='.$StartDate.'&EndDate='.$EndDate.'\');return false"><img src="../.'.$_SESSION['Theme'].'/iconfilemanager/createzip.png" alt="zip current folder"></a>';	
	echo '<div id="formresultouput"></div>';

	$PageId = array();
	$SearchString = trim($SearchString);
	$SearchString = str_replace("!", " ",$SearchString);
	$SearchString = str_replace(".", " ",$SearchString);
	$SearchString = str_replace("?", " ",$SearchString);
	$SearchString = str_replace(",", " ",$SearchString);
	$SearchstringM = explode(" ", $SearchString );
	//array_push($SearchstringM, $SearchString, $SearchString, $SearchString, $SearchString, $SearchString);
	
	if ($SearchString == ""){
	// nog geen zoekopdracht
	$sqlsearstring = "";

	if ($theForm != ""){
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theGroup = "'.$theForm.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theGroup = "'.$theForm.'"';
		}
	}
	if ($theLanguage != ""){
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE Language = "'.$theLanguage.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND Language = "'.$theLanguage.'"';
		}
	}
	if ($StartDate != ""){
		$dag = substr($StartDate,0,2);
		$maand = substr($StartDate,3,2);
		$jaar = substr($StartDate,6,4);
		$StartDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theDate > "'.$StartDate.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theDate > "'.$StartDate.'"';
		}
	}
	if ($EndDate != ""){
		$dag = substr($EndDate,0,2);
		$maand = substr($EndDate,3,2);
		$jaar = substr($EndDate,6,4);
		$EndDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE theDate < "'.$EndDate.'"';
		}else{
			$sqlsearstring = $sqlsearstring.' AND theDate < "'.$EndDate.'"';
		}
	}
	
	echo '<script language="javascript">';
	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theName"], "UTF-8"))).','.str_replace("'", "\'",json_encode(mb_convert_encoding($row["theValue"], "UTF-8"))).',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	
	echo 'updateform ();</script>';
	
	}else{
	// Zoekopdracht
$sqlsearstring = "";

	
	if ($SearchString != ""){
	$first = true;
	foreach ($SearchstringM  as $keyword) {
	
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE (theValue LIKE \'%'.$keyword.'%\')';
		}else{
			if ($first == true){
				$sqlsearstring = $sqlsearstring.' OR theValue LIKE \'%'.$keyword.'%\'';
			}else{
				$sqlsearstring = $sqlsearstring.' OR theValue LIKE \'%'.$keyword.'%\'';
			}
		}
	}
	
	
	}

	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	$sqlsearstring2 = "";
	while($row = mysqli_fetch_array($result)){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE ( MainId = "'.$row["MainId"].'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' OR MainId = "'.$row["MainId"].'"';
		}
	}

	if ($sqlsearstring2 != ""){
	
	$sqlsearstring2 = $sqlsearstring2.' ) ';
	if ($theForm != ""){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theGroup = "'.$theForm.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theGroup = "'.$theForm.'"';
		}
	}
	if ($theLanguage != ""){
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  Language = "'.$theLanguage.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND Language = "'.$theLanguage.'"';
		}
	}
	if ($StartDate != ""){
		$dag = substr($StartDate,0,2);
		$maand = substr($StartDate,3,2);
		$jaar = substr($StartDate,6,4);
		$StartDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theDate > "'.$StartDate.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theDate > "'.$StartDate.'"';
		}
	}
	if ($EndDate != ""){
		$dag = substr($EndDate,0,2);
		$maand = substr($EndDate,3,2);
		$jaar = substr($EndDate,6,4);
		$EndDate = $jaar."-".$maand."-".$dag;
		if ($sqlsearstring2 == ""){
			$sqlsearstring2 = ' WHERE  theDate < "'.$EndDate.'"';
		}else{
			$sqlsearstring2 = $sqlsearstring2.' AND theDate < "'.$EndDate.'"';
		}
	}
	
	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment".$sqlsearstring2);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	//echo $sqlsearstring2
	echo '<script language="javascript">';
	
	while($row = mysqli_fetch_array($result)){

		echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theName"], "UTF-8"))).','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theValue"], "UTF-8"))).',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	//echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\',\''.str_replace("'", "\'", $row["theName"]).'\',\''.str_replace("'", "\'", $row["theValue"]).'\',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	echo 'updateform ();</script>';
	}else{
		echo 'No results';
	}
}
}else if($type=="delete"){
$message = "Information deleted";


	 mysqli_query($link,"DELETE FROM formapplayment".$MainId  )or ($message = mysqli_error($link));
		
		
	//echo "DELETE FROM formapplayment".$MainId;

			
				
				echo $message;
				echo '<script language="javascript">setTimeout("history.go(-1)", 2222);</script>';
	

}else if($type == "select"){
	$MainId = intval ($MainId);
	echo 'edit form applayment <a href="#" onClick="history.go(-2);">Back</a>
	<form name="formsave"  action="formresult.php?type=save&Id='.$MainId.'" method="POST" >';

	echo '<script language="javascript">';
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo 'addLanguage(\''.str_replace("'", "\'", $row2["Id"]).'\',\''.str_replace("'", "\'", $row2["Language"]).'\');';
	}
	echo '</script>';
	echo '<div id="formresultouput"></div>';
	echo '<script language="javascript">';
	$result = mysqli_query($link,"SELECT MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment WHERE MainId =".$MainId);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theName"], "UTF-8"))).','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theValue"], "UTF-8"))).',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	
	echo 'updateform2 ();</script><br></form>
	<div align="left">
            <a href="javascript: submitform2()"><h4>Save</h4></a>
          </div>';
}else if ($type == "save"){
	echo 'saving...';
	$message = "saved";
	$result = mysqli_query($link,"SELECT Id, MainId, theName, theValue, theGroup, Language, theDate FROM formapplayment WHERE MainId =".$MainId);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$theDate =$_POST["theDate"];
		$language= $_POST["language"];
		$thevalue=$_POST[$row["theName"]];
		$Id = $row["Id"];

		$theDate = str_replace("\\", "\\\\", $theDate);
		$theDate = str_replace("'", " ", $theDate);
		$theDate = str_replace("\"", " ", $theDate);
		$language = str_replace("\\", "\\\\", $language);
		$language = str_replace("'", " ", $language);
		$language = str_replace("\"", " ", $language);
		$thevalue = str_replace("\\", "\\\\", $thevalue);
		$thevalue = str_replace("'", " ", $thevalue);
		$thevalue = str_replace("\"", " ", $thevalue);
		
		mysqli_query($link,"UPDATE formapplayment SET theDate = '$theDate', Language = '$language', theValue = '$thevalue' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
				
		//echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\',\''.str_replace("'", "\'", $row["theName"]).'\',\''.str_replace("'", "\'", $row["theValue"]).'\',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	echo $message;
		echo '<script language="javascript">setTimeout("history.go(-2)", 2222);</script>';
}
}else{
echo 'error not logged in';

}
?>

