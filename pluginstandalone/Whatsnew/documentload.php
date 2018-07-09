<?php
session_start();


include('../../DB.php');
include('../../system/include.php');
if ( $_SESSION['Language'] == ""){
 setDefaultLanguage ();
}
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
header ("content-type: text/xml; charset=utf-8");
mysqli_set_charset($link, "utf8");
$acces = false;
$found = 0;
$msgnumber = intval($_POST["msgnumber"]);
$msgjaar = intval($_POST["msgjaar"]);
$msgmaand= intval($_POST["msgmaand"]);
if (($theDate = strtotime($msgjaar.'-'.$msgmaand.'-31 23:59:49')) === -1) {
		echo "De string  is niet geldig";
} 
$msgnumber = str_replace("'", " ", $msgnumber);
$msgnumber = str_replace('"', " ", $msgnumber);
$msgnumber = str_replace("\\", "\\\\", $msgnumber);



$result = mysqli_query($link,"SELECT Id, Naam, MainId, Type, targetmainid FROM groepen WHERE (Language = ".$_SESSION['Language']." AND PublishDate <  '".date("Y-m-d H:i:s",$theDate)."')  ORDER BY PublishDate DESC LIMIT $msgnumber,10") or die ('Query failed: ' . mysqli_error($link));
	
	while($row = mysqli_fetch_array($result)){
	if (isset( $_SESSION["Id"])) {
		$documentinfo = getdocumentinfo($row["MainId"],array(), $_SESSION["Id"]);
	}else{
		$documentinfo = getdocumentinfo($row["MainId"],array());
	}
	
	if (isset($documentinfo["basedocument"])){
		if ($documentinfo["basedocument"] == $row["MainId"]){
			$acces = $documentinfo["accesdoc"];
		}else{
		
			$acces = false;
		}
	}else{
		$acces = $documentinfo["accesdoc"];
	}
	$found++;
	$Naam = $row['Naam'];
	$Hyrargie = findId($row['MainId'], array());
	
	//$acces = true;
	if ($acces == true){
	$Predirwhattext = "../.";
	if (is_file($Predirwhattext.'./plugins/'.$row["Type"].'/whatisthetext.php')) {
	
		include $Predirwhattext.'./plugins/'.$row["Type"].'/whatisthetext.php';
	echo '<table id="messagelayout"><tr><td>';
	echo '<h4><a href="'.$row["Type"].'-'.$Hyrargie[0].'-'.$row['MainId'].'-'.$Naam.'.html"> '.$row['Naam'].'</a></h4>';
	
	
	
	
	preg_match_all('/<img[^>]+>/i',$returntext, $images);
	preg_match_all('/src\=\"(.*?)\"/',$images[0][0], $imgurl);
	$imgurl = substr($imgurl[0][0], 5, -1);
	array_push($_SESSION['Accesfiles2'], $imgurl);
	if (strlen($imgurl)>5){
		echo'';
		echo'<a href="'.$row["Type"].'-'.$Hyrargie[0].'-'.$row['MainId'].'-'.$Naam.'.html"><img src="./system/imgtumb.php?url='.$imgurl.'&maxsize=100&square=1" align="left"></a>';
	} 
	echo ''.substr(strip_tags($returntext),0,300).'<a href=""></a>';
							
	if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
	
		echo '<h4><a href="'.$row["Type"].'-'.$Hyrargie[0].'-'.$row['MainId'].'-'.$Naam.'.html"> meer...</a><a href="indexadminnew.php?plugin='.$row['Type'].'&type=select&Id='.$row['MainId'].'&sectie='.$Hyrargie[0].'"> Admin Control panel...</a></h4>';
	}else{
		echo '<h4><a href="'.$row["Type"].'-'.$Hyrargie[0].'-'.$row['MainId'].'-'.$Naam.'.html"> meer...</a></h4>';
	}
	echo '</td></tr></table>';
	}else{
		$returntext = "";
	}
		}
}
	if ($found < 10){
		echo '';
		echo '<div id="theenddoc">the end</div>';
	}


mysqli_close ($link);

?>
