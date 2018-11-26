<?php
$tinypngkey = "";

require_once("tinify-php-master/lib/Tinify/Exception.php");
require_once("tinify-php-master/lib/Tinify/ResultMeta.php");
require_once("tinify-php-master/lib/Tinify/Result.php");
require_once("tinify-php-master/lib/Tinify/Source.php");
require_once("tinify-php-master/lib/Tinify/Client.php");
require_once("tinify-php-master/lib/Tinify.php");

\Tinify\setKey($tinypngkey);

/*$query = "SELECT tinyupdate FROM system WHERE Id=1";
		$result = mysqli_query($link,$query);
		if (!$result) {
    		die('Query failed: ' . mysqli_error($link));
		
		}
		while($row = mysqli_fetch_array($result)){
			$keepcachetumb = intval($row['tinyupdate']);
		}*/
			


/*if  (isset($cachetumblengt)){
	$keepcachetumb = $cachetumblengt;
} else {
	$keepcachetumb = mktime(date("h")-336, date("m"), date("s"), date("m"), date("d"), date("Y"));
}*/
$dir ="./system/imgtumbcache";
$files = scandir($dir);

foreach ($files as $file){
	if(!in_array($file,array(".",".."))){
		if (is_dir($dir.DIRECTORY_SEPARATOR.$file)){
			
		}else{
			$keepcachetumb =0;
			if (file_exists ($dir.DIRECTORY_SEPARATOR."tinynew".DIRECTORY_SEPARATOR.$file)){
				$keepcachetumb = fileatime ($dir.DIRECTORY_SEPARATOR."tinynew".DIRECTORY_SEPARATOR.$file);
			}
			if (fileatime ($dir.DIRECTORY_SEPARATOR.$file)	> $keepcachetumb ){
			$source = \Tinify\fromFile($dir.DIRECTORY_SEPARATOR.$file);
			$source->toFile($dir.DIRECTORY_SEPARATOR."tinynew".DIRECTORY_SEPARATOR.$file);			
			//mysqli_query($link,"UPDATE system SET tinyupdate = '".date ("Y-m-d H:i:s", fileatime ($dir.DIRECTORY_SEPARATOR.$file))."'") or die(mysqli_error($link)); 
			set_time_limit('1000');
			}
		}
	}

}

?>