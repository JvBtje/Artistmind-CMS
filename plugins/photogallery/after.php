<?php
echo'
<div id="gallerybuttonsmain" name="gallerybuttonsmain" style="position:fixed; left:0px; top:0px; right:0px; bottom:0px; overflow:hidden; display:none; z-index:100;"><div id ="closgaladmin" style="position:absolute; top:10px; right:10px;"></div></div>
<div name="editimgmain" id="editimgmain"><div id="imgcontainermain2" name="imgcontainermain2"  style="overflow:hidden; align: center; vertical-align:middle;  "><div id="imgcontainermain" name="imgcontainermain" style="align:center; vertical-align:middle;"><img src="" id="imgshowermain" name="imgshowermain" onload="Imagemainisloaded()"></div></div>
<div style="position:fixed; left:0px; overflow:hidden; right:0px; bottom:0px; background-color:#000; height:110px" id ="Infoimagebgmain" name="Infoimagebgmain"></div><div style="position:fixed; overflow:hidden; left:10px; height:100px; right:10px; bottom:5px; " id ="Infoimagemain" name="Infoimagemain">
<div align="right" style="display:inline-block;"><div id="buttonlayout">
            <a href="javascript: submitimage()"><h4>Save</h4></a>
          </div></div>      
 <tr><td>         
      <input type="text" name="imageNaam" id="imageNaam" value="" size="25" border="0" onchange="changeval();"><br><textarea id="imgetext" name="imagetext" style="width: 750px; height: 25px;" ></textarea></div>	  
	 
		  </div>
		 

<div id="gallerybuttons" name="gallerybuttons" style="position:fixed; opacity:1;left:0px; top:0px; right:0px; bottom:0px; overflow:hidden; display:none; z-index:300;">
<div style="position:absolute; top:0px; right:0px; left:66%; bottom:66%;" onclick="closeeditimg();return false"><a href="#" ></a></div>
<div style="position:absolute; top:33%; right:0px; bottom:33%; left:66%;" onclick="nextimg2();return false"></div>
<div style="position:absolute; bottom:0px; left:33%; right:33%; top:66%;" onclick="play2();return false"></div>
<div style="position:absolute; bottom:0px; left:0px; right:66%; top:66%;" onclick="imgquality2();return false"></div>
<div style="position:absolute; top:33%; left:0px; bottom:33%; right:66%;" onclick="previousimg2();return false"></div>

<div id="closegalb" style="position:absolute; top:0px; right:0px;"></div>
<div id="nextgalb" style="position:absolute; top:50%; margin-top:-25px;right:0px;"></div>
<div id="playgalb" style="position:absolute; bottom:0px; left:50%;margin-left:-25px;"></div>
<div id="qualitygalb" style="position:absolute; bottom:0px; left:0px;"><a href="#" onclick="imgquality2();return false"><img id="quality" src="'.$_SESSION['Theme'].'systemicon/quality.png" ></a></div>
<div id="prevgalb" style="position:absolute; top:50%; margin-top:-25px;left:0px;"></div>

<script type="text/javascript">
scale = 1 / window.devicePixelRatio;
document.getElementById(\'closegalb\').innerHTML = \'<a onclick="closeeditimg();"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'systemicon/close2.png&maxsize=\'+(50* window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\';
document.getElementById(\'nextgalb\').innerHTML = \'<a onclick="nextimg2();"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'systemicon//Next.png&maxsize=\'+(50* window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\';
document.getElementById(\'playgalb\').innerHTML = \'<a onclick="play2();"><img id="playpauze" src="./system/imgtumb.php?url='.$_SESSION['Theme'].'systemicon/Play.png&maxsize=\'+(50* window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\';
document.getElementById(\'prevgalb\').innerHTML = \'<a onclick="previousimg2();"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'systemicon/Previous.png&maxsize=\'+(50* window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\';
document.getElementById(\'closgaladmin\').innerHTML = \'<a onclick="closeeditimgmain();"><img src="./system/imgtumb.php?url='.$_SESSION['Theme'].'systemicon/close2.png&maxsize=\'+(50* window.devicePixelRatio)+\'&square=0" style="zoom: \'+scale+\'; -moz-transform: scale(\'+scale+\');"></a>\';
</script>
</div>



<div id="imgcontainer5" name="imgcontainer5" style="overflow:hidden; vertical-align:top; display:none; width:0px; height:0px;"><img src="" id="imgshower2" name="imgshower2"></div>
<div name="editimg" id="editimg">
<div id="imgcontainer2" name="imgcontainer2"  style="overflow:hidden;"><div id="imgcontainer" name="imgcontainer" style="align:left; style="overflow:hidden; vertical-align:top;"><img src="" id="imgshower" name="imgshower"></div></div><div style="position:absolute; left:10px; overflow:hidden; right:10px; bottom:10px; background-color:#000; height:75px" id ="Infoimagebg" name="Infoimagebg"></div><div style="position:absolute; overflow:hidden; left:10px; height:65px; right:10px; bottom:15px; " id ="Infoimage" name="Infoimage"></div>
<script language="javascript">
	document.getElementById(\'imgshower\').onload = function() {
	Imageisloaded()
	}
	document.getElementById(\'imgshower2\').onload = function() {
	Imageisloaded2();
	}
</script>
</div>';
?>