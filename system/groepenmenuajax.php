

<script type="text/javascript">

function layerActie(ID) {
	
   if (document.getElementById("menu"+ID).style.display=="none") {
      	document.getElementById("menu"+ID).style.display="block";
	document.getElementById("menuimg"+ID).src='./system/imgtumb.php?url='+themeurl+'systemicon/down.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"'; 
	
   } else {
   
      document.getElementById("menu"+ID).style.display="none";
	document.getElementById("menuimg"+ID).src= './system/imgtumb.php?url='+themeurl+'systemicon/pijl rechts.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"';
	
	  
   }
}

function menuitemswitch(item1, item2)
{
	
	params = "command=bogus=bogus&" ;
	params = params + "item1="+item1+"&";
	params = params + "item2="+item2;

	var xmlhttpcreatedir;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpcreatedir=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpcreatedir=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpcreatedir.onreadystatechange=function()
  	{
		
		var i =0;
		if (xmlhttpcreatedir.readyState==4 && xmlhttpcreatedir.status==200)
   		 {
				
				window.menuitemidopen = new Array();
			
				loadXMLDoc();
		}
	 }
	xmlhttpcreatedir.open("POST","./system/groepitemswitch.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
	
	
}
function deleteitems()
{
	<?php	/*
	echo 'var ii = 0;
	params = "command=bogus=bogus&" ;';
	function displaydeleteitems ($Start, $Laag, $text, $Ids){
		
		$Laag++;
		$oldtext = $text;
		$query = 'SELECT Id, MainId, Parent, Naam, Type, targetmainid FROM groepen WHERE Parent = '.$Start.' AND Language='. $_SESSION['Language'] .' AND Type= "groep" ORDER BY theOrder';
		$result = mysqli_query($link,$query);
		if (!$result) {
  		  	die('Query failed: ' . mysqli_error($link));
		}
		while($row = mysqli_fetch_array($result)){
			$found = "false";
			for($i=0;$i<count($Ids);$i++){
				if ($Ids[$i] == intval($row["MainId"])){
					$found = "true";
				}
			}
			
			echo 'if (document.getElementById("itemid"+'.$row["MainId"].').checked == true){
				ii++;
				params = params +"item"+ii+"="+'.$row["MainId"].' + "&";
			}';
					
			if ($row["Type"] == "groep"){
				displaydeleteitems ($row["MainId"],$Laag,$text, $Ids);
			}
		}
	}
	displaydeleteitems ($sectie,0,"", array());*/
	?>
	/*totalfiles = parseInt(document.getElementById('totalfiles').value);
	ii = 0;
	params = "command=bogus=bogus&" ;
	
	for (i=2;i<totalfiles+2;i++)
	{	
		
		if (document.getElementById('fileid'+i).checked == true){
			ii++;
			params = params +'file'+ii+'='+ window.currentuploaddir + document.getElementById('filename'+i).value + "&";
		}
		
	}*/
	
	params = params + "totalfile="+ii;
	if (confirm("Do you whant to delete items?")) { 
 // do things if OK

	var xmlhttpdel;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttpdel=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttpdel=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttpdel.onreadystatechange=function()
  	{
		if (xmlhttpdel.readyState==4 && xmlhttpdel.status==200)
   		 {
			
			loadXMLDoc("./system/loaddir.php?url="+ window.currentuploaddir);
		}
	 }
	
	xmlhttpdel.open("POST","./system/delitems.php");
	xmlhttpdel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpdel.setRequestHeader("Content-length", params.length);
	xmlhttpdel.setRequestHeader("Connection", "close");
	xmlhttpdel.send(params);
}
	
}
function displaymenu(x){
	
var i = 0;
var ii = 0;	
var txt = "<table>";
if (x.childNodes.length > 0){
	for (i=0;i<x.childNodes.length;i++)
    	 {
		
		switch(x.childNodes[i].getAttribute("type")) {
			
		<?php
			foreach($_SESSION['menuadmin'] as $value)
			{ 
				include './plugins/'.$value.'/menuadminajax.js';
			}
		?>
			default:
				txt= txt + '<tr><td></td>';
				
				if (x.childNodes[i].getAttribute("mainid") == "<?php echo $MainId; ?>"){
					txt= txt + '<td background="<?php echo $_SESSION['Theme']; ?>windows/selected.png">';
				}else{
					txt= txt + '<td >';
				}
				
				txt= txt + '<input type="hidden" name="itemtype'+x.childNodes[i].getAttribute("mainid")+'" id="itemtype'+x.childNodes[i].getAttribute("mainid")+'" value="'+x.childNodes[i].getAttribute("type")+'"/>';
				txt= txt + '<a href="indexadminnew.php?plugin='+x.childNodes[i].getAttribute("type")+'&type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
				
				txt= txt +x.childNodes[i].getAttribute("id")+" "+x.childNodes[i].getAttribute("naam") + '</a>';
				
				if (i==0 && i == x.childNodes.length -1){
					txt = txt + '';
					
				} else if(i==0){
					txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/down.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></a></td>';
				} else if (i== x.childNodes.length -1){
					txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/up.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></a></td>';
				} else {
					txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/up.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></a>';
					txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/down.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></a></td>';
				}
				
				txt = txt + '</tr>';
				
				break;
		}
		
		/*
		//if (x.childNodes[i].getAttribute("type") == "groep"){
		//	txt= txt + '<tr><td><a href="#" onClick="layerActie(\''+x.childNodes[i].getAttribute("id")+'\');return false"><img id="menuimg'+x.childNodes[i].getAttribute("id")+'" src="<?php echo $_SESSION['Theme']; ?>systemicon/pijl rechts.png" border="0"></a></td>';
		//} else{
			txt= txt + '<tr><td></td>';
		//}
		if (x.childNodes[i].getAttribute("mainid") == <?php echo $MainId; ?>){
			txt= txt + '<td background="<?php echo $_SESSION['Theme']; ?>windows/selected.png">';
		}else{
			 txt= txt + '<td >';
		}
		txt= txt + '<input type="hidden" name="itemtype'+x.childNodes[i].getAttribute("mainid")+'" id="itemtype'+x.childNodes[i].getAttribute("mainid")+'" value="'+x.childNodes[i].getAttribute("type")+'"/>';
		if (x.childNodes[i].getAttribute("type") == "groep"){
			txt= txt + '<a href="groepen.php?type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
		}else if (x.childNodes[i].getAttribute("type") == "richtext"){
			txt= txt + '<a href="richtext.php?type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
		}else if (x.childNodes[i].getAttribute("type") == "lijst"){
			txt= txt + '<a href="lijst.php?type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
		}else if (x.childNodes[i].getAttribute("type") == "form"){
			txt= txt + '<a href="form.php?type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
		}else if (x.childNodes[i].getAttribute("type") == "photogallery"){
			txt= txt + '<a href="Gallery.php?type=select&Id='+x.childNodes[i].getAttribute("mainid")+'&sectie='+sectie+'" >' ;
		}
		txt= txt +x.childNodes[i].getAttribute("id")+" "+x.childNodes[i].getAttribute("naam") + '</a>';
		if (i==0 && i == x.childNodes.length -1){
			txt = txt + '';
		} else if(i==0){
			txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/down.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20"></a></td>';
		} else if (i== x.childNodes.length -1){
			txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/up.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></td>';
		} else {
			txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/up.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20">';
			txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="./system/imgtumb.php?url=\'+themeurl+\'systemicon/down.png&maxsize=\'+(20* window.devicePixelRatio)+\'&square=0" width="20" height="20"></a></td>';
		}
		txt = txt + '</tr>';
		if (x.childNodes[i].getAttribute("type") == "groep"){
			
			txt = txt + '<tr><td valign="top" background="<?php echo $_SESSION['Theme']; ?>systemicon/lijn.png"></td><td>';
			// bepaald of een groep open of dicht is
			if (window.menuitemidopen.length > 0){
				found = false;
				for (ii=0;ii<window.menuitemidopen.length;ii++){
					if (x.childNodes[i].getAttribute("id")==window.menuitemidopen[ii]){
						found = true;
						
					}
				}

				if (found == true){
					txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "display:block;">';
				}else{
					txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "display:none;">';
				};
			} else {
				if (x.childNodes[i].getAttribute("open") == "true"){
					txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "display:block;">';
				}else{
					txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "display:none;">';
				}
			}
 			txt = txt + displaymenu(x.childNodes[i]);
			txt = txt + '</div></td></tr>';
			
		}*/
		window.menuitemid.push(x.childNodes[i].getAttribute("id"));
    }
}
	txt = txt+ "</table>";
	return txt;
}

function loadXMLDoc()
{
	
	 <?php if (isset($sectie)){
		echo 'sectie = '.$sectie.';';
		}else{
		echo 'sectie = "undefined";';
		}		
	?>	
	 <?php if (isset($MainId) and $MainId != "new"){
		echo 'MainId = '.$MainId.';';
		}else{
		echo 'MainId = "undefined";';
		}		
	?>
	
	if (sectie == "undefined"){
		if (MainId == "undefined"){
			alert ('no input');
			url = "";
		}else{
			alert ('no sectie');
			url = "./system/loadgroepenmenu.php?MainId="+MainId;
		}
	}else{
		if (MainId == "undefined"){
			url = "./system/loadgroepenmenu.php?sectie="+sectie;
		}else{
			url = "./system/loadgroepenmenu.php?MainId="+MainId+"&sectie="+sectie;
		}		
	}
	
var xmlhttp;
var txt,xx,x,i;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
	x=xmlhttp.responseXML.documentElement.getElementsByTagName("stat");
	for (i=0;i<x.length;i++)
	{
		if (x[i].firstChild.nodeValue == "Logged out"){
			alert("You can not use this page because you ar not logged in");
		}
	}
    	txt= "";
 	
	
    x=xmlhttp.responseXML.documentElement.getElementsByTagName("groepen");
	window.menuitemid = new Array();
	
		//txt= txt + '<a href="#" onClick="deleteitems();return false"><img src="./system/iconfilemanager/Delete.png" alt="delete files"></a> <a href="#" onClick="cutitems();return false"><img src="./system/iconfilemanager/cut.png" alt="cut files"></a> <a href="#" onClick="copyitems();return false"><img src="./system/iconfilemanager/copy.png" alt="copy files"></a> <a href="#" onClick="pastitems();return false"><img src="./system/iconfilemanager/past.png" alt="past file"></a> <br>';
		
   		txt = txt + displaymenu(x[0],0, sectie);

	
      txt =txt+"</table>";
	
     
	
    document.getElementById('menuajax').innerHTML=txt;
    }
  }

xmlhttp.open("GET",url,true);
xmlhttp.send();
}
window.menuitemid = new Array();
window.menuitemidopen = new Array();

loadXMLDoc();
</script>



