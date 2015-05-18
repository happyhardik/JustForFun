<?php

class request_helper {
	public function __construct() {
		
	}
	
	public function requestData($url, $port, $data) {
		$fp = fsockopen($url, $port);
		fwrite($fp, $data);
		$output = "";
		while (!feof($fp)) {
			$output .= fgets($fp, 1024);
		}
		//echo "output ".$output;
		fclose($fp);
		return $output;
	}
}