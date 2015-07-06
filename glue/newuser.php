<?php
die();
require('routeros_api.class.php');

$API = new routeros_api();

$API->debug = true;

if ($API->connect('10.168.192.11', 'admin', '')) {



	$API->comm("/ip/hotspot/user/add", array(
			  "name"     => "user2",
			  "password" => "pass2",
			  "profile" => "default"
	));


   $API->disconnect();

}

?>