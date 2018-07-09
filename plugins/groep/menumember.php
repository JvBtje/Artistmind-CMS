<?php
if ($found == "true"){				
	echo '<tr><td><a href="#" onClick="layerActiesubmenub(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" class="pijldown" src="" border="0" width="20" height="20"></a></td><td><a href="#" onClick="layerActiesubmenub(\''.$row["Id"].'\');return false">'.$row["Naam"].'</a></td></tr>';
	echo '<tr><td valign="top" background="'.$_SESSION['Theme'].'systemicon/lijn.png"></td><td>';
	echo '<div id="menu'.$row["Id"].'" style= "display:block;">';
	displaymenu ($row["MainId"],$Laag,$text, $Ids, $sectie);
	echo'<script>
				document.getElementById("menu'.$row["Id"].'").style.overflow="hidden";
				
			</script>';	
	echo '</div></td></tr>';				
}else{
	echo '<tr><td><a href="#" onClick="layerActiesubmenub(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" class="pijlrechts" src="" border="0" width="20" height="20"></a></td><td><a href="#" onClick="layerActiesubmenub(\''.$row["Id"].'\');return false">'.$row["Naam"].'</a></td></tr>';
	echo '<tr><td valign="top" background="'.$_SESSION['Theme'].'systemicon/lijn.png"></td><td>';
	echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
	displaymenu ($row["MainId"],$Laag,$text, $Ids, $sectie);
	echo'<script> document.getElementById("menu'.$row["Id"].'").style.height="0px";
				document.getElementById("menu'.$row["Id"].'").style.overflow="hidden"; </script>';			
	echo '</div></td></tr>';
}
?>