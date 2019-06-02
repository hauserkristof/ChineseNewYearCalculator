<?php
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
		//loop through the year
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

		//$str=$dates_array[$shortest_key];
		$str=($year-1).'-12-22';
		//$date2 = strtotime($str);
		$dt = new DateTime($str);
		//var_dump($dt);
		//$dt->setTimestamp($date2);

		$moon = new Solaris\MoonPhase($dt);

		//var_dump($moon->get_phase('next_new_moon'));

		$dtY=new DateTime();
		$dtY = DateTime::createFromFormat('U', round($moon->get_phase('next_new_moon')));

		$next =$dtY->format('Y-M-d G:i:s');
		//var_dump($dtY->format('Y-M-d G:i:s'));
		//$date2=strtotime($next);
		//var_dump($moon);

		echo "1.: $next <br/>";

		//$prevMoon=$date2;

		$date2=round($moon->get_phase('next_new_moon'))+(24*60*60);
		$dtY->add(new DateInterval('P1D'));

		//$date2=strtotime('+1 day',$date2);
		$dt = new DateTime($dtY->format('Y-m-d'));

		var_dump($dt);
		$moon2 = new Solaris\MoonPhase($dt);
		//$next = date('Y-M-d G:i:s', $moon2->get_phase('next_new_moon'));
		//$date2=strtotime($next);
		var_dump($moon2->get_phase('next_new_moon'));


		$dtY = DateTime::createFromFormat('U', round($moon2->get_phase('next_new_moon')));
		$next =$dtY->format('Y-M-d G:i:s');
		$date2=round($moon2->get_phase('next_new_moon'))+(24*60*60);
		$dtY->add(new DateInterval('P1D'));
		echo "2.: $next <br/>";


		$prevMoon=$date2;


		$date2=round($moon2->get_phase('next_new_moon'))+(24*60*60);
		$dtY->add(new DateInterval('P1D'));
		//$date2=strtotime('+1 day',$date2);
		$dt = new DateTime($dtY->format('Y-m-d'));

		//var_dump($dt);
		$moon3 = new Solaris\MoonPhase($dt);
		//$next = date('Y-M-d G:i:s', $moon2->get_phase('next_new_moon'));
		//$date2=strtotime($next);
		//var_dump($moon->get_phase('next_new_moon'));
		$dtY = DateTime::createFromFormat('U', round($moon3->get_phase('next_new_moon')));
		$next =$dtY->format('Y-M-d G:i:s');
		$date2=round($moon3->get_phase('next_new_moon'))+(24*60*60);
		//$dtY->add(new DateInterval('P1D'));
/*		$date2=strtotime('+1 day',$date2);
		$dt->setTimestamp($date2);		
		$moon3 = new Solaris\MoonPhase($dt);
		$next = date('Y-M-d G:i:s', $moon3->get_phase('next_new_moon'));
		$date2=strtotime($next);*/
		echo "3.: $next <br/>";

		$lastMoon=$date2;

		/*$str=$year.'-02-04';
		$date2 = strtotime($str);
		$dt = new DateTime();
		$dt->setTimestamp($date2);		
		$moon = new Solaris\MoonPhase($dt);
		$next = date('Y-M-d G:i:s', $moon->get_phase('next_new_moon'));
		$date2=strtotime($next);

		$prevMoon=$date2;

		$dt->setTimestamp($date2);
		$moon = new Solaris\MoonPhase($dt);
		$next = date('Y-M-d G:i:s', $moon->get_phase('next_new_moon'));
		$lastMoon=strtotime($next);*/

		$dtX = new DateTime(($year.'-02-20'));

		//$moonDate=strtotime(($year.'-02-20'));
		echo "(".($dtY->format('Y-m-d')).") ". $lastMoon.' - '.$dtX->format('U')."(".($year.'-02-20').")<br/>";


		if($lastMoon>$dtX->format('U')){
			$dtFin=new DateTime();
			$dtFin = DateTime::createFromFormat('U', $prevMoon);

			echo "the chinesee new year in ".$year." is at: ".$dtFin->format('Y-M-d H:m:i')."<br/><br/>";
		}else{
			$dtFin=new DateTime();
			$dtFin = DateTime::createFromFormat('U', $lastMoon);

			echo "the chinesee new year in ".$year." is at: ".$dtFin->format('Y-M-d H:m:i')."<br/><br/>";
		}

	}

	for($i=1800;$i<1820;$i++){
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
?>