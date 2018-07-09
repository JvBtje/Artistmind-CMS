<script language="javascript">
if (window.embedder instanceof Array ){

}else{
	window.embedder = new Array();
}

function createembedder (id, tag, thediv){	
	tmparray = new Array();
	tmparray.tag = tag;	
	tmparray.oldwidth = -1;
	document.getElementById(thediv).innerHTML = tag;
	tmparray.thediv = thediv;	
	tmparray.aspectratio = document.getElementById(thediv).children[0].height / document.getElementById(thediv).children[0].width
	window.embedder[id] = tmparray;	
	resizeframe();
}
</script>