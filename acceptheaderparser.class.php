<?php

class AcceptHeaderParser {

    function getAcceptHeader(){
        if(isset($_SERVER['HTTP_ACCEPT'])) return trim($_SERVER['HTTP_ACCEPT']);
        else return null;
    }
    
    function getAcceptTypes($defaultTypes = array()){
        $header = $this->getAcceptHeader();
        $mimes = explode(',',$header);
    	$accept_mimetypes = array();
	
        foreach($mimes as $mime){
        $mime = trim($mime);
    		$parts = explode(';q=', $mime);
    		if(count($parts)>1){
    			$accept_mimetypes[$parts[0]]=strval($parts[1]);
    		}
    		else {
    			$accept_mimetypes[$mime]=1;
    		}
    	}
  /* prefer html, then xhtml, then anything in the default array, to mimetypes with the same value. this is because WebKit browsers (Chrome, Safari, Android) currently prefer xml and even image/png to html */
  $defaultTypes = array_merge(array('text/html', 'application/xhtml+xml'), $defaultTypes);
	foreach($defaultTypes as $defaultType){
		if(isset($accept_mimetypes[$defaultType])){	
			$count_values = array_count_values($accept_mimetypes);
			$defaultVal = $accept_mimetypes[$defaultType];
			if($count_values[$defaultVal] > 1){
				$accept_mimetypes[$defaultType]=strval(0.001+$accept_mimetypes[$defaultType]);
			}
		}
  }
    	arsort($accept_mimetypes);
    	return array_keys($accept_mimetypes);
    }
    
    function hasAcceptTypes(){
        $acceptheader = $this->getAcceptHeader();
        if(empty($acceptheader)){
           return false; 
        } else {
            return true;
        }
    }

}
?>
