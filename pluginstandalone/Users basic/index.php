<?php
if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
$selectId = intval($_GET["Id"]);
$output .= '
<script language="javascript">
function window_onload(){

}
function changeval(){	
	
	document.forms["form1"]["changed"].value = "true";
}

function submitform(){
	document.forms["form1"]["changed"].value = "false";
	document.form1.submit();
}

function window_onunload(){
if (document.forms["form1"]["changed"].value == "true"){
if (confirm(\'Save the changes?\')) { }
}}
</script>';


function displayList ($MainId = -1){
$menuurl ='./pluginstandalone/Users basic/loadusermenu.php';
$menuname = 'Users';
include ('submenulayout.php');
}




if ($type=="nieuw"){
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users Basic&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table></td>
			</tr>
			<tr>
				
				<td>';
$output .= '<form action="indexstandalone.php?plugin=Users Basic&type=save" method="POST" name="form1" autocomplete="on">
	<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="new" border="0">
		<tr><td>Username </td><td><input type="text" name="Username" value="" size="24" border="0" onchange=changeval()></td></tr>
		<tr><td>Newpassword </td><td><input type="password" name="newpassword" size="24" border="0" onchange=changeval()></td></tr>
			
		<tr><td>Newpassword retype </td><td><input type="password" name="newpassword2" size="24" border="0" onchange=changeval()></td></tr>';
		$output .= '<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .= '<option value="'.$row2['Id'].'"';
			if ($row['Language'] == $row2['Id'] ){$output .= ' selected ';}
			$output .= '>'.$row2['Language'].'</option>';
			}
		$output .= '</select></td></tr>
			<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>change user</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table
		</form>';
	$output .= '</td>
			</tr>
		</table>';
}elseif ($type=="delete"){
	$message = "User deleted";
	$Id = intval($_GET["Id"]);
	mysqli_query($link,"DELETE FROM login WHERE Id=$Id")or die(mysqli_error($link));
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .= '<script type="text/javascript">setTimeout("window.open(\'indexstandalone.php?plugin=Users Basic\',\'_self\',\'\',\'true\')", 0);</script>';
}elseif ($type=="select"){
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users Basic&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table></td><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users Basic&type=delete&Id='.$selectId.'"><h4>Delete</h4></a>
          </h4></td>
        </tr>
      </table> </td>
			</tr>
			<tr>
				
				<td>';

	$query = "SELECT Id, Username,Nieuws,Language,  DATE_FORMAT(DATE_SUB(LastLogin, INTERVAL '-0 0:00:00' DAY_SECOND),'%d/%m/%y - [ %T ]') AS LastLogin FROM login WHERE Id=$selectId";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$id = $row['Id'];
		$datefromdb = $row['LastLogin'];
		$output .= "id = $id Last login $datefromdb <br> ";
		$Username = $row['Username'];
		$output .= '<form action="indexstandalone.php?plugin=Users Basic&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="false">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$id.'" border="0">
		<tr><td>Username</td><td> <input type="text" name="Username" value="'.$Username.'" size="24" border="0" onchange=changeval()></td></tr>			
		<tr><td>Newpassword </td><td><input type="password" name="newpassword" size="24" border="0" onchange=changeval()></td></tr>			
		<tr><td>Newpassword retype </td><td><input type="password" name="newpassword2" size="24" border="0" onchange=changeval()></td></tr>
		';
		$output .= '<tr><td>Language </td><td><select name="language" id="language" onchange=changeval()>';
		$result2 = mysqli_query($link,"SELECT Id, Language FROM language");
		if (!$result2) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row2 = mysqli_fetch_array($result2)){
			$output .= '<option value="'.$row2['Id'].'"';
			if ($row['Language'] == $row2['Id'] ){$output .= ' selected ';}
			$output .= '>'.$row2['Language'].'</option>';
			}
		$output .= '</select></td></tr>';
				
		
			$output .= '<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>change user</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
	}
	$output .= '</td>
			</tr>
		</table>';
}else if ($type=="save"){
	$Id = $_POST["Id"]; 
	$selectId = $Id;
	$Username = $_POST["Username"];
	$Password = $_POST["Oldpassword"];
	$newpassword = $_POST["newpassword"];
	$newpassword2 = $_POST["newpassword2"];
	$language = intval($_POST["language"] );
	$Email = $_POST["Email"];
	$message = "";
	$error = false;
	$Password = str_replace("'", " ", $Password);
	$Password = str_replace('"', " ", $Password);
	$Password = str_replace("\\", "\\\\", $Password);
	$Nieuws = str_replace("'", " ", $Nieuws);
	$Nieuws = str_replace('"', " ", $Nieuws);
	$Nieuws = str_replace("\\", "\\\\", $Nieuws);
	$Username= str_replace("'", " ", $Username);
	$Username= str_replace('"', " ", $Username);
	$Username = str_replace("\\", "\\\\", $Username);
	$newpassword = str_replace("'", " ", $newpassword);
	$newpassword = str_replace('"', " ", $newpassword);
	$newpassword = str_replace("\\", "\\\\", $newpassword);
	$newpassword2= str_replace("'", " ", $newpassword2);
	$newpassword2= str_replace('"', " ", $newpassword2);
	$newpassword2 = str_replace("\\", "\\\\", $newpassword2);
	if ($Id == "new"){
		$systemPassword = "";
	}else{
		$query = "SELECT Password FROM login WHERE Id=$Id";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
	
		while($row = mysqli_fetch_array($result)){
			$systemPassword = $row['Password'];
		}
	}
	
		if ($newpassword == $newpassword2 and $newpassword <> ""){
			$newpassword = md5($newpassword);
			if ($Id == "new"){
				mysqli_query($link,"INSERT INTO login (Username, Password, ErrorLogin, Nieuws, Language) VALUES ('$Username', '$newpassword','0','$Nieuws','$language')")or ($message = mysqli_error($link));
			}else{
				mysqli_query($link,"UPDATE login SET Nieuws = '$Nieuws', Language = '$language', Username = '$Username', Password = '$newpassword' WHERE Id = '$Id'") or ($message = mysqli_error($link)); 
			}
			if ($message == ""){
				$message="User saved";
			}else{
				$error = true;
			}
		}else{
		$message="New password don't match";
		$error = true;
		}

	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users Basic&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table> </td>
			</tr>
			<tr>
				
				<td>';
	array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
	$output .='<script type="text/javascript">refreshingmessage();</script>';
	if ($error == true){
$output .= '
<form action="indexstandalone.php?plugin=Users Basic&type=save" method="POST" name="form1" autocomplete="on">
		<table>
		<input type="hidden" name="changed" id="changed" value="true">
		<input type="hidden" name="type" value="save" border="0"><input type="hidden" name="Id" value="'.$Id.'" border="0">
		<tr><td>Username</td><td> <input type="text" name="Username" value="'.$Username.'" size="24" border="0" onchange=changeval()></td></tr>			
		<tr><td>Newpassword </td><td><input type="password" name="newpassword" size="24" border="0" onchange=changeval()></td></tr>			
		<tr><td>Newpassword retype </td><td><input type="password" name="newpassword2" size="24" border="0" onchange=changeval()></td></tr>
		<tr><td><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="javascript: submitform()"><h4>change user</h4></a>
          </div></td>
        </tr>
      </table></td><td></td></tr></table>
			
		</form>';
		}
	$output .= '</td>
			</tr>
		</table>';
}else {
	$output .= '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				
				<td><a href="indexstandalone.php?plugin=Users Basic&type=nieuw"><table width="120" border="0" cellpadding="0" cellspacing="0" background="menu/Menubut.png">
        <tr>
          <td width="120" height="34"><div align="center">
            <a href="indexstandalone.php?plugin=Users Basic&type=nieuw"><h4>New</h4></a>
          </div></td>
        </tr>
      </table></a> </td>
			</tr>
			<tr>
				
				<td></td>
			</tr>
		</table>';
}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ; 
	exit;
}
?>