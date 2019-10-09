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
)";
$result = mysqli_query($link, $query);
for($records = []; $row = mysqli_fetch_assoc($result); $records[] = $row);

//Get id from public tables 
$query = "SELECT id, name, date FROM tables WHERE isPublic = 1";
$result = mysqli_query($link, $query);
for($tables = []; $row = mysqli_fetch_assoc($result); $tables[] = $row);

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