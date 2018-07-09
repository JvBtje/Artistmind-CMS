<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
//include('../DB.php');
//$link = mysql_connect($DbServer, $DbUsername, $DbPassword);
//mysql_select_db($Db, $link) or die('Could not select database.');
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
 echo '<script language="javascript">
function layerActie(divID) {
	
   if (document.getElementById(divID).style.display=="none") {
      document.getElementById(divID).style.display="block";
	 
   } else {
   
      document.getElementById(divID).style.display="none";
	
	  
   }
}
</script>';

	function displaymenu($Start, $Laag, $text, $Ids){
		
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, Parent, Naam FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$text = $oldtext;
			echo' <ul class="nav" id="nav">';
			for ($i = 1; $i < $Laag; $i++){
				if ($i < $Laag -1){
					echo '<img src="./system/systemicon/lijn.png" border="0">';
				}else{
					echo '<img src="./system/systemicon/lijntjes.png" border="0">';
				}
			}
			$found = false;
			for ($i=0; $i < count($Ids); $i++){
				if($Ids[$i] ==	$row["Id"]){
					$found = true;	
				}
			}
		
			echo '<a href="#" onClick="layerActie(\'menu'.$row["Id"].'\');return false">';
			
			echo '<img src="./system/systemicon/pijl rechts.png" border="0"></a><a href="ProductenGroep.php?type=select&Id='.$row["Id"].'">'.$row["Naam"].'</a><br>';
			echo "</ul>";
			
			if ($found == true){
				echo '<div id="menu'.$row["Id"].'" style= "display:block;">';
			}else{
				echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
			}
			$text = $text.$row["Naam"].'/';
			displaymenu ($row["Id"],$Laag,$text, $Ids);
			echo '</div>';
		}
	}
	echo '<div class="menu">';
	if(isset($_GET["Id"])){
		$selectId = intval($_GET["Id"]);
	}else{
	$selectId = 0;	
	}
	displaymenu(-1,0,"root/",array());
	//displaymenu(-1,0,"root/", findId($selectId, array()));
	echo '</div>';




} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}
?>