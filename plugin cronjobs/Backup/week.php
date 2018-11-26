<?php
//include("../../DB.php");
#create a sql backup and send it to your e-mail address 
//define settings 
//database host 
DEFINE('dbhost',$DbServer); 
//database name 
DEFINE('dbnaam',$Db); 
//database user 
DEFINE('dbuser',$DbUsername); 
//database passwordt 
DEFINE('dbpass',$DbPassword); 
//domeinnaam 
DEFINE('domein',$_SERVER["SERVER_NAME"]); 
//doel 
$coalitionoverride = "";
//$coalitionoverride = "utf8_unicode_ci";

//connect with database 
//$link2 = mysql_connect($DbServer, $DbUsername, $DbPassword);
//mysql_select_db($Db, $link2) or die('Could not select database.');

$query = "SELECT Id, BackupEmail, LastBackup, Backup FROM system WHERE Id=1";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		
		}
		while($row = mysqli_fetch_array($result)){
			$Backup = intval($row['Backup']);
			DEFINE('email',$row['BackupEmail']); 
			if (($LastBackup = strtotime($row['LastBackup'])) === -1) {
    					echo "De string ($str) is niet geldig";
						mysqli_query($link,"UPDATE system SET LastBackup = '".date("Y-m-d H:i:s")."'") or die(mysqli_error($link)); 
					} 
			
					
		}
		
$Weekgeleden	=	mktime(0, 0, 0, date("m")  , date("d")-7, date("Y"));

if ($LastBackup < $Weekgeleden AND $Backup == 1){

// mysqli_query($link,"UPDATE system SET LastBackup = '".date("Y-m-d H:i:s")."'") or die(mysqli_error($link)); 
//query to recive table names 
$query = mysqli_query($link,'SHOW TABLE STATUS') or die(mysqli_error($link)); 
$sql_backup = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";';
//whileloop to loop trough every table 
while($row = mysqli_fetch_assoc($query))
{ 
    //show sql query to rebuild the query 
    $sql = 'SHOW CREATE TABLE '.$row['Name'].''; 
    //exucte error or give a error 
    $query2 = mysqli_query($link,$sql) or die(mysqli_error($link)); 
    
    //create sql 
    $sql_backup.="\r\n#Create table ".$row['Name']."\r\n\r\n"; 
    $out = mysqli_fetch_assoc($query2); 

   // if (substr_count( $out['Create Table'], "`") * 2 == substr_count( $out['Create Table'], "'")){
   // 	$sql_backup.= str_replace("''", "'", $out['Create Table']).";\r\n\r\n"; 
	//}else{
		$sql_backup.= $out['Create Table'].";\r\n\r\n"; 
		$CHARSET= explode('CHARSET=', $out['Create Table']);
		
	//}

	if (strlen ($coalitionoverride) >3){
		$codetype =explode('_', $coalitionoverride);
		$sql_backup.= 'ALTER TABLE '.$row['Name'].' CHARACTER SET '.$codetype[0].' COLLATE '.$coalitionoverride.';

';
		//$code['COLLATION_NAME'] = $coalitionoverride;
	}
	$result = mysqli_query($link,'SELECT TABLE_CATALOG, TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, COLLATION_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \''.$Db.'\' AND TABLE_NAME = \''.$row['Name'].'\'')or die(mysqli_error($link));
	//print_r($result);
	while($code = mysqli_fetch_array($result))
    { 
		//$sql_backup.= $code['TABLE_SCHEMA'];
		if (strlen ($code['COLLATION_NAME']) > 3){
			$result2 = mysqli_query($link,'SHOW FIELDS FROM '.$row['Name'].' where Field =\''.$code['COLUMN_NAME'].'\'')or die(mysqli_error($link));

			while($code2 = mysqli_fetch_array($result2))
			{ 
				if (strlen ($coalitionoverride) >3){
					$code['COLLATION_NAME'] = $coalitionoverride;
				}
				
				
				$codetype =explode('_', $code['COLLATION_NAME']);
				
				$sql_backup.=  'ALTER TABLE '.$row['Name'].' MODIFY COLUMN '.$code['COLUMN_NAME'].' '.$code2['Type'].' CHARACTER SET '.$codetype[0].' COLLATE '.$code['COLLATION_NAME'].';
';
			}
		}
	}
	
    $sql_backup.="
	#Dump data\r\n\r\n"; 

    //SQL code to select everything for table 
    $sql = 'SELECT * FROM '.$row['Name']; 
    $out = mysqli_query($link,$sql); 
    $sql_code = ''; 

    //loop trough the colloms 
    while($code = mysqli_fetch_array($out))
    { 
        $sql_code .= "INSERT INTO ".$row['Name']." SET "; 
        
        foreach($code as $insert => $value)
        { 
			if (is_int($insert)){
			}else{
				$sql_code.=$insert ."='".mysqli_real_escape_string($link,$value)."',"; 
			}
        } 
        $sql_code = substr($sql_code, 0, -1); 
        $sql_code.= ";\r\n"; 
    } 
    $sql_backup.= $sql_code; 
} 
//echo $sql_backup;
//generade a unique id 
$unique = md5(uniqid(time())); 

//message 
$message = "Backup procedure van database: ".dbnaam." is met succes verlopen. U vind in de bijlage een backup van de inhoud gemaakt op. ".date('d-m-Y H:i:s')."\r\n Autobot"; 

//maak headers aan 
//form header 
$headers = "From: Autobot <noreply@".domein.">\r\n"; 
//terug sturen naar een niet bestaand mail adress (noreply@domein.nl) 
$headers .= "Reply-To: Autobot <noreply@".domein.">\r\n"; 
//vertel dat het een mine versie is 
$headers .= "MIME-Version: 1.0\r\n"; 
//email bestaat uit meerdere  bestanden dus vertel wat de scheidings teken is en dat het een multipart is 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$unique."\"\r\n"; 
//we zenden een attachment mee 
$headers .= "Content-Disposition:  attachment\r\n"; 
$headers .= 'Content-type: text/html; charset=UTF-8' . "\n";

//generenen een body. Dit is een multi part gezeik 
$body.= "This is a multi-part message in MIME format.\r\n"; 
$body.= "\r\n"; 
//boundary 
$body.= "--".$unique."\r\n"; 
$body.= "\r\n"; 
//het bericht 
$body.= $message ."\r\n"; 
//boundaty 
$body.= "--".$unique."\r\n"; 
//content type + naam bestand (database.sql) 
$body .= "Content-Type: application/zip; name=".dbnaam.date('d-m-Y H:i:s').".sql\r\n"; 
//codering 
$body .= "Content-Transfer-Encoding: base64\r\n"; 
//als bijlage toegevoegd 
$body.= "Content-disposition: attachment\r\n"; 
$body .= "\n"; 
//de inhoud van het bestand 
$body .= chunk_split(base64_encode ($sql_backup)).'\r\n'; 
//zet alles op email! 
//hier kan wat tijdsverschil in zitten! 
mail(email,'Mysql backup '.date('d-m-Y H:i:s'),$body,$headers); 
mysqli_query($link,"UPDATE system SET LastBackup = '".date("Y-m-d H:i:s")."'") or die(mysqli_error($link)); 
}
//mysqli_close($link2);

?> 