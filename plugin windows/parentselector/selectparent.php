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
	body {
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		color:#333;
		background:url(bg.jpg);
	}
</style>
<script language="javascript">
<?php
echo '
function UrlSelectorPage(){';
	global $link;

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
	document.getElementById("menuimg"+ID).src="../.<?php echo $_SESSION['Theme'];?>systemicon/down.png"; 
	
   } else {
   
      document.getElementById("menu"+ID).style.display="none";
	document.getElementById("menuimg"+ID).src= "../.<?php echo $_SESSION['Theme'];?>systemicon/pijl rechts.png"
	
	  
   }
}
</script>
<?php

function displaymenuparentselector($Start, $Laag, $text, $Ids, $searchstring){
global $link;
		echo '<table>';
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' '.$searchstring.' ORDER BY theOrder';
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
			echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="../../'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="#" onclick="parent.doselectparent('.$row["MainId"].',\''.$row["MainId"].' '.$row["Naam"].'\');return false">'.$row["Id"].' '.$row["Naam"].'</a></td></tr>';
			
					
			//if ($row["Type"] == "groep"){
				echo '<tr><td valign="top" background="../../'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" >';
				displaymenuparentselector ($row["MainId"],$Laag,$text, $Ids,$searchstring);
				echo '</div></td></tr>';
			//}
		}
		echo '</table>';
	}


$root = scandir('../../plugins'); 
$searchstring = ' AND (';
$i=0;
foreach($root as $value)
{ 
	if (is_file('../../plugins/'.$value.'/parentselector.php')) {
		if ($i == 0){
			$searchstring .=  ' Type="' .$value.'" ';
		}else{
			$searchstring .=  ' OR Type="' .$value.'" ';
		}
		$i++;
	}
	
}
$searchstring .= ')';

echo '
<table><tr><td>sectie</td><td><select name="sectie" id="sectie" onchange="UrlSelectorPage()">';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){

		echo '<option value="'.$row["MainId"].'">'.$row["MainId"].' '.$row["Naam"].'</option>';
	}
echo '</select></td></tr><tr><td>group</td><td>';

	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		echo '<div id="sectie'.$row["MainId"].'" >';
		echo '<table><tr><td><a href="#" onclick="parent.doselectparent('.$row["MainId"].',\''.$row["MainId"].' '.$row["Naam"].'\');return false">'.$row["Id"].' '.$row["Naam"].'</a></td></tr></table>';
		displaymenuparentselector($row["MainId"],0,"",array(),$searchstring);
		echo '</div>';
	}

echo'</td></tr></table>';
echo '<script language="javascript">UrlSelectorPage()</script>'; 

}else{
echo 'error not logged in';

}
?>

