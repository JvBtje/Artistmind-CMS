<?php
// Init session settings
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
include("./system/include.php");
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
  header("Cache-control: private"); 
$output .= '
<!DOCTYPE HTML PUBLIC 
   "http://www.w3.org/TR/html4/strict.dtd"><accept-charset="UTF-8"><meta charset="utf-8">


<head>
<script type="text/javascript" src="nicEdit.js"></script>
<script language="javascript">
var myNicEditor1,myNicEditor2,myNicEditor3,myNicEditor4;

 function changelanguase(veld, Id){
    if(veld == \'new\'){
 		 window.open(\'main.php?type=new_Language\',\'_self\',\'\',\'true\');
 	}else if(veld == \'delete\'){
	if (confirm(\'Are you sure to delete this language?\')) { 
 		 window.open(\'main.php?type=delete_Language&delete_Language_Id=\'+Id,\'_self\',\'\',\'true\');
		 }
 	}else if(veld == \'unknow\'){
  
 	}else{
	window.open(\'main.php?language_id=\'+veld,\'_self\',\'\',\'true\');
	} 
	
 }
function addArea2() {
	myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\', thehtml : \'hallo\'}).panelInstance(\'Text1\',\'test\',\'hallo wereld\');
}
function removeArea2() {
	myNicEditor1.removeInstance(\'Text1\');	
}


function window_onload(){
			 myNicEditor1 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Text1\');
			 myNicEditor2 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Text2\');
			 myNicEditor3 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'Text3\');
			 myNicEditor4 = new nicEditor({fullPanel : true, iconsPath : \'./iconen/nicEditorIcons.gif\'}).panelInstance(\'HeadText\');
}


function changeval(){
	document.forms["form1"]["changed"].value = "true";
}

function submitform2(){
document.form1.submit();
}

function submitform(){

	document.forms["form1"]["changed"].value = "false";	
	myNicEditor4.removeInstance(\'HeadText\');	
	myNicEditor1.removeInstance(\'Text1\');	
	myNicEditor2.removeInstance(\'Text2\');	
	myNicEditor3.removeInstance(\'Text3\');	
	document.form1.submit();
}
function dofilemanager(link){
	document.getElementById(window.elementvar).value = link;	
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


function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { submitform()}
}}
</script>';

$myUrl = explode("?", curPageURL());

// set and check language
$language_id = intval($_GET["language_id"]); 
if ($language_id != ""){$_SESSION['Language'] =$language_id;}
// header settings
$banner = "";
include "header.php";

?>
<div id="Middel">
<?php
$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien

function displayList (){


}



if ($type=="new_Language"){
		$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td> </td>
			</tr>
			<tr>
				<td width="33%">';
	// ouput user selectie
	displayList ();
	
	$output .= '</td>
				<td>';
				$output .='	<form action="main.php?type=save_Language" method="POST" name="form1" autocomplete="on">
				<input type="hidden" name="changed" id="changed" value="false"><select name="language" id="language" onchange=changeval()>';
				$result = mysqli_query($link,"SELECT Id, Language FROM mainbody");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	while($row = mysqli_fetch_array($result)){
		$Present_Language[$Present_Language.sizeof] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id != ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." AND Id != ".$row['Language'];
		}
	}
	$result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$output .= '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected ';}
	$output .= '>'.$row2['Language'].'</option>';
	}
	$output .= '</select><br><br><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform2()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></form>
	';

	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="save_Language"){
	
	$newlanguage = $_POST["language"];
	$found = false;
	if ($newlanguage <> ""){
	$result = mysqli_query($link,"SELECT Id, Text1, Text2, Text3, HeadText, Image1, Image2, Image3 FROM mainbody WHERE Language =".$newlanguage);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$found = true;
	}
	if ($found == true){
		$message = "Language already exist";
	}else{
		$message = "Language is created";
	$result = mysqli_query($link,"SELECT Id, Naam1, Naam2, Naam3, Support, News, MainId, Text1, Text2, Text3, HeadText, Image1, Image2, Image3, Language  FROM mainbody WHERE Language =".$_SESSION['Language']);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	
	while($row = mysqli_fetch_array($result)){
	$Naam1 = $row["Naam1"]; 
	$Naam2 = $row["Naam2"]; 
	$Naam3 = $row["Naam3"]; 
	$MainId = $row["MainId"];
	$Id = $row["Id"];
	$HeadText = $row["HeadText"];
	$Text1 = $row["Text1"]; 
	$Text2 = $row["Text2"]; 
	$Text3 = $row["Text3"]; 
	$Image1 = $row["Image1"]; 
	$Image2 = $row["Image2"]; 	
	$Image3 = $row["Image3"]; 
	$News =$row["News"]; 
	$Support =$row["Support"]; 
	$Langinputid = $row['Language'];
	}

// Voor zoekt iso6931 codes op voor vertaling
	$result2 = mysqli_query($link,"SELECT Id, iso6392code, Language FROM language WHERE Id =".$Langinputid) or die("fout bij uitvoeren van query");
	$myflds2 = mysqli_num_fields($result2);

	while($row2 = mysqli_fetch_array($result2)){
		$langinput = $row2['iso6392code'];
		$langinputid = $row2['Id'];
  		$langerror = 'The source language is '. $row2['Language'];
		$langerror = translate( $langerror, $destLang = $langouput, $srcLang = 'en' ) ;
		$output .= $langerror;
		break;
		}
	
	$result2 = mysqli_query($link,"SELECT Id, iso6392code, Language FROM language WHERE Id =".$newlanguage) or die("fout bij uitvoeren van query");
	$myflds2 = mysqli_num_fields($result2);

	while($row2 = mysqli_fetch_array($result2)){
		$langouput = $row2['iso6392code'];
		$langouputid = $row2['Id'];
  		$langerror = 'The source language is '. $row2['Language'];
		$langerror = translate( $langerror, $destLang = $langouput, $srcLang = $langinput ) ;
		$output .= $langerror;
		break;
		}

	$Naam1 = str_replace('"', " ", $Naam1);
	$Naam1 = str_replace("\\", "\\\\", $Naam1);
	$Naam1 = str_replace('"', " ", $Naam1);
	$Naam2 = str_replace('"', " ", $Naam2);
	$Naam2 = str_replace("\\", "\\\\", $Naam2);
	$Naam2 = str_replace('"', " ", $Naam2);
	$Naam3 = str_replace('"', " ", $Naam3);
	$Naam3 = str_replace("\\", "\\\\", $Naam3);
	$Naam3 = str_replace('"', " ", $Naam3);
	
	$Text1= addslashes($Text1);
	$Text2 = addslashes($Text2);
	$Text3= addslashes($Text3);
	$HeadText= addslashes($HeadText);
	
	//$Text1 = str_replace("\\", "\\\\", $Text1);
	//$Text1 = str_replace("'", "\\\'", $Text1);
	//$Text2 = str_replace("\\", "\\\\", $Text2);
	//$Text2 = str_replace("'", "\\\'", $Text2);
	//$Text3 = str_replace("\\", "\\\\", $Text3);
	//$Text3 = str_replace("'", "\\\'", $Text3);
	//$HeadText = str_replace("\\", "\\\\", $HeadText);
	//$HeadText = str_replace("'", "\\\'", $HeadText);
	$Image1 = str_replace("'", " ", $Image1);
	$Image1 = str_replace('"', " ", $Image1);
	$Image1 = str_replace("\\", "\\\\", $Image1);
	$Image2 = str_replace('"', " ", $Image2);
	$Image2 = str_replace("\\", "\\\\", $Image2);
	$Image2 = str_replace('"', " ", $Image2);
	$Image3 = str_replace('"', " ", $Image3);
	$Image3 = str_replace("\\", "\\\\", $Image3);
	$Image3 = str_replace('"', " ", $Image3);
	
	$Support = str_replace('"', " ", $Support);
	$Support = str_replace("\\", "\\\\", $Support);
	$Support = str_replace('"', " ", $Support);
	
	$News = str_replace('"', " ", $News);
	$News = str_replace("\\", "\\\\", $News);
	$News = str_replace('"', " ", $News);
	
	mysqli_query($link,"INSERT INTO mainbody (MainId, Text1, Text2, Text3,Language, Image1, Image2, Image3, HeadText, Naam1, Naam2, Naam3, News, Support) VALUES ('$MainId', '$Text1','$Text2','$Text3','$newlanguage','$Image1','$Image2','$Image3','$HeadText','$Naam1', '$Naam2', '$Naam3','$News','$Support')")or ($message = mysqli_error($link));
	$_SESSION['Language'] = $newlanguage;
	}
	
	} else {
	$output .= 'error new language is not set';
	}
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'main.php\',\'_self\',\'\',\'true\')", 0);</script>';
} else if ($type=="delete_Language"){
	//if ($_SESSION['Language'] != "" and $_SESSION['Language'] != -1 and $_GET['delete_Language_Id'] == $_SESSION['Language']){
	$message = "";
		mysqli_query($link,"DELETE FROM mainbody WHERE Id=".intval($_GET['delete_Language_Id']))or ($message = mysqli_error($link));
		if ($message == ""){	
		$message ="Language deleted";
		
		}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'main.php\',\'_self\',\'\',\'true\')", 0);</script>';
}else if ($type=="save"){
	$Id = intval($_POST["Id"]);
	$HeadText = $_POST["HeadText"];
	$Naam1 = $_POST["Naam1"]; 
	$Naam2 = $_POST["Naam2"]; 
	$Naam3 = $_POST["Naam3"]; 
	$Text1 = $_POST["Text1"]; 
	$Text2 = $_POST["Text2"]; 
	$Text3 = $_POST["Text3"]; 
	$Image1 = $_POST["Image1"]; 
	$Image2 = $_POST["Image2"]; 	
	$Image3 = $_POST["Image3"]; 
	$News =$_POST["News"]; 
	$Support =$_POST["Support"]; 
	//$Text1= addslashes($Text1);
	
	//$Naam = str_replace('"', " ", $Naam);
	$Naam1 = str_replace("\\", "\\\\", $Naam1);
	$Naam1 = str_replace('"', " ", $Naam1);
	$Naam2 = str_replace("\\", "\\\\", $Naam2);
	$Naam2 = str_replace('"', " ", $Naam2);
	$Naam3 = str_replace("\\", "\\\\", $Naam3);
	$Naam3 = str_replace('"', " ", $Naam3);
	$Text1= addslashes($Text1);
	$Text2= addslashes($Text2);
	$Text3= addslashes($Text3);
	$HeadText= addslashes($HeadText);
	//$output .= removeFullLinks();
	$Text1 = removeFullLinks($Text1);
	$Text2 = removeFullLinks($Text2);
	$Text3 = removeFullLinks($Text3);
	//$HeadText = removeFullLinks($HeadText);
	//$Text1 = str_replace("\\", "\\\\", $Text1);
	//$Text1 = str_replace("'", "\\\'", $Text1);
	//$Text2 = str_replace("\\", "\\\\", $Text2);
	//$Text2 = str_replace("'", "\\\'", $Text2);
	//$Text3 = str_replace("\\", "\\\\", $Text3);
	//$Text3 = str_replace("'", "\\\'", $Text3);
	//$HeadText = str_replace("\\", "\\\\", $HeadText);
	//$HeadText = str_replace("'", "\\\'", $HeadText);
	$Image1 = str_replace("'", " ", $Image1);
	$Image1 = str_replace('"', " ", $Image1);
	$Image1 = str_replace("\\", "\\\\", $Image1);
	$Image2 = str_replace('"', " ", $Image2);
	$Image2 = str_replace("\\", "\\\\", $Image2);
	$Image2 = str_replace('"', " ", $Image2);
	$Image3 = str_replace('"', " ", $Image3);
	$Image3 = str_replace("\\", "\\\\", $Image3);
	$Image3 = str_replace('"', " ", $Image3);
	$Support = str_replace('"', " ", $Support);
	$Support = str_replace("\\", "\\\\", $Support);
	$Support = str_replace('"', " ", $Support);
	$News = str_replace('"', " ", $News);
	$News = str_replace("\\", "\\\\", $News);
	$News = str_replace('"', " ", $News);
	
	
	$message = "";
	$error = false;
	if ($Id == "new"){
		$systemPassword = "";
	}else{
		$query = "SELECT Password FROM login WHERE Id=$Id";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
	
		while($row = mysqli_fetch_array($result)){
			$systemPassword = $row['Password'];
		}
	}
	
		
			

	mysqli_query($link,"UPDATE mainbody SET Text1 = '$Text1',Naam1 = '$Naam1',Naam2 = '$Naam2',Naam3 = '$Naam3',Support= '$Support',News = '$News', Text2 = '$Text2', Text3 = '$Text3', HeadText = '$HeadText', Image1 = '$Image1', Image2 = '$Image2', Image3 = '$Image3' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			
	if ($message == ""){
		$message="Main body saved";
	}else{
		$error = true;
	}

	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'main.php\',\'_self\',\'\',\'true\')", 0);</script>';
}else {
$result = mysqli_query($link,"SELECT Id FROM mainbody WHERE Language =".$_SESSION['Language'] );
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Id = -1;
	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
	}
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%"></td>
				<td><select name="language" id="language" onchange="changelanguase(this.value,'.$Id.');">';
				
	$result = mysqli_query($link,"SELECT Id, Language FROM mainbody");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	$Present_Language = array ();
	$searchstring = " WHERE";
	$first = true;
	$foundLanguage = false; 
	while($row = mysqli_fetch_array($result)){
		$Present_Language[count($Present_Language)] = $row['Language'];
		if ($first == true){
			$searchstring =$searchstring." Id = ".$row['Language'];
			$first = false;
		}else{
			$searchstring =$searchstring." OR Id = ".$row['Language'];
		}
	}
	
	 $result2 = mysqli_query($link,"SELECT Id, Language FROM language". $searchstring);
	if (!$result2) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
	$output .= '<option value="'.$row2['Id'].'"';
	if ($_SESSION['Language'] == $row2['Id']){$output .= ' selected '; $foundLanguage = true;}
	$output .= '>'.$row2['Language'].'</option>';
	}
	
	if ( $foundLanguage == true){$output .= '<option value="new">new</option>';}else if ($_SESSION['Language']==""){$_SESSION['Language'] = -1;}
	if (count($Present_Language) > 1 and $foundLanguage == true){$output .= '<option value="delete">Delete current</option>';}
	$output .= '</select>
				</td>
			</tr>
			<tr>
				<td width="30%" valign="top">';
	// ouput user selectie
	displayList ();
$output .= '</td>
				<td>';

	$query = "SELECT Id, Text1, Text2, Text3, Naam1,Naam2,Naam3, HeadText,  Image1, Image2, Image3, Support, News FROM mainbody WHERE Language =".$_SESSION['Language'];
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		$Text1 = $row['Text1'];
		$Text2 = $row['Text2'];
		$Text3 = $row['Text3'];
		
		$output .= '
		
		<div id="contain">
		<form action="main.php?type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr colspan="2"><td>Algemene text </td></tr><tr><td colspan="2"><textarea id="HeadText" name="HeadText" style="width: 550px; height: 100px;" >'.$row['HeadText'].'</textarea></td></tr>
		<tr><td>Naam 1</td><td><input type="text" name="Naam1" value="'.$row['Naam1'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Image 1</td><td><input type="text" id="Image1" name="Image1" value="'.$row['Image1'].'" size="30" border="0" onchange="changeval();"><input type = "button" value = "Choose file" onclick="selectFile(\'listFiles.php\',\'Image1\');" /></td></tr>
		<tr><td colspan="2">text 1</td></tr><tr><td colspan="2" bgcolor="#426f78"> <textarea id="Text1" name="Text1" style="width: 550px; height: 175px;" >'.$Text1.'</textarea></td></tr>
				<tr><td>Naam 2</td><td><input type="text" name="Naam2" value="'.$row['Naam2'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Image 2</td><td><input type="text" id="Image2" name="Image2" value="'.$row['Image2'].'" size="30" border="0" onchange="changeval();" ><input type = "button" value = "Choose file" onclick="selectFile(\'listFiles.php\',\'Image2\');" /></td></tr>			
		<tr><td colspan="2">text 2</td></tr><tr><td colspan="2" bgcolor="#426f78"><textarea id="Text2" name="Text2" style="width: 550px; height: 175px;" >'.$Text2.'</textarea></td></tr>			
				<tr><td>Naam 3  </td><td><input type="text" name="Naam3" value="'.$row['Naam3'].'" size="30" border="0" onchange="changeval();"></td></tr>
		<tr><td>Image 3</td><td><input type="text" id="Image3" name="Image3" value="'.$row['Image3'].'" size="30" border="0"  onchange="changeval();"><input type = "button" value = "Choose file" onclick="selectFile(\'listFiles.php\',\'Image3\');" /></td></tr>
		<tr><td colspan="2">text 3</td></tr><tr><td colspan="2" bgcolor="#426f78"><textarea id="Text3" name="Text3" style="width: 550px; height: 175px;" >'.$Text3.'</textarea></td></tr>
		<tr><td>News </td><td><input type="text" name="News" value="'.$row['News'].'" size="30" border="0"  onchange="changeval();"></td></tr>
		<tr><td>Support</td><td><input type="text" name="Support" value="'.$row['Support'].'" size="30" border="0"  onchange="changeval();"></td></tr>
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>Save</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			

		</form></div>
				<script type="text/javascript">		



		</script>';
		
	}
	$output .= '</td>
			</tr>
		</table>';
}
include "footer.php";
$output .= '</div>';

// menu
$languase = 1;
include "menu.php";
$output .= '<div name="directory" id="directory"></div> <div name="filemanager" id="filemanager"><table width = "100%" cellpadding="10"><tr><td BGCOLOR="#000"> <b><FONT COLOR="#fff">File Manager</font></b>  <a href="#" onclick="hidefilemanager();return false"><img src="./system/systemicon/close.png" style=" float: right;"></a></td></tr><tr><td><iframe  frameborder="0" width="100%" height="100%" name="filelinker" id="filelinker" onload="resizeFrame()" src="blank.html">your browser does not support iframe</iframe></td></tr></table></div>';


}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
