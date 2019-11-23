<?php
include "../scripts/DBconnect.php";
$id = $_GET['id'];

$query = "DELETE FROM records WHERE id = $id";

if(mysqli_query($link, $query))
	echo $_GET['tableId'];
else 
	echo 0;