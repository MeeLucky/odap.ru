<?php 
$DB_HOST = 'localhost';
$DB_NAME = 'root';#o95037n0_general
$DB_PASS = '';
$DB_DBNAME = 'resultsofcompetitions';#o95037n0_general

$link = mysqli_connect($DB_HOST, $DB_NAME, $DB_PASS, $DB_DBNAME);

function DBQuery ($query) 
{
	global $link;//я не шарю зачем это но боюсь убрать :)
	$result = mysqli_query($link, $query);
	for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

	return $data; 
}