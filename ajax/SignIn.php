<?php
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

include "../scripts/DBconnect.php";

$query = "SELECT login FROM users WHERE login = '$login' AND password = '$password'";
$res = mysqli_query($link, $query);

if($res->num_rows == 1)
{
	 $_SESSION['sign'] = $login;
}
else
{
	echo 1;
}