<?php

//ASSIGN VARIABLES TO USER INFO
$time = date("M j G:i:s Y");
$ip = getenv('REMOTE_ADDR');
$userAgent = getenv('HTTP_USER_AGENT');
$referrer = getenv('HTTP_REFERER');
$query = getenv('QUERY_STRING');

//COMBINE VARS INTO OUR LOG ENTRY
$msg = "IP: " . $ip . " TIME: " . $time . " REFERRER: " . $referrer . " SEARCHSTRING: " . $query . " USERAGENT: " . $userAgent." VARIABLES GET: ".  fetch_query_string(). " VARIABLES POST : ".  fetch_query_stringPost();

//CALL OUR LOG FUNCTION
writeToLogFile($msg);

function writeToLogFile($msg) {
    $today = date("Y_m_d");
    $logfile = $today . "_log.txt";
    $dir = 'logs/' . $_SERVER["SERVER_NAME"];


    if (!file_exists($dir) and !is_dir($dir)) {
        @mkdir($dir);
    }


    $saveLocation = $dir . '/' . $logfile;
    if (!$handle = @fopen($saveLocation, "a")) {
        exit;
    } else {
        if (@fwrite($handle, "$msg\r\n") === FALSE) {
            exit;
        }

        @fclose($handle);
    }
}
function fetch_query_string($exclusions = array())
{
	$str = "";
	
	foreach ($_GET as $key => $val)
	{
		if (!in_array($key, $exclusions))
		{
			$str .= $key . "=" . $val . "&";
		}
	}
	
	$str = substr($str, 0, strlen($str) - 1);
	
	return $str;
}
function fetch_query_stringPost($exclusions = array())
{
	$str = "";
	
	foreach ($_POST as $key => $val)
	{
		if (!in_array($key, $exclusions))
		{
			$str .= $key . "=" . $val . "&";
		}
	}
	
	$str = substr($str, 0, strlen($str) - 1);
	
	return $str;
}

?>