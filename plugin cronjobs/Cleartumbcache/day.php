<?php
if  (isset($cachetumblengt)){
	$keepcachetumb = $cachetumblengt;
} else {
	$keepcachetumb = mktime(date("h")-336, date("m"), date("s"), date("m"), date("d"), date("Y"));
}
$dir ="./system/imgtumbcache";
$files = scandir($dir);

foreach ($files as $file){
	if(!in_array($file,array(".",".."))){
		if (is_dir($dir.DIRECTORY_SEPARATOR.$file)){
			
		}else{
			//echo fileatime ($dir.DIRECTORY_SEPARATOR.$file)	< $keepcachetumb
			if (fileatime ($dir.DIRECTORY_SEPARATOR.$file)	< $keepcachetumb ){
				if (file_exists ($dir.DIRECTORY_SEPARATOR."tinynew".DIRECTORY_SEPARATOR.$file)){
					unlink($dir.DIRECTORY_SEPARATOR."tinynew".DIRECTORY_SEPARATOR.$file);
				}
				echo $dir.DIRECTORY_SEPARATOR.$file."<br>";
				//chmod($dir.'/'.$file,0777);
				unlink($dir.DIRECTORY_SEPARATOR.$file);
				
			}
		}
	}
}

?>