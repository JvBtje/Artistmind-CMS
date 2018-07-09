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
$stat = $_GET["stat"];
$groupid=$_GET["groupid"];
if ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator'){ 
?>
<style type="text/css">
	img {border:0px}
	body {
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		color:#000;
		background:url(bg.jpg);
	}
	#friendlistouput img{
	border:2px solid #dadada;
	border-radius:7px;
	background-color:#fff;
	padding:3px;
	spacing:5px; 
	}
	#friendaddbtn img{
		border:0px solid #dadada;
		border-radius:0px;
	}
</style>
<script language="javascript">
window.friends = new Array();

function addfriendlist(Id, Username,Profilepic){
		tmparray = new Array();
		tmparray.Id = Id;
		tmparray.Username = Username;
		tmparray.Profilepic = Profilepic;
		window.friends.push(tmparray);
		
}
function selectall()
{
	for (i=0;i<window.friends.length;i++)
	{
		document.getElementById('friendid'+window.friends[i].Id).checked = true;
	}
}

function deselectall()
{
	for (i=0;i<window.friends.length;i++)
	{
		document.getElementById('friendid'+window.friends[i].Id).checked = false;
	}
}
function updatefriendlist (){
	window.curpage = 1;
	pages = 1;
	ii = 1
	txt = '<table>'
	
	for (i=0;i<window.friends.length;i++)
	{
		if (ii == 1){
			txt =txt +"<tr>"
		}
		txt = txt +'<td valign="top"><div style="width:110px; "><center><img src="../../system/imgtumb.php?url='+window.friends[i].Profilepic+'&maxsize=100&square=1 " ><br><input type="checkbox" name="friendid'+window.friends[i].Id+'" id="friendid'+window.friends[i].Id+'"/><br> '+window.friends[i].Username+'<br><a href="#" onClick="dofriend('+window.friends[i].Id+',\''+window.friends[i].Profilepic+'\',\''+window.friends[i].Username+'\');return false"><div id="friendaddbtn"><img src="./system/iconfilemanager/add.png" alt="add"></div></center></div></td>';
		
		if (ii == 5){
			txt =txt +"</tr>";
			ii=1;	
		}else {
			ii = ii+1;
		}
			
	}
	
	txt = txt + '</table>';
	
	document.getElementById('friendlistouput').innerHTML = txt;
	
}

function domultifriend()
{

	
	ii = 0;
	
	for (i=0;i<window.friends.length;i++)
	{	
		
		if (document.getElementById('friendid'+window.friends[i].Id).checked == true){
			parent.dodocumentfriends (window.friends[i].Id, window.friends[i].Profilepic, window.friends[i].Username);
		}
		
	}
	

	
}
function dofriend(friendid, tumbnail, name)
{
	
	parent.dodocumentfriends (friendid, tumbnail, name);
}
</script>
<?php
if($type == ""){
	$SearchString = $_GET["Searchstring"]; 

	
	$SearchString = str_replace("'", " ", $SearchString);
	$SearchString = str_replace('"', " ", $SearchString);
	$SearchString = str_replace(',', " ", $SearchString);
	$SearchString = str_replace('\\', " ", $SearchString);
	

	
	
	echo '<form name="zoekfriend"  action="Friendsdocuments.php" method="GET" ><table><tr><td>Search</td><td> <input type="text" name="Searchstring" id ="Searchstring" value="'.$SearchString.'" size="24" border="0"> </td>
				</tr></table></form>';
				
	echo'<a href="#" onClick="selectall();return false"><img src="../../'.$_SESSION['Theme'].'/iconfilemanager/selectall.png" alt="select all"></a><a href="#" onClick="deselectall();return false"><img src="../../'.$_SESSION['Theme'].'/iconfilemanager/deselectall.png" alt="deselect all"></a><a href="#" onClick="domultifriend();return false"><img src="../../'.$_SESSION['Theme'].'/iconfilemanager/add.png" alt="add"></a>';	
	echo '<div id="friendlistouput"></div>';
	
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
	echo '<script language="javascript">';
	$result = mysqli_query($link,"SELECT Username, Id, Profilepic FROM login WHERE TypeUser = 'Member' OR TypeUser = 'Admin' OR TypeUser = 'Moderator'");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo 'addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["Username"], "UTF-8"))).','.str_replace("'", "\'",json_encode(mb_convert_encoding($row["Profilepic"], "UTF-8"))).');';
	}
	
	echo 'updatefriendlist ();</script>';
	
	
	
	}else{
	// Zoekopdracht
$sqlsearstring = "";

	
	if ($SearchString != ""){
	$first = true;
	foreach ($SearchstringM  as $keyword) {
	
		if ($sqlsearstring == ""){
			$sqlsearstring = ' WHERE (TypeUser = \'Member\' OR TypeUser = \'Admin\' OR TypeUser = \'Moderator\') AND (Username LIKE \'%'.$keyword.'%\')';
		}else{
			
			$sqlsearstring = $sqlsearstring.' OR Username LIKE \'%'.$keyword.'%\'';
		}
	}
	
	
	}

	$result = mysqli_query($link,"SELECT  Username, Id, Profilepic FROM login".$sqlsearstring);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo '<script language="javascript">';
	
	while($row = mysqli_fetch_array($result)){
		echo 'addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode(mb_convert_encoding($row["Username"], "UTF-8"))).','.str_replace("'", "\'",json_encode(mb_convert_encoding($row["Profilepic"], "UTF-8"))).');';
	}
	
	echo 'updatefriendlist ();</script>';
}
}

}else{
echo 'error not logged in';

}
?>

