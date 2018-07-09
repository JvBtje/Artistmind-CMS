  

<script type="text/javascript">
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
		if (xmlhttpcreatedir.readyState==4 && xmlhttpcreatedir.status==200)
   		 {
				
			
				loadXMLDoc("./system/loadsectiemenu.php");
		}
	 }
	xmlhttpcreatedir.open("POST","./system/groepitemswitch.php");
	xmlhttpcreatedir.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttpcreatedir.setRequestHeader("Content-length", params.length);
	xmlhttpcreatedir.setRequestHeader("Connection", "close");
	xmlhttpcreatedir.send(params);
	
	
}

function loadXMLDoc(url)
{

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
    	txt= "<table>";
 	
	
    x=xmlhttp.responseXML.documentElement.getElementsByTagName("menuitem");
   
	 for (i=0;i<x.length;i++)
    	  {	
		if (x[i].getAttribute("mainid") == <?php echo $MainId; ?>){
			txt= txt + '<tr><td background="<?php echo $_SESSION['Theme']; ?>windows/selected.png"><a href="sectieedit.php?type=select&Id='+x[i].getAttribute("mainid")+'" >' +x[i].getAttribute("id")+" "+x[i].firstChild.nodeValue + '</a></td><td></a></td>';
		}else{
			 txt= txt + '<tr><td ><a href="sectieedit.php?type=select&Id='+x[i].getAttribute("mainid")+'" >' +x[i].getAttribute("id")+" "+x[i].firstChild.nodeValue + '</a></td><td></a></td>';
		}
		if (i==0 && i == x.length -1){
			txt = txt + '<td></td>';
		} else if(i==0){
			txt = txt + '<td><a href="#" onClick="menuitemswitch(\''+x[i].getAttribute("id")+'\',\''+x[i+1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/down.png"></a></td>';
		} else if (i== x.length -1){
			txt = txt + '<td><a href="#" onClick="menuitemswitch(\''+x[i].getAttribute("id")+'\',\''+x[i-1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/up.png"></td>';
		} else {
			txt = txt + '<td><a href="#" onClick="menuitemswitch(\''+x[i].getAttribute("id")+'\',\''+x[i-1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/up.png"></td>';
			txt = txt + '<td><a href="#" onClick="menuitemswitch(\''+x[i].getAttribute("id")+'\',\''+x[i+1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/down.png"></a></td>';
		}
		txt = txt + '</tr>';
    	  }
	
      txt =txt+"</table>";

       
	
    document.getElementById('menuajax').innerHTML=txt;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

loadXMLDoc("./system/loadsectiemenu.php");
</script>



