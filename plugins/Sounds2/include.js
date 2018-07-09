<script language="javascript">
window.mainsoundgal2 = new Array();
window.mainsoundgalnum = -1;
window.soundplayercrub = false;
window.soundplayercrub2 = false;
window.firstplay = true;
function selectsoundgal (num){
	window.mainsoundgal = Array();
	window.mainsoundgal = window.mainsoundgal2[num];
	window.mainsoundgalnum = num;
}

function showmp3info(list, listnum){
	//soundinfopic'.$MainId.'num'.$numimg.'
	//soundinfo'.$MainId.'num'.$numimg.'
	pic = document.getElementById("soundinfopic"+list+"num"+listnum);
	mp3info = document.getElementById("soundinfo"+list+"num"+listnum);
	
	if (pic.src.search("down.png") != -1){
		pic.src = './system/imgtumb.php?url='+themeurl+'systemicon/up.png&maxsize='+(20* window.devicePixelRatio)+'&square=0';
		mp3info.style.display = "block"
	}else{
		pic.src = './system/imgtumb.php?url='+themeurl+'systemicon/down.png&maxsize='+(20* window.devicePixelRatio)+'&square=0';
		mp3info.style.display = "none"
	}
}

function updatesoundgal (){
	txt = '<table width="100%" id="musicplayerlist" border = "0" cellspacing="10">';
	ii =0;
	for (i=0;i<window.mainsoundgal.length;i++)
	{
		//alert (window.mainsoundgal[i].AlbumArt);
		AlbumArt = '../../system/imgtumb.php?url='+window.mainsoundgal[i].AlbumArt+'&maxsize='+(50* window.devicePixelRatio)+'&square=0';
		if (ii < 1){			
			ii = ii + 1;
		}else{
			ii = 1;
		}
		
		if (window.cursound == i){
			txt = txt + '<tr><th ><a href="#" onClick="window.cursound = '+i+';playsound (window.mainsoundgal[window.cursound].url);return false;"><img src="'+AlbumArt+'" width="50" height="50"></a></th><th><a href="#" onClick="window.cursound = '+i+';playsound (window.mainsoundgal[window.cursound].url);return false;"><b>'+window.mainsoundgal[i].title+'</b><br><i>'+window.mainsoundgal[i].Author+'</i></a></th>' ;
		}else{
			txt = txt + '<tr><td ><a href="#" onClick="window.cursound = '+i+';playsound (window.mainsoundgal[window.cursound].url);return false;"><img src="'+AlbumArt+'" width="50" height="50"></a></td><td><a href="#" onClick="window.cursound = '+i+';playsound (window.mainsoundgal[window.cursound].url);return false;"><b>'+window.mainsoundgal[i].title+'</b><br><i>'+window.mainsoundgal[i].Author+'</i></a></td>' ;
		}
	}

	txt = txt +'</table><input type="hidden" name="totalsound" id="totalsound" value="'+window.mainsoundgal.length+'">';

	document.getElementById('soundgal').innerHTML = txt;
}
function updatesoundgalmember (id, mp3lang){
	txt = '<table border = "0">';
	ii =0;
	txt = txt + '<tr><td colspan=3><div id="betweenbar" name="betweenbar"></div></td></tr>'
	for (i=0;i<window.mainsoundgal2[id].length;i++)
	{
		AlbumArt = './system/imgtumb.php?url='+window.mainsoundgal2[id][i].AlbumArt+'&maxsize='+(50* window.devicePixelRatio)+'&square=0';
		if (ii < 1){
			
			ii = ii + 1;
		}else{
			ii = 1;
		}
		
		txt = txt + '<tr><td width="75"><a onClick="selectsoundgal('+id+');window.cursound = '+i+';opensoundplayer();"><img src="'+AlbumArt+'" width="50" height="50"></a></td><td style="vertical-align: middle;" ><a onClick=" selectsoundgal('+id+');window.cursound = '+i+';opensoundplayer();"> <b>'+window.mainsoundgal2[id][i].title+'</b> - <i>'+window.mainsoundgal2[id][i].Author+'</i></a></td><td style="vertical-align: middle;"><a id="soundinfourl'+id+'num'+i+'" onClick="showmp3info('+id+','+i+')"><div id=\"gallerybut\"><img id="soundinfopic'+id+'num'+i+'" src="./system/imgtumb.php?url='+themeurl+'systemicon/down.png&maxsize='+(20* window.devicePixelRatio)+'&square=0" width="20" height="20"></div></td>' ;
		
		txt = txt +'</td></tr>';
		
		txt = txt +'<tr><td colspan=3><div id="soundinfo'+id+'num'+i+'" style="display:none;">';
		if (window.mainsoundgal2[id][i]['title'].length > 0){txt = txt +'<h2>'+window.mainsoundgal2[id][i]['title']+'</h2>';}
		txt = txt +'<div style="-webkit-column-count: auto; -moz-column-count: 3; column-count: auto; -webkit-column-width: 300px; -moz-column-width: 300px; column-width: 300px; " >';
		AlbumArt = './system/imgtumb.php?url='+window.mainsoundgal2[id][i].AlbumArt+'&maxsize='+(200* window.devicePixelRatio)+'&square=0';
		txt = txt +'<a href="#" onClick="selectgallery(window.maingalleryimages['+id+']);galleryimgshow('+i+');return false"><img src="'+AlbumArt+'" width="200" height="200"></a><br>';
		if (window.mainsoundgal2[id][i]['Album'].length > 0){txt = txt + mp3lang.Album +" : " + window.mainsoundgal2[id][i]['Album']+"<BR>";}
//		tmparray.Album="";
		if (window.mainsoundgal2[id][i]['Author'].length > 0){txt = txt + mp3lang.Author +" : " + window.mainsoundgal2[id][i]['Author']+"<BR>";}	
//		tmparray.Author = "";
		if (window.mainsoundgal2[id][i]['AlbumAuthor'].length > 0){txt = txt + mp3lang.AlbumAuthor +" : " + window.mainsoundgal2[id][i]['AlbumAuthor']+"<BR>";}
//		tmparray. = "";
		if (window.mainsoundgal2[id][i]['Track'].length > 0){txt = txt + mp3lang.Track +" : " + window.mainsoundgal2[id][i]['Track']+"<BR>";}
//		tmparray.Track = "";
		if (window.mainsoundgal2[id][i]['Year'].length > 0){txt = txt + mp3lang.Year +" : " + window.mainsoundgal2[id][i]['Year']+"<BR>";}
//		tmparray.Year = "";
		if (window.mainsoundgal2[id][i]['theLenght'].length > 0){txt = txt + mp3lang.theLenght +" : " + window.mainsoundgal2[id][i]['theLenght']+"<BR>";}
//		tmparray.theLenght = "";
		if (window.mainsoundgal2[id][i]['theDesc'].length > 0){txt = txt + mp3lang.theDesc +" : " + window.mainsoundgal2[id][i]['theDesc']+"<BR>";}
//		tmparray.theDesc = "";
		if (window.mainsoundgal2[id][i]['Genre'].length > 0){txt = txt + mp3lang.Genre +" : " + window.mainsoundgal2[id][i]['Genre']+"<BR>";}
//		tmparray.Genre = "";
		if (window.mainsoundgal2[id][i]['Copyright'].length > 0){txt = txt + mp3lang.Copyright +" : " + window.mainsoundgal2[id][i]['Copyright']+"<BR>";}
//		tmparray.Copyright = "";
		if (window.mainsoundgal2[id][i]['Publisher'].length > 0){txt = txt + mp3lang.Publisher +" : " + window.mainsoundgal2[id][i]['Publisher']+"<BR>";}
//		tmparray.Publisher = "";
		if (window.mainsoundgal2[id][i]['URL'].length > 0){txt = txt + mp3lang.URL +" : " + window.mainsoundgal2[id][i]['URL']+"<BR>";}
//		tmparray.URL = "";
		if (window.mainsoundgal2[id][i]['Comments'].length > 0){txt = txt + mp3lang.Comments +" : " + window.mainsoundgal2[id][i]['Comments']+"<BR>";}
//		tmparray.Comments = "";
		if (window.mainsoundgal2[id][i]['Composer'].length > 0){txt = txt + mp3lang.Composer +" : " + window.mainsoundgal2[id][i]['Composer']+"<BR>";}
//		tmparray.Composer = "";
		if (window.mainsoundgal2[id][i]['Genre'].length > 0){txt = txt + mp3lang.Genre +" : " + window.mainsoundgal2[id][i]['Genre']+"<BR>";}
//		tmparray.Genre = "";

		txt = txt +'</div></div>';
		txt = txt + '<tr><td colspan=3><div id="betweenbar" name="betweenbar"></div></td></tr>';
	}
	txt = txt +'</table><input type="hidden" name="totalsound" id="totalsound" value="'+window.mainsoundgal2[id].length+'">';

	document.getElementById('soundgal'+id).innerHTML = txt;
}
function startscrub (){
	window.timersoundIDloadwindow=clearTimeout(window.timersoundIDloadwindow);
	window.soundplayercrub = "first";
}

function startscrub2 (){	
	window.soundwindow.window.timersoundIDloadwindow=window.soundwindow.clearTimeout(window.soundwindow.window.timersoundIDloadwindow);
	window.soundwindow.soundplayercrub2 = "first";
	
}

function posx(elm) {
    var test = elm, left = 0;

    while(!!test && test.tagName.toLowerCase() !== "body") {
        left += test.offsetLeft;
        test = test.offsetParent;
    }

    return left;
}
function addsoundfile(Url,id3tage, AlbumArt){
		if (typeof id3tage == "undefined" || id3tage == null){
			tmparray = new Array();
			tmparray.url = Url;
			var res = Url.split("/"); 
			tmparray.title = res[res.length-1];
			tmparray.Album="";
			tmparray.Author = "";
			tmparray.AlbumAuthor = "";
			tmparray.Track = "";
			tmparray.Year = "";
			tmparray.theLenght = "";
			tmparray.theDesc = "";
			tmparray.Genre = "";
			tmparray.Copyright = "";
			tmparray.Publisher = "";
			tmparray.URL = "";
			tmparray.Comments = "";
			tmparray.Composer = "";
			tmparray.Genre = "";
			tmparray.Copyright = "";
			tmparray.AlbumArt =AlbumArt
			
		}else{
			id3tage = JSON.parse(id3tage);
			tmparray = new Array();
			tmparray.url = Url;
			
			if (typeof id3tage['Title'] != "undefined" || id3tage['Title'] != null){
				tmparray.title = id3tage['Title'];
			}else{
				var res = Url.split("/"); 
				tmparray.title = res[res.length-1];
			}
			
			if (typeof id3tage['Album'] != "undefined" || id3tage['Album'] != null){
				tmparray.Album = id3tage['Album'];
			}else{
				tmparray.Album = "";
			}
			
			if (typeof id3tage['Author'] != "undefined" || id3tage['Author'] != null){
				tmparray.Author = id3tage['Author'];
			}else{
				tmparray.Author = "";
			}
			if (typeof id3tage['AlbumAuthor'] != "undefined" || id3tage['AlbumAuthor'] != null){
				tmparray.AlbumAuthor = id3tage['AlbumAuthor'];
			}else{
				tmparray.AlbumAuthor = "";
			}
			if (typeof id3tage['Track'] != "undefined" || id3tage['Track'] != null){
				tmparray.Track = id3tage['Track'];
			}else{
				tmparray.Track = "";
			}
			if (typeof id3tage['Year'] != "undefined" || id3tage['Year'] != null){
				tmparray.Year = id3tage['Year'];
			}else{
				tmparray.Year = "";
			}
			if (typeof id3tage['Lenght'] != "undefined" || id3tage['Lenght'] != null){
				tmparray.theLenght = id3tage['Lenght'];
			}else{
				tmparray.theLenght = "";
			}
			if (typeof id3tage['Desc'] != "undefined" || id3tage['Desc'] != null){
				tmparray.theDesc = id3tage['Desc'];
			}else{
				tmparray.theDesc = "";
			}
			if (typeof id3tage['Genre'] != "undefined" || id3tage['Genre'] != null){
				tmparray.Genre = id3tage['Genre'];
			}else{
				tmparray.Genre = "";
			}
			if (typeof id3tage['Copyright'] != "undefined" || id3tage['Copyright'] != null){
				tmparray.Copyright = id3tage['Copyright'];
			}else{
				tmparray.Copyright = "";
			}
			if (typeof id3tage['Publisher'] != "undefined" || id3tage['Publisher'] != null){
				tmparray.Publisher = id3tage['Publisher'];
			}else{
				tmparray.Publisher = "";
			}
			if (typeof id3tage['URL'] != "undefined" || id3tage['URL'] != null){
				tmparray.URL = id3tage['URL'];
			}else{
				tmparray.URL = "";
			}
			if (typeof id3tage['Comments'] != "undefined" || id3tage['Comments'] != null){
				tmparray.Comments = id3tage['Comments'];
			}else{
				tmparray.Comments = "";
			}
			if (typeof id3tage['Composer'] != "undefined" || id3tage['Composer'] != null){
				tmparray.Composer = id3tage['Composer'];
			}else{
				tmparray.Composer = "";
			}
			tmparray.AlbumArt =AlbumArt
		}
		
		return tmparray;
		
}

function soundscrub(event){
	

	if (window.down == 1){
	var thetimeslider = document.getElementById("soundslider");	
	if (window.soundplayercrub == "first"){
		window.soundplayercrub =  document.getElementById("timeslider").offsetLeft +10;
		//alert (event.clientX)
	}
	if (window.soundplayercrub != false){
		
		
		var mousex = event.clientX - window.soundplayercrub ;			
		var newplace = mousex ;
		if (newplace < 0){newplace = 0;}
		if (newplace > 150){newplace = 150;}
		thetimeslider.style.left = (newplace)+"px";
		//window.timersoundIDloadwindow=clearTimeout(window.timersoundIDloadwindow);
		//window.timersoundIDloadwindow = setTimeout("updatesoundstart ();",3000);		
	}
	}else{
		if (window.soundplayercrub != false){
			//window.timersoundIDloadwindow=clearTimeout(window.timersoundIDloadwindow);
			//window.timersoundIDloadwindow=setTimeout("updatesoundstart ()",70);	
			window.soundplayercrub = false;
		}
	}
}

function soundscrub2(event){
	
	if (window.down == 1){
	
	var thetimeslider = document.getElementById("soundslider");	
	if (window.soundwindow.soundplayercrub2 == "first"){
		window.soundwindow.soundplayercrub2 =  document.getElementById("timeslider").offsetLeft +15;		
	}
	if (window.soundwindow.soundplayercrub2 != false){		
		var mousex = event.clientX - window.soundwindow.soundplayercrub2 ;			
		var newplace = mousex ;
		if (newplace < 0){newplace = 0;}
		if (newplace > 150){newplace = 150;}
		thetimeslider.style.left = (newplace)+"px";
		//window.soundwindow.timersoundIDloadwindow=window.soundwindow.clearTimeout(window.soundwindow.timersoundIDloadwindow);
		//window.soundwindow.timersoundIDloadwindow = window.soundwindow.setTimeout("updatesoundstart ();",3000);
		
	}
	}else{ 
		
		if (window.soundwindow.soundplayercrub2 != false){
			//window.soundwindow.timersoundIDloadwindow=window.soundwindow.clearTimeout(window.soundwindow.timersoundIDloadwindow);
			//window.soundwindow.timersoundIDloadwindow= window.soundwindow.setTimeout("updatesoundstart ()",70);	
			window.soundwindow.soundplayercrub2 = false;
		}
	}
}

function updatesoundstart (){
	window.scrubbing = false;
}
function soundscrubend (event){ 
	if (window.soundplayercrub != false){
		var thetimeslider = document.getElementById("soundslider");
		var mousex = event.clientX;
		
		var newplace = mousex - document.getElementById("timeslider").offsetLeft -10;
		if (newplace < 0){newplace = 0;}
		if (newplace > 150){newplace = 150;}
		var duration = window.mySoundObject.durationEstimate;
		//var duration = window.myaudio.duration;
		//alert ((newplace / 150)  )
		//window.myaudio.currentTime = Math.floor((newplace / 150) * duration);
		//pos = parseFloat(((newplace) / 150) * duration)
		
		window.mySoundObject.setPosition((((newplace) / 150) * duration));
		thetimeslider.style.left = (newplace+10)+"px";
		//window.timersoundIDsetpos=setTimeout('window.mySoundObject.setPosition('+pos+');',270);	
		window.soundplayercrub = false;	
		//alert(window.mySoundObject.durationEstimate +" " + parseFloat(((newplace) / 150) * duration));
	}
	
}

function soundscrubend2 (event){ 
	if (window.soundwindow.soundplayercrub2 != false){
		var thetimeslider = document.getElementById("soundslider");
		var mousex = event.clientX;
		
		var newplace = mousex - document.getElementById("timeslider").offsetLeft -10;
		if (newplace < 0){newplace = 0;}
		if (newplace > 150){newplace = 150;}
		var duration = window.soundwindow.mySoundObject.durationEstimate;
		window.soundwindow.mySoundObject.setPosition((((newplace) / 150) * duration));
		thetimeslider.style.left = (newplace)+"px";
		//window.soundwindow.timersoundIDloadwindow=window.soundwindow.setTimeout("updatesound ()",70);	
		window.soundwindow.soundplayercrub2 = false;	
	}
}
function stopscrub2(event){
	soundscrubend2(event);
}
function stopscrub(event){
	
	soundscrubend(event);
	
}

 
function playsound (url){
	
	if (window.startloading == true){	
		window.mySoundObject.destruct();
		window.firstplay = true;		
	}else{
		
	}
	window.mySoundObject = soundManager.createSound({id:'mySound', autoPlay: true, url: '../../'+url,	
		onplay: function() {
			document.getElementById("playpauze").src = '../../'+themeurl+'musicplayer/pauze.png';
			if (window.opener){
				window.parentwindow.document.getElementById("playpauzeaudio").src = themeurl+'musicplayer/pauze.png';
			}
		},
		onresume: function() {
			document.getElementById("playpauze").src = '../../'+themeurl+'musicplayer/pauze.png';
			if (window.opener){
				window.parentwindow.document.getElementById("playpauzeaudio").src = themeurl+'musicplayer/pauze.png';
			}
		},
		onpause: function() {
			document.getElementById("playpauze").src = '../../'+themeurl+'musicplayer/play.png';
			if (window.opener){
				window.parentwindow.document.getElementById("playpauzeaudio").src = themeurl+'musicplayer/play.png';
			}
		},
		onfinish: function() {
			nextsound ();
		},
		whileplaying: function() {
			updatesound ()
		},
		onload: function () {
			window.firstplay = false;
		}
	});
	window.startloading = true;
	updatesoundgal ();
}

function opensoundplayer (){
	window.soundwindow = window.open("./plugins/Sounds2/musicplayer.php?soundgalnum="+window.mainsoundgalnum,"artistmindmusicplayer", "menubar=1,resizable=1,scrollbars=1,width=300,height=400", false);
	window.soundwindow.focus();
}

function formatSecondsAsTime(secs, format) {
  var hr  = Math.floor(secs / 3600);
  var min = Math.floor((secs - (hr * 3600))/60);
  var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

  if (min < 10){ 
    min = "0" + min; 
  }
  if (sec < 10){ 
    sec  = "0" + sec;
  }

  return +min + ':' + sec;
}

function updatesound (){
	
	if (window.soundplayercrub == false ){
		window.soundplayercrub = false;
		
		
		var currTime = window.mySoundObject.position/1000;  
		var duration = window.mySoundObject.durationEstimate/1000; 
		
		document.getElementById("soundslider").style.left= ((currTime/duration*150)-10)+'px';
		document.getElementById("curaudiotime").innerHTML = formatSecondsAsTime(currTime);
		  if (isNaN(duration)){
			document.getElementById("curaudiolength").innerHTML = '00:00';
		  } 
		  else{
			document.getElementById("curaudiolength").innerHTML = formatSecondsAsTime(duration);
		  }
		
		if (window.opener){
		if ( window.soundwindow.soundplayercrub2 == false){
			window.soundwindow.soundplayercrub2 = false;
			window.parentwindow.document.getElementById("soundslider").style.left= ((currTime/duration*150)-10)+'px';
			window.parentwindow.document.getElementById("curaudiotime").innerHTML = formatSecondsAsTime(currTime);
			if (isNaN(duration)){
				window.parentwindow.document.getElementById("curaudiolength").innerHTML = '00:00';
			  } 
			  else{
				window.parentwindow.document.getElementById("curaudiolength").innerHTML = formatSecondsAsTime(duration);
			  }
			  window.parentwindow.document.getElementById("soundplayer").style.display="block";
			  window.parentwindow.soundwindow = window.soundwindow;
			  window.parentwindow.document.getElementById("titlesound").innerHTML = "<b>" + window.mainsoundgal[window.cursound].title +"</b> - <i>" + window.mainsoundgal[window.cursound].Author + "</i>";
			  }
		}
	}
}

function playpauze (){
	var statsound = window.soundManager.togglePause('mySound');
}
function nextsound (){
	document.getElementById("playpauze").src = '../../'+themeurl+'musicplayer/play.png';
	if (window.opener){
		window.parentwindow.document.getElementById("playpauzeaudio").src = themeurl+'musicplayer/play.png';
	}
	window.cursound++
	if (window.cursound > window.mainsoundgal.length -1){
		window.cursound = window.mainsoundgal.length -1;
	}else{
		playsound (window.mainsoundgal[window.cursound].url)
		
	}
}
function prevsound (){
	document.getElementById("playpauze").src = '../../'+themeurl+'musicplayer/play.png';
	if (window.opener){
		window.parentwindow.document.getElementById("playpauzeaudio").src = themeurl+'musicplayer/play.png';
	}
	window.cursound--
	if (window.cursound < 0){
		window.cursound = 0
	}else{
		playsound (window.mainsoundgal[window.cursound].url)
	}
}


updatesound ();
</script>