<?php
$newitemstring="";
$newitemstring .='<div  id="newdocument" style="text-align:left;"><div id="buttonlayout"><h4>new</h4></div></div>';

$after .= '<div id="Menudocument_child" style="position:absolute;">
<Table id="subMainmenu" width="200"><tr><td>';
$root = scandir('./plugins'); 

foreach($root as $value)
{ 
	if ($value != 'default' and $value != '.' and $value != '..'){
		$after .= '<a href="indexadminnew.php?plugin='.$value.'&type=new&sectie='.$sectie.'"><h4>New '.$value.'</h4>';
	}
} 
	/*<a href="groepen.php?type=new&sectie=<?php echo $sectie ; ?>"><h4>New group</h4></a>
	<a href="richtext.php?type=new&sectie=<?php echo $sectie ; ?>"><h4>New richt text</h4></a>
	<a href="Gallery.php?type=new&sectie=<?php echo $sectie ; ?>"><h4>New Gallery</h4></a>
	<a href="lijst.php?type=new&sectie=<?php echo $sectie ; ?>"><h4>New List</h4></a>
	<a href="form.php?type=new&sectie=<?php echo $sectie ; ?>"><h4>New Form</h4></a>*/
	$after .= '</tr></table></div><script type="text/javascript">at_attach("newdocument", "Menudocument_child", "hover", "y", "pointer","");</script>';
return $newitemstring;
?>