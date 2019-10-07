<?php
session_start();
$login = $_POST['login'];
$password = $_POST['password'];

if($login == "Admin" and $password == "wuntik")
{
	echo $_SESSION['sign'] = $login;
}
else
{
	echo true;
}