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
  <div align="center">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo $HeadText; ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
       
              <td width="33%" valign="top"><div align="left"><table width="284" height="504" border="0" cellpadding="0" cellspacing="0" background="./Themes/artistmind/windows/concept.jpg">
              
            <tr>
                  <td colspan="3" height="42"></td>
                </tr>
                <tr ><td width="70" ></td>
                <td >
                <div align="left"></div>				  
                  </td>
                  <td width="15" ></td></tr>
                  <tr><td width="70"></td>
                  <td ><table cellspacing="5"><tr><td>
                  			 <?php echo $Text1; ?> </td></tr></table>
                  </td>
                  <td width="15"></td></tr>
                <tr>                  
                  <td colspan="3" >&nbsp;</td>                  
                </tr></table></div></td>
              <td width="33%" valign="top"><div align="center"><table width="284" height="504" border="0" cellpadding="0" cellspacing="0" background="./Themes/artistmind/windows/Realisatie.jpg">
              
              <tr>
                  <td colspan="3" height="42" ></td>
                </tr>
                <tr ><td width="70"></td>
                <td>
                <div align="left"></div>				  
                  </td>
                  <td width="15" ></td></tr>
                  <tr><td width="70"></td>
                  <td ><table cellspacing="5"><tr><td>
                  			 <?php echo $Text2; ?> </td></tr></table>
                  </td>
                  <td width="15" ></td></tr>
                <tr>                  
                  <td colspan="3" height="27">&nbsp;</td>                  
                </tr></table></div></td>
              <td width="33%" valign="top"><div align="right"><table width="284" height="504" border="0" cellpadding="0" cellspacing="0" background="./Themes/artistmind/windows/Presentatie.jpg">
              
              <tr>
                  <td colspan="3" height="42"></td>
                </tr>
                <tr ><td width="70" ></td>
                <td >
                <div align="left"></div>				  
                  </td>
                  <td width="15" ></td></tr>
                  <tr><td width="70"></td>
                  <td ><table cellspacing="5"><tr><td>
                  			 <?php echo $Text3; ?> </td></tr></table>
                  </td>
                  <td width="15" ></td></tr>
                <tr>                  
                  <td colspan="3"  height="27">&nbsp;</td>                  
                </tr></table></div></td>
      </table>  
    <br />
   
    
        
  </div>
  <p>&nbsp;</p>
  <?php } else {
  	echo 'The page you try to acces is not in your Language Pleas select the Language from the language menu ';
  }

?>