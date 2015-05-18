<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$output = "";
if(isset($_REQUEST['domain'])) {
	require_once('classes/request.class.php');
	$request = new request();
	$output = $request->getwhois($_REQUEST['domain']);
}
//should include header here
require_once('views/main.php');
if($output != "") {
	echo "<br /><br /><textarea rows='50' cols='100'>". $output ."</textarea>";
}
//footer
?>
