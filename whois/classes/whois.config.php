<?php 
class whois_class {
	
	public $whois_list; 

	public function __construct() {
		//get who is list from 
		//http://cvs.savannah.gnu.org/viewvc/jwhois/jwhois/example/jwhois.conf
		$this->whois_list = array(
		".com" => array("server" => "whois.verisign-grs.com", "queryformat"=> "domain $*", "port" => 43),
		".net" => array("server" => "whois.verisign-grs.com", "queryformat"=> "domain $*", "port" => 43),
		".info" => array("server" => "whois.afilias.info", "queryformat"=> null, "port" => 43),
		".in" => array("server" => "whois.inregistry.in", "queryformat"=> null, "port" => 43),
		);
	}
	
	public function getWhoisDetails($tld) {		
		return $this->whois_list[$tld];
	}
	
}