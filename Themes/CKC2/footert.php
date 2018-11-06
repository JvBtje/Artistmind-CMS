<br><br><br><div Id="footerback"></div><div Id="footer">
<center>

<div style="width:50%; height:142px; line-height: 142px; vertical-align: middle; display:inline-block; background-image:url(./Themes/CKC/background/footerback.jpg);" >
<a href="http://www.waterheuvel.nl/" target="_blank"><img src="./Themes/CKC2/footer/waterheuvel.png" style="vertical-align: middle;"/></a>
</div><div style="width:50%; height:142px; line-height: 142px;vertical-align: middle; display:inline-block; background-image:url(./Themes/CKC/background/footerback.jpg);">
<a href="http://www.cordaan.nl/" target="_blank"><img src="./Themes/CKC2/footer/logo.jpg" style="vertical-align: middle;" /></a>
</div>

<a href="http://www.artistmind.nl/" target="_blank"><img src="./Themes/CKC2/footer/Artistmind.png" /></a><br>


</center>
</div>
<script type="text/javascript">
window.onscroll = function(){
	if (document.getElementById('artistmindfloatmenu')){
		floatingmenu();
	}
	if (document.getElementById('menuajax')){
		slidemenu(document.getElementById('menuslidertop'),document.getElementById('menusliderbottom'),document.getElementById('footer'),document.getElementById('menusliderstill'),document.getElementById('menuslider'));
	}
	if (document.getElementById('menuajax2')){
		slidemenu(document.getElementById('menuslidertop2'),document.getElementById('menusliderbottom2'),document.getElementById('footer'),document.getElementById('menusliderstill2'),document.getElementById('menuslider2b'));
	}
	if (document.getElementById('menuajax3')){
		slidemenu(document.getElementById('menuslidertop3'),document.getElementById('menusliderbottom3'),document.getElementById('footer'),document.getElementById('menusliderstill3'),document.getElementById('menuslider3'));
	}
	scrollalles();
	//alert ("hey");
}
</script>
<script type="text/javascript"> 
window.bodyfadegtimer = setTimeout("startfadebodyin()", 1000); 

</script>
<script type="text/javascript">


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


function slidemenu(elm, elm2, elm3, elm4, elm5){


	var vpH = viewPortHeight(), // Viewport Height
	st = scrollY() +50// Scroll Top
	y = posY(elm);
	y2 = posY(elm2);
	y3 = posY(elm3);
	
	documentwidth = window.innerWidth;
	menusliderheight =  parseInt(y2)-parseInt(y)-50
	menuslidertop = parseInt(elm5.style.top)
	thetop =menuslidertop;
	
	if (menusliderheight < vpH-100){
		thetop = (menuslidertop - parseInt((y - (st))));
	}else{
		//y = posY(elm);
		if ( y  > st ){
			thetop = (menuslidertop - parseInt((y - (st))));
			
		} 
	
	}
	
	if  ( parseInt(y)> parseInt(st) ){
		 thetop = (menuslidertop - parseInt((y - (st))));
	} 
	
	if ( y2 +76 < (vpH + st) && vpH < menusliderheight+99){
			thetop = vpH + st - 125 - menusliderheight -parseInt(y-menuslidertop);

	} 

	docheight = parseInt(getDocHeight());
	elm5.style.top = thetop+"px";
	y = posY(elm);
	y4 = posY(elm4);
	//alert (thetop +" "+ y3)
	if (y + menusliderheight+50 > y3 ){
		//alert (y3)
		thetop = y3 - menusliderheight -  50 - y4;
	}
	elm5.style.top = thetop+"px";
	y = posY(elm);
	//alert (elm.style.addtotop)
	if (documentwidth > 700){
		if (thetop < 0 ){		
			thetop = 0;
		}
	}else{
		if (y < 0){
			thetop = thetop - y +50;
		}
	}

	elm5.style.top = thetop+"px";
		
}

function checksubmenuresizechange(){	
	elm = document.getElementById('menuslider');
	menusliderheight =  parseInt(elm4.offsetHeight.offsetHeight);
	
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