<?php
$id = $_GET['id'];
$newState = $_GET['newState'];

include "../DBconnect.php";

$query = "UPDATE tables SET isPublic = $newState WHERE id = $id;";

echo mysqli_query($link, $query);