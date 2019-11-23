<?php
include "../scripts/DBconnect.php";
$id = $_GET['id'];
$query = "DELETE FROM tables WHERE id = $id";

if (mysqli_query($link, $query))
{
	echo 1;

	$query = "DELETE FROM records WHERE tableid = $id";
	mysqli_query($link, $query);
}