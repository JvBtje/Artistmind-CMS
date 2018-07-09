<?php
if ($found == "true"){	
	echo '<tr><td><img id="bol" src="" class="bol" width="20" height="20" border="0"></td><td background="'.$_SESSION['Theme'].'windows/selected.png"><a href="'.$row["Type"].'-'.$sectie.'-'.$row["MainId"].'-'.$Naam.'.html">'.$row["Naam"].'</a></td></tr>';
}else{
	echo '<tr><td><img id="bol" src="" class="bol" width="20" height="20" border="0"></td><td><a href="'.$row["Type"].'-'.$sectie.'-'.$row["MainId"].'-'.$Naam.'.html">'.$row["Naam"].'</a></td></tr>';
} 

?>