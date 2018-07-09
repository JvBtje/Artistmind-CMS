<?php

ini_set('memory_limit', '2048M');



	$searchplug = Array();
	$i = 0;
	$root = scandir('./plugins'); 
	foreach($root as $value)
	{ 
		if (is_file('./plugins/'.$value.'/search.php')) {
			$searchplug[$i][0] = 'include(\'./plugins/'.$value.'/search.php\');';
			$searchplug[$i][1] = $value;
			$i++;
		}
	} 

	$root = scandir('./plugin windows'); 
	foreach($root as $value)
	{ 
		if (is_file('./plugin windows/'.$value.'/search.php')) {
			$searchplug[$i][0] = 'include(\'./plugins windows/'.$value.'/search.php\');';
			$searchplug[$i][1] = $value;
			$i++;
		}
	} 
	
	$root = scandir('./pluginstandalone'); 
	foreach($root as $value)
	{ 
		if (is_file('./pluginstandalone/'.$value.'/search.php')) {
			$searchplug[$i][0] = 'include(\'./pluginstandalone/'.$value.'/search.php\');';
			$searchplug[$i][1] = $value;
			$i++;
		}
	} 
	//print_r($searchplug);
	$_SESSION['search'] = $searchplug;


function DoSearch($SearchString="", $Sectie ="", $smallsearch=false){
	global $link;
	$PageId = array();
	
	$SearchString = trim($SearchString);
	$SearchString = str_replace("!", " ",$SearchString);
	$SearchString = str_replace(".", " ",$SearchString);
	$SearchString = str_replace("?", " ",$SearchString);
	$SearchString = str_replace(",", " ",$SearchString);
	//$SearchString = str_replace("-", " ",$SearchString);
	$SearchString = str_replace("/", " ",$SearchString);
	$SearchString = str_replace("(", " ",$SearchString);
	$SearchString = str_replace(")", " ",$SearchString);
	$SearchString = str_replace("'", " ",$SearchString);
		
	$SearchStringM3 = explode('"', $SearchString);
	$SearchstringM2 = array();
	$SearchstringM4 = array();
	$SearchstringM5 = array();
	$SearchstringM = array();
	$i = 0;
	
	
	foreach ($SearchStringM3 as $value) {
		if ($i == 0){
			$tmparray2 =explode("-", trim($value));
			$ii=0;
		foreach ($tmparray2 as $value2) {
				if ($ii == 0){	
					$tmparray =explode(" ", trim($value2));			
					$SearchstringM2 = array_merge ($SearchstringM2, $tmparray);
					$ii++;
				}else{
					array_push($SearchstringM5, Array($value2,5));
					$ii = 0;
				}
			}
			
			$i++;
		}else{
			array_push($SearchstringM4, Array($value,5));
			$i = 0;
		}
	}
	

	
		
	foreach ($SearchstringM2 as $value) {
		$realstrlenght = strlen($value);
		if ($realstrlenght == 0){
		
		}else if ($realstrlenght < 4){
			array_push($SearchstringM, array($value,4));
		}else if ($realstrlenght < 8){
			$mid = intval($realstrlenght /2);
			array_push($SearchstringM, array($value,4));
			array_push($SearchstringM, array(substr($value,0,$mid+1),2));
			array_push($SearchstringM, array(substr($value,$mid,$mid+1),1));			
		}else{
			$mid = intval($realstrlenght /2);
			$part = intval($realstrlenght /4);
			array_push($SearchstringM, array($value,4));
			array_push($SearchstringM, array(substr($value,0,$mid+1),2));
			array_push($SearchstringM, array(substr($value,$mid,$mid+1),1));
			array_push($SearchstringM, array(substr($value,$part,$mid+1),2));
			array_push($SearchstringM, array(substr($value,0,$part+1),2));
			array_push($SearchstringM, array(substr($value,$part,$part+1),1));
			array_push($SearchstringM, array(substr($value,$mid,$part+1),1));
			array_push($SearchstringM, array(substr($value,$mid + $part,$part+1),1));	
		}		
	}
	/*foreach ($SearchstringM  as $keyword) {
		for ($i=0;$i<10;$i++){
			array_push($SearchstringM, " ".$keyword." ");
			//array_push($SearchstringM, $keyword." ");
			array_push($SearchstringM, " ".$keyword."!");
			array_push($SearchstringM, " ".$keyword.".");
			array_push($SearchstringM, " ".$keyword."?");
			array_push($SearchstringM, " ".$keyword.",");
			array_push($SearchstringM, " ".$keyword."-");
			array_push($SearchstringM, " ".$keyword."/");
			array_push($SearchstringM, " ".$keyword.")");
			array_push($SearchstringM, " ".$keyword."(");
		}
	}*/
	array_push($SearchstringM, array($SearchString,5));
	$SearchstringM = array_merge ($SearchstringM, $SearchstringM4);

	$mysqlsearchstring = "";
	foreach ($_SESSION['search'] as $searchplugin) {
		$mysqlsearchstring .=" Type = '".$searchplugin[1]."' OR";
	}
	$mysqlsearchstring = substr($mysqlsearchstring,0,-2);
	
	/*print_r ($SearchstringM5); // strict delete keyword search
	print_r ($SearchstringM4); //strict normal search
	print_r ($SearchstringM3); // nothing at all
	print_r ($SearchstringM2); //normal search - detail sub search*/
	
	if ($SearchString == ""){
	// nog geen zoekopdracht
	if ($Sectie == ""){
		$query = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND ($mysqlsearchstring) ORDER BY PublishDate DESC";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}	
		$plugintype="plugins";
		while($row = mysqli_fetch_array($result)){
			//$acces = accesdocument($row['MainId'], $Ids = array(), $_SESSION["Id"]);
			//if ($acces == true){
				
				//if (intval($Sectie) == intval($Hyrargie[0])){
					array_push($PageId, array( "Id"=>$row['MainId'],"Plugintype"=>$plugintype,"Pluginname"=>""));
				//}
			//}
		}
	} else {
		foreach($searchplug as $value)
		{ 
			$querysearchstring = 'Type = '.$value[1].' OR ';
		}
		$querysearchstring = substr ($querysearchstring,  0, strlen ($querysearchstring)-4);
		$query = "SELECT MainId FROM groepen WHERE Language=". $_SESSION['Language'] ." AND  ($querysearchstring)ORDER BY PublishDate DESC";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}	
		$plugintype="plugins";
		while($row = mysqli_fetch_array($result)){
			//$acces = accesdocument($row['MainId'], $Ids = array(), $_SESSION["Id"]);
			//if ($acces == true){
				
				//if (intval($Sectie) == intval($Hyrargie[0])){
					array_push($PageId, array( "Id"=>$row['MainId'],"Plugintype"=>$plugintype,"Pluginname"=>""));
				//}		
			//}
		}
	}
	}else{
	// Zoekopdracht
	$PageIddelete = Array();
	$plugintype="plugins";
	
		foreach ($SearchstringM5  as $keywordb) {
		$keyword = mb_strtolower ( $keywordb[0]);
		if (strlen ($keyword) > 1){
		$importend = $keywordb[1];
		$Searchstingadd = " ";
			$Sectie = str_replace("'", " ",$Sectie);
			$Sectie = str_replace("\"", " ",$Sectie);

		$query = "SELECT MainId,Id, MainId, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND ($mysqlsearchstring) AND (Naam LIKE '%".$keyword."%')";
		//$query = "SELECT MainId,Id, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND (Type = 'richtext' OR Type = 'photogallery' OR Type = 'form' )AND (Naam SOUNDS LIKE '%".$keyword."%')";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
				
			array_push($PageId, array( "Id"=>$row['MainId'],"Plugintype"=>$plugintype,"Pluginname"=>""));
			
		}//}
		
		foreach ($_SESSION['search'] as $searchplugin) {
			eval($searchplugin[0]);
		}
		
	}}
	foreach ($PageId  as $keywordb) {
		array_push($PageIddelete, $keywordb);
		if ($keywordb["Plugintype"] == "plugins"){			
			$subdocuments = getAllsubdocuments ($keywordb["Id"]);
			if ($subdocuments["basedocument"] != NULL){
				array_push($PageIddelete, array( "Id"=>$subdocuments["basedocument"],"Plugintype"=>"plugins","Pluginname"=>""));
				//echo $subdocuments["basedocument"];
				//print_r ($subdocuments["docIds"]);
				foreach ($subdocuments["docIds"] as $subdoc) {
					//print_r ($subdoc);
					array_push($PageIddelete, array( "Id"=>$subdoc,"Plugintype"=>"plugins","Pluginname"=>""));
				}
			}
		}
	}
	//print_r($PageIddelete);
	$PageId = Array();
	foreach ($SearchstringM  as $keywordb) {
	
		//$keyword = mb_strtolower( $keywordb[0]);
		$keyword = mb_strtolower($keywordb[0]);
		if (strlen ($keyword) > 1){
		$importend = $keywordb[1];
		$Searchstingadd = " ";
			$Sectie = str_replace("'", " ",$Sectie);
			$Sectie = str_replace("\"", " ",$Sectie);

		$query = "SELECT MainId,Id, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND ($mysqlsearchstring) AND (Naam LIKE '%".$keyword."%')";
		//$query = "SELECT MainId,Id, Naam FROM groepen WHERE Language=". $_SESSION['Language'] ." AND (Type = 'richtext' OR Type = 'photogallery' OR Type = 'form' )AND (Naam SOUNDS LIKE '%".$keyword."%')";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
		//$acces = accesdocument($row['MainId'], $Ids = array(), $_SESSION["Id"]);
		//if ($acces == true){
			$add = true;
			foreach ($PageIddelete as $Keyworddel){
				if ($Keyworddel["Id"] == $row["MainId"]){
					$add = false;
					//break;
				}
			}
			if ($add == true){
				preg_match("/\b$keyword\b/",mb_strtolower($row['Naam']), $matches);
				$verschil = (count($matches)*10) +5;
				
				
				$verschil += (substr_count(mb_strtolower($row['Naam']), $keyword) * 10)+5;
				
				
				$verschil = $verschil * $importend;
				
				if ($verschil < 1){
					
				array_push($PageId, array( "Id"=>$row['MainId'],"Plugintype"=>$plugintype,"Pluginname"=>""));
				}else{
					for($i=0; $i<$verschil;$i++){
						
						array_push($PageId, array( "Id"=>$row['MainId'],"Plugintype"=>$plugintype,"Pluginname"=>""));
					}
				}
			}
		}//}
		
		foreach ($_SESSION['search'] as $searchplugin) {
	
			eval($searchplugin[0]);
		}
		
	}}
	//$PageIdtmp = $PageId;
	//$PageId = array();
	

	//print_r($PageId);
	//print_r($PageIddelete);
	/*
	foreach ($PageId  as $deleteid) {
		for($i=0; $i< count($PageIdtmp);$i++){
			if ($PageIdtmp[$i]["Id"] == $deleteid["Id"]){				
				unset($PageIdtmp[$i]);
				$i--;
				$i--;
			}else{
			}
		}
	}*/
	
	//$PageId = $PageIdtmp;
	}
	
	$output .=DisplaySearch($PageId, $_GET["Orderening"], $smallsearch, $Sectie, $SearchString);
	
	return $output;
}

function DisplaySearch($PageId, $Orderening, $smallsearch, $Sectie, $SearchString){
	$output = '<div id="lijstthesearch">';
	global $link;
	
	$Resultnumber = intval($_GET["Resultnumber"]);
	$Resultnumberold= $Resultnumber;
	$Resultnumber = $Resultnumber +26;
	if (count($PageId) > 0){
	if ($SearchString != ""){
		$PageId = multi_unique($PageId);	
	}
	
	if ($Resultnumber > count($PageId)-1){
		$limit = count($PageId)-1;
	}else{
		if ($Resultnumber != 0){
			$limit = $Resultnumber;
		}else{
			if (26 > count($PageId)-1){
				$limit = count($PageId)-1;
			}else{
				$limit = 26;
			}
		}
	}
	
	for ($i=0; $i <= $Resultnumber ; $i++){
		if ($PageId[$i][Plugintype]=="plugins"){
		if($Sectie != ""){		
			//echo $PageId[$i][Id];
			//$Hyrargie = findId($PageId[$i][Id], array());
				if (isset( $_SESSION["Id"])) {
					$documentinfo = getdocumentinfo($PageId[$i][Id],array(), $_SESSION["Id"]);
				}else{
					$documentinfo = getdocumentinfo($PageId[$i][Id],array());
				}
				$Hyrargie = $documentinfo["Ids"];
				
			if (intval($Sectie) != intval($Hyrargie[count($Hyrargie)-1])){
				array_splice($PageId, $i, 1);
				$i--;
			}else{
				//echo "id=".$PageId[$i][Id];

				//$acces = accesdocument($PageId[$i][Id], $Ids = array(), $_SESSION["Id"]);
				if (isset($documentinfo["basedocument"])){
				
					if ($documentinfo["basedocument"] == $row["MainId"]){
						$acces = $documentinfo["accesdoc"];
					}else{
						$foundprevbasedoc = false;
						for ($ii=0; $ii < $i ; $ii++){
							if ($PageId[$ii][Id] == $documentinfo["basedocument"]){
								$foundprevbasedoc = true;
							}
						}
						if ($foundprevbasedoc == false){
							$PageId[$i][Id] = $documentinfo["basedocument"];
							if (isset( $_SESSION["Id"])) {
								$documentinfo = getdocumentinfo($PageId[$i][Id],array(), $_SESSION["Id"]);
							}else{
								$documentinfo = getdocumentinfo($PageId[$i][Id],array());
							}
							 
							$acces = $documentinfo["accesdoc"];
						}else{
							$acces = false;
						}
					}
				}else{
					$acces = $documentinfo["accesdoc"];
				}
				if ($acces != true){
					
					array_splice($PageId, $i, 1);
					$i--;
				}
			}
			
		}else{
				//echo "id=".$PageId[$i][Id];
				if (isset( $_SESSION["Id"])) {
					$documentinfo = getdocumentinfo($PageId[$i][Id],array(), $_SESSION["Id"]);
				}else{
					$documentinfo = getdocumentinfo($PageId[$i][Id],array());
				}
				if (isset($documentinfo["basedocument"])){
					if ($documentinfo["basedocument"] == $row["MainId"]){
						$acces = $documentinfo["accesdoc"];
					}else{
						$foundprevbasedoc = false;
						for ($ii=0; $ii < $i ; $ii++){
							if ($PageId[$ii][Id] == $documentinfo["basedocument"]){
								$foundprevbasedoc = true;
							}
						}
						if ($foundprevbasedoc == false){
							$PageId[$i][Id] = $documentinfo["basedocument"];
							if (isset( $_SESSION["Id"])) {
								$documentinfo = getdocumentinfo($PageId[$i][Id],array(), $_SESSION["Id"]);
							}else{
								$documentinfo = getdocumentinfo($PageId[$i][Id],array());
							}
							 
							$acces = $documentinfo["accesdoc"];
						}else{
							$acces = false;
						}
					}
				}else{
					$acces = $documentinfo["accesdoc"];
				}
				
				if ($acces != true){
					
					array_splice($PageId, $i, 1);
					$i--;
				}
			}
		}else{
			if($Sectie != ""){
				array_splice($PageId, $i, 1);
				$i--;
			}
		}
		if (count($PageId)-1 < $Resultnumber){
			if ($limit == 0){
				break;
			}
			$Resultnumber--;
		}
	}
	}
	/*$query2 = 'SELECT Listview, Listview2 FROM system';
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
		die('Query failed: ' . mysqli_error($link2));
	}
	while($row2 = mysqli_fetch_array($result2)){
		$htmlwithimg = $row2['Listview'];
		$htmlwithoutimg = $row2['Listview2'];
	}*/
	if ($_SESSION['Themeoverride'] == ""){
		include $_SESSION['Theme']."listt.php";
	}else{
		include $_SESSION['Themeoverride']."listt.php";
	}
	$Resultnumber = $Resultnumberold;
	//$PageId = array_unique ($PageId, $sort_flags = SORT_STRING);
	//$PageId = array_reverse ($PageId );
	
	if ($smallsearch == true){
	$output .= '<a href="#"><h3>Gerelateerde pagina\'s.</h3></a>';
	//echo count($PageId) ." Pagina's gevonden<br>";
	$listlength = 6;
	}else{
	$output .= count($PageId) ." Pagina's gevonden<br>";
	$listlength = 23;
	}
	
	if (count($PageId) == 0){
	// niks gevonden niks laten zien
	}else{
	if ($smallsearch == false){
	$Resultnumber = $_GET["Resultnumber"];
	$Resultnumber = str_replace("'", " ", $Resultnumber);
	$Resultnumber = str_replace('"', " ", $Resultnumber);
	//if ($Resultnumber == ""){
		$theurl = curPageURL(); 
	//}else{
		$url = curPageURL();
		$url = str_replace ('a=0&','',$url);
		$url = explode("?", $url);
		$url[1] = explode("&", $url[1]);
		$theurl=$url[0]."?a=0&";
		
		$i=0;
		foreach ($url[1] as $urlvar) {
			if (substr($urlvar,0,12) <> "Resultnumber"){
			if ($i==0){$theurl = $theurl."".$urlvar;}else{$theurl = $theurl."&".$urlvar;}
			}
			$i++;
		}
	//}
	
	$Resultnumber = intval($Resultnumber); 
	$i=0;
	$ii=23;
	$iii=0;
	$lijstclicken = "";
	
	foreach ($PageId as $ThePageId) {
		$i++;
		$ii++;
		if ($ii==24){
			$iii++;
			$lijstclicken .= '<div id="resultnumberlayout"><a href="'.$theurl.'&Resultnumber='.($i-1).'">'.($iii).'</a></div> ';
			$ii = 0;
		}
	}
	}
	$output .= '<br><br>';
	$output .= $lijstclicken;
	$output .= '<br><br>';
                    
		for ( $i = $Resultnumber; $i <= $Resultnumber+$listlength; $i ++) {
			 
			if ($PageId[$i][Plugintype]=="plugins"){
			
			if (array_key_exists ($i, $PageId) == true){
			   
			
			
			$query = "SELECT Id, MainId, Naam, Type, targetmainid FROM groepen WHERE Language=". $_SESSION['Language'] ." AND MainId=".$PageId[$i][Id];
				
			
			
			$result = mysqli_query($link,$query);
			if (!$result) {
    				die('Query failed: ' . mysqli_error($link));
			}

	
			while($row = mysqli_fetch_array($result)){
			
				$Page = $row['MainId'];
				$Sectie = findId($PageId[$i][Id], array());
				$Sectie = $Sectie[0];
				//echo ' in ';
				//$query2 = "SELECT Smalltext, DATE_FORMAT(DATE_SUB(TheTime, INTERVAL '-0 0:00:00' DAY_SECOND),'%d/%m/%y - [ %T ]') AS TheTime, Werkervaring, Max, Maya, XCI, Avid, FCS, Shake, Combustion, AfterEffects, Premiere, Anders, Inzetbaarheid FROM profielen WHERE IdUser=".$PerId;
				$Naam = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),mb_convert_encoding($row['Naam'], "UTF-8"));
					
					
				if ($smallsearch == false){
				
					$Naam2 = str_replace(array(":","/","\\","-","?"), array(" "," "," "," "," "),mb_convert_encoding($row['Naam'], "UTF-8"));
					$url = ''.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html';
					$adminurl = 'indexadminnew.php?plugin='.$row['Type'].'&type=select&Id='.$row['MainId'].'&sectie='.$Sectie;
			//$output .= '<table><tr><td><div style="display:block;"><h4><a href="'.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html"> '.$row['Naam'].'</a></h4>';
			$returntext = "";
			$returntextb="";
			if (is_file('./plugins/'.$row["Type"].'/whatisthetext.php')) {
				include './plugins/'.$row["Type"].'/whatisthetext.php';
			}else{
				$returntext = "";
			}
			$returntext= mb_convert_encoding($returntext, "UTF-8");
			$row['Naam']= mb_convert_encoding($row['Naam'], "UTF-8");
			preg_match_all('/<img[^>]+>/i',$returntext, $images);
			preg_match_all('/src\=\"(.*?)\"/',$images[0][0], $imgurl);
			$imgurl = substr($imgurl[0][0], 5, -1);
			array_push($_SESSION['Accesfiles2'], $imgurl);
			$returntext = substr(strip_tags($returntext),0,300);
			if (strlen($imgurl)>5){
				
				//$output .='<a href="'.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html"><img src="./system/imgtumb.php?url='.$imgurl.'&maxsize=100&square=1" align="left"></a>';
			}
			//$output .= ''.substr(strip_tags($returntext),0,300).'<a href=""></a>';
			if ($_SESSION['newsession'] == false and $_SESSION['TypeUser'] == 'Admin' ){
				//$output .= ' <table><tr><td><h4><a href="'.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html"> meer...</a> </h4></td><td> <h4> <a href="indexadminnew.php?plugin='.$row['Type'].'&type=select&Id='.$row['MainId'].'&sectie='.$Sectie.'">Admin Control panel...</a></h4></td></tr></table></div>';
				
			}else{
				//$output .= ' <h4><a href="'.$row['Type'].'-'.$Sectie.'-'.$row['MainId'].'-'.$Naam2.'.html"> Meer...</a> </h4></div>';
			}
			if (strlen($imgurl)>5){
				$htmlwithimg2 = str_replace("%listurl%", $url, $listimage);
				$htmlwithimg2 = str_replace("%listtext%", $returntext, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listheading%", $row['Naam'], $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listimage%", $imgurl, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%adminurl%", $adminurl, $htmlwithimg2);
				$output .= $htmlwithimg2;
			}else{
				$htmlwithoutimg2 = str_replace("%listurl%", $url, $listnoimage);
				$htmlwithoutimg2 = str_replace("%listtext%", $returntext, $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%listheading%", $row['Naam'], $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%adminurl%", $adminurl, $htmlwithoutimg2);
				$output .= $htmlwithoutimg2;
			}
				}else{

				}
			}	
			}
		}else if($PageId[$i][Plugintype]=="pluginstandalone"){
			
			$url = 'indexstandalone.php?plugin='.$PageId[$i][Pluginname].'&type=Profile&Id='.$PageId[$i][Id];
			$returntext = "";
			$returntextb="";
			$title="";
			if (is_file('./pluginstandalone/'.$PageId[$i][Pluginname].'/whatisthetext.php')) {
				include './pluginstandalone/'.$PageId[$i][Pluginname].'/whatisthetext.php';
			}else{
				$returntext = "";
			}
			$returntext= mb_convert_encoding($returntext, "UTF-8");
			$listheading= mb_convert_encoding($listheading, "UTF-8");
			preg_match_all('/<img[^>]+>/i',$returntext, $images);
			preg_match_all('/src\=\"(.*?)\"/',$images[0][0], $imgurl);
			$imgurl = substr($imgurl[0][0], 5, -1);
			array_push($_SESSION['Accesfiles2'], $imgurl);
			
			$returntext = substr(strip_tags($returntext),0,300);
			
			if (strlen($imgurl)>5){
				$htmlwithimg2 = str_replace("%listurl%", $url, $listimage);
				$htmlwithimg2 = str_replace("%listtext%", $returntext, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listheading%", $listheading, $htmlwithimg2);
				$htmlwithimg2 = str_replace("%listimage%", $imgurl, $htmlwithimg2);
				$output .= $htmlwithimg2;
			}else{
				$htmlwithoutimg2 = str_replace("%listurl%", "$url", $listnoimage);
				$htmlwithoutimg2 = str_replace("%listtext%", $returntext, $htmlwithoutimg2);
				$htmlwithoutimg2 = str_replace("%listheading%", $listheading, $htmlwithoutimg2);
				$output .= $htmlwithoutimg2;
			}
			}
		}
	$output .= '</div></td>
			</tr>
		</table>';
		//}
	$output .='<br><br>';
	
	$output .= $lijstclicken;
	}
	$output .= '<script language="javascript">updatelijst("thesearch",'.$tumbsizelist.');</script>';
	return $output;
}
?>
