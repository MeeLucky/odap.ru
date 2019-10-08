<?php
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

include "../DBconnect.php";

$query = "SELECT login FROM users WHERE login = '$login' AND password = '$password'";

if(mysqli_query($link, $query))
{
	echo $_SESSION['sign'] = $login;
}
else
{
	echo true;
}