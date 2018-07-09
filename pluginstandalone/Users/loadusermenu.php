<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
?>
<script language="javascript">


function layerActie(ID) {
	
   if (document.getElementById("menu"+ID).style.display=="none") {
      	document.getElementById("menu"+ID).style.display="block";
	document.getElementById("menuimg"+ID).src="./<?php echo $_SESSION['Theme'];?>systemicon/down.png"; 
	
   } else {
   
      document.getElementById("menu"+ID).style.display="none";
	document.getElementById("menuimg"+ID).src= "./<?php echo $_SESSION['Theme'];?>systemicon/pijl rechts.png"
	
	  
   }
}
</script>
<?php
//include('./DB.php');
//$link = mysql_connect($DbServer, $DbUsername, $DbPassword);
//mysql_select_db($Db, $link) or die('Could not select database.');

if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
	echo 'Your friends';
	echo '<table>';
		$selectId = $_SESSION["Id"];
		$searchstring = "";
	$result = mysqli_query($link,"SELECT Id, Type, User1, User2 FROM friends WHERE (User1 = '$selectId' OR  User2 = '$selectId') AND Type = 'Friend'  ");
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			if ($row["User1"] == $selectId){
				if ($searchstring == ""){
					$searchstring = " WHERE Id=".$row["User2"];
				}else{
					$searchstring .= " OR Id=".$row["User2"];
				}
			}else{
				if ($searchstring == ""){
					$searchstring = " WHERE Id=".$row["User1"];
				}else{
					$searchstring .= " OR Id=".$row["User1"];
				}
			}			
		}	
		
	if ($searchstring != ""){
		$query = 'SELECT Id, Username, Profilepic FROM login '.$searchstring;
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
			$id = $row['Id'];
			$Profilepic = $row['Profilepic'];
			array_push($_SESSION['Accesfiles2'], $Profilepic);
			
			echo '<tr>';
			 echo '<div  style="height:60px;"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$id.'">';
			 if (is_file($Profilepic)) {
			echo '<img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="middle">'." ". $row['Username'];
			}else{
			echo '<img src="'.$_SESSION['Theme'].'/systemicon/bol.png" align="middle">'." ". $row['Username'];
			}
		echo '</a><br /></div></td>
                </tr>';
		}
	}
	echo '</table>';
function displaymenuparentselector($Start, $Laag, $text, $Ids){
		global $link;
		echo '<table>';
		$groupacces = accesgroup ($Start, $_SESSION["Id"]);
		if ($groupacces == true){
		
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type FROM usergroepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$found = false;
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					$found = true;
				}
			}
			if ($found == true){
				if ($_GET["type"] == "Group" and intval($_GET["Id"]) == intval($row["MainId"])){
					echo '<tr><td ><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/down.png" border="0"></a></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}else{
					echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/down.png" border="0"></a></td><td><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}				
			
				echo '<tr><td valign="top" background="./'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:block;">';
				 	displaymenuparentselector ($row["MainId"],0,"", $Ids);
				echo '</div></td></tr>';
			}else{
				if ($_GET["type"] == "Group" and intval($_GET["Id"]) == intval($row["MainId"])){
					echo '<tr><td ><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}else{
					echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}
				echo '<tr><td valign="top" background="./'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
				 	displaymenuparentselector ($row["MainId"],0,"", $Ids);
				echo '</div></td></tr>';
			}
			
		}}
		echo '</table>';
	}

echo '
Groups';

echo '<table>';
		
		$Ids = findgroupmemberId(intval($_GET["Id"]), array());
		
		$query = 'SELECT Id, MainId, Parent, Naam, Type FROM usergroepen WHERE Parent=0 AND Language='. $_SESSION['Language'] .' ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$found = false;
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					$found = true;
				}
			}
			if ($found == true){
				if ($_GET["type"] == "Group" and intval($_GET["Id"]) == intval($row["MainId"])){
					echo '<tr><td ><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/down.png" border="0"></a></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}else{
					echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/down.png" border="0"></a></td><td><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}
					
			
				echo '<tr><td valign="top" background="./'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:block;">';
				 	displaymenuparentselector ($row["MainId"],0,"", $Ids);
				echo '</div></td></tr>';
			}else{
				if ($_GET["type"] == "Group" and intval($_GET["Id"]) == intval($row["MainId"])){
					echo '<tr><td ><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}else{
					echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="./'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="indexstandalone.php?plugin=Users&type=Group&Id='.$row['MainId'].'" > '.$row["Naam"].'</a></td></tr>';
				}
				echo '<tr><td valign="top" background="./'.$_SESSION['Theme'].'/systemicon/lijn.png"></td><td>';
				echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
				 	displaymenuparentselector ($row["MainId"],0,"", $Ids);
				echo '</div></td></tr>';
			}
			
		}
		echo '</table>';
	
	//var_dump ($Ids);
	
	$query = 'SELECT Id, Username, Profilepic FROM login WHERE TypeUser = "Admin"';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo 'Admin users';
	echo '<table>';

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$Profilepic = $row['Profilepic'];
		array_push($_SESSION['Accesfiles2'], $Profilepic);
		
//		echo '<script type="text/javascript">addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode($row["Username"])).','.str_replace("'", "\'",json_encode($row["Profilepic"])).');</script>';
		echo '<tr>
                  ';
				  if ($MainId == $id){
				  	echo '<td width="210" background="windows/selected.png"><h4>';
				  }else{
				  	
				  }
                  echo '<div  style="height:60px;"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$id.'">';
		 if (is_file($Profilepic)) {
			echo '<img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="middle">'." ". $row['Username'];
			}else{
			echo '<img src="'.$_SESSION['Theme'].'/systemicon/bol.png" align="middle">'." ". $row['Username'];
			}
		echo '</a><br /></div></td>
                </tr>';
	}
	echo '</table>';
	
	$query = 'SELECT Id, Username, Profilepic FROM login WHERE TypeUser = "Moderator"';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo 'Moderator users';
	echo '<table>';

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$Profilepic = $row['Profilepic'];
		array_push($_SESSION['Accesfiles2'], $Profilepic);
//		echo '<script type="text/javascript">addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode($row["Username"])).','.str_replace("'", "\'",json_encode($row["Profilepic"])).');</script>';
		echo '<tr>
                  ';
				  if ($MainId == $id){
				  	echo '<td width="210" background="windows/selected.png"><h4>';
				  }else{
				  	
				  }
                  echo '<div  style="height:60px;"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$id.'">';
		 if (is_file($Profilepic)) {
			echo '<img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="middle">'." ". $row['Username'];
			}else{
			echo '<img src="'.$_SESSION['Theme'].'/systemicon/bol.png" align="middle">'." ". $row['Username'];
			}
		echo '</a><br /></div></td>
                </tr>';
	}
	echo '</table>';
	
	$query = 'SELECT Id, Username, Profilepic FROM login WHERE TypeUser = "Member"';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo 'Member users';
	echo '<table>';

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$Profilepic = $row['Profilepic'];
		array_push($_SESSION['Accesfiles2'], $Profilepic);
//		echo '<script type="text/javascript">addfriendlist(\''.str_replace("'", "\'", $row["Id"]).'\','.str_replace("'", "\'", json_encode($row["Username"])).','.str_replace("'", "\'",json_encode($row["Profilepic"])).');</script>';
		echo '<tr  >
                  ';
				  if ($MainId == $id){
				  	echo '<td width="210" background="windows/selected.png"><h4>';
				  }else{
				  	
				  }
                  echo '<div  style="height:60px;"><a href="indexstandalone.php?plugin=Users&type=Profile&Id='.$id.'">';
		 if (is_file($Profilepic)) {
			echo '<img src="./system/imgtumb.php?url='.$Profilepic.'&maxsize=50&square=1 " align="middle">'." ". $row['Username'];
			}else{
			echo '<img src="'.$_SESSION['Theme'].'/systemicon/bol.png" align="middle">'." ". $row['Username'];
			}
		echo '</a><br /></div></td>
                </tr>';
	}
	echo '</table>';
	
	if ($_SESSION['TypeUser'] == 'Admin'){
	$query = 'SELECT Id, Username FROM login WHERE TypeUser = "Nieuws"';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	echo 'Newsletter users';
	echo '<table>';

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		echo '<tr>
                  ';
				  if ($MainId == $id){
				  	echo '<td width="210" background="windows/selected.png"><h4>';
				  }else{
				  	
				  }
                  echo '<div >';
		echo $id. " ". $row['Username'];
		echo '</a><br /></div></td>
                </tr>';
	}
	echo '</table>';
	}
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}

?>