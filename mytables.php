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
			if($_SESSION['sign'] != null and $_SESSION['sign'] != undefined)
			{
				$userName = strtolower($_SESSION['sign']);
				$query = "SELECT * FROM ".$userName."table";
				$link = mysqli_connect('localhost', 'root', '', 'resultsofcompetitions');
				$result = mysqli_query($link, $query);
				for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

				echo "<table cellpadding='8'>";
				echo "<tr> <th>id</th> <th>name</th>
				<th>1</th> <th>2</th> <th>3</th> <th>4</th> <th>5</th>
				<th>AVG5</th> <th>Best</th>";
					// var_dump($data);
				foreach ($data as $item) {
					echo "<tr>";
					echo "<td>".$item['id']."</td>";
					echo "<td>".$item['name']."</td>";
					echo "<td>".$item['try1']."</td>";
					echo "<td>".$item['try2']."</td>";
					echo "<td>".$item['try3']."</td>";
					echo "<td>".$item['try4']."</td>";
					echo "<td>".$item['try5']."</td>";
					echo "<td>"."</td>";
				}
				echo "</table>";
			}
			else
			{
				echo "Чтобы увдитеть свои таблицы нужно авторезироваться.";
			}
			
		 ?>
	</main>
</body>
</html>