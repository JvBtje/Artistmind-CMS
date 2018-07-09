<?php
// Init session settingsif ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
// header
 $output .= '
<script language="javascript">
</script>';
$type = $_GET["type"]; 
//$selectId = intval($_GET["Id"]);
// laat een lijst zien
if ($type=="deletesession"){
	$output .= ini_get( 'session.save_path');
	$files = scandir(session_save_path());
	$current_id=session_id();
	foreach($files as $file) {
		if (substr ($file, 0, 5 ) == sess_){
			$sSessId = substr ($file, 5, strlen($file));
			session_write_close();
			session_id($sSessId);
			session_start();
			session_destroy();
			$output .= '<br>killing'.$file;		
		}
    }
	session_write_close();
	session_id($current_id);
	session_start();
	session_regenerate_id();
	header( 'Location: Logout.php' ) ;
}else {
$output .='<div id="buttonlayout">
            <h4><a href="indexstandalone.php?plugin=Killsessions&type=deletesession">Kill all</a></h4>
          </div><br><br>';	$output .= ini_get( 'session.save_path');
	$files = scandir(session_save_path());
	foreach($files as $file) {
		if (substr ($file, 0, 5 ) == "sess_"){
		
		$output .= '<br>'.$file;
				
		}
    }}
}else{
// user is niet ingelogt
	header( 'Location: Login.php?redirect='.curPageURL() ) ;
	exit;
}
?>
