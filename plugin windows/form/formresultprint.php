<?php session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include('../../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
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

function addLanguage(Id, Language){
	tmparray = new Array();
	tmparray.Id = Id;
	tmparray.Language = Language;
	window.Language[Id] = new Array();
	window.Language[Id] = tmparray;
}

function sortby(property){
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
					txt = txt +'<tr><td></td><td>'+item[window.propertys[i]].MainId+'</td><td>'+item[window.propertys[i]].theDate+'</td><td>'+window.Language[item[window.propertys[i]].Language].Language+'</td>'+tmptxt;
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
	$SortBy = $_GET["OrderBy"];
	$SearchString = str_replace("'", " ", $SearchString);
	$SearchString = str_replace('"', " ", $SearchString);
	$SearchString = str_replace(',', " ", $SearchString);
	$SearchString = str_replace('\\', " ", $SearchString);
	$SortBy = str_replace("'", " ", $SortBy);
	$SortBy = str_replace('"', " ", $SortBy);
	$SortBy = str_replace(',', " ", $SortBy);
	$SortBy = str_replace('\\', " ", $SortBy);
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

$result2 = mysqli_query($link,"SELECT MainId, Naam, Parent, TheOrder, Type, Id, targetmainid FROM groepen WHERE Type = 'form' AND MainId='$theForm' AND Language=". $_SESSION['Language']);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		echo "<h1>$theForm ".$row2['Naam']."</h1><br>";
	}
	echo "
		Search = $SearchString <br>";
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language WHERE Id = '$theLanguage'");
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo "Language = ";
	while($row2 = mysqli_fetch_array($result2)){
		echo $row2['Language'];
	}
		
		echo "<br>Start Date = $StartDate<br>
		End Date = $EndDate<br>
		Order by = $SortBy";
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
		echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theName"], "UTF-8"))).','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theValue"], "UTF-8"))).',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	
	if ($SortBy == ""){
		echo 'updateform ();';
	}else{
		if ($SortBy == "Id" OR $SortBy == 'Date' OR $SortBy == 'Language'){
			
			echo "sortby2('$SortBy');";
		}else{
			echo "sortby('$SortBy');";
		}
		
	}
	echo 'window.print();</script>';
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
	
	echo '<script language="javascript">';
	while($row = mysqli_fetch_array($result)){
		echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theName"], "UTF-8"))).','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["theValue"], "UTF-8"))).',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	}
	//echo 'addformelement(\''.str_replace("'", "\'", $row["MainId"]).'\',\''.str_replace("'", "\'", $row["theName"]).'\',\''.str_replace("'", "\'", $row["theValue"]).'\',\''.str_replace("'", "\'", $row["theGroup"]).'\',\''.str_replace("'", "\'", $row["Language"]).'\',\''.str_replace("'", "\'", $row["theDate"]).'\',-1);';
	
	if ($SortBy == ""){
		echo 'updateform ();';
	}else{
		if ($SortBy == "Id" OR $SortBy == 'Date' OR $SortBy == 'Language'){
			echo "sortby2('$SortBy');";
		}else{
			echo "sortby('$SortBy');";
		}
		echo 'updateform ();';
	}
	echo 'window.print();</script>';
	}
}}
}else{
echo 'error not logged in';

}
?>

