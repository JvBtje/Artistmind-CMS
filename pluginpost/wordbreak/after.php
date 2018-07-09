<script language="javascript">
function textWrap(text) {
	new_text = "";
	
	
	sizeof = text.length; 
	ii = 0;
	stat = 0;
	
	
	for (i=0; i<sizeof+1; i++) { 
	
		thechar = text.substring(i, i+1);
		new_text = new_text + thechar;
		
		
		switch (stat) {
			case 0:
				if (thechar == "<"){
					stat = 1;
					
					scripttest = text.substring( i, i+ 7).toLowerCase()
					scripttest = scripttest.replace(' ', '' );
					if (scripttest == "<script"){
						stat = 9;
					}
					
					scripttest = text.substring( i, i+ 9).toLowerCase()
					scripttest = scripttest.replace(' ', '' );
					if (scripttest == "<textarea"){
						stat = 10;
					}
					
					scripttest = text.substring( i, i+ 7).toLowerCase()
					scripttest = scripttest.replace(' ', '' );
					if (scripttest == "<nowbr>"){
						stat = 11;
					}
					scripttest = text.substring( i, i+ 5).toLowerCase()
					scripttest = scripttest.replace(' ', '' );
					if (scripttest == "<code"){
						stat = 12;
						
					}
					
				}	
				if (thechar == " " || thechar == "&"){
					ii=0;
				}		
				break;
			case 1:
				if (thechar == ">"){
					stat = 0;
				}
				
				if (thechar == "'" || thechar == '"'){
					thecharb = text.substring( i-1, i+ 1);
					if (thechar != "\\\\" ){
						stat = 2;
					}
				}
				break;
			case 2:
				if (thechar == "'" || thechar == '"'){
					if (thechar != "\\\\" ){
						stat = 1;
					}					
				}
				break;
			case 9:
				scripttest = text.substring( i, i+9).toLowerCase()
				scripttest = scripttest.replace(' ', '' );
				if (scripttest == '<\/script>'){
						stat = 0;
						ii = -9;
				}
				break;
			case 10:
				scripttest = text.substring( i, i+11).toLowerCase()
				scripttest = scripttest.replace(' ', '' );
				if (scripttest == '<\/textarea>'){
						stat = 0;
						ii = -11;
				}
				break;
			case 11:
				scripttest = text.substring( i, i+8).toLowerCase()
				scripttest = scripttest.replace(' ', '' );
				if (scripttest == '<\/nowbr>'){
						stat = 0;
						ii = -11;
				}
				break;
			case 12:
				scripttest = text.substring( i, i+7).toLowerCase()
				scripttest = scripttest.replace(' ', '' );
				if (scripttest == '<\/code>'){
						stat = 0;
						ii = -11;
						
				}
				break;
		}		
		
		if (stat == 0){
			ii++;
		}
		
			if (ii == 10){
				if (text.substring(i+1, i+2) == " " || text.substring(i+1, i+2) == "." || text.substring(i+1, i+2) == "	" || text.substring(i, i+1) == ">" ){
					ii = 0;
				}else{
					ii = 0;
					new_text = new_text + "<wbr>";
				}
			}
			
		}
		
		return new_text;
    } 
	
	//document.getElementById("outputhtml").value = textWrap (document.getElementById("Middel").innerHTML );
	document.getElementById("Middel").innerHTML = textWrap (document.getElementById("Middel").innerHTML );
	</script>
	