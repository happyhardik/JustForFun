<?php 

class parser {
	
	public $whois_server;
	
	public function __construct() {
		$this->whois_server = "";
	}
	
	public function parseData($data) {
		$arr1 = explode("Whois Server:", $data);
		if(sizeof($arr1)>1) {
			$arr2 = explode("Referral URL:", $arr1[1]);
			$this->whois_server = $arr2[0];
			return true;
		} else	
		{
			return false;
		}
	}
	
}