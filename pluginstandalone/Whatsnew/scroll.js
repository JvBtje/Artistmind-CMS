	if (typeof(loaddocuments) === 'function'){
		clearTimeout(window.msgtimer3); 
		window.msgtimer3 = setTimeout("loaddocuments(window.thedocuments)", 1000); 
	}
	
	if (typeof(loadmessagewhatsnew) === 'function'){
		clearTimeout(window.msgtimer4); 
		window.msgtimer4 = setTimeout("loadmessagewhatsnew(window.themessage)", 1000); 
	}