<?php
$id = $_GET['id'];//table's id
$text = $_GET['text'];//new description

include "../scripts/DBconnect.php";

$query = "UPDATE tables
SET description = '$text'
WHERE id = $id";

if(mysqli_query($link, $query)) 
	echo 1; //всё ок ;)
