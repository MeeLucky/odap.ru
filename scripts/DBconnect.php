<?php 
$DB_HOST = 'localhost';
$DB_NAME = 'root';
$DB_PASS = '';
$DB_DBNAME = 'resultsofcompetitions';

$link = mysqli_connect($DB_HOST, $DB_NAME, $DB_PASS, $DB_DBNAME);

function DBQuery ($query) 
{
	global $link;
	$result = mysqli_query($link, $query);
	for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

	return $data; 
}