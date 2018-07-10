<?php
// Init session settings

// header settings
// header
if (isset($_GET["sectie"])){
	$sectie = intval($_GET["sectie"]);
}
$output .= '
<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">

themeurl = "'.$_SESSION['Theme'].'";
window.formelements = new Array();
window.curformelement = -1;
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
	error = checkform();
	
	if (error == false){
		document.form1.submit();
	}
		
	
}
function submitform2(){

		document.form1.submit();
		
	
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function setCheckedValue(radioObj, newValue) {
	if(!radioObj)
		return;
	var radioLength = radioObj.length;
	if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}
function nextpage (startpunt){
	error = checkform(startpunt);
	
	if (error == false){
		document.getElementById("page"+window.curpage).style.display = "none";
		window.curpage = window.curpage + 1
		document.getElementById("page"+window.curpage).style.display = "block";
	}
}
function backpage (startpunt){
	
		document.getElementById("page"+window.curpage).style.display = "none";
		window.curpage = window.curpage - 1
		document.getElementById("page"+window.curpage).style.display = "block";
	
}
function checkform(startpunt){
	alles = false;
	if (typeof startpunt == \'undefined\'){
		alles = true;
		startpunt = window.formelements.length-1;
		
	}
	
	error = false;
	for (i=startpunt;i>-1;i--)
	{
		
		
		if (window.formelements[i].Type == "nextpage" && startpunt != i && alles != true){
			
			i = -1;
		}else{
			value ="";
			if (window.formelements[i].Type == "radio"){
					value = getCheckedValue(document.getElementsByName(window.formelements[i].Name));
			}else if (window.formelements[i].Type == "checkbox"){
					if (document.getElementById(window.formelements[i].Name).checked == true){
						value = document.getElementById(window.formelements[i].Name).value;
					}else{
						value="";
					}
			}else if(window.formelements[i].Type == "recieveremail"){
					
			}else{
					if (window.formelements[i].Name != ""){
						value = document.getElementById(window.formelements[i].Name).value;
					}
			}
			
			switch(window.formelements[i].rules){
			case "0":
				break;
			case "1":
				
				if (value.length > 0){
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "2":
				
				if (value.length == 10){
					line1 = value.charAt(2);
					line2 = value.charAt(5);
					if (line1 == "-" && line2 == "-"){
						dag = value.substr(0,2);
						maand = value.substr(3,2);
						jaar = value.substr(6,4);
						if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
						}else{
							error = true;
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
						}
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "3":
				
				if (value.length == 8){
					line1 = value.charAt(2);
					line2 = value.charAt(5);
					if (line1 == ":" && line2 == ":"){
						dag = value.substr(0,2);
						maand = value.substr(3,2);
						jaar = value.substr(6,2);
						if (isNaN(dag) == false && isNaN(maand) == false && isNaN(jaar) == false){
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
						}else{
							error = true;
							document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
						}
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				break;
			case "4":
				
				if (value.length > 0){
					newarray = value.split("@");
					if (newarray.length == 2){
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				
				break;
			case "5":
				
				
				if (value.length > 8){
					http = value.substr(0,4);
					if (http == "http"){
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "none";
					}else{
						error = true;
						document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
					}
				}else{
					error = true;
					document.getElementById(window.formelements[i].Name+"errormsg").style.display = "block";
				}
				
				break;
		}

	}}
	return error;
}

function updateform (){

	window.curpage = 1;
	pages = 1;
	txt = \'<div id="page\'+pages+\'" style="display:block;"><table>\';
	
	for (i=0;i<window.formelements.length;i++)
	{
			
		txt = txt+"<tr><td>";
		switch(window.formelements[i].Type){
		case "richtext":
			txt = txt +\'</td><td colspan="3">\'+ window.formelements[i].text+\'\';
		break;
		case "text":
			txt = txt +\'</td><td width="100">\'+ window.formelements[i].text+\'</td><td> <input type="text" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "hidden":
			txt = txt +\'</td><td></td><td> <input type="hidden" name="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" />\';
			break;
		case "radio":
			if (window.formelements[i].checked == true){
				ischecked= "checked";
			}else{
				ischecked= "";
			}
			txt = txt +\'</td><td width="100">\'+ window.formelements[i].text+\'</td><td> <input type="radio" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" \'+ischecked+\' value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "checkbox":
			if (window.formelements[i].checked == true){
				ischecked= "checked";
			}else{
				ischecked= "";
			}
			txt = txt +\'</td><td width="100">\'+ window.formelements[i].text+\'</td><td> <input type="checkbox" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" \'+ischecked+\' value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		case "textarea":
			txt = txt +\'</td><td colspan="2">\'+ window.formelements[i].text+\'<br><textarea id="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" name="\'+window.formelements[i].Name+\'" style="width: 350px; height: 175px;" >\'+window.formelements[i].theValue+\'</textarea></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div> \';
			break;
		case "recieveremail":
			txt = txt +\'</td><td width="100"> </td><td><input type="hidden" name="\'+window.formelements[i].Name+\'" id="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td>\';
			break;
		case "nextpage":
			txt = txt +\'</td><td colspan="3"><br><a href="#" onClick="nextpage(\'+i+\');return false">\'+ window.formelements[i].text+\'</a><br> \';
			txt = txt +\'</table></div>\';
			pages = pages + 1;
			txt = txt + \'<div id="page\'+pages+\'" style="display:none;"><table><a href="#" onClick="backpage(\'+i+\');return false">Back</a>\';
			
			break;
		case "submitbutton":
			txt = txt +\'</td><td colspan="3"><br><div id="buttonlayout"><h4><a href="#" onClick="submitform();return false">\'+ window.formelements[i].text+\'</a></h4></div><br> \';
			break;
		case "Vertivicationcode":
			txt = txt +\'</td><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr><tr><td></td><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"></td><td>\';
			
			break;
		case "applyeremail":
			txt = txt +\'</td><td>\'+ window.formelements[i].text+\'</td><td> <input type="text" id="\'+window.formelements[i].Name+\'" name="\'+window.formelements[i].Name+\'" value="\'+window.formelements[i].theValue+\'" /></td><td><div id="\'+window.formelements[i].Name+\'errormsg" style="display:none;"><div id="errormsg">\'+window.formelements[i].errormsg+\'</div></div>\';
			break;
		}		
		
	}
	txt = txt +\'</table></div>\';
	document.getElementById(\'formelements\').innerHTML = txt;
	
}

function addformelement(Name,theValue,Type,checked,text,rules,errormsg,formeditid){
	
	if (formeditid == -1){
		error = false;
		if (Type == "Vertivicationcode"){
			for (i=0;i<window.formelements.length;i++)
			{
				if (window.formelements[i].Type=="Vertivicationcode"){
					error= true;
				}
			}
		}
		if (error == true){
			alert("You can only add 1 vertivication code");
		}else{
			tmparray = new Array();
			tmparray.Name = Name;
			tmparray.theValue = theValue;
			tmparray.Type = Type;
			tmparray.checked = checked;
			tmparray.text = text;
			tmparray.rules = rules;
			tmparray.errormsg = errormsg;
			window.formelements.push(tmparray);
		}
	}else{
		window.formelements[formeditid].Name = Name;
		window.formelements[formeditid].theValue = theValue;
		window.formelements[formeditid].Type = Type;
		window.formelements[formeditid].checked = checked;
		window.formelements[formeditid].text = text;
		window.formelements[formeditid].rules = rules;
		window.formelements[formeditid].errormsg = errormsg;
	}
}
</script>';

	

$txt =  '<form action="indexnew.php?plugin=form&type=save&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on"><div id="formelements"></div></form>';
$found = false;
if ($type == "select"){

	$result = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$acces = $documentinfo["accesdoc"];
		$found = true;
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		$MainId = $row['targetmainid'];
		$MessageSetting = findMessagesettings($row['MainId'], array());
		if (($theDate = strtotime($row['theDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($LastSaved = strtotime($row['LastSaved'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		if (($PublishDate = strtotime($row['PublishDate'])) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		$todays_date = date("Y-m-d H:i:s");
		
		if (($todays_date = strtotime($todays_date)) === -1) {
		echo "De string ($str) is niet geldig";
		} 
		
		
	}
	
	if ($found == true){
	$txt = $txt.'<script language="javascript">';
$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			$text = $row2["text"];
			if ( $row2["Type"]=="richtext" and $acces == true){
				preg_match_all('/src\=\".\/uploads\/(.*?)\"/',$text, $theurl);
				for($i=0;$i<count($theurl[0]);$i++){		
					array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 5, strlen($theurl[0][$i])-6));
				}
				preg_match_all('/background\=\".\/uploads\/(.*?)\"/',$text, $theurl);
				for($i=0;$i<count($theurl[0]);$i++){		
					array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 12, strlen($theurl[0][$i])-13));
				}
				preg_match_all('/href\=\".\/uploads\/(.*?)\"/',$text, $theurl);
				for($i=0;$i<count($theurl[0]);$i++){		
					array_push($_SESSION['Accesfiles2'], substr($theurl[0][$i], 6, strlen($theurl[0][$i])-7));
				}
				$text = preg_replace('/src\=\".\/uploads\/(.*?)\"/', 'src="./system/fileopen2.php?url=./uploads/$1"', $text);
				$text = preg_replace('/background\=\".\/uploads\/(.*?)\"/', 'background="./system/fileopen2.php?url=./uploads/$1"', $text);
				$text = preg_replace('/href\=\".\/uploads\/(.*?)\"/', 'href="./system/fileopen2.php?url=./uploads/$1"', $text);
			}
			$txt = $txt. 'addformelement(\''.str_replace("'", "\'", $row2["Name"]).'\',\''.str_replace("'", "\'", $row2["theValue"]).'\',\''.str_replace("'", "\'", $row2["Type"]).'\',\''.str_replace("'", "\'", $row2["checked"]).'\',\''.str_replace("'", "\'", $text).'\',\''.str_replace("'", "\'", $row2["formrules"]).'\',\''.str_replace("'", "\'", $row2["errormsg"]).'\',-1);';
			
		}
		$txt = $txt.'updateform ();</script> ';
	}
} else if ($type == "save"){
$result =  mysqli_query($link,"SELECT Id, Replystext, Reply, Noreplyfound, introreply, Usernametext, emailtext, secretcodetext, insertsecretcodetext, informmetext, messagetext, messagebuttontext, Nomailtext, somebodyrespondtext, messageplaced, nomessagefound, emailisempty, messageisempty, usernameisempty, wrongsecretcode FROM messagetext WHERE Language =".$_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	//$Id = intval($row["Id"]);
	$Replystext= $row["Replystext"];
	$Reply= $row["Reply"];
	$Noreplyfound= $row["Noreplyfound"];
	$introreply= $row["introreply"];
	$Usernametext= $row["Usernametext"];
	$emailtext= $row["emailtext"];
	$secretcodetext= $row["secretcodetext"];
	$insertsecretcodetext= $row["insertsecretcodetext"];
	$informmetext= $row["informmetext"];
	$messagetext= $row["messagetext"];
	$messagebuttontext= $row["messagebuttontext"];
	$Nomailtext= $row["Nomailtext"];
	$somebodyrespondtext= $row["somebodyrespondtext"];
	$messageplaced= $row["messageplaced"];
	$nomessagefound= $row["nomessagefound"];
	$emailisempty= $row["emailisempty"];
	$messageisempty= $row["messageisempty"];
	$usernameisempty= $row["usernameisempty"];
	$wrongsecretcode= $row["wrongsecretcode"];	

	}

	$txt = $messageplaced."<br>";
	$result = mysqli_query($link,"SELECT Naam, Parent, Id, targetmainid FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$found = true;
		$acces = $documentinfo["accesdoc"];
		$Naam = $row['Naam'];
		$Parent = $row['Parent'];
		$IdGroup = $row['Id'];
		$MainIdGroup = $MainId;
		//$MainId = $row['targetmainid'];
	}
	//error checking
	$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." AND Type='Vertivicationcode' ORDER BY Theorder");
	if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
	}
	$error = false;
	
	while($row2 = mysqli_fetch_array($result2)){
			
			$ImgPas = $_POST["ImgPas"];
			$ImgPas= str_replace("'", " ", $ImgPas);
			$ImgPas= str_replace('"', " ", $ImgPas);
			if ($ImgPas != $_SESSION['SystemImgPas'] or $ImgPas == ""){
				$error = true;
			}
			//echo $ImgPas . $_SESSION['SystemImgPas'];
	}
	if ($error == true){
	// error detected
		$txt =  '<form action="indexnew.php?plugin=form&type=save&sectie='.$sectie.'&Id='.$MainId.'" method="POST" name="form1" autocomplete="on"><div id="formelements" style="display:none"></div>';
		$txt = $txt.'<script language="javascript">';
$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." ORDER BY Theorder");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}

		while($row2 = mysqli_fetch_array($result2)){
			if ($row2["Type"] != "Vertivicationcode"){
				switch ($row2["Type"]){
					case "text":			
				
					case "hidden":	
			
					case "textarea":
						
						
					
					
					case "applyeremail":
						$value = $_POST[$row2["Name"]];
						$checked = $row2["checked"];
						break;
					case "recieveremail":
						$value = $row2["theValue"];
						$checked = $row2["checked"];
						break;
					case "radio":				
						if ($_POST[$row2["Name"]] == $row2["theValue"]){
							$checked = true;
						}else {
							$checked = false;
						}
						$value = $row2["theValue"];
						break;	
					case "checkbox":
						if ($_POST[$row2["Name"]] == $row2["theValue"]){
							$checked = true;
						}else {
							$checked = false;
						}
						$value = $row2["theValue"];
						break;	
						
			}
				
				$txt = $txt.'addformelement(\''.str_replace("'", "\'", $row2["Name"]).'\',\''.str_replace("'", "\'", $value).'\',\''.str_replace("'", "\'", $row2["Type"]).'\',\''.str_replace("'", "\'", $checked).'\',\''.str_replace("'", "\'", $row2["text"]).'\',\''.str_replace("'", "\'", $row2["formrules"]).'\',\''.str_replace("'", "\'", $row2["errormsg"]).'\',-1);';
				
			}
		}
		$txt = $txt.'updateform ();</script>';
		
		$txt = $txt. '<table>';
		$txt = $txt. '<tr><td><div id="errormsg">'.$wrongsecretcode.'</div></td></tr>';
		$txt = $txt.'<tr><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr>
		<tr><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"></td></tr>';
		$txt = $txt. '</table>';
		$txt = $txt. '<div id="buttonlayout">
            <a href="javascript: submitform2()"><h4>Save</h4></a>
          </div></form>';
	}else if ($acces == true){
	
	// saving
	$result2 = mysqli_query($link,"SELECT Id, Name, theValue, Type, checked, TheOrder,text,formrules,errormsg FROM formfield WHERE FormId=".$IdGroup." ORDER BY Theorder");
	if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
	}
	
	$first = true;
	$inputMainId = -1;
	$to="";
	$subject=$Naam;
	while($row2 = mysqli_fetch_array($result2)){
		
		switch ($row2["Type"]){
			case "text":			
				
			case "hidden":				
					
			case "radio":

			case "checkbox":				
				
			case "textarea":
				
				$thename =$row2["Name"];
				$value = $_POST[$row2["Name"]];
				$value = str_replace("<", " ", $value);
				$found2 = false;
				$thename =addslashes($thename);
				$value =addslashes($value);
				$result3 = mysqli_query($link,"SELECT MainId, theName FROM formapplayment WHERE MainId=".$inputMainId." AND theName = '".$thename."'");
				if (!$result3) {
    					die('Query failed: ' . mysqli_error($link));
				}				
				while($row3 = mysqli_fetch_array($result3)){
					$found2 = true;
				}
				if ($found2 == false){
					$txt=$txt.$row2["Name"]." = ".$_POST[$row2["Name"]]."<br>";
					mysqli_query($link,"INSERT INTO formapplayment (MainId, theName, theValue, theGroup, Language) VALUES ('$inputMainId', '$thename','$value','$MainIdGroup','".$_SESSION['Language']."')")or  ($txt = $txt.mysqli_error($link));
					if ($first == true){
						$inputMainId = mysqli_insert_id($link);
						mysqli_query($link,"UPDATE formapplayment SET MainId = '$inputMainId' WHERE Id = '$inputMainId'");
						$first = false;
					}
				}
				break;	
			case "applyeremail":
				$thename =$row2["Name"];
				$value = $_POST[$row2["Name"]];
				$value = str_replace("<", " ", $value);
				$found2 = false;
				$thename =addslashes($thename);
				$value =addslashes($value);
				$result3 = mysqli_query($link,"SELECT MainId, theName FROM formapplayment WHERE MainId=".$inputMainId." AND theName = '".$thename."'");
				if (!$result3) {
    					die('Query failed: ' . mysqli_error($link));
				}				
				while($row3 = mysqli_fetch_array($result3)){
					$found2 = true;
				}
				if ($found2 == false){
					$txt=$txt.$row2["Name"]." = ".$_POST[$row2["Name"]]."<br>";
					mysqli_query($link,"INSERT INTO formapplayment (MainId, theName, theValue, theGroup, Language) VALUES ('$inputMainId', '$thename','$value','$MainIdGroup','".$_SESSION['Language']."')")or  ($txt = $txt.mysqli_error($link));
					if ($first == true){
						$inputMainId = mysqli_insert_id($link);
						mysqli_query($link,"UPDATE formapplayment SET MainId = '$inputMainId' WHERE Id = '$inputMainId'");
						$first = false;
					}
				}
				if ($to == ""){
					$to = $value;
				}else{
					$to = $to.",".$value;
				}
				break;
			case "recieveremail":
				$value = $row2["theValue"];
				if ($to == ""){
					$to = $value;
				}else{
					$to = $to.",".$value;
				}
				break;		
		}
	}
	$query2 = "SELECT Id, submitemail, submitreplyemail, submitsenderemail FROM system ";
			$result2 = mysqli_query($link,$query2);
			if (!$result) {
	    			die('Query failed: ' . mysqli_error($link));
			}
			while($row2 = mysqli_fetch_array($result2)){
				$headers  = 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\n";
				$headers .= 'From: '.$row2['submitsenderemail']. "\n" .
	    			'Reply-To: '.$row2['submitreplyemail'] . "\n" .
    				'X-Mailer: PHP/' . phpversion();
			}
			
			mail($to, $subject, $txt.'</body></html>' , $headers);
			
	}
	
}

if (isset($sectie)){
$result = mysqli_query($link,"SELECT MainId, Naam, Menu, Showtimestamp FROM groepen WHERE Language =".$_SESSION['Language']." AND MainId=".$sectie );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$menuname = $row["Naam"] ;
		if ($row["Menu"] == Horizontal){
			$menu = 'Horizontal' ;
		}else if($row["Menu"] == Vertical){
			$menu = 'Vertical' ;
		}else{
			$menu = 'Hidden' ;
		}
		$Showtimestamp = $row["Showtimestamp"];
	}}else{
	$menu = 'Vertical' ;
	$Showtimestamp = 1;
	}


if ($found == true and $acces == true){
	
	
	if ($Showtimestamp==1 and $timestampoverrid != -1){$output = "<i><b>Created:</b> ".date('Y-m-j',$theDate)." <b>Last modified:</b> ".date('Y-m-j',$LastSaved)." <b>Published:</b> ".date('Y-m-j',$PublishDate)."</i><br><br>".$output;}
	$output .= $txt;
	
	

} elseif ($found == true and $acces == false){

		$Naam = 'acces denied';
		$output = "";
		if ($_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Moderator'){
		
		}else{
		$output .= '
		<p>Voer hier uw username en password in:</p>
		<form action="Login.php?redirect='.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
		}	
}else{
	$Naam = '';
	$output = "";
	if ($type == "select") {
		$Naam = 'Page not found';
		$output .= 'The page you try to acces is not found, try another Language. Pleas select the Language from the language menu ';
	}
}
?>
