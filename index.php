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
include "DBconnect.php";
$query = "SELECT tableid, fio, try1, try2, try3, try4, try5, avg 
FROM records WHERE tableid IN(
	SELECT id FROM tables WHERE isPublic = 1
)";
$result = mysqli_query($link, $query);
for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

if()/*
нужно сделать разделения на разные таблицы
и чтобы таблица была под спойлером

apache_2.4-php_7.0
php_7.1-x64
MariaDB-10.3-x64
*/
{
	echo "<table class='tables' border='1px'>
		<tr>
			<th>№</th>
			<th>Фамилие И. О.</th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>avg</th>
		</tr>";
		$num = 0;
	foreach ($data as $item) {
		$num++;
		echo "<td>$num</td>";
		echo "<td>".$item['fio']."</td>";
		echo "<td>".$item['try1']."</td>";
		echo "<td>".$item['try2']."</td>";
		echo "<td>".$item['try3']."</td>";
		echo "<td>".$item['try4']."</td>";
		echo "<td>".$item['try5']."</td>";
		echo "<td>".$item['avg']."</td>";
	}
	echo "</table>";
}
?>
	</main>
</body>
</html>