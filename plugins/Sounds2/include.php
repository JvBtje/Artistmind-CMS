<?php
/*
002
	 
003
	// set error reporting level
004
	if (version_compare(phpversion(), '5.3.0', '>=') == 1)
005
	  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
006
	else
007
	  error_reporting(E_ALL & ~E_NOTICE);
008
	 
009
	 
010
	// gathering all mp3 files in 'mp3' folder into array
011
	$sDir = 'mp3/';
012
	$aFiles = array();
013
	$rDir = opendir($sDir);
014
	if ($rDir) {
015
	    while ($sFile = readdir($rDir)) {
016
	        if ($sFile == '.' or $sFile == '..' or !is_file($sDir . $sFile))
017
	            continue;
018
	 
019
	        $aPathInfo = pathinfo($sFile);
020
	        $sExt = mb_strtolower($aPathInfo['extension']);
021
	        if ($sExt == 'mp3') {
022
	            $aFiles[] = $sDir . $sFile;
023
	        }
024
	    }
025
	    closedir( $rDir );
026
	}
027
	 
028
	// new object of our ID3TagsReader class
029
	$oReader = new ID3TagsReader();
030
	 
031
	// passing through located files ..
032
	$sList = $sList2 = '';
033
	foreach ($aFiles as $sSingleFile) {
034
	    $aTags = $oReader->getTagsInfo($sSingleFile); // obtaining ID3 tags info
035
	    $sList .= '<tr><td>'.$aTags['Title'].'</td><td>'.$aTags['Album'].'</td><td>'.$aTags['Author'].'</td>
036
	                    <td>'.$aTags['AlbumAuthor'].'</td><td>'.$aTags['Track'].'</td><td>'.$aTags['Year'].'</td>
037
	                    <td>'.$aTags['Lenght'].'</td><td>'.$aTags['Lyric'].'</td><td>'.$aTags['Desc'].'</td>
038
	                    <td>'.$aTags['Genre'].'</td></tr>';
039
	 
040
	    $sList2 .= '<tr><td>'.$aTags['Title'].'</td><td>'.$aTags['Encoded'].'</td><td>'.$aTags['Copyright'].'</td>
041
	                    <td>'.$aTags['Publisher'].'</td><td>'.$aTags['OriginalArtist'].'</td><td>'.$aTags['URL'].'</td>
042
	                    <td>'.$aTags['Comments'].'</td><td>'.$aTags['Composer'].'</td></tr>';
043
}

 

// main output

echo strtr(file_get_contents('main_page.html'), array('__list__' => $sList, '__list2__' => $sList2));

 */

 

// class ID3TagsReader

class ID3TagsReader {

 

    // variables

    var $aTV23 = array( // array of possible sys tags (for last version of ID3)

        'TIT2',

        'TALB',

        'TPE1',

        'TPE2',

        'TRCK',

        'TYER',

        'TLEN',

        'USLT',

        'TPOS',

        'TCON',

        'TENC',

        'TCOP',

        'TPUB',

        'TOPE',

        'WXXX',

        'COMM',

        'TCOM'

    );

    var $aTV23t = array( // array of titles for sys tags

        'Title',

        'Album',

        'Author',

        'AlbumAuthor',

        'Track',

        'Year',

        'Lenght',

        'Lyric',

        'Desc',

        'Genre',

        'Encoded',

        'Copyright',

        'Publisher',

        'OriginalArtist',

        'URL',

        'Comments',

        'Composer'

    );

    var $aTV22 = array( // array of possible sys tags (for old version of ID3)

        'TT2',

        'TAL',

        'TP1',

        'TRK',

        'TYE',

        'TLE',

        'ULT'

    );

    var $aTV22t = array( // array of titles for sys tags

        'Title',

        'Album',

        'Author',

        'Track',

        'Year',

        'Lenght',

        'Lyric'

    );

 

    // constructor

    //function ID3TagsReader() {}

 

    // functions

    function getTagsInfo($sFilepath) {

        // read source file

        $iFSize = filesize($sFilepath);

        $vFD = fopen($sFilepath,'r');

        $sSrc = fread($vFD,$iFSize);

        fclose($vFD);

 

        // obtain base info

        if (substr($sSrc,0,3) == 'ID3') {

            $aInfo['FileName'] = $sFilepath;

            $aInfo['Version'] = hexdec(bin2hex(substr($sSrc,3,1))).'.'.hexdec(bin2hex(substr($sSrc,4,1)));

        }
		

        // passing through possible tags of idv2 (v3 and v4)

        if ($aInfo['Version'] == '4.0' || $aInfo['Version'] == '3.0') {

            for ($i = 0; $i < count($this->aTV23); $i++) {

                if (strpos($sSrc, $this->aTV23[$i].chr(0)) != FALSE) {

 

                    $s = '';

                    $iPos = strpos($sSrc, $this->aTV23[$i].chr(0));

                    $iLen = hexdec(bin2hex(substr($sSrc,($iPos + 5),3)));

 

                    $data = substr($sSrc, $iPos, 10 + $iLen);
					
                    for ($a = 0; $a < strlen($data); $a++) {

                        $char = substr($data, $a, 1);
						$char2 = substr($data, $a+1, 1);
						
                        if ($char >= ' ' && $char <= '~'){
                            $s .= $char;
						}else if (ord($char).ord($char2) == "255254"){
							
							$s = substr($s, 0,4);						
						}

                    }

                    if (substr($s, 0, 4) == $this->aTV23[$i]) {

                        $iSL = 4;

                        if ($this->aTV23[$i] == 'USLT') {

                            $iSL = 7;

                        } elseif ($this->aTV23[$i] == 'TALB') {

                            $iSL = 4;

                        } elseif ($this->aTV23[$i] == 'TENC') {

                            $iSL = 6;

                        }

                        $aInfo[$this->aTV23t[$i]] = substr($s, $iSL);

                    }

                }

            }

        }

 

        // passing through possible tags of idv2 (v2)

        if($aInfo['Version'] == '2.0') {

            for ($i = 0; $i < count($this->aTV22); $i++) {

                if (strpos($sSrc, $this->aTV22[$i].chr(0)) != FALSE) {

 

                    $s = '';

                    $iPos = strpos($sSrc, $this->aTV22[$i].chr(0));

                    $iLen = hexdec(bin2hex(substr($sSrc,($iPos + 3),3)));

 

                    $data = substr($sSrc, $iPos, 6 + $iLen);

                    for ($a = 0; $a < strlen($data); $a++) {

                        $char = substr($data, $a, 1);

                        if ($char >= ' ' && $char <= '~')

                            $s .= $char;

                    }

 

                    if (substr($s, 0, 3) == $this->aTV22[$i]) {

                        $iSL = 3;

                        if ($this->aTV22[$i] == 'ULT') {

                            $iSL = 6;

                        }

                        $aInfo[$this->aTV22t[$i]] = substr($s, $iSL);

                    }

                }

            }

        }

        return $aInfo;

}

}?>