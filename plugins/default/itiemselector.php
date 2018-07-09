<?php
echo '<tr><td><img id="bol" src="../../'.$_SESSION['Theme'].'systemicon/bol.png" border="0"></td><td><a href="#" onclick="parent.dofilemanager(\''.$row["Type"].'-'.$sectie.'-'.$row["MainId"].'-'.str_replace (array("?",":",'\'','"','/'), " ",$row["Naam"]).'.html\');return false">'.$row["Naam"].'</a></td></tr>';
?>