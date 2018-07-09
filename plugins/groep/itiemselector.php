<?php
echo '<tr><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false"><img id="menuimg'.$row["Id"].'" src="../../'.$_SESSION['Theme'].'systemicon/pijl rechts.png" border="0"></a></td><td><a href="#" onClick="layerActie(\''.$row["Id"].'\');return false">'.$row["Id"].' '.$row["Naam"].'</a></td></tr>';

echo '<tr><td valign="top" background="'.$_SESSION['Theme'].'systemicon/lijn.png"></td><td>';
echo '<div id="menu'.$row["Id"].'" style= "display:none;">';
displaymenu ($row["MainId"],$Laag,$text, $Ids, $sectie);
echo '</div></td></tr>';
?>