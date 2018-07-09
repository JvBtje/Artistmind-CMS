<?php
if ($found == "true"){	
	echo '<tr><td><img class="bol" src="" border="0" width="20" height="20"></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="'.$row["Type"].'-'.$sectie.'-'.$row["MainId"].'-'.$Naam.'.html">'.$row["Naam"].'</a></td></tr>';
}else{
	echo '<tr><td><img class="bol" src="" border="0" width="20" height="20"></td><td><a href="'.$row["Type"].'-'.$sectie.'-'.$row["MainId"].'-'.$Naam.'.html">'.$row["Naam"].'</a></td></tr>';
} 

?>