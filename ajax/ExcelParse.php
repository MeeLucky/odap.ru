<?php 
session_start();
ini_set('display_errors','Off');

#var_dump($_FILES['myfile']);
include "../scripts/DBconnect.php";

require_once "../PHPExcel-1.8/Classes/PHPExcel.php";

// Открываем файл
$xls = PHPExcel_IOFactory::load($_FILES['myfile']['tmp_name']);
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();

$result = [];
// Получили строки и обойдем их в цикле


// var_dump($result);
$id = $_POST['id'];
$owner = $_SESSION['sign'];
$query = "INSERT INTO 
records (id, owner, tableid, fio, try1, try2, try3, try4, try5, avg) 
VALUES ";

$rowIterator = $sheet->getRowIterator();

//формирования запроса на добавление всех записей
foreach ($rowIterator as $row) {
	$cellIterator = $row->getCellIterator();
	$query .= "(NULL, (SELECT id FROM users WHERE login = '$owner'), $id";

	$i = 0;
	foreach ($cellIterator as $cell) {
		$value = TimeToSec((string)$cell->getCalculatedValue());

		if(is_float($cell->getCalculatedValue()))
			$query .= ", ".(string)$value;
		else
			$query .= ", '".$cell->getCalculatedValue()."'";

		$tryes[] = $value;

		$i++;
	}
	$query .= ", ".GetAvg($tryes);
	$query .= "), ";
}
//отрезает запятую и пробел в конце
$query = substr($query, 0, strlen($query)-2);

// echo $query;
echo mysqli_query($link, $query);
// if(mysqli_query($link, $query))
	// echo 1;
// echo DBQuery($query);
function TimeToSec($time) {
	$dot2 = strpos($time, ':');
	if($dot2 > 0) {
		$min = substr($time, 0, $dot2);
		$time = substr($time, $dot2+1);
	}
		
	$time = ($min * 60) + $time;
	return $time;
}

//просто скопировал как даун из AddRecord.php 
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