<script language="javascript">
function updatebolpng (){
	var el = document.getElementsByClassName("bol")
	for (var i = 0, ilen = el.length; i < ilen; i++) {
		el[i].src = "./system/imgtumb.php?url="+themeurl+"systemicon/bol.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
	}
		var el = document.getElementsByClassName("bol")
	for (var i = 0, ilen = el.length; i < ilen; i++) {
		el[i].src = "./system/imgtumb.php?url="+themeurl+"systemicon/bol.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
	}
	var el = document.getElementsByClassName("down")
	for (var i = 0, ilen = el.length; i < ilen; i++) {
		el[i].src = "./system/imgtumb.php?url="+themeurl+"systemicon/down.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
	}
}
function layerActiesubmenub(ID) {
   if (document.getElementById("menu"+ID).style.display=="none") {
	document.getElementById("menu"+ID).style.height =  document.getElementById("menu"+ID).offsetHeight + "px"	
    document.getElementById("menu"+ID).style.display="block";
	document.getElementById("menuimg"+ID).src="./system/imgtumb.php?url="+themeurl+"systemicon/down.png&maxsize="+(20* window.devicePixelRatio)+"&square=0"; 
	fadesubmenuheight ("menu"+ID,-1)
   } else {
		document.getElementById("menuimg"+ID).src= "./system/imgtumb.php?url="+themeurl+"systemicon/pijl rechts.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
		document.getElementById("menu"+ID).style.height =  document.getElementById("menu"+ID).offsetHeight + "px"
		fadesubmenuheight ("menu"+ID,0)
	  
   }
}

function layerActiesubmenub2(ID) {

   if (document.getElementById("menub"+ID).style.display=="none") {
	document.getElementById("menub"+ID).style.height =  document.getElementById("menu"+ID).offsetHeight + "px"	
    document.getElementById("menub"+ID).style.display="block";
	document.getElementById("menuimgb"+ID).src="./system/imgtumb.php?url="+themeurl+"systemicon/down.png&maxsize="+(20* window.devicePixelRatio)+"&square=0"; 
	fadesubmenuheight ("menub"+ID,-1)
   } else {
		document.getElementById("menuimgb"+ID).src= "./system/imgtumb.php?url="+themeurl+"systemicon/pijl rechts.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
		document.getElementById("menub"+ID).style.height =  document.getElementById("menu"+ID).offsetHeight + "px"
		fadesubmenuheight ("menub"+ID,0)
	  
   }
}
function posY(elm) {
for (var topPos = 0;
        elm != null;
        topPos += elm.offsetTop, elm = elm.offsetParent);
    return topPos;
}

function posX(elm) {
for (var topPos = 0;
        elm != null;
        topPos += elm.offsetLeft, elm = elm.offsetParent);
    return topPos;
}

function viewPortHeight() {
    var de = document.documentElement;
	
    if(!!window.innerWidth)
    { return window.innerHeight; }
    else if( de && !isNaN(de.clientHeight) )
    { return de.clientHeight; }

    return 0;
}

function scrollY() {
    if( window.pageYOffset ) { return window.pageYOffset; }
    return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
}

</script>