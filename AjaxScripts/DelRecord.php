<?php
include "../DBconnect.php";
$id = $_GET['id'];

$query = "DELETE FROM records WHERE id = $id";

echo mysqli_query($link, $query);