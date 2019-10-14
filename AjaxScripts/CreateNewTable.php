<?php
session_start();
$name = $_GET['name'];

include "../DBconnect.php";
$query = "INSERT INTO tables (ownerid, isPublic, name, date)
VALUES (
	(SELECT id FROM users WHERE login = '".$_SESSION['sign']."'),
	0,
	'$name',
	'".date("Y-m-d")."'
)";
echo mysqli_query($link, $query);