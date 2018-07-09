<?php
session_start();
if ($_SESSION['newsession'] == false and ($_SESSION['TypeUser'] == 'Admin' or $_SESSION['TypeUser'] == 'Member' or $_SESSION['TypeUser'] == 'Moderator' ) ){
include "userdir.php";$userdir = '../../.'.$userdir;
$temp = explode(".", $_FILES["file"]["name"]);

function removeupdir($url){
	$oldlength = strlen($url);
	$url = str_replace ( "../", "./" , $url );
	if ( strlen($url) != $oldlength){
		$url = removeupdir($url);
	}
	return $url;
}
$name = $_GET['filename'];
$name = removeupdir($name);
$name =$userdir.$name;
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $name.$_FILES["file"]["name"] . "<br>";
	echo "dir".$name."<br>";
    if (file_exists($name . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $name . $_FILES["file"]["name"]);
      echo "Stored in: " . $name . $_FILES["file"]["name"];
      }
    }
echo '<br><script type="text/javascript" > window.parent.loadXMLDoc(\'./system/loaddir.php?url=\'+ window.parent.currentuploaddir);</script>your file is uploaded <a href="../link3.html"> <br>go back </a>to upload another file';
}else{
	echo'you are not logged in.';
}
?>