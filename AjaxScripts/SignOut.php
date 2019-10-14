<?php
session_start();

$_SESSION['sign'] = null;

header('Location: http://odap.ru/index.php');
exit;
