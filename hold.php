<?php
	$start=microtime(true);
	error_reporting(E_ALL);
	include_once('MoonPhase.php');
	// create an instance of the class, and use the current time
	
	date_default_timezone_set('Asia/Chongqing');

	function solstice($year){

		// Set timezone
		date_default_timezone_set('Asia/Chongqing');
		
		//$year=1973;

		$date=($year-1).'/01/01';

		$end_date=($year-1).'/12/31';

		$i = 0;
		/*//loop through the year
		while(strtotime($date)<=strtotime($end_date)) { 
			//$sunrise=date_sunrise(strtotime($date),SUNFUNCS_RET_DOUBLE,31.47,35.13,90,3);
			//$sunset=date_sunset(strtotime($date),SUNFUNCS_RET_DOUBLE,31.47,35.13,90,3);

			//china:
			$sunrise=date_sunrise(strtotime($date),SUNFUNCS_RET_DOUBLE, 39.916667, 116.383333,108,8);
			$sunset=date_sunset(strtotime($date),SUNFUNCS_RET_DOUBLE, 39.916667, 116.383333,108,8);


			//calculate time difference
			$delta = $sunset-$sunrise;
			//store the time difference
			$delta_array[$i] = $delta;
			//store the date
			$dates_array[$i] = $date;
			$i++;
			//next day
			$date=date("Y-m-d",strtotime("+1 day",strtotime($date)));
		}

		$shortest_key = array_search(min($delta_array), $delta_array);
		$longest_key = array_search(max($delta_array), $delta_array);

		echo "The longest day is:".$dates_array[$longest_key]. "<br />";
		echo "The shortest day is:".$dates_array[$shortest_key]. "<br />";

		//$str=$dates_array[$shortest_key];*/
		$str=($year-1).'-12-22';
		//$date2 = strtotime($str);
		$dt = new DateTime($str);
		
		$moon = new Solaris\MoonPhase($dt);
		$dtY=new DateTime();
		$dtY = DateTime::createFromFormat('U', round($moon->get_phase('next_new_moon')));
		$next =$dtY->format('Y-M-d G:i:s');

		$firstMoon = new DateTime();
		$firstMoon = DateTime::createFromFormat('U', round($moon->get_phase('next_new_moon')));


		//echo "1.: $next <br/>";

		//$prevMoon=$date2;

		$dtY->add(new DateInterval('P2D'));
		$dt = new DateTime($dtY->format('Y-m-d'));
		$moon2 = new Solaris\MoonPhase($dt);

		$dtY = new DateTime();
		$dtY = DateTime::createFromFormat('U', round($moon2->get_phase('next_new_moon')));
		$next =$dtY->format('Y-M-d G:i:s');


		$secondMoon = new DateTime();
		$secondMoon = DateTime::createFromFormat('U', round($moon2->get_phase('next_new_moon')));

		$prevMoon=$next;
		//echo "2.: $next <br/>";


		$dtY->add(new DateInterval('P2D'));		
		$dt = new DateTime($dtY->format('Y-m-d'));
		$moon3 = new Solaris\MoonPhase($dt);

		$dtY=new DateTime();
		$dtY = DateTime::createFromFormat('U', round($moon3->get_phase('next_new_moon')));
		$next =$dtY->format('Y-M-d G:i:s');
		
		$thirdMoon = new DateTime();
		$thirdMoon = DateTime::createFromFormat('U', round($moon3->get_phase('next_new_moon')));

		$lastMoon=$next;


		//echo "3.: $next <br/>";


		$dtX = new DateTime(($year.'-02-20'));

		//$moonDate=strtotime(($year.'-02-20'));
		//echo "(".($thirdMoon->format('Y-m-d')).") ". $thirdMoon->format('U').' - '.$dtX->format('U')."(".($year.'-02-20').")<br/>";


		if($thirdMoon->format('U')>$dtX->format('U')){
			//echo 'the chinesee new year in '.$year.' is at: '.$secondMoon->format('Y-m-d H:m:i')."<br/><br/>";
			echo $year.chr(9).$secondMoon->format('Y-m-d')."<br/>";
/*
			echo $year.chr(9).$secondMoon->format('Y-m-d');
			$dtFin=new DateTime();
			$dtFin = DateTime::createFromFormat('U', $prevMoon);

			echo "the chinesee new year in ".$year." is at: ".$dtFin->format('Y-M-d H:m:i')."<br/><br/>";*/
		}else{
			//echo 'the chinesee new year in '.$year.' is at: '.$thirdMoon->format('Y-m-d H:m:i')."<br/><br/>";
			echo $year.chr(9).$thirdMoon->format('Y-m-d')."<br/>";
			/*
			$dtFin=new DateTime();
			$dtFin = DateTime::createFromFormat('U', $lastMoon);

			echo "the chinesee new year in ".$year." is at: ".$dtFin->format('Y-M-d H:m:i')."<br/><br/>";*/
		}

		unset($firstMoon);
		unset($secondMoon);
		unset($thirdMoon);
		unset($dt);
		unset($dtY);
	}

	for($i=1;$i<2223;$i++){
		solstice($i);
	}

//	solstice(1973);

	/*solstice(1998);

	$str='1998-02-04';
	$date = strtotime($str);
	$dt = new DateTime();
	$dt->setTimestamp($date);

	$moon = new Solaris\MoonPhase($dt);
	//$age = round($moon->get('age'), 1);
	//$stage = $moon->phase() < 0.5 ? 'waxing' : 'waning';
	//$distance = round($moon->get('distance'), 2);

	$next = date('Y-M-d G:i:s', $moon->get_phase('next_new_moon'));
	$new = date('Y-M-d G:i:s', $moon->get_phase('new_moon'));
	echo "$str ->  The next new moon is at $next. (".(round(  ( ( strtotime($next)-$date) / (60 * 60 * 24)) )).") | prev: $new (".(round( (($date-strtotime($new)) / (60 * 60 * 24)))).") <br/>";
	

	$str='1920-02-04';
	$date=strtotime($str);
	$dt->setTimestamp($date);
	$moon = new Solaris\MoonPhase($dt);
	$next = date('Y-M-d G:i:s', $moon->get_phase('next_new_moon'));
	$new = date('Y-M-d G:i:s', $moon->get_phase('new_moon'));
	echo "$str ->  The next new moon is at $next. (".(round(  ( ( strtotime($next)-$date) / (60 * 60 * 24)) )).") | prev: $new (".(round( (($date-strtotime($new)) / (60 * 60 * 24)))).")";	
	echo solstice(1920);*/

//	printf("%f s", (microtime(true)-$start));
?>