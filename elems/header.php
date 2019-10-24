<?php
$result = "<li><a onclick='SignIn()'>Войти</a></li>";

if(isset($_SESSION['sign']))
	$result = "<li><a href='../index.php'>результаты соревнований</a></li>
		<li><a href='../mytables.php'>".$_SESSION['sign']."</a></li>
		<li><a onclick='SignOut()'>выйти</a></li>";
else
	$result = "<li><a href='../index.php'>результаты соревнований</a></li>
		<li><a onclick='SignIn()'>войти</a></li>";
?>
<header>
	<ul>
		<?=$result?>
	</ul>
</header>	