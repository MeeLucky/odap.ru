<?php
$id = $_GET['id'];
$name = $_GET['newname'];

include "../scripts/DBconnect.php";

$query = "UPDATE tables
SET name = '$name'
WHERE id = $id";
echo mysqli_query($link, $query);
