<?php

include ("search2.php");
// set and check language

// header settings
// header
if ($type == "ViewPer"){
	$PerId = $_GET["Perid"];	
	$PerId = str_replace("'", " ", $PerId);
	$PerId = str_replace('"', " ", $PerId);
	$PerId = str_replace(',', " ", $PerId);
	$query = "SELECT Id, Username, Voornaam, Achternaam, Bedrijf, Website FROM login WHERE Id=".$PerId;
	$result = mysqli_query($link,$query);
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
	$maintitel = $row['Voornaam'].' '.$row['Achternaam'];
	}
}else{
$Naam = "";
}

$output .=  '

<script language="javascript">
function updatelijst(lijstid,tumbsizelist){	
	scale = 1 / window.devicePixelRatio;
	tumbsizelist = tumbsizelist * window.devicePixelRatio;	
	html = document.getElementById(\'lijst\'+lijstid).innerHTML;
	html = html.replace(/%maxsize/g, tumbsizelist);
	html = html.replace(/%scale%/g, scale);
	document.getElementById(\'lijst\'+lijstid).innerHTML = html;	
	
}

function changeval(){	
	
}

function submitform(){
	
		document.formzoek.submit();
    	
}
</script>';

	




function CountPerids($Perid1, $Perid2){
	global $Perids; 
	
	$Searchresult1 = array_keys($Perids, $Perid1);
	$Searchresult2 = array_keys($Perids, $Perid2);
	
	if (count($Searchresult1) == count($Searchresult2)) {
        return 0;
    }
	return ( count($Searchresult1) < count($Searchresult2)) ? -1 : 1;
}



if($type == ""){
	
	$SearchString = $_GET["Searchstring"]; 
	
	$Orderening = $_GET["Orderening"];
	if (isset($_GET["Sectie"])){		
		$Sectie = $_GET["Sectie"];
	}
	
	$SearchString = str_replace("'", " ", $SearchString);
	//$SearchString = str_replace('"', " ", $SearchString);
	$SearchString = str_replace(',', " ", $SearchString);
	$SearchString = str_replace('\\', " ", $SearchString);
	$Orderening = str_replace("'", " ", $Orderening);
	$Orderening = str_replace('"', " ", $Orderening);
	$Orderening = str_replace(',', " ", $Orderening);
	$Orderening = str_replace('\\', " ", $Orderening);
	$Sectie = str_replace("'", " ", $Sectie);
	$Sectie = str_replace('"', " ", $Sectie);
	$Sectie = str_replace(',', " ", $Sectie);
	$Sectie = str_replace('\\', " ", $Sectie);

	//$SearchstringM = str_replace(" ", "%", $SearchstringM);
	
	$output .=  '<form name="formzoek"  action="indexstandalone.php" method="GET" name="Users" accept-charset="UTF8"><input type="hidden" name="plugin" value="Search" border="0"><input type="hidden" name="type" value="" border="0">Search <input type="text" name="Searchstring" id ="Searchstring" value=\''.$SearchString.'\'size="24" border="0"> Sectie <select name="Sectie" size="1">
				<option '; if($Sectie == "Alles"){$output .= ' selected ';} $output .= ' value="">Alles</option>';
	$result = mysqli_query($link,"SELECT Id, Naam, TheOrder, MainId FROM groepen WHERE Language =".$_SESSION['Language']." AND Parent=-1 ORDER BY TheOrder ");
	if (!$result) {
    	die('Query failed: ' . mysqli_error($link));
	}

	while($row = mysqli_fetch_array($result)){
		$acces = accesdocument($row["Id"], $Ids = array(), $_SESSION["Id"]);
				
		if ($acces == true){
			$output .=  '<option '; if($Sectie == $row['MainId']){$output .= ' selected ';} $output .= ' value="'.$row['MainId'].'">'.$row['Naam'].'</option>';
		}
	}
				
				$output .=  '
			</select><div id="buttonlayout">
            <h4><a href="javascript: submitform()">Search</a></h4>
          </div>
			
			
			
			</form>';
	
	 $output .= DoSearch($SearchString, $Sectie);
}


?>
