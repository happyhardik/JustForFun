<?php

require_once('whois.config.php');
require_once('parser.class.php');
require_once('requesthelper.class.php');
require_once('data/requests.php');

class request {
	public function __construct() {
	
	}
	public function getwhois($domain) {
		$output = $domain;
		if(!$this->validDomain($domain)) {
			$message = "Domain is not valid";
			return $message;
		}
		$tld = $this->getTLD($domain);
		$whois_obj = new whois_class();		
		$whois_data = $whois_obj->getWhoisDetails(".".$tld);
		$server = $whois_data['server'];
		$queryformat = $whois_data['queryformat'];
		$port = $whois_data['port'];
		$request_helper = new request_helper();
		if($queryformat != null) {
			//should use regex here
			$data = str_replace("$*",$domain."\n\r",$queryformat);
		}
		else {
			$data = $domain."\n\r";
		}
		$output = $request_helper->requestData($server, $port, $data);
		$parser = new parser();
		$need_further_request = $parser->parseData($output);
		if($need_further_request) {
			//keeping the second request
			$whois_server2 = $parser->whois_server;
			//$data = "domain ".$domain."\n\r";
			$data = $domain."\n\r";
			$output = $whois_server2;
			$output = $request_helper->requestData(trim($whois_server2), $port, $data);
		}
		
		//save request data to the database
		$dbdata = array('domain' => $domain, 'userip' => '123.123.123.123' , "others" => ' other stuff to store');
		$requestsdb = new requestsdb();
		$requestsdb->save($dbdata);
		
		//return the output data
		return $output;
	}
	private function validDomain($domain) {
		return true;
	}
	private function getTLD($domain) {
		$parts = explode('.', $domain);		
		return $parts[sizeof($parts)-1];
	}
}