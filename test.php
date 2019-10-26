<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "elems/head.php"?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
	<style>
		body { background: white; }
	</style>
<?php
include "scripts/PHPFunctions.php";

$time = "32.52";

$sec = TimeToSec($time);
$newTime = SecToTime($sec);
echo "time = sec = new time<br>";
echo "$time = $sec = $newTime";
?>

<div>
	<span class="event">2019-10-25</span>
</div>
</body>
</html>
