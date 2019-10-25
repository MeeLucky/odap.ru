<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "elems/head.php"?>
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
</body>
</html>
