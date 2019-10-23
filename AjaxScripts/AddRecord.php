<?php
session_start();
include "../scripts/PHPFunctions.php";

$table = $_GET['table'];
$name = $_GET['name'];
$tryes[] = TimeToSec($_GET['try1']);
$tryes[] = TimeToSec($_GET['try2']);
$tryes[] = TimeToSec($_GET['try3']);
$tryes[] = TimeToSec($_GET['try4']);
$tryes[] = TimeToSec($_GET['try5']);
$max = max($tryes);
$min = min($tryes);

$wasMax = false; $wasMin = false;
foreach ($tryes as $item) {
	if(!$wasMax and $item == $max)
	{
		$wasMax = true;
		continue;
	}
	if(!$wasMin and $item == $min)
	{
		$wasMin = true;
		continue;
	}

	$forAvg[] = $item;
}


$avg = round(array_sum($forAvg) / 3);
$owner = $_SESSION['sign'];

include "../scripts/DBconnect.php";
$query = "INSERT INTO 
records (id, owner, tableid, fio, try1, try2, try3, try4, try5, avg) 
VALUES (NULL, 
	(SELECT id FROM users WHERE login = '$owner'), 
    (SELECT id FROM tables WHERE name = '$table'), 
    '$name', 
    $tryes[0], $tryes[1], $tryes[2], $tryes[3], $tryes[4], $avg)";
    
echo mysqli_query($link, $query);