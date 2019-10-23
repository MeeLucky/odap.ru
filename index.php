<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php include "elems/head.php"?>
</head>
<body>
	<?php include "elems/header.php"?>
	<main>
<?php 
include "PHPFunctions.php";
include "DBconnect.php";

//Get all public records
$query = "SELECT tableid, fio, try1, try2, try3, try4, try5, avg 
FROM records WHERE tableid IN(
	SELECT id FROM tables WHERE isPublic = 1
) ORDER BY avg";
$records = DBQuery($query);

//Get id from public tables 
$tables = DBQuery("SELECT id, name, date FROM tables WHERE isPublic = 1");

//output tables
foreach ($tables as $table) 
{
	foreach ($records as $item) 
	{
		if($item['tableid'] == $table['id'])
			$data[] = $item;
	}
	PrintTable($data, $table['name'], $table['date']);
	unset($data);
}
?>
	</main>
</body>
</html>