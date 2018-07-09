<?php 

session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
include('../DB.php');
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
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

function UrlSelectorPage(){
	
<?php
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM usergroepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
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
	document.getElementById("menuimg"+ID).src="../<?php echo $_SESSION['Theme'];?>systemicon/down.png"; 
	
   } else {
   
      document.getElementById("menu"+ID).style.display="none";
	document.getElementById("menuimg"+ID).src= "../<?php echo $_SESSION['Theme'];?>systemicon/pijl rechts.png"
	
	  
   }
}
</script>
<?php

function displaymenuparentselector($Start, $Laag, $text, $Ids){
		echo '<table>';
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type FROM usergroepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
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
			echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="../'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="#" onclick="parent.dodocumentgroup('.$row["MainId"].',\''.$row["MainId"].' '.$row["Naam"].'\');return false">'.$row["MainId"].' '.$row["Naam"].'</a></td></tr>';
			
					
			
				echo '<tr><td valign="top" background="../'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
				displaymenuparentselector ($row["MainId"],$Laag,$text, $Ids);
				echo '</div></td></tr>';
			
		}
		echo '</table>';
	}



echo '
<table><tr><td>group</td></tr><tr><td>';
echo '<table>';
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type FROM usergroepen WHERE Parent=0 AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
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
			echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="../'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="#" onclick="parent.dodocumentgroup('.$row["MainId"].',\''.$row["MainId"].' '.$row["Naam"].'\');return false">'.$row["MainId"].' '.$row["Naam"].'</a></td></tr>';
			
					
			
				echo '<tr><td valign="top" background="../'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
				displaymenuparentselector ($row["MainId"],$Laag,$text, $Ids);
				echo '</div></td></tr>';
			
		}
		echo '</table>';

echo'</td></tr></table>';
echo '<script language="javascript">UrlSelectorPage()</script>'; 
}else{
echo 'error not logged in';

}
?>

