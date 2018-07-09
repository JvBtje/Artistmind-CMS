case "tab":
	
	found = false;	

	if (window.menuitemidopen.length > 0){
		found = false;
		for (ii=0;ii<window.menuitemidopen.length;ii++){
			if (x.childNodes[i].getAttribute("id")==window.menuitemidopen[ii]){
				found = true;				
			}
		}
	}else{
		if (x.childNodes[i].getAttribute("open") == "true"){
			found = true
		}else{
			
		}
	}
	if (found == true){
		txt= txt + '<tr><td><a href="#" onClick="layerActiesubmenub(\''+x.childNodes[i].getAttribute("id")+'\');return false"><img id="menuimg'+x.childNodes[i].getAttribute("id")+'" src="<?php echo $_SESSION['Theme']; ?>systemicon/down.png" border="0"></a></td>';
	}else{
		txt= txt + '<tr><td><a href="#" onClick="layerActiesubmenub(\''+x.childNodes[i].getAttribute("id")+'\');return false"><img id="menuimg'+x.childNodes[i].getAttribute("id")+'" src="<?php echo $_SESSION['Theme']; ?>systemicon/pijl rechts.png" border="0"></a></td>';
	}
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
		txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/down.png"></a></td>';
	} else if (i== x.childNodes.length -1){
		txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/up.png"></td>';
	} else {
		txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i-1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/up.png">';
		txt = txt + '<a href="#" onClick="menuitemswitch(\''+x.childNodes[i].getAttribute("id")+'\',\''+x.childNodes[i+1].getAttribute("id")+'\');return false"><img src="<?php echo $_SESSION['Theme']; ?>systemicon/down.png"></a></td>';
	}
	txt = txt + '</tr>';
	txt = txt + '<tr><td valign="top" background="<?php echo $_SESSION['Theme']; ?>systemicon/lijn.png"></td><td>';
			// bepaald of een groep open of dicht is
	

		if (found == true){
			txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "overflow:hidden; display:block;">';
		}else{
			txt = txt + '<div id="menu'+x.childNodes[i].getAttribute("id")+'" style= "overflow:hidden; display:none;">';
		};
	txt = txt + displaymenu(x.childNodes[i]);
	txt = txt + '</div></td></tr>';
			
		
	break;
break;