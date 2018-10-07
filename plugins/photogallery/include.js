<script language="javascript">
window.galleryimages = new Array();
window.curgalleryimg = -1;
window.imageeditorscale = 0;
window.nextimage = "";
window.curalpha = 0;
window.imggalstat = "pauze";
window.flipimage = 0;
window.curgalleryimg = -1;

function updategaltumbs(thegal){
	divID = 'thegaltumbdiv' + thegal;
	theoutput = "";
	
	for (i = 0; i < window.maingalleryimages[thegal].length; i++){
		TumbSize = window.maingalleryimages[thegal][i].tumbsize * window.devicePixelRatio;
		scale = 1 / window.devicePixelRatio;
		Tumbnailsquare = window.maingalleryimages[thegal][i].tumbnailsquare;
		if (String(Tumbnailsquare) == "1"){
			tumbwidth = window.maingalleryimages[thegal][i].tumbsize
			tumbheight = window.maingalleryimages[thegal][i].tumbsize
		}else{
			if (window.maingalleryimages[thegal][i].theHeight >  window.maingalleryimages[thegal][i].theWidth){
				percent = window.maingalleryimages[thegal][i].tumbsize / window.maingalleryimages[thegal][i].theHeight ;
				tumbwidth = window.maingalleryimages[thegal][i].theWidth * percent;
				tumbheight = window.maingalleryimages[thegal][i].theHeight * percent;
			}else {	
				percent = window.maingalleryimages[thegal][i].tumbsize / window.maingalleryimages[thegal][i].theWidth ;
				tumbwidth = window.maingalleryimages[thegal][i].theWidth * percent;
				tumbheight = window.maingalleryimages[thegal][i].theHeight * percent;
			}
		}
		//alert (tumbwidth+ " "+tumbheight)
		if (typeof putimgurlindataoriginal === 'undefined' || putimgurlindataoriginal === null){
			theoutput = theoutput +'<div style="margin:20px;display:inline-block;vertical-align:middle;text-align:center;;"><a href="#" onClick="selectgallery(window.maingalleryimages['+thegal+']);galleryimgshow(\''+i+'\');return false"><img width="'+tumbwidth+'" height="'+tumbheight+'" src="./system/imgtumb.php?url='+window.maingalleryimages[thegal][i].url+'&maxsize='+TumbSize+'&square='+Tumbnailsquare+'" ></a></div>' ;
		}else{
			theoutput = theoutput +'<div style="margin:20px;display:inline-block;vertical-align:middle;text-align:center;"><a href="#" onClick="selectgallery(window.maingalleryimages['+thegal+']);galleryimgshow(\''+i+'\');return false"><img width="'+tumbwidth+'" height="'+tumbheight+'" data-original="./system/imgtumb.php?url='+window.maingalleryimages[thegal][i].url+'&maxsize='+TumbSize+'&square='+Tumbnailsquare+'" ></a></div>' ;
			
		}
	}
	
	document.getElementById(divID).innerHTML = theoutput;
}

function addgalimg(Naam,ImgText,Url,theWidth,theHeight,thetumbsize,tumbnailsquare){
		
		tmparray = new Array();
		tmparray.url = Url;
		tmparray.name = Naam;
		tmparray.text = ImgText;
		tmparray.theWidth = theWidth;
		tmparray.theHeight = theHeight;
		tmparray.tumbsize = thetumbsize;
		tmparray.tumbnailsquare = tumbnailsquare;
		return tmparray;
}
if (screen.width > screen.height){
	window.imgquality = screen.width* window.devicePixelRatio;
}else{
	window.imgquality = screen.height* window.devicePixelRatio;
}


function selectgallery(thegallery){
	
	window.galleryimages = thegallery;
	window.curgalleryimg = -1;
	window.imageeditorscale = 0;
	window.nextimage = "";
	window.curalpha = 0;
	window.imggalstat = "pauze";
	window.flipimage = 0;
	window.curgalleryimg = -1;
}

function loadimgdemensions(num){
	ajaxObj=new Object();
	
	ajaxObj.url = window.galleryimages[num].url;
	
	paramsasstring = $.param(ajaxObj);
	
	var xmlhttppostmessage;
	var txt,xx,x,i;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttppostmessage=new XMLHttpRequest();
  	}
	else
 		{// code for IE6, IE5
  		xmlhttppostmessage=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	xmlhttppostmessage.onreadystatechange=function()
  	{
		
		var i =0;
		if (xmlhttppostmessage.readyState==4 && xmlhttppostmessage.status==200)
   		 {	
			demensions = xmlhttppostmessage.responseText.split("-");
			
			window.galleryimages[num].theWidth = demensions[0];
			window.galleryimages[num].theHeight = demensions[1];
			
			if (num == window.curgalleryimg){
				document.getElementById('imgshower').width = demensions[0];
				document.getElementById('imgshower').height = demensions[1];
			}
			
			resizeframe();
		}
	 }
	
	xmlhttppostmessage.open("POST","./system/imgdemensions.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
}
function scrollY() {
    if( window.pageYOffset ) { return window.pageYOffset; }
    return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
}

function cancelFullScreen(el) {
	var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.msExitFullscreen;
	if (requestMethod) { // cancel full screen.
		requestMethod.call(el);
	} 
	
	window.timerIDloadwindow=setTimeout("window.scrollTo(+window.scrollplacment+, 0);",100);
	
	
}

function requestFullScreen(el) {
	window.scrollplacment = scrollY();
	
	// Supports most browsers and their versions.
	var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;
	
	if (requestMethod) { // Native full screen.
		requestMethod.call(el);
	} 
	return false
}


function galleryimgshow(Num){
	if (document.getElementById("editimg") !== null){
		window.galleryfunction = "gal";
		Num = parseInt(Num);
		  var x,y;
		 document.documentElement.style.overflow="hidden";
		
		if (window.imgqualityb == undefined){
			window.imgqualityb = window.imgquality
		}

		document.getElementById("editimg").style.top ='50%';
		document.getElementById("editimg").style.bottom =  '50%';
		document.getElementById("editimg").style.left = '50%';
		document.getElementById("editimg").style.right =  '50%';
		
		window.curgalleryimg = parseInt(Num);

		if (document.getElementById('imgshower').src != window.galleryimages[Num].url){
			
			changeOpac(0, "imgcontainer");
			
			document.getElementById('imgshower').src = "";
			if (window.imgquality == 0 ){
			
				document.getElementById('imgshower').src = "./system/fileopen.php?url="+window.galleryimages[window.curgalleryimg].url;
			} else {
				
				document.getElementById('imgshower').src = "./system/imgtumb.php?url="+window.galleryimages[window.curgalleryimg].url+"&maxsize="+window.imgquality;
			}
			if (window.galleryimages[window.curgalleryimg].theWidth == 0){
				loadimgdemensions(window.curgalleryimg);
				
			}
		
		}
		
		document.getElementById('Infoimage').innerHTML = "<B>"+window.galleryimages[Num].name+"</B><p>"+window.galleryimages[Num].text+"</p>"
		
		//document.getElementById('imageNaam').value =window.galleryimages[Num].name;
		//document.getElementById('imgetext').value = window.galleryimages[Num].text;
		changeOpac(50, "Infoimagebg");
		
		if (imgdetail == "1"){		
			document.getElementById('Infoimagebg').style.display = 'block';
			document.getElementById('Infoimage').style.display = 'block';
		}else {		
			document.getElementById('Infoimagebg').style.display = 'none';
			document.getElementById('Infoimage').style.display = 'none';
		}
		
		window.imageeditorscale = 0;
		document.getElementById('editimg').style.transform="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		document.getElementById('editimg').style.MozTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		document.getElementById('editimg').style.WebkitTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
		document.getElementById('editimg').style.OTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
		document.getElementById('editimg').style.msTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		
		changeOpac(0, "directory");
		changeOpac(0, "gallerybuttons");

		document.getElementById('directory').style.display = 'block';
		document.getElementById('editimg').style.display = 'block';
		document.getElementById('gallerybuttons').style.display = 'block';
		
		requestFullScreen(document.documentElement);
		growimagewindow()
		fadeingallerybuttons()
	}
}
function growimagewindow(growvalue){
	growvalue = typeof growvalue !== 'undefined' ? growvalue :1;
	window.timerIDloadwindow=clearTimeout(window.timerIDloadwindow);
	
	var curalpha = parseFloat(document.getElementById('imgcontainer').style.opacity);
	//window.imageeditorscale = (window.imageeditorscale + 0.1);
	 window.imageeditorscale=  ((growvalue - window.imageeditorscale)/4)+window.imageeditorscale
	document.getElementById('editimg').style.transform="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	document.getElementById('editimg').style.MozTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	document.getElementById('editimg').style.WebkitTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
	document.getElementById('editimg').style.OTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
	document.getElementById('editimg').style.msTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	
	var curalphadir = parseFloat(document.getElementById('directory').style.opacity);
	//curalphadir = parseFloat((curalphadir + 0.075)*100);
	curalphadir =  (parseFloat(parseFloat(1 - curalphadir)/4) + parseFloat(curalphadir))*100
	//alert (curalphadir)
	changeOpac(curalphadir, "directory");
	//changeOpac(curalphadir, "gallerybuttons");
	
	if (window.imageeditorscale > growvalue - 0.01 && window.imageeditorscale < growvalue + 0.01){		
		window.imageeditorscale =growvalue;
		document.getElementById('editimg').style.transform="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		document.getElementById('editimg').style.MozTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		document.getElementById('editimg').style.WebkitTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
		document.getElementById('editimg').style.OTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
		document.getElementById('editimg').style.msTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
		
	}else{
		window.timerIDloadwindow=setTimeout("growimagewindow("+growvalue+")",30);

	}
}

function Imageisloaded(){
	
	curgalleryimg2 = "";
	nextimage2 ="";
	
	document.getElementById('imgshower').width = window.galleryimages[window.curgalleryimg].theWidth;
	document.getElementById('imgshower').height = window.galleryimages[window.curgalleryimg].theHeight;
	
	resizeframe();
	
	window.imageeditorscale =0.5;
	
	addalphaimg();
	growimagewindow();
	if (window.imggalstat == "play"){
		window.timerIDimgplaycheck=clearTimeout(window.timerIDimgplaycheck);
		window.timerIDimgplay=clearTimeout(window.timerIDimgplay);
		window.timerIDimgplay=setTimeout("nextimg2();",5000);
		window.timerIDimgplaycheck = setTimeout("nextimg2();play2();play2();",600000);
	}
	
	if (window.curgalleryimg < window.galleryimages.length-1){
		
		curgalleryimg2 = parseInt(window.curgalleryimg+1);
	}else{
		curgalleryimg2 =0;
	}
	if (window.imgqualityb == 0 ){
		window.nextimage2 = "./system/fileopen.php?url="+window.galleryimages[curgalleryimg2].url;
	} else {
		window.nextimage2 = "./system/imgtumb.php?url="+window.galleryimages[curgalleryimg2].url+"&maxsize="+window.imgqualityb;
	}
	if (window.galleryimages[curgalleryimg2].theWidth == 0){
			loadimgdemensions(curgalleryimg2);
	}
	window.timerIDimgloader =setTimeout("document.getElementById('imgshower2').src = \"\";document.getElementById('imgshower2').src = window.nextimage2;",1500);
}

function Imageisloaded2(){
	
	if (window.flipimage == 1){
		if (window.imgqualityb == 0 ){
			window.nextimage = "./system/fileopen.php?url="+window.galleryimages[window.curgalleryimg].url;
		} else {
			window.nextimage = "./system/imgtumb.php?url="+window.galleryimages[window.curgalleryimg].url+"&maxsize="+window.imgqualityb;
		}
		if (window.galleryimages[window.curgalleryimg].theWidth == 0){
			loadimgdemensions(window.curgalleryimg);
		}
		document.getElementById('imgshower').src = "";
		document.getElementById('imgshower').src = window.nextimage;		
	}
	window.flipimage = 2;
	
}

function changeOpac(opacity, id) {
	
    var object = document.getElementById(id).style;
	if (opacity != 0){
		object.opacity = (opacity / 100);
		object.MozOpacity = (opacity / 100);
		object.KhtmlOpacity = (opacity / 100); 	
	}else{
		object.opacity = 0;
		object.MozOpacity = 0;
		object.KhtmlOpacity = 0;
	}
    object.filter = "alpha(opacity=" + opacity + ")";
}

function addalphaimg(){
	
	window.timerIDimg=clearTimeout(window.timerIDimg);
	var curalpha = parseFloat(document.getElementById('imgcontainer').style.opacity);
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/16) + parseFloat(curalpha))*100
	changeOpac(curalpha, "imgcontainer");
	
	if (parseInt(curalpha) < 98){		
		window.timerIDimg=setTimeout("addalphaimg()",30);
	}else{	
		curalpha = 100;
		changeOpac(curalpha, "imgcontainer");		
		window.timerIDimg=clearTimeout(window.timerIDimg);
		
		
		
	}
}
function delalphaimg2(){
	window.timerIDimg=clearTimeout(window.timerIDimg);
	var curalpha = parseFloat(document.getElementById('imgcontainer').style.opacity);
	
	//window.curalpha= (parseFloat(window.curalpha) -0.1);
	curalpha =  (parseFloat(parseFloat(0 - curalpha)/5) + parseFloat(curalpha))*100
	changeOpac(parseInt(curalpha), "imgcontainer");
	
	if (parseFloat(curalpha) > 1){		
		window.timerIDimg=setTimeout("delalphaimg2()",30);
	}else{
		
		window.timerIDimg=clearTimeout(window.timerIDimg);
		if (window.flipimage != 1){			
			document.getElementById('imgshower').src = "";
			document.getElementById('imgshower').src = window.nextimage;
			document.getElementById('Infoimage').innerHTML = "<b>"+window.galleryimages[window.curgalleryimg].name+"</b><p>"+window.galleryimages[window.curgalleryimg].text+"</p>"
		}
	}
}
function closeeditimg(){
	document.documentElement.style.overflow="auto";
	document.getElementById('imgshower').src = "";
	document.body.scrolling = 'auto';
	document.getElementById('playpauze').src = "./system/imgtumb.php?url="+themeurl+"systemicon/Play.png&maxsize="+(50* window.devicePixelRatio)+"&square=0";
	
	window.timerIDimgplay=clearTimeout(window.timerIDimgplay);
	window.timerIDloadimg=clearTimeout(window.window.timerIDloadwindow);
	
	window.imggalstat = "exit";
	
	//window.imageeditorscale = (window.imageeditorscale - 0.1);
	window.imageeditorscale=  ((0 - window.imageeditorscale)/4)+window.imageeditorscale
	document.getElementById('editimg').style.transform="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	document.getElementById('editimg').style.MozTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	document.getElementById('editimg').style.WebkitTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
	document.getElementById('editimg').style.OTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";	
	document.getElementById('editimg').style.msTransform ="scale("+window.imageeditorscale+","+window.imageeditorscale+")";
	
	var curalphadir = parseFloat(document.getElementById('directory').style.opacity);
	//curalphadir = parseFloat((curalphadir - 0.075)*100);
	curalphadir =  (parseFloat(parseFloat(0 - curalphadir)/4) + parseFloat(curalphadir))*100
	changeOpac(curalphadir, "directory");
	changeOpac(curalphadir, "gallerybuttons");
	
	if (window.imageeditorscale > 0.1){		
		window.timerIDwindow=setTimeout("closeeditimg()",30);
	}else{
		cancelFullScreen(document);
		window.curgalleryimg = -1;
		document.getElementById('playpauze').src = "./system/imgtumb.php?url="+themeurl+"systemicon/Play.png&maxsize="+(50* window.devicePixelRatio)+"&square=0";
		window.timerIDimgplay=clearTimeout(window.timerIDimgplay);		
		window.imggalstat = "pauze";
		document.getElementById('directory').style.display = 'none';
		document.getElementById('editimg').style.display = 'none';
		document.getElementById('gallerybuttons').style.display = 'none';
	}

	
}
function fadeoutgallerybuttons(){
	
	clearTimeout (window.timerIDfadegalbuttonswindow);
	var curalphadir = parseFloat(document.getElementById('gallerybuttons').style.opacity);
	curalphadir = parseInt((curalphadir - 0.075)*100);	
	if (curalphadir > 0){	
		
		changeOpac(curalphadir, "gallerybuttons");
		window.timerIDfadegalbuttonswindow=setTimeout("fadeoutgallerybuttons()",30);
	}else{
		
		changeOpac(0, "gallerybuttons");
	}
}
function fadeingallerybuttons(){
	
	if (window.imggalstat != "exit"){
	clearTimeout (window.timerIDfadegalbuttonswindow);
	var curalphadir = parseFloat(document.getElementById('gallerybuttons').style.opacity);
		
	curalphadir = parseInt((curalphadir + 0.025)*100);
	
	if (curalphadir < 100){
		changeOpac(curalphadir, "gallerybuttons");	
		window.timerIDfadegalbuttonswindow=setTimeout("fadeingallerybuttons()",30);
		
	}else{
			
	}
	}else{
		//alert ("hallo");
	}
}
function nextimg2(){
	window.curalpha = 1;
	if (window.curgalleryimg < window.galleryimages.length-1){
		
		window.curgalleryimg = parseInt(window.curgalleryimg+1);
	}else{
		window.curgalleryimg =0;
	}
	if (window.imgqualityb == 0 ){
		window.nextimage = "./system/fileopen.php?url="+window.galleryimages[window.curgalleryimg].url;
	} else {
		window.nextimage = "./system/imgtumb.php?url="+window.galleryimages[window.curgalleryimg].url+"&maxsize="+window.imgqualityb;
	}
	if (window.galleryimages[window.curgalleryimg].theWidth == 0){
			loadimgdemensions(window.curgalleryimg);
		}
	if (window.flipimage != 2){
		window.flipimage = 1;
	}
	delalphaimg2();
	growimagewindow(1.1);
}

function play2(){
	
	if (window.imggalstat == "pauze") {
		
		document.getElementById('playpauze').src = "./system/imgtumb.php?url="+themeurl+"systemicon/Pauze.png&maxsize="+(50* window.devicePixelRatio)+"&square=0";
		window.imggalstat = "play";
		window.timerIDimgplay=setTimeout("nextimg2();",1);
		window.timerIDimgplaycheck = setTimeout("nextimg2();play2();play2();",600000);
	}else{
		document.getElementById('playpauze').src = "./system/imgtumb.php?url="+themeurl+"systemicon/Play.png&maxsize="+(50* window.devicePixelRatio)+"&square=0";
		window.timerIDimgplay=clearTimeout(window.timerIDimgplay);
		window.imggalstat = "pauze";
	}
}

function imgquality2(){
	var auto = false;
	if (window.imgqualityb == undefined){
		window.imgqualityb = window.imgquality
	}
	if (window.imgqualityb == 7680) {
		window.imgqualityb = 1920;
		alert ("Image quality is set to full hd");
	}else if (window.imgqualityb == 1920) {
		window.imgqualityb = 720;
		alert ("Image quality is set to sd");
	}else if (window.imgqualityb == 720){
		window.imgqualityb = 320;
		alert ("Image quality is set to smart phone");
	}else if (window.imgqualityb == 320){
		window.imgqualityb = 0;
		alert ("Image quality is set to orginale size");
	}else if (window.imgqualityb == 0){
		auto = true;
		window.imgqualityb = window.imgquality +1
		alert ("Image quality is set to automatic size");		
	}else{
		window.imgqualityb = 7680;
		alert ("Image quality is set to ultra hd");
	}	
	
	if (window.imgqualityb == 0 ){
		window.nextimage = window.galleryimages[window.curgalleryimg].url;
	} else {
		window.nextimage = "./system/imgtumb.php?url="+window.galleryimages[window.curgalleryimg].url+"&maxsize="+window.imgqualityb;
	}
	delalphaimg2();
	growimagewindow(1.1);
	if (auto == true){
		imgqualityb = 1;
	}
}

function previousimg2(){
	window.curalpha = 1;
	if (window.curgalleryimg > 0){
		
		window.curgalleryimg = parseInt(window.curgalleryimg-1);
	}else{
		window.curgalleryimg =window.galleryimages.length-1;
	}
	
	if (window.imgqualityb == 0 ){
		window.nextimage = "./system/fileopen.php?url="+window.galleryimages[window.curgalleryimg].url;
	} else {
		window.nextimage = "./system/imgtumb.php?url="+window.galleryimages[window.curgalleryimg].url+"&maxsize="+window.imgqualityb;
	}
	if (window.galleryimages[window.curgalleryimg].theWidth == 0){
			loadimgdemensions(window.curgalleryimg);
		}
	delalphaimg2();
	growimagewindow(1.1);
}


function domousegalbuttons (){
  clearTimeout(window.mousemovetimeout);
  fadeingallerybuttons();
  
  window.mousemovetimeout = setTimeout(function(){fadeoutgallerybuttons()}, 3000);
}

	



</script>