<?php
$time = "6:21.11";


$time = TimeToSec($time);
echo "<br>-----<br>";
echo $time;

function toTime($time) {
	$sec = floor($time);
	$sub = round(($time - $sec) * 100);

	if($sec >= 60) {
		$min = floor($sec / 60);
		$sec = $sec % 60;
	}

	if($sub < 10 && $sub >= 0) $sub = "0".$sub;
	if($sec < 10 && $sec >= 0) $sec = "0".$sec;
	if($min > 0) $min = $min.":";

	return "$min$sec.$sub";
}

function toFixed($num)
{
	$p = strpos($num, ".");

	return substr($num, 0, $p+3);
}

function TimeToSec($time) {
	$dot2 = strpos($time, ':');
	if($dot2 > 0) {
		$min = substr($time, 0, $dot2);
		$time = substr($time, $dot2+1);
	}
		
	return $min * 60 + $time;
}