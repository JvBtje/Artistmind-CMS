<script type="text/javascript">
function posY(elm) {
    var test = elm, top = 0;

    while(!!test && test.tagName.toLowerCase() !== "body") {
        top += test.offsetTop;
        test = test.offsetParent;
    }

    return top;
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

function checkvisible( elm ) {
    var vpH = viewPortHeight(), // Viewport Height
        st = scrollY(), // Scroll Top
        y = posY(elm);
	if ( y < (vpH + st) && y >st){
		return true
	} else {
		return false
	}
    //return (y > (vpH + st));
}

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}


function slidemenu(){

	elm = document.getElementById('menuslidertop');
	elm2 = document.getElementById('menusliderbottom');
	elm3 = document.getElementById('footer');
	var vpH = viewPortHeight(), // Viewport Height
	st = scrollY(), // Scroll Top
	y = posY(elm);
	y2 = posY(elm2);
	y3 = posY(elm3);
	menusliderheight =  parseInt(document.getElementById('menuslider').offsetHeight)
	menuslidertop = parseInt(document.getElementById('menuslider').style.top)
	thetop =menuslidertop;
	
	if (menusliderheight < vpH){
		thetop = (menuslidertop - parseInt((y - (st)))+50);
	}else{
		y = posY(elm);
		if ( y > st ){
			thetop = (menuslidertop - parseInt((y - (st)))+50);
			
		} 
	
	}
	
	if  ( parseInt(y)-50 > parseInt(st) ){
		 thetop = (menuslidertop - parseInt((y - (st)))+50);
	} 
	
	if ( y2 < (vpH + st) && vpH < menusliderheight+50){
			thetop = vpH + st - menusliderheight -parseInt(y-menuslidertop);

	} 

	docheight = parseInt(getDocHeight());
	document.getElementById('menuslider').style.top = thetop+"px";
	y2 = parseInt(posY(elm2));
	
	if (y2 > y3){
		//alert (y3 + " " + menusliderheight + " " + y + " " + menuslidertop)
		thetop = y3 - menusliderheight -parseInt(y-menuslidertop);
	}
	
	if (thetop < 0){		
		thetop = 0;
	}	
	document.getElementById('menuslider').style.top = thetop+"px";
		
}

function checksubmenuresizechange(){	
	elm = document.getElementById('menuslider');
	menusliderheight =  parseInt(document.getElementById('menuslider').offsetHeight);
	
	if (typeof(elm.menuslideroldheight)== 'undefined'){	
		elm.menuslideroldheight = menusliderheight;
	}
	
	if (elm.menuslideroldheight != menusliderheight){
		elm.menuslideroldheight = menusliderheight;
		slidemenu();		
	}
	setTimeout("checksubmenuresizechange()", 1000);
}
</script>
<?php
	echo '<div id="menusliderstill">';
	echo '<div id="menuslider" name="menuslider" style="top:0px; position:relative;" >';
	echo '<div id="menuslidertop" name="menuslidertop"></div>';
	
	
	echo '<div id="menuajax" name="menuajax" >';
	echo '<h2>'.$menuname.'</h2>';
	include ($menuurl);
	echo '</div>';
	echo '<div id="menusliderbottom" name="menusliderbottom"></div></div></div>';
	$after .=  '<div id="menusliderstill3">';
	$after .= '<div id="menuslider3" name="menuslider3" style="top:0px; position:relative;" >';
	$after .= '<div id="menuslidertop3" name="menuslidertop3"></div>';
	
	
	$after .= '<div id="menuajax3" name="menuajax3" style="">';	
	
	$after .= '</div>';
	$after .= '<div id="menusliderbottom3" name="menusliderbottom3"></div></div></div>';


?>
<script type="text/javascript">
slidemenu();
checksubmenuresizechange();
</script>
