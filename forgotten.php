<?phpinclude("system/include.php");session_start();if ($_SESSION['newsession'] != false ){	$_SESSION['SystemImgPas'] = md5( rand(100, 999));	$_SESSION['newsession'] = false;	}include("DB.php");$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);// header settingsif ( $_SESSION['Language'] == ""){ setDefaultLanguage ();}
include("./system/backup.php");
// header
$type = $_GET["type"];include "header.php";


echo '<div id="Middel">';
 if ($type==""){
	
 	echo 'When you are forgotten your password or username you can reset your account.<br>';
	echo '<form action="'.$url.'?type=save" method="Post" name="FormName">';
	$_SESSION['SystemImgPas'] = md5( rand(100, 999));
	echo '<table>
		<tr><td>E-mail </td><td><input type="text" name="email" value="" size="24" border="0"></td></tr>			
		<tr><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr>
				 <tr><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"> (Gebruik Hoofdletters)</td></tr>
			</table><input type="submit" value="Send mail" name="submitButtonName" border="0">
		</form>';
}else if ($type=="save"){
	$Email = $_POST["email"];
	$ImgPas =$_POST["ImgPas"];

	$error = false;
	if ($_SESSION['SystemImgPas'] <> $ImgPas or $ImgPas == ""){
		$_SESSION['SystemImgPas'] = md5( rand(100, 999));
		$error = true;
	}
	
	$founduser = 0;
	$result = mysqli_query($link,"SELECT Username, Email FROM login WHERE Email='$Email'") or die ('Query failed: ' . mysqli_error($link));
		while($row = mysqli_fetch_array($result)){			
			$founduser++;
		}
		
	if ($error == true){
	//img pas error
	echo '<p><h2>There are errors, pleas check your submission</h2></p>
	When you are forgotten your password or username you can reset your account.<br>';
	echo '<form action="'.$url.'?type=save" method="Post" name="FormName">';
	$_SESSION['SystemImgPas'] = md5( rand(100, 999));
	
	echo '<table>
		<tr><td>'; if ($Email == "" ){echo'<h2>';} echo 'E-mail adres '; if ($Email == "" ){echo'</h2>';} echo '</td><td><input type="text" name="email" value="'.$Email.'" size="24" border="0"></td></tr>			
		<tr><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr>
				 <tr><td>';if ($ImgPas == "" or $ImgPas <> $_SESSION['SystemImgPas']){echo'<h2>';}echo'Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"> (Gebruik Hoofdletters)</td></tr>
			</table><input type="submit" value="Send mail" name="submitButtonName" border="0">
		</form>';
	} else if ($founduser == 0){
	// email adres error
	echo '<p><h2>There are errors, pleas check your submission</h2></p>	When you are forgotten your password or username you can reset your account.<br>';
	if ($founduser == 0 ){ echo '<h2>Email not found in database.</h2>';}
	echo '<form action="'.$url.'?type=save" method="Post" name="FormName">';
	
	echo '<table>
		<tr><td>'; if ($Email == "" or $founduser == 0){echo'<h2>';} echo 'E-mail adres '; if ($Email == "" or $founduser == 0){echo'</h2>';} echo '</td><td><input type="text" name="email" value="'.$Email.'" size="24" border="0"></td></tr>			
<input type="hidden" name="ImgPas" value="'.$ImgPas.'" size="24" border="0">
			</table><input type="submit" value="Send mail" name="submitButtonName" border="0">
		</form>';
	}else{
	// geen fouten ontdekt
	$result = mysqli_query($link,"SELECT Id, Username, Email, Username, Password FROM login WHERE Email='$Email'") or die ('Query failed: ' . mysqli_error($link));
		while($row3 = mysqli_fetch_array($result)){			$Username = $row3['Username'];
		$message = $message.'U heeft gevraagt om uw username en password te sturen door '.curPageURL().', u vind hem hieronder:<table>		
		<tr><td>Username </td><td>'.$row3['Username'].'</td></tr>';		$password = md5( rand(100,999));		$pasdb = md5($password);		mysqli_query($link,"UPDATE login SET Password = '$pasdb' WHERE Id='".$row3["Id"]."'") or die(mysqli_error($link));
		$message = $message. '<tr><td>Password </td><td>'.$password.'</td></tr></table>';
		//echo $message;
		}
	$query = "SELECT Id, submitemail, submitreplyemail, submitsenderemail FROM system WHERE Id=1";
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}
	while($row = mysqli_fetch_array($result)){
		$to = $Email;
		$headers  = 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\n";
		$headers .= 'From: '.$row['submitsenderemail']. "\n" .
    		'Reply-To: '.$row['submitreplyemail'] . "\n" .
    		'X-Mailer: PHP/' . phpversion();
	}


	$emailheader = '<html><body>';
	$subject = 'Username Password voor '.curPageURL().' '. $Username;
	
	mail($to, $subject, $emailheader.$message.'</body></html>' , $headers);

	echo "The e-mail is send to: ". $Email;
	
	}
}
 include "footer.php"; echo '</div>';if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){// menu//$languase = 1;include "menu.php";}else{// menu//$languase = 1;include "menu.php";} ?>
