<?php // no direct access
defined('_JEXEC') or die('Restricted access');

	/**
	 * Get current page url 
	 * @return string String of current page url
	 */
	function curPageURL() {
		$pageURL = 'http';
	 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 		$pageURL .= "://";
	 	if ($_SERVER["SERVER_PORT"] != "80") {
	  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 	} else {
	  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 	}
	 	
	 	
	 	$pos1 = stripos($_SERVER["REQUEST_URI"], "/index.php");
		//$pos2 = stripos($meinstring2, $findmich);
		
		// 'a' ist natürlich nicht in 'xyz' enthalten
		if ($pos1 === false) {
		    //echo "Die Zeichenkette '$findmich' kommt nicht im String '$meinstring1' vor.";
		}else{
			$pageURL = 'http';
			$pageURL .= "://";
			$pageURL .= $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"], 0, $pos1);
		}
	 	//echo "ServerName: " . $_SERVER["SERVER_NAME"];
	 	
	 	//echo "NewURI: " . $pageURL;
	 	return $pageURL;	
	}
	
	$sroot = '';
	/*$pos = strpos(parse_url(curPageURL(), PHP_URL_PATH), "/", 1);
	if ($pos === false) { // Beachten sie die drei Gleichheitszeichen
	    // nicht gefunden ...
	    echo "NOT FOUND";*/
	    $sroot = curPageURL() . '/components/com_jevent';  // bcd	
	/*}else{
		$sroot = substr(parse_url(curPageURL(), PHP_URL_PATH), 0, $pos).'/components/com_jevent';  // bcd	
	}*/
	//echo "ROOT: " . $sroot; 
	$googleMapsLink = 'http://maps.google.com/maps?q=';
?>