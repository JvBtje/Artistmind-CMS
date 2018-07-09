<?php
$searchitem =mb_strtolower($searchitem);
$verschil = 0;
$verschil += (substr_count($searchitem, $keyword) )+2;
preg_match("/\b$keyword\b/", strip_tags ($searchitem), $matches);
$verschil = $verschil+(count($matches)  +2);
$verschil = $verschil * $importend;

if ($verschil < 1){
	array_push($PageId, array( "Id"=>$GroupMainId));
}else{
	for($i=0; $i<$verschil;$i++){					
		array_push($PageId, array( "Id"=>$GroupMainId));
	}
}
?>