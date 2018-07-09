<?phpinclude("../../DB.php");$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);include("../../system/include.php");session_start();if ( $_SESSION['Language'] == ""){ setDefaultLanguage ();}//$_SESSION['Accesfiles2']= array();$type = $_GET["type"]; if (isset($_GET["sectie"])){	$sectie = intval($_GET["sectie"]);}$language_id = intval($_GET["language_id"]); if ($language_id != ""){$_SESSION['Language'] =$language_id;}//$selectId = intval($_GET["Id"]);$MainId = intval($_GET["project"]);$selectId = intval($_GET["project"]);

$id = intval($_GET["project"]); 
$StartDatum = $_GET["StartDatum"];
$EindDatum = $_GET["EindDatum"];
$Date = $_GET["Date"];
$StartDatum= str_replace("'", " ", $StartDatum);
$StartDatum= str_replace('"', " ", $StartDatum);
$StartDatum = str_replace("\\", "\\\\", $StartDatum);
$EindDatum= str_replace("'", " ", $EindDatum);
$EindDatum= str_replace('"', " ", $EindDatum);
$EindDatum = str_replace("\\", "\\\\", $EindDatum);
$Date= str_replace("'", " ", $Date);
$Date= str_replace('"', " ", $Date);
$Date = str_replace("\\", "\\\\", $Date);
$id = str_replace("'", " ", $id);
$id = str_replace('"', " ", $id);
$id = str_replace('\\', " ", $id);
// create the hash for the random number and put it in the session$acces == false;$acces = accesdocument($MainId, $Ids = array(), $_SESSION["Id"]);if ($acces == true){
// create the image
$image = imagecreate(900, 500);
// use white as the background image
$bgColor = imagecolorallocate ($image, 255, 255, 255); 
// the text color is black
$textColor = imagecolorallocate ($image, 0, 0, 0); $linColor = imagecolorallocate ($image, 200, 200, 200);
$blauw = imagecolorallocate ($image, 0, 0, 255);
$rood =  imagecolorallocate ($image, 255, 0, 0); 
$groen = imagecolorallocate ($image, 0, 255, 0); 
/// Rekent graph uit

	
	$IdProject = $MainId;
		$id = $IdProject;
		//$creator == $row['Creator'];
		//$datefromdb = $row['TheTime'];
		//echo "id = $id Created $datefromdb by $creator <br> ";
		//echo '<b>'.$row['Naam'].'</b> '.$row['Omschrijving'].'<br>
		// Members Project
	//	';
	$uren ="";	
	$totaaluren = 0;
	$totaalurenkosten = 0 ;
	$totaalonkosten = 0;
	$totaalinkomsten = 0;
	$begindatum = -1;
	$eindatum = -1;

	$query2 = "SELECT IdUren FROM linkurenprojecten WHERE IdProjecten = $id";
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
   		die('Query failed: ' . mysqli_error($link));
	}
	while($row2 = mysqli_fetch_array($result2)){
		
		$query3 = 'SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Type, User, Uurtarief FROM uren WHERE Id = "'.$row2['IdUren'].'"';
		$result3 = mysqli_query($link,$query3);
		if (!$result3) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row3 = mysqli_fetch_array($result3)){
		if ((strtotime($row3['StartDatumTijd']) > strtotime($StartDatum) and strtotime($row3['StartDatumTijd']) < strtotime($EindDatum) and $Date == "aan") or $Date <> "aan"){
			if ($uren == ""){
			$uren = "Id = ".$row2['IdUren'];
		}else{
			$uren = $uren." OR Id = ".$row2['IdUren'];
		}
			if ($begindatum >  strtotime($row3['StartDatumTijd']) or $begindatum == -1){
				if (($begindatum = strtotime($row3['StartDatumTijd'])) === -1) {
				
			}}
			if ($eindatum <  strtotime($row3['StartDatumTijd']) or $einddatum == -1){
				if (($eindatum = strtotime($row3['StartDatumTijd'])) === -1) {
				
			}}
			//echo date('l jS \of F Y h:i:s A',$eindatum). ' ' . $row3['EindDatumTijd'].'<br>';
			
			$found = false;
			
			//if ($found == false){
				
				if ($row3['Type']== 'uitgaven'){
					//echo '<tr><td>'.$row3['Id'] . '</td><td>'.$row3['Bedrag'].'</td><td><td></td></td><td></td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td>'.$Rekening.'</td><td>';
					
					$totaalonkosten =$totaalonkosten +$row3['Bedrag'];
				}else if ($row3['Type']== 'inkomsten'){
					//echo '<tr><td>'.$row3['Id'] . '</td><td>'.$row3['Bedrag'].'</td><td></td><td></td><td></td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td>'.$Rekening.'</td><td>';
					
					$totaalinkomsten =$totaalinkomsten +$row3['Bedrag'];
				}else{
				if (($timestamp = strtotime($row3['StartDatumTijd'])) === -1) {
    				//echo "De string ($str) is niet geldig";
				} 
				if (($timestamp2 = strtotime($row3['EindDatumTijd'])) === -1) {
		    		//echo "De string ($str) is niet geldig";
				} 
				$gewerkt = $timestamp2 - $timestamp;
				$gewerkt = ($gewerkt / 60) / 60;
				$totaaluren = $totaaluren + $gewerkt;
				$totaalurenkosten = $totaalurenkosten +($gewerkt*$row3['Uurtarief']);
				//echo '<tr><td>'.$row3['Id'] . '</td><td>'.$gewerkt*$row3['Uurtarief'].'</td><td>'.$row3['StartDatumTijd'].'</td><td>'.$row3['EindDatumTijd'].'</td><td>';
			
				//echo $gewerkt. '</td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td>'.$Rekening.'</td><td>';
				
				//echo '</td></tr>';
				}
			}
		}
	
	}
	//echo '</table>';
	//echo 'Totaal aantal uren gewerkt is '. $totaaluren. ', totaal aan onkosten is '.$totaalonkosten.' ,totaal aan inkomsten is '.$totaalinkomsten.' totaal bedrag is '. (0-($totaalurenkosten)-$totaalonkosten + $totaalinkomsten) . ' euro';

//rekent de maximale waarde van de graph uit
if (($totaalurenkosten + $totaalonkosten) > $totaalinkomsten){
	$maxgraph = $totaalurenkosten + $totaalonkosten;
}else{
	$maxgraph = $totaalinkomsten;
}
$eenheden = 10;
$font = 'lib.ttf'; 
$fontsize = 10; 
$smfontsize = 8; 
// rekent de eenheden uit
if ($maxgraph > 500){$eenheden = 100;}
if ($maxgraph > 1000){$eenheden = 500;}
if ($maxgraph > 5000){$eenheden = 1000;}
if ($maxgraph > 10000){$eenheden = 5000;}
if ($maxgraph > 50000){$eenheden = 10000;}
if ($maxgraph > 100000){$eenheden = 50000;}
if ($maxgraph > 500000){$eenheden = 100000;}
if ($maxgraph > 1000000){$eenheden = 500000;}
if ($maxgraph > 5000000){$eenheden = 1000000;}
if ($maxgraph > 10000000){$eenheden = 5000000;}
if ($maxgraph > 50000000){$eenheden = 10000000;}
if ($maxgraph > 100000000){$eenheden = 50000000;}
if ($maxgraph > 500000000){$eenheden = 100000000;}
if ($maxgraph > 1000000000){$eenheden = 500000000;}
for ($i = 0; $i <= $maxgraph+1; $i = $i + $eenheden) {	if ($maxgraph != 0){
		$place = 430 - ($i *420 / $maxgraph);	}else{		$place = 0;	}	imageline($image, 10, $place, 800, $place, $linColor);
	ImageTTFText($image, $fontsize, 0, 810, $place, $textColor, $font, $i);
}
// rekent datums uit
//if (($timestamp = strtotime($begindatum)) === -1) {}
ImageTTFText($image, $fontsize, 0, 300, 450, $textColor, $font, gmstrftime ("%b %d %Y",$begindatum));
//if (($timestamp2 = strtotime($eindatum)) === -1) {}
ImageTTFText($image, $fontsize, 0, 810, 450, $textColor, $font, gmstrftime ("%b %d %Y",$eindatum));
$Starttime = $begindatum;

$maxtime = $eindatum - $begindatum;
if ($maxtime == 0){$maxtime = 1;}
imagesetthickness($image, 4);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);if ($maxgraph != 0){
	$topinkomsten = 430 - ($totaalurenkosten * 420 / $maxgraph);}else {	$topinkomsten = 430 - (0);}

if ($maxgraph != 0){	$topinkomsten2 = 430 - ($totaalonkosten * 420 / $maxgraph);}else {	$topinkomsten2 = 430 - (0);}
imagefilledrectangle($image, 90, $topinkomsten, 110, $topinkomsten2, $rood);imagefilledrectangle($image, 90, 430, 110, $topinkomsten, $blauw);if ($maxgraph != 0){	$topinkomsten = 430 - ($totaalinkomsten * 420 / $maxgraph);}else {	$topinkomsten = 430 - (0);}

imagefilledrectangle($image, 190, 430, 210, $topinkomsten, $groen);
ImageTTFText($image, $fontsize, 0, 60, 450, $textColor, $font, "Onkosten $totaalonkosten");
ImageTTFText($image, $fontsize, 0, 60, 470, $textColor, $font, "& Uren $totaalurenkosten");
ImageTTFText($image, $fontsize, 0, 160, 450, $textColor, $font, "Inkomsten $totaalinkomsten");
//imagestring ($image, 5, 5, 8, $rand, $textColor); 
$uitgavenx = 0;
$uitgavenoldx = 300;
$uitgaveny = 0;
$uitgavenoldy = 430;
$inkomstennx = 0;
$inkomstenoldx = 300;
$inkomsteny = 0;
$inkomstenoldy = 430;
$urenx = 0;
$urenoldx = 300;
$ureny = 0;
$urenoldy = 430;
$totaaluren = 0;
$totaalurenkosten = 0 ;
$totaalonkosten = 0;
$totaalinkomsten = 0;

if ($uren != ""){	$query3 = 'SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Type, User, Uurtarief FROM uren WHERE '.$uren.' ORDER BY StartDatumTijd';}else {	$query3 = 'SELECT Id, StartDatumTijd, EindDatumTijd, Omschrijving, Bedrag, Type, User, Uurtarief FROM uren ORDER BY StartDatumTijd';}

//echo $query3;
		$result3 = mysqli_query($link,$query3);
		if (!$result3) {
    		die('Query failed: ' . mysqli_error($link));
		}
		while($row3 = mysqli_fetch_array($result3)){
			if ($begindatum == -1){
				$begindatum = $row3['StartDatumTijd'];
			}
			$eindatum = $row3['EindDatumTijd'];
			$found = false;
			
			//if ($found == false){
				
				if ($row3['Type']== 'uitgaven'){
					if (($timestamp = strtotime($row3['StartDatumTijd'])) === -1) {
    				
					} 
					
					$totaalonkosten =$totaalonkosten +$row3['Bedrag'];					if ($maxgraph == 0 or $totaalonkosten == 0){						$uitgaveny = 0;					}else{
						$uitgaveny = 430 - ($totaalonkosten * 420 / $maxgraph);					}
					$uitgavenx = 300 + (($timestamp - $Starttime) * 500 / $maxtime);
					
					imageline($image, $uitgavenoldx, $uitgavenoldy, $uitgavenx, $uitgaveny, $rood);
					$uitgavenoldx = $uitgavenx;
					$uitgavenoldy = $uitgaveny;
				}else if ($row3['Type']== 'inkomsten'){
					if (($timestamp = strtotime($row3['StartDatumTijd'])) === -1) {
    				
					} 
					
					$totaalinkomsten =$totaalinkomsten +$row3['Bedrag'];					if ($maxgraph != 0){						$inkomsteny = 430 - ($totaalinkomsten * 420 / $maxgraph);					}else {						$inkomsteny = 430 - (0);					}
					
					$inkomstenx = 300 + (($timestamp  - $Starttime)* 500 / $maxtime);
					
					imageline($image, $inkomstenoldx, $inkomstenoldy, $inkomstenx, $inkomsteny, $groen);
					$inkomstenoldx = $inkomstenx;
					$inkomstenoldy = $inkomsteny;
					
					
				}else{
					if (($timestamp = strtotime($row3['StartDatumTijd'])) === -1) {
    				
					} 
					if (($timestamp2 = strtotime($row3['EindDatumTijd'])) === -1) {
    				
					} 
					$gewerkt = $timestamp2 - $timestamp;
					$gewerkt = ($gewerkt / 60) / 60;
					$totaaluren = $totaaluren + $gewerkt;				
					$totaalurenkosten = $totaalurenkosten +($gewerkt*$row3['Uurtarief']);
										if ($maxgraph != 0){						$ureny = 430 - ($totaalurenkosten * 420 / $maxgraph);					}else {						$ureny = 430 - (0);					}
					
					$urenx = 300 + (($timestamp - $Starttime) * 500 / $maxtime);
					
					imageline($image, $urenoldx, $urenoldy, $urenx, $ureny, $blauw);
					$urenoldx = $urenx;
					$urenoldy = $ureny;
					
				
				//echo '<tr><td>'.$row3['Id'] . '</td><td>'.$gewerkt*$row3['Uurtarief'].'</td><td>'.$row3['StartDatumTijd'].'</td><td>'.$row3['EindDatumTijd'].'</td><td>';
			
				//echo $gewerkt. '</td><td>'.$row3['Omschrijving'].'</td><td>'.$Naam.'</td><td>'.$Rekening.'</td><td>';
				if ($TypeUser == "administrator" or ($TypeUser == "user" and $creator = $ThisUserId)){
					//echo '<a href="#" onclick=" ConfirmDelete('.$row3['Id'].'); return false;">Delete</a>';
			//	}
				//echo '</td></tr>';
				}
			}
		}
// Date in the past 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
// HTTP/1.0 
header("Pragma: no-cache");
// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');
// send the image to the browser
imagejpeg($image);
// destroy the image to free up the memory
imagedestroy($image);}else{	echo 'acces denied';}
?>