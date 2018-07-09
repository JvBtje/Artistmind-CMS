<?php
// Init session settings
include("system/include.php");
session_start();
if ($_SESSION['newsession'] != false ){
	$_SESSION['SystemImgPas'] = md5( rand(100, 999));
	$_SESSION['newsession'] = false;
	
}
include("DB.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
 
// header settings
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
// header
header( "Cache-Control: max-age=3600, proxy-revalidate" );
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><accept-charset="UTF-8"><meta charset="utf-8">
<head>
<script language="javascript">
function window_onload(){

}

function window_onunload(){
	
}

</script>';

// DB

$banner = "";
include "header.php";

?>

<div id="Middel">
<?php
	if(get_magic_quotes_runtime())
	{
    // Deactivate
		echo 'error: magic quotes is turned on you can\'t login because the system is instable';
	}else{
	if ($_SESSION['TypeUser'] == 'Admin'){
		$message = 'You are already logged in as '.$_SESSION['Username'].' as '.$_SESSION['TypeUser'].'. Loge out to change your account.';
		echo $message;
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $message));
		echo'<script type="text/javascript">refreshingmessage();</script>';
	}else{
 	$Username = $_POST["Username"]; 
	$Password = md5(trim($_POST["Password"]));
	$ImgPas = $_POST["ImgPas"];
	$Password = str_replace("'", " ", $Password);
	$Password = str_replace('"', " ", $Password);
	$Password = str_replace('\\', " ", $Password);
	$Username= str_replace("'", " ", $Username);
	$Username= str_replace('"', " ", $Username);
	$Username= str_replace('\\', " ", $Username);
	$Username= trim($Username);
	$ImgPas= str_replace("'", " ", $ImgPas);
	$ImgPas= str_replace('"', " ", $ImgPas);
	$ImgPas= str_replace('\\', " ", $ImgPas);
	$ImgPas= trim($ImgPas);

	
	if ($Username == ""){
	// eerste keer dat iemand het loginscherm ziet
	$_SESSION['SystemImgPas'] = md5( rand(100, 999));
	echo'
		<p>Voer hier uw username en password in:</p>
		<form action="'.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr></table>
			<input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
	} else {
	// iemand probeert in te loggen
	// Haalt password uit database op
	$founduser = false;
	$error = false;
	$result = mysqli_query($link,"SELECT Id, Password, TypeUser, ErrorLogin, LastLogin FROM login WHERE (Username='$Username' OR Email='$Username')AND (TypeUser='Admin' OR TypeUser='Moderator' OR TypeUser='Member')") or die ('Query failed: ' . mysqli_error($link));
		while($row = mysqli_fetch_array($result)){
			$id = $row['Id'];
			$founduser = true;
			$systemPassword = $row['Password'];
			$TypeUser = $row['TypeUser'];
			$ErrorLogin = $row['ErrorLogin'];
			if (($LastLogin = strtotime($row['LastLogin'])) === -1) {
				echo "De string ($str) is niet geldig";
			}
			$daggeleden = mktime(date("G"),date("i"),date("s"), date("m"), date("d")-1, date("Y"));
		
	// checkt of er een username is gevonden
	if ($founduser == true ){
		// kijkt hoeveel keer er is ingelogt in 1 dag
		if ($ErrorLogin > 50 and $daggeleden < $LastLogin){
			$error = true;
		} elseif ($ErrorLogin > 0 and $daggeleden < $LastLogin){
		// checkt imagepas indien nodig
			if ($ImgPas != $_SESSION['SystemImgPas'] ){
				$error = true;
			}
		}
		if ($ErrorLogin > 0 and $daggeleden > $LastLogin){
			$ErrorLogin =0;
			mysqli_query($link,"UPDATE login SET ErrorLogin = '0' WHERE Username='$Username'") or die(mysqli_error($link)); 
		}
		if ($systemPassword != $Password){
			$error = true;
		}
	}else{
		$error = true;
	}
	
	
	if ($error == false){
		
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => "You are logged in"));
		$cururl = curPageURL();
		echo'<script type="text/javascript">refreshingmessage();</script>';
	// login is goed
		mysqli_query($link,"UPDATE login SET ErrorLogin = '0' WHERE Username='$Username'") or die(mysqli_error($link)); 
		$_SESSION['Menu'] = "User";
		$_SESSION['TypeUser'] = $TypeUser;
		$_SESSION['Username'] =	addslashes($Username);
		$_SESSION['Id'] =	$id ;
		echo'Login is correct.';
		$thestring = curPageURL();
		$directoryb= explode('redirect=',$thestring);
		
		$directorys = "";
			for ($i=1; $i < count($directoryb); $i++){
				$directorys = $directorys.$directoryb[$i];
			}
			
			if (count($directoryb) > 1){
				
				echo '<script type="text/javascript">setTimeout("window.open(\''.$directorys.'\',\'_self\',\'\',\'true\')", 0);</script>';
			}else{
			
				$query = "SELECT RedirectLogin FROM system";
				$result = mysqli_query($link,$query);
				if (!$result) {
					die('Query failed: ' . mysqli_error($link));
				}
				while($row = mysqli_fetch_array($result)){					
					echo '<script type="text/javascript">setTimeout("window.open(\''.$row["RedirectLogin"].'\',\'_self\',\'\',\'true\')", 0);</script>';					
				}
				
			}
		if (is_dir('./uploads/users/')){
		
		}else{
			mkdir('./uploads/users/', 0755);
		}
		if (is_dir('./uploads/users/'. $_SESSION['Id'].'/')){
			
		} else {			
			mkdir('./uploads/users/'. $_SESSION['Id'].'/', 0755);
		}
		chmod("./uploads/users/", 0755);
		chmod("./uploads/", 0755);
	}else{
		if ($ErrorLogin > 50 and $daggeleden < $LastLogin){
			$dagerbij =  mktime(0,0,0, 1, 2, 2000) - mktime(0,0,0, 1, 1, 2000);
			$unblock = $LastLogin +$dagerbij;
			$txt = "This account has been blocked for 1 day because of number of error login. This account is automatic unblock at ".date(DATE_RFC2822,$unblock).".";
			array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => $txt));
			echo $txt;
			echo'<script type="text/javascript">refreshingmessage();</script>';
		} else {
		array_push($_SESSION['Messages'], array("Date" => microtime(true), "html" => "Wrong Username and Password or secret code"));
		echo'<script type="text/javascript">refreshingmessage();</script>';
	// login is fout opnieuw
	$ErrorLogin += 1;
	mysqli_query($link,"UPDATE login SET ErrorLogin = '$ErrorLogin' WHERE Username='$Username'") or die(mysqli_error($link)); 	
	$_SESSION['SystemImgPas'] = md5( rand(100, 999));
			echo'
		<p>Wrong Username and Password or secret code</p>
		<form action="'.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr>';
		if ($ErrorLogin > 0){
		 	echo'<tr><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr>
				 <tr><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"></td></tr>';
				
		}
			
			echo '</table><input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
		}
	}
	}
	if ($founduser == false ){
	echo'
		<p>Wrong Username and Password or secret code</p>
		<form action="'.curPageURL().'" method="POST" name="Login">
			<table>
			<tr><td>Username</td><td><input type="text" name="Username" size="24" border="0"></td></tr>
			<tr><td>Password</td><td><input type="password" name="Password" size="24" border="0"></td></tr>';
		if ($ErrorLogin > 0){
		 	echo'<tr><td>Secret code</td><td><img src="system/imageauth.php"> </td></tr>
				 <tr><td>Secret code invoer</td><td><input type="password" name="ImgPas" size="24" border="0"></td></tr>';
				
		}
			
			echo '</table><input type="submit" name="submitButtonName" border="0" value="Login">
		</form>';
	}
	
	}
	}}
	echo '<a href="forgotten.php">Forgotten Username and Password</a>';
 include "footer.php";
 
echo '</div>';

if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// menu
//$languase = 1;

include "menu.php";
}else{
// menu
//$languase = 1;
include "menu.php";
}
?>