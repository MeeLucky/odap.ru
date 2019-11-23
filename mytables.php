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
	include "scripts/DBconnect.php";
	$tables = DBQuery("SELECT id, name FROM tables WHERE ownerid = 
	(SELECT id FROM users WHERE login = '".$_SESSION['sign']."')");

	foreach ($tables as $item) {
		echo "<details id='table".$item['id']."'><summary id='tableSummary".$item['id']."' onclick='refreshTable(".$item['id'].", true)'>".$item['name']."</summary>
</details>";
	}
?>
	<div class="newtable">
		<input type="text" class="newTableName" placeholder="Название таблицы">
		<button onclick="CreateTable()">создать таблицу</button>
	</div>
	</main>
<?php include "elems/footer.php"; ?>
</body>
</html>