<?php
App::uses('Component', 'Controller');

class MinifierComponent extends Component
{	

	public static function normalize($arr = array(), $extention = 'minify')
	{	
		$newArr = array();
		foreach ($arr as $file) {
			$fileType = substr($file,  strrpos($file, '.'), strlen($file));
			$fileName = substr($file, 0, (strlen($file) - strlen($fileType)) );

			$newArr[$file] = $fileName . '.' . $extention . $fileType;
		}
		return $newArr;
	}

	public static function checkSize($arr = array())
	{
		foreach ($arr as $key => $value) {
			debug($key);
			debug($value);
		}
	}

	public static function minifyJS($arr){
	    if( MinifierComponent::minify($arr, 'https://javascript-minifier.com/raw') ) 
	    	return true;
	}

	public static function minifyCSS($arr){
		if ( MinifierComponent::minify($arr, 'https://cssminifier.com/raw') )
	    	return true;
	}

	public static function minify($arr, $url) {
	    foreach ($arr as $key => $value) {
	        $handler = fopen($value, 'w');
	        
	        if ($handler === false) {
	        	return false;
	        }

	        if( fwrite($handler, MinifierComponent::getMinified($url, file_get_contents($key))) === false )
	        {
	        	return false;
	        }

	        if ( fclose($handler) === false ) {
	        	return false;
	        }
	    }
	    return true;
	}

	public static function getMinified($url, $content) {
	    $postdata = array('http' => array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query( array('input' => $content) ) ) );
	    return file_get_contents($url, false, stream_context_create($postdata));
	}

	public static function getMinifiedCurl($url, $content, $sslcheck = false, $sslv3 = false)
	{	
		// init the request, set some info, send it and finally close it
	    $ch = curl_init($url);

	    $data = array(
        	'input' => $content,
    	);
	    
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $sslcheck);
        if ($sslv3) {
            curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        }
	    $minified = curl_exec($ch);
	    curl_close($ch);
	   	
	    if ($minified !== false) {
	    	throw new Exception("Error: " . $minified, 400);
	    	
	    }

	    return $minified;
	}
}