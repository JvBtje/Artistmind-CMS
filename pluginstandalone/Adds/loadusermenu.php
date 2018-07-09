<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}


if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	
	echo  '<table><tr>
                  ';	
					echo  '<td width="210" background="windows/back.png">';
				 
                  	echo '<div id="GroupUnsorted" > <table>';			  
				  	$result2 = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM reclame WHERE Language =".$_SESSION['Language']."  ORDER BY Startdate ");
					if (!$result2) {
    					die('Query failed: ' . mysqli_error($link));
					}
					while($row2 = mysqli_fetch_array($result2)){
						 
				  		$tmpId = $row2['MainId'];
						if ($tmpId == $MainId){
							echo  '<td width="210" background="windows/selected.png"><h4>';
						}else{							
							echo  '<td width="210" background="windows/back.png">';
						}
						echo  '<div align="left"><a href="indexstandalone.php?plugin=Adds&type=select&Id='.$row2['MainId'].'">'.$row2['TheOrder'].' '.$row2['Naam'].'</a></td></tr>';
					}
				  echo  '</table></div></td> </tr></div>';

	echo '
                <tr>
                  
                  <td background="windows/smalBottom.png" height="27">&nbsp;</td>
                  
                </tr>
                      </table>';
return $output;
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}

?>