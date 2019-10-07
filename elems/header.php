<?php
$result = "<li><a onclick='SignIn()'>Войти</a></li>";

if($_SESSION['sign'] == "Admin")
	$result = "<li><a onclick='SignOut()'>".$_SESSION['sign']."</a></li>";
?>
<header>
	<ul>
		<li><a href="../index.php">Результаты соревнований</a></li>
		<li><a href="../mytables.php">Мои таблицы</a></li>
		<?=$result?>
	</ul>
</header>	