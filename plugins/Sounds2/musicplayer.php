<?php
session_start();
include("../../DB.php");
include("../../system/include.php");
include("include.php");
$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);
mysqli_set_charset($link, "utf8");
 header("Cache-Control: max-age=0, no-cache, no-store");
  header("Content-type: text/html; charset=utf-8");
include ("include.js");

if ($_SESSION['newsessionany'] != 10 ){
	$_SESSION['newsessionany'] = 10;
	setDefaultLanguage ();
}

$MainId = intval($_GET["soundgalnum"]);
if ($MainId == undefined or $MainId == null){
	echo '<html >
	<script src="soundmanager2-nodebug-jsmin.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">';
	echo 'Error illigal mainid';
	echo '</body></html>';
	}else {
	if (isset( $_SESSION["Id"])) {
		$documentinfo = getdocumentinfo($MainId,array(), $_SESSION["Id"]);
	}else{
		$documentinfo = getdocumentinfo($MainId,array());
	} 
	$acces = $documentinfo["accesdoc"];
	if ($acces == true){
	echo '<html >
	<script src="soundmanager2-nodebug-jsmin.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">';

	$result = mysqli_query($link,"SELECT Naam, Parent, Id, MainId, targetmainid, PublishDate, LastSaved, theDate FROM groepen WHERE MainId=".$MainId." AND Language=". $_SESSION['Language']);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}


		while($row = mysqli_fetch_array($result)){
				$MainId = $row['targetmainid'];
		}
		$query = "SELECT Id, LargText, DATE_FORMAT(TheDate, '%d-%c-%Y %H:%i:%s') AS TheDate FROM soundsmain WHERE MainId =".$MainId." AND Language =".$_SESSION['Language'];
		$result = mysqli_query($link,$query);
		if (!$result) {
			die('Query failed: ' . mysqli_error($link));
		}

		while($row = mysqli_fetch_array($result)){
		$Id = $row['Id'];
		}
	$result2 = mysqli_query($link,"SELECT Id, IdGal, Theorder, Url FROM sounds WHERE IdGal=".$Id." ORDER BY Theorder");
		if (!$result2) {
			die('Query failed: ' . mysqli_error($link));
		}
		
		echo '<script language="javascript">window.mainsoundgal = Array ()</script>';
		while($row2 = mysqli_fetch_array($result2)){

			
			if (file_exists("../../".$row2["Url"])){
			
				if ($ii < $TumbRows){
				
				$ii = $ii + 1;
			}
			
			//read id3 tage
			$oReader = new ID3TagsReader();
			$aTags = $oReader->getTagsInfo("../../".$row2["Url"]);
			$jsarray = str_replace("'", "\'", json_encode($aTags));
			$direxplode = explode("/", $row2["Url"]);
			$dir = "";
			$albumimg = "../../system/imgtumb.php?url=".$_SESSION['Theme']."systemicon/sound icoon.jpg&maxsize=50";
			$albumimgurl=$_SESSION['Theme']."systemicon/sound icoon.jpg";
			for($i=0; $i< count ($direxplode)-1;$i++){
				$dir .= $direxplode[$i]."/";
				array_push($_SESSION['Accesfiles2'], $row2["Url"]);
			}
			if (file_exists("../.".$dir."album.jpg")){
				$albumimg = "../../system/imgtumb.php?url=".$dir."album.jpg&maxsize=50";
				$albumimgurl=$dir."album.jpg";
			}
			if ($jsarray == "null"){
				echo '<script language="javascript">window.mainsoundgal.push(addsoundfile(\''.$row2["Url"].'\', null,\''.$albumimgurl.'\'));</script>';
			}else{
				echo '<script language="javascript">window.mainsoundgal.push(addsoundfile(\''.$row2["Url"].'\', \''.$jsarray.'\',\''.$albumimgurl.'\'));</script>';
			}
			$numimg++;
			}
		//	
		}

	echo'<script type="text/javascript">window.themeurl="'.$_SESSION['Theme'].'"

	function loader (){
			
			window.titlescroller = 0;
			window.cursound=0;
			if (window.opener){ window.cursound = window.opener.cursound;}
			window.parentwindow = window.opener;
			if (window.opener){ window.soundwindow = window.opener.soundwindow;}
			
			window.playsound (window.mainsoundgal[window.cursound].url)
			
			updatesoundgal ();
			window.parentwindow.document.getElementById("soundplayer").style.display="block";
			
	}
	function ontlader (){
			window.parentwindow.document.getElementById("soundplayer").style.display="none";
	}
	</script>';

		
	echo '<style>
	body {
	  overflow-x: hidden;
	  overflow-y: auto;
	}
	body img{
		padding:3px;
	}
	html {
		overflow: -moz-scrollbars-vertical;
	}
	</style>';
	echo '<LINK HREF="../../'.$_SESSION['Theme'].'style.css" REL="stylesheet" TYPE="text/css">';
	}else{
		echo "acces deniend";
	}
	echo'<body  onload="loader()" onunload="ontlader()" onmouseup="window.down=0;" onmousedown="window.down=1;"><div id="soundgal"></div><div style="height:100px;">
	<script>
	soundManager.setup({
	  url: \'./\',
	  flashVersion: 9, // optional: shiny features (default = 8)
	  // optional: ignore Flash where possible, use 100% HTML5 mode
	  // preferFlash: false,
	  onready: function() {
		// Ready to use; soundManager.createSound() etc. can now be called.
	  }
	});
	</script>
	</div>
	';
	echo'<div id="soundplayerinline" name="soundplayerinline" ><div style="display:inline-block;width:100%;height:31px;"> <div style="bottom:31px; position:absolute; text-align: center; "> <a onclick="prevsound();"><img  src="../../'.$_SESSION['Theme'].'musicplayer/prev.png" ></a><a onclick="window.soundwindow.playpauze();"><img  id="playpauze" src="../../'.$_SESSION['Theme'].'musicplayer/pauze.png" ></a><a onclick="nextsound();"><img src="../../'.$_SESSION['Theme'].'musicplayer/next.png" ></a></div></div><br><div style="display:block;bottom:0px;">
	<div id="curaudiotime" style="padding-left:10px;padding-right:10px;display:inline-block;"></div>      <div id="timeslider" onmousemove="soundscrub(event);" onClick="startscrub(event);soundscrub(event);stopscrub(event);" style="display:inline-block;"><div style="position:relative;  height:2px;width:150px;bottom:-18px; background-image:url(../../'.$_SESSION['Theme'].'musicplayer/timeline.png);"></div><a onmousedown="startscrub();" onClick="soundscrubend(event);" onmouseup="stopscrub();"><div id="soundslider"  style="position:relative; left:0px;height:21px;width:21px;bottom:-7px; background-image:url(../../'.$_SESSION['Theme'].'musicplayer/timeslider.png);"></div></a></div> <div id="curaudiolength" style="	padding-left:10px;padding-right:10px;display:inline-block;"></div></div></div>';
	echo '</body></html>';
}
mysqli_close ($link);
session_write_close();
?>