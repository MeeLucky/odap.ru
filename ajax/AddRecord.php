<?php
session_start();

$table = $_GET['tableid'];
$name = $_GET['name'];
$tryes[] = $_GET['try1'];
$tryes[] = $_GET['try2'];
$tryes[] = $_GET['try3'];
$tryes[] = $_GET['try4'];
$tryes[] = $_GET['try5'];

//перевод 2:13,12 в 133,12
$k = 0;
foreach ($tryes as $item) {
	
	$dot2 = strpos($item, ':');
	if($dot2 > 0) {
		$min = substr($item, 0, $dot2);
		$item = substr($item, $dot2+1);
	}
		$tryes[$k] = $min * 60 + $item;
	$k++; 
}

$avg = GetAvg($tryes);
$owner = $_SESSION['sign'];

include "../scripts/DBconnect.php";//(SELECT id FROM tables WHERE name = '$table'), table был названием таблицы а теперь сразу её ид
$query = "INSERT INTO 
records (id, owner, tableid, fio, try1, try2, try3, try4, try5, avg) 
VALUES (NULL, 
	(SELECT id FROM users WHERE login = '$owner'), 
    $table,
    '$name', 
    $tryes[0], $tryes[1], $tryes[2], $tryes[3], $tryes[4], $avg)";
    
echo mysqli_query($link, $query);


function GetAvg($tryes) {
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

	return array_sum($forAvg) / 3;
}