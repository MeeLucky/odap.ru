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
if(!isset($_SESSION['sign']))
{
	echo "Авторизируйтесь";
	exit();
}
include "scripts/PHPFunctions.php";
include "scripts/DBconnect.php";

//Get all users records 
$query = "SELECT id, tableid, fio, try1, try2, try3, try4, try5, avg 
FROM records WHERE owner IN(
	SELECT id FROM users WHERE login = '".$_SESSION['sign']."'
) ORDER BY avg";
$records = DBQuery($query);

//Get id from users tables 
$query = "SELECT id, name, date, isPublic FROM tables WHERE ownerid = 
	(SELECT id FROM users WHERE login = '".$_SESSION['sign']."')";
$tables = DBQuery($query);

//output tables
foreach ($tables as $table) 
{
	$data = [];
	foreach ($records as $item) 
	{
		if($item['tableid'] == $table['id'])
			$data[] = $item;
	}
	PrintTable($data, $table['name'], $table['date'], $table['isPublic'], $table['id'], true);
	
	unset($data);
}
?>
		<div class="newTable">
			<input type="text" class="newTableName" placeholder="Название таблицы">
			<button class="AddTable focusOff" onclick="CreateTable()">Добавить таблицу</button>
		</div>
	</main>
<?php include "elems/footer.php"; ?>
</body>
</html>