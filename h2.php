<?php
	error_reporting(E_ALL);
	include_once('MoonPhase.php');
	// create an instance of the class, and use the current time
	
	date_default_timezone_set('Asia/Chongqing');
	ini_set('date.default_latitude',39.916667);
	ini_set('date.default_longitude', 116.383333);
	ini_set('date.timezone','Asia/Chongqing');

	$str='1701-01-05';

	//$date2 = strtotime($str);
	try{
		$dt = new DateTime($str);
	}catch (Exception $e) {
	    echo $e->getMessage();
	    exit(1);
	}
	
	var_dump((float)$dt->format('U'));
	var_dump($dt);

	$unix=(float)$dt->format('U');

	$dtY=new DateTime($unix);
	$dtY = DateTime::createFromFormat('U', $unix);
	echo $dtY->format('Y-m-d');

	$moon = new Solaris\MoonPhase($dt);
	$next = gmdate('Y-M-d G:i:s', $moon->get_phase('next_new_moon'));
	echo "$next is the next";

?>