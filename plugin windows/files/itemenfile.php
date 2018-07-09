<?php 
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
include('../../DB.php');
include('../../system/include.php');
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<title>artistmind uploader en selector </title>

<LINK HREF="./link.css" REL="stylesheet" TYPE="text/css">
<!-- <script type="text/javascript"  src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script> -->

</head>
<body >
<a href="#" onclick="document.getElementById('fileselector').style.display = 'block';document.getElementById('itemselector2').style.display = 'none';return false;">Open file Selector</a>  <a href="#" onclick="document.getElementById('fileselector').style.display = 'none';document.getElementById('itemselector2').style.display = 'block';return false;">Open Item selector</a>

<?php 

include('./link2.php');

?>

</div>


<?php
//itemselector start
?>
<div id="itemselector2">
<?php session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}

$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
?>

<script language="javascript">

function UrlSelectorPage(){
	
<?php
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo 'if('.$row["MainId"].'== document.getElementById("sectie").value){';
		 echo 'document.getElementById("sectie'.$row["MainId"].'").style.display="block";';
		echo '}else{';
		 echo 'document.getElementById("sectie'.$row["MainId"].'").style.display="none";';
		echo '}';
	}
?>
}


function layerActie(ID) {
	
   if (document.getElementById("menu"+ID).style.display=="none") {
      	document.getElementById("menu"+ID).style.display="block";
	document.getElementById("menuimg"+ID).src="../../<?php echo $_SESSION['Theme'];?>systemicon/down.png"; 
	
   } else {
   
      document.getElementById("menu"+ID).style.display="none";
	document.getElementById("menuimg"+ID).src= "../../<?php echo $_SESSION['Theme'];?>systemicon/pijl rechts.png"
	
	  
   }
}
</script>
<?php

function displaymenu($Start, $Laag, $text, $Ids, $sectie){
	global $link;
		echo '<table>';
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$found = "false";
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					$found = "true";
				}
			}
			
			if (is_file('../../plugins/'.$row["Type"].'/itiemselector.php')) {
				include '../../plugins/'.$row["Type"].'/itiemselector.php';
			}else{
				include '../../plugins/default/itiemselector.php';
			}

		}
		echo '</table>';
	}




	echo '<div id="Home">';
	echo '<a href="#" onclick="parent.dofilemanager(\'index.php\');return false">Home</a>';
	echo '</div>';	
	
	echo '<div id="Login">';
	echo '<a href="#" onclick="parent.dofilemanager(\'Login.php\');return false">Login</a>';
	echo '</div>';
	
	echo '<div id="Log out">';
	echo '<a href="#" onclick="parent.dofilemanager(\'Logout.php\');return false">Log out</a>';
	echo '</div>';
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
	foreach ($_SESSION['stpmenu'] as $stpmenu) {
			if ($stpmenu["Item"] != ""){
				echo $stpmenu["Item"];
			}
		}
echo '<table><tr><td>sectie</td><td>';
	
	echo '<select name="sectie" id="sectie" onchange="UrlSelectorPage()">';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){

		echo '<option value="'.$row["MainId"].'">'.$row["MainId"].' '.$row["Naam"].'</option>';
	}
echo '</select></td></tr><tr><td>';
	

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo '<div id="sectie'.$row["MainId"].'">';
		echo displaymenu($row["MainId"],0,"",array(),$row["MainId"]);
		echo '</div>';
	}
	
echo'</td></tr></table>';
echo '<script language="javascript">UrlSelectorPage(); </script>';
}else{
echo 'error not logged in';

}
?>
</div>

</body>
</html>
<SCRIPT LANGUAGE="JavaScript">

document.getElementById('itemselector2').style.display = 'none';
document.getElementById('fileselector').style.display = 'block';
</SCRIPT>