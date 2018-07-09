<?php

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){

// header
$output .= '
  
<script language="javascript">


function showfilemanager(elementvar){
	newpath = \'./plugin windows/files/itemenfile.php\';
	if (document.getElementById(\'filelinker\').src.substring(document.getElementById(\'filelinker\').src.length-10,document.getElementById(\'filelinker\').src.length) == "blank.html"){
		document.getElementById(\'filelinker\').src = newpath;
	}	
	
	window.elementvar = elementvar;
	
	document.getElementById(\'directory\').style.display = \'block\';
	document.getElementById(\'filemanager\').style.display = \'block\';
}
function hidefilemanager(){	
	document.getElementById(\'directory\').style.display = \'none\';
	document.getElementById(\'filemanager\').style.display = \'none\';
}
    </script> <div id="buttonlayout">
           <h4> <a href="#" onClick="showfilemanager();return false;">File manager</a></h4>
          </div>';





//echo '<iframe frameborder="0" scrolling="auto" width="100%" height="750"  name="filelinkerb" id="filelinkerb" onload="load()" src="plugin windows/files/link2.php">your browser does not support iframe</iframe>';



}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>
