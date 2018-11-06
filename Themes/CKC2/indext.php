<?php
$found = false;
$query = "SELECT Id, Naam1,Naam2,Naam3, Text1, Text2, Text3, HeadText, Image1, Image2, Image3 FROM mainbody WHERE Language =".$_SESSION['Language'];
	$result = mysql_query($query);
	if (!$result) {
    	die('Query failed: ' . mysql_error());
	}

	while($row = mysql_fetch_array($result)){
		$Naam1 = $row["Naam1"];
		$Naam2 = $row["Naam2"];
		$Naam3 = $row["Naam3"];
		$Id = $row['Id'];
		$HeadText = $row['HeadText'];
		$Text1 = $row['Text1'];
		$Text2 = $row['Text2'];
		$Text3 = $row['Text3'];
		$Image1 = $row['Image1'];
		$Image2 = $row['Image2'];
		$Image3 = $row['Image3'];
		$found = true;
	}

?>
<div id="Middel">
<?php if ($found == true){?>


     <?php echo $HeadText; ?>

    <p>&nbsp;</p>
    
       
              <div style="min-width:286px; max-width:500px; width:33%; display:inline-block; text-align: left;"><div style="background-image:url(Themes/CKC2/menu/mid.png);width:210px;height:444px;padding:30px;padding-left:30px;display:inline-block;vertical-align:middle;"><div style="display: inline-block;  margin-top:100px">
                  			 <?php echo $Text1; ?> </div></div></div>
              <div style="min-width:286px; max-width:500px; width:33%; display:inline-block; text-align: center;"><div  style="background-image:url(Themes/CKC2/menu/mid.png);width:210px;height:444px;padding:30px;padding-left:30px;display:inline-block;vertical-align:middle;"><div style="display: inline-block;  margin-top:100px">
                  			 <?php echo $Text2; ?> </div></div></div>
              <div style="min-width:286px; max-width:500px; width:33%; display:inline-block; text-align: right;"><div style="background-image:url(Themes/CKC2/menu/mid.png);width:210px;height:444px;padding:30px;padding-left:30px;display:inline-block;vertical-align:middle;"><div style="display: inline-block;  margin-top:100px">
                  			 <?php echo $Text3; ?> </div></div></div>
      
    <br />
   
    
      
  
  <p>&nbsp;</p>
  <?php } else {
  	echo 'The page you try to acces is not in your Language Pleas select the Language from the language menu ';
  }

?>