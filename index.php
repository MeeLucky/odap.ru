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
	$tables = DBQuery("SELECT id, name FROM tables WHERE isPublic = 1");

	foreach ($tables as $item) {
		echo "<details id='table".$item['id']."'><summary id='tableSummary".$item['id']."' onclick='refreshTable(".$item['id'].", false)'>".$item['name']."</summary>
</details>";
	}
?>
</main>
<?php include "elems/footer.php"; ?>
</body>
</html>