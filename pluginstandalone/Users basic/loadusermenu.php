<?php
session_start();
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}


if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){ 
	

	$query = 'SELECT Id, Username FROM login WHERE TypeUser = "Admin"';
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error());
	}
	echo '<table>';

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		echo '<tr>
                  ';
				  if ($MainId == $id){
				  	echo '<td width="210" background="windows/selected.png"><h4>';
				  }else{
				  	
				  }
                  echo '<div align="left"><a href="indexstandalone.php?plugin=Users basic&type=select&Id='.$id.'">';
		echo $id. " ". $row['Username'];
		echo '</a><br /></div></td>
                </tr>';
	}
	echo '</table>';
} else {
	echo '<?xml version="1.0" encoding="UTF-8"?><lijst>';
	echo '<stat>Logged out</stat>';
	echo '</lijst>';
}

?>