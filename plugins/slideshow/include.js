<script language="javascript">
if (window.slideshows instanceof Array ){

}else{
	window.slideshows = new Array();
}

function loadallslideshows (){

	for (var id in window.slideshows) {
		
		if(window.slideshows.hasOwnProperty(id)){
			
            loadslider(String(id));
    }}
	
}
function addslidetoshow(Url,Image,theWidth,theHeight){	
	
		tmparray = new Array();
		tmparray.url = Url;
		tmparray.image = Image;
		tmparray.theWidth = theWidth;
		tmparray.theHeight = theHeight;
		return tmparray;
}

function createslideshow (id, thediv){
	tmparray = new Array();
	tmparray.slides = new Array();
	tmparray.curslide = 0;	
	tmparray.theWidth = 0;
	tmparray.theHeight = 0;
	tmparray.aspectratio = 1;
	tmparray.timerfade = null;
	tmparray.thetimer = null;
	tmparray.repairbrokentimer = null;
	tmparray.quality = null;
	tmparray.imagetop = 0;
	tmparray.nextimgwidth = 0;
	tmparray.image1loaded = false;
	tmparray.image2loaded = false;
	tmparray.divid = thediv;
	tmparray.oldwidth = -10;
	tmparray.functionimage1 = function() {Imageslideisloaded(id);}
	tmparray.functionimage2 = function() {Imageslide2isloaded(id);}
	window.slideshows[id] = tmparray;
}
function slideswitch (item1,item2){
	slidediv = document.getElementById('slides');
	slide1 = window.slideshows['main'].slides[item1];
	window.slideshows['main'].slides[item1] = window.slideshows['main'].slides[item2];
	window.slideshows['main'].slides[item2] = slide1;
	updateslides()
}
function updateslides(){	
	slidediv = document.getElementById('slides');
	theslides = window.slideshows['main'].slides;
	thetext = "<div id=\"gallerybut\"><table>";
	
	for (i=0; i<theslides.length; i++){	
		thetext += '<tr><td>Slide</td><td><input type="checkbox" name="slideid'+i+'" id="slideid'+i+'"/>';
		if (i==0 && i == theslides.length -1){
			thetext +=  '';
		} else if(i==0){
			thetext += '<a href="#" onClick="slideswitch(\''+i+'\',\''+(i+1)+'\');return false"><img src="'+themeurl+'systemicon/down.png"></a>';
		} else if (i== theslides.length -1){
			thetext += '<a href="#" onClick="slideswitch(\''+i+'\',\''+(i-1)+'\');return false"><img src="'+themeurl+'systemicon/up.png"></a>';
		} else {
			thetext += '<a href="#" onClick="slideswitch(\''+i+'\',\''+(i-1)+'\');return false"><img src="'+themeurl+'systemicon/up.png"></a>';
			thetext += '<a href="#" onClick="slideswitch(\''+i+'\',\''+(i+1)+'\');return false"><img src="'+themeurl+'systemicon/down.png"></a>';
		}	
		'</td></tr>' ;
		thetext += '<tr><td>Url</td><td><input type="text" id="SlideUrl'+i+'" name="SlideUrl'+i+'" value="'+ theslides[i].url+'" size="45" border="0" onchange="changeval();"><a href="#" onClick="showfilemanager(\'SlideUrl'+i+'\');return false"><img src="'+themeurl+'/iconfilemanager/add.png" alt="add"></a></td></tr>';
		thetext += '<tr><td>Image</td><td><input type="text" id="SlideImage'+i+'" name="SlideImage'+i+'" value="'+ theslides[i].image+'" size="45" border="0" onchange="changeval();"><a href="#" onClick="showfilemanager(\'SlideImage'+i+'\');return false"><img src="'+themeurl+'/iconfilemanager/add.png" alt="add"></a></td></tr>';		
	}
	thetext += '<tr><td>Total slides</td><td>'+ theslides.length+'<input type="hidden" id="totalslides" name="totalslides" value="'+ theslides.length+'" size="45" border="0" onchange="changeval();"></td></tr>';
	thetext += "</table></div>";
	slidediv.innerHTML = thetext;	
	loadslider('main');
}

function importslides(){
	slidediv = document.getElementById('slides');
	theslides = window.slideshows['main'].slides;
	
	for (i=0; i<theslides.length; i++){	
		theslides[i].url = document.getElementById('SlideUrl'+i).value
		theslides[i].image = document.getElementById('SlideImage'+i).value
	}
	loadslider('main');
}

function selectallslides(){
	slidediv = document.getElementById('slides');
	theslides = window.slideshows['main'].slides;
	
	for (i=0; i<theslides.length; i++){	
		document.getElementById('slideid'+i).checked = true;
	}
}

function deselectallslides(){
	slidediv = document.getElementById('slides');
	theslides = window.slideshows['main'].slides;
	
	for (i=0; i<theslides.length; i++){	
		document.getElementById('slideid'+i).checked = false;
	}
}

function deleteslide(){
	slidediv = document.getElementById('slides');
	theslides = window.slideshows['main'].slides;
	ii = 0
	for (i=0; i<theslides.length; i++){	
		if (document.getElementById('slideid'+ii).checked == true){
			window.slideshows['main'].slides.splice(i, 1);
			i = i-1;
		}
		ii++
	}
	updateslides();
}

function loadslider(idname){
	if (window.slideshows[idname].loaded != true){
	slideshowdiv = document.getElementById(window.slideshows[idname].divid);
	viewportscroll = parseInt(scrollY())+ parseInt(viewPortHeight()); 
	theposy = parseInt(posY(slideshowdiv));
	if (typeof putimgurlindataoriginal === 'undefined' || putimgurlindataoriginal === null||(putimgurlindataoriginal == true && theposy < viewportscroll)){
	scale = 1 / window.devicePixelRatio;
	
	if (window.slideshows[idname].timerfade !== undefined && window.slideshows[idname].timerfade !== null){
		window.slideshows[idname].timerfade=clearTimeout(window.slideshows[idname].timerfade);
	}
	if (window.slideshows[idname].thetimer !== undefined && window.slideshows[idname].thetimer !== null){
		window.slideshows[idname].thetimer=clearTimeout(window.slideshows[idname].thetimer);
	}
	thetext = '<div id="gallerybut"><div id="slidercontainer'+idname+'" style="width:100%; position:relative; overflow:hidden; padding: 0px; border: 0px;margin: 0px;"><a id="slidershref1'+idname+'" href="#" onClick="return false;"><div id="sliders1'+idname+'" style="left:0px;position:absolute;padding: 0px; border: 0px;margin: 0px;">';
	thetext += '<img id="imageslide'+idname+'"src="blank.png" align="center">';
	
	thetext += '</div></a><a id="slidershref2'+idname+'" href="#" onClick="return false;"><div id="sliders2'+idname+'" style="left:0px;position:absolute;padding: 0px; border: 0px;margin: 0px;"><img id="image2slide'+idname+'"src="blank.png" align="center"></div></a><div id="nextslide'+idname+'" style="width:50px;position:absolute;z-index:3;"><a href="#" onClick="nextslide(\''+idname+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/Next.png&maxsize='+(50* window.devicePixelRatio)+'&square=0" style="zoom: '+scale+'; -moz-transform: scale('+scale+');"></a></div><div id="prevslide'+idname+'" style="position:absolute;z-index:3;"><a href="#" onClick="prevslide(\''+idname+'\');return false"><img src="./system/imgtumb.php?url='+themeurl+'systemicon/Previous.png&maxsize='+(50* window.devicePixelRatio)+'&square=0" style="zoom: '+scale+'; -moz-transform: scale('+scale+');"></a></div></div></div> <div id="sliderwidth'+idname+'" style="left:0px; right:0px;"></div>';
	
	slideshowdiv.innerHTML = thetext;
	document.getElementById('imageslide'+idname).onload = window.slideshows[idname].functionimage1 ();
	document.getElementById('image2slide'+idname).onload = window.slideshows[idname].functionimage2 ();
	document.getElementById('sliders1'+idname).style.left = document.getElementById('slidercontainer'+idname).offsetWidth+'px';
	document.getElementById('sliders2'+idname).style.left = document.getElementById('slidercontainer'+idname).offsetWidth+'px';
	window.slideshows[idname].nextimgwidth = document.getElementById('nextslide'+idname).offsetWidth;
	window.slideshows[idname].imagetop = 0;
	window.slideshows[idname].curslide = 0;
	window.slideshows[idname].loaded = true;
	
	if (window.slideshows[idname].slides.length > 0){
		if (window.slideshows[idname].slides[0].image.length > 0){	
			if (window.slideshows[idname].slides[0].theWidth >0 && window.slideshows[idname].slides[0].theHeight >0){
				
				window.slideshows[idname].theWidth = window.slideshows[idname].slides[0].theWidth;
				window.slideshows[idname].theHeight = window.slideshows[idname].slides[0].theHeight;
				window.slideshows[idname].aspectratio = window.slideshows[idname].slides[0].theHeight / window.slideshows[idname].slides[0].theWidth;
				window.slideshows[idname].oldwidth = -1;
				resizeframe();
			}else{
				
				loadimgdemensionsslide(window.slideshows[idname].slides[0].image, idname)
			}				
		}		
		}
	}
	}
	//alert ("loadslider")
}

function Imageslideisloaded(id){
	window.slideshows[id].image1loaded = true;
}

function Imageslide2isloaded(id){
	window.slideshows[id].image2loaded = true;
}

function fadeslidein (id){
	window.slideshows[id].fading = true;
	window.slideshows[id].timerfade=clearTimeout(window.slideshows[id].timerfade);
		document.getElementById('imageslide'+id).onload = window.slideshows[id].functionimage1 ();
		document.getElementById('image2slide'+id).onload =window.slideshows[id].functionimage2 ();
	theleft = document.getElementById('sliders1'+id).style.left
	theleft = theleft.substring(theleft.length -2, theleft.lenght -0);
	
	if (theleft > 1){
		if (window.slideshows[id].image1loaded == true ){
			document.getElementById('sliders1'+id).style.left = (theleft / 2) +'px';
		}
		window.slideshows[id].timerfade=setTimeout("fadeslidein('"+id+"')",30);
	}else {
		window.slideshows[id].fading = false;
		document.getElementById('sliders1'+id).style.left = '0px'
		window.slideshows[id].thetimer=clearTimeout(window.slideshows[id].thetimer);
		window.slideshows[id].repairbrokentimer=clearTimeout(window.slideshows[id].repairbrokentimer)
		window.slideshows[id].thetimer=setTimeout("nextslide('"+id+"')",3000);
		curslide = window.slideshows[id].curslide+1
		
		if (curslide == window.slideshows[id].slides.length){
			curslide = 0;
		}
		
		if (window.slideshows[id].imagetop == 0){
			theimage = document.getElementById ("imageslide"+id);
			//window.slideshows[id].imagetop = 1;
			document.getElementById('sliders1'+id).style.left = document.getElementById('slidercontainer'+id).offsetWidth+'px';
			document.getElementById('sliders1'+id).style.zIndex = "1";
			document.getElementById('sliders2'+id).style.zIndex = "0";
			window.slideshows[id].image1loaded = false;
		}else{		
			theimage = document.getElementById ("image2slide"+id);
			//window.slideshows[id].imagetop = 0;
			document.getElementById('sliders2'+id).style.left = document.getElementById('slidercontainer'+id).offsetWidth+'px';
			document.getElementById('sliders2'+id).style.zIndex = "1";
			document.getElementById('sliders1'+id).style.zIndex = "0";
			window.slideshows[id].image2loaded = false;
		}
		
		theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
		
	}
}

function fadeslide2in (id){
	window.slideshows[id].fading = true;
	window.slideshows[id].timerfade=clearTimeout(window.slideshows[id].timerfade);
		document.getElementById('imageslide'+id).onload = window.slideshows[id].functionimage1 ();
		document.getElementById('image2slide'+id).onload =window.slideshows[id].functionimage2 ();
	theleft = document.getElementById('sliders2'+id).style.left
	theleft = theleft.substring(theleft.length -2, theleft.lenght -0);
	//alert (theleft);
	if (theleft > 1){
		//alert (window.slideshows[id].image2loaded);
		if (window.slideshows[id].image2loaded == true ){
			document.getElementById('sliders2'+id).style.left = (theleft / 2) +'px';
		}
		window.slideshows[id].timerfade=setTimeout("fadeslide2in('"+id+"')",30);
	}else {
		window.slideshows[id].fading = false;
		document.getElementById('sliders2'+id).style.left = '0px'
		window.slideshows[id].thetimer=clearTimeout(window.slideshows[id].thetimer);
		window.slideshows[id].repairbrokentimer=clearTimeout(window.slideshows[id].repairbrokentimer)
		window.slideshows[id].thetimer=setTimeout("nextslide('"+id+"')",3000);
		curslide = window.slideshows[id].curslide+1
		if (curslide == window.slideshows[id].slides.length){
			curslide = 0;
		}
		if (window.slideshows[id].imagetop == 0){
			theimage = document.getElementById ("imageslide"+id);
			document.getElementById('sliders1'+id).style.left = document.getElementById('slidercontainer'+id).offsetWidth+'px';
			document.getElementById('sliders1'+id).style.zIndex = "1";
			document.getElementById('sliders2'+id).style.zIndex = "0";
			window.slideshows[id].image1loaded = false;
		}else{
			theimage = document.getElementById ("image2slide"+id);
			document.getElementById('sliders2'+id).style.left = document.getElementById('slidercontainer'+id).offsetWidth+'px';
			document.getElementById('sliders2'+id).style.zIndex = "1";
			document.getElementById('sliders1'+id).style.zIndex = "0";
			window.slideshows[id].image2loaded = false;
		}
		theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
		
	}
}

function nextslide(id){
	if (window.slideshows[id].fading != true){
		window.slideshows[id].repairbrokentimer=clearTimeout(window.slideshows[id].repairbrokentimer)
		window.slideshows[id].thetimer=clearTimeout(window.slideshows[id].thetimer);
		window.slideshows[id].curslide++;
		if (window.slideshows[id].curslide == window.slideshows[id].slides.length){
			window.slideshows[id].curslide = 0;
		}
		if (window.slideshows[id].slides.length > 1){
			if (window.slideshows[id].imagetop == 0){
				fadeslidein (id)
				window.slideshows[id].imagetop = 1;
				if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
					document.getElementById ("slidershref1"+id).href = "#"
				}else{
					document.getElementById ("slidershref1"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
				}
			}else{
				fadeslide2in (id)
				window.slideshows[id].imagetop = 0;
				if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
					document.getElementById ("slidershref2"+id).href = "#"
				}else{
					document.getElementById ("slidershref2"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
				}
			}
		}
		window.slideshows[id].repairbrokentimer=setTimeout("nextslide('"+id+"')",6000);
	}
}

function prevslide(id){	
	if (window.slideshows[id].fading != true){
		window.slideshows[id].repairbrokentimer=clearTimeout(window.slideshows[id].repairbrokentimer)
		window.slideshows[id].thetimer=clearTimeout(window.slideshows[id].thetimer);
		window.slideshows[id].curslide--;
		if (window.slideshows[id].curslide == -1){
			window.slideshows[id].curslide = window.slideshows[id].slides.length-1;
		}
		if (window.slideshows[id].slides.length > 1){
			if (window.slideshows[id].imagetop == 0){
				theimage = document.getElementById ("imageslide"+id);
				theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[window.slideshows[id].curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
				fadeslidein (id)
				window.slideshows[id].imagetop = 1;
				if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
					document.getElementById ("slidershref1"+id).href = "#"
				}else{
					document.getElementById ("slidershref1"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
				}
			}else{
				theimage = document.getElementById ("image2slide"+id);
				theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[window.slideshows[id].curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
				fadeslide2in (id)
				window.slideshows[id].imagetop = 0;
				if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
					document.getElementById ("slidershref2"+id).href = "#"
				}else{
					document.getElementById ("slidershref2"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
				}
			}
		}
	}
}

function playslide(id){
	if (window.slideshows[id].imagetop == 0){
		theimage = document.getElementById ("imageslide"+id);
		window.slideshows[id].imagetop = 1;
		theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[window.slideshows[id].curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
		fadeslidein(id);
		if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
			document.getElementById ("slidershref1"+id).href = "#"
		}else{
			document.getElementById ("slidershref1"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
		}
		
	}else{
		theimage = document.getElementById ("image2slide"+id);
		window.slideshows[id].imagetop = 0;
		theimage.src = "./system/imgtumb.php?url="+window.slideshows[id].slides[window.slideshows[id].curslide].image+"&maxsize="+(window.slideshows[id].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[id].aspectratio
		fadeslide2in(id);
		if (window.slideshows[id].slides[window.slideshows[id].curslide].url.length < 2){
			document.getElementById ("slidershref2"+id).href = "#"
		}else{
			document.getElementById ("slidershref2"+id).href = window.slideshows[id].slides[window.slideshows[id].curslide].url
		}
	}
	
	
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
function loadimgdemensionsslide(theurl, id){

	ajaxObj=new Object();
	ajaxObj.url = theurl;
		
	paramsasstring = $.param(ajaxObj);
	
	var root = Object.create(null);
	root.id = id;
	
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
			//cfunc.bind(xmlhttppostmessage)(this.id);
			
			demensions = xmlhttppostmessage.responseText.split("-");
			
			window.slideshows[this.id].theWidth = demensions[0];
			window.slideshows[this.id].theHeight = demensions[1];
			window.slideshows[this.id].aspectratio = demensions[1] / demensions[0];
			window.slideshows[this.id].oldwidth = -1;
			resizeframe();
			/*thewidth = document.getElementById('slidercontainer'+this.id).offsetWidth;
			
			if (demensions[0] > thewidth){
				document.getElementById('slidercontainer'+this.id).style.width= thewidth-1+'px';
				document.getElementById('slidercontainer'+this.id).style.height= (thewidth*window.slideshows[this.id].aspectratio)+'px';
				document.getElementById('sliders1'+this.id).style.left = thewidth+'px';
				if (demensions[0] > demensions[1]){
					window.slideshows[this.id].quality = thewidth;
					document.getElementById('nextslide'+this.id).style.top = (thewidth*window.slideshows[this.id].aspectratio/2)+'px'
					document.getElementById('nextslide'+this.id).style.left = (thewidth-document.getElementById('nextslide'+this.id).offsetWidth-50)+'px'
					document.getElementById('prevslide'+this.id).style.top = (thewidth*window.slideshows[this.id].aspectratio/2)+'px'
				}else{
					window.slideshows[this.id].quality = thewidth*window.slideshows[this.id].aspectratio;
					document.getElementById('nextslide'+this.id).style.top = (thewidth*window.slideshows[this.id].aspectratio/2)+'px'
					document.getElementById('nextslide'+this.id).style.left = (thewidth-document.getElementById('nextslide'+this.id).offsetWidth-50)+'px'
					document.getElementById('prevslide'+this.id).style.top = (thewidth*window.slideshows[this.id].aspectratio/2)+'px'
				}
			}else{
				document.getElementById('slidercontainer'+this.id).style.width= window.slideshows[this.id].theWidth-1+'px';
				document.getElementById('slidercontainer'+this.id).style.height= (window.slideshows[this.id].theWidth*window.slideshows[this.id].aspectratio)+'px';
				document.getElementById('sliders1'+this.id).style.left = thewidth+'px';
				if (demensions[0] > demensions[1]){
					window.slideshows[this.id].quality = demensions[0];
					document.getElementById('nextslide'+this.id).style.top = (demensions[1]/2)+'px'
					document.getElementById('nextslide'+this.id).style.left = (demensions[0]-document.getElementById('nextslide'+this.id).offsetWidth-50)+'px'
					document.getElementById('prevslide'+this.id).style.top = (demensions[1]/2)+'px'
				}else{
					window.slideshows[this.id].quality = demensions[1];
					document.getElementById('nextslide'+this.id).style.top = (demensions[1]/2)+'px'
					document.getElementById('nextslide'+this.id).style.left = (demensions[0]-document.getElementById('nextslide'+this.id).offsetWidth-50)+'px'
					document.getElementById('prevslide'+this.id).style.top = (demensions[1]/2)+'px'
				}
			}
			window.slideshows[this.id].oldwidth = thewidth;
			if (window.slideshows[this.id].slides.length < 2){
				changeOpac(0, 'nextslide'+this.id);
				changeOpac(0, 'prevslide'+this.id);
			}else{
				changeOpac(100, 'nextslide'+this.id);
				changeOpac(100, 'prevslide'+this.id);
			}		*/	
			//playslide(id);
		}
	 }.bind(root)
	
	xmlhttppostmessage.open("POST","./system/imgdemensions.php");
	xmlhttppostmessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttppostmessage.setRequestHeader("Content-length", paramsasstring.length);
	xmlhttppostmessage.setRequestHeader("Connection", "close");
	xmlhttppostmessage.send(paramsasstring);
	
}</script>