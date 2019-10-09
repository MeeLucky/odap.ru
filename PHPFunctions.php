<?php #functions
function PrintTable ($data, $tableName, $tableDate, $isPrivate = false) 
{
	if($isPrivate)
	{
		$btn1 = "| <button class='addRecord' onclick='AddRecord()'>Добавить</button>
		<button class='delTable' onclick='DelTable()'><span>X</span> удалить</button>";
		$btn2 = "<td class='delRecord' onclick='DelRecord()'>X</td>";
	}

	echo "<details>
<summary>$tableName | $tableDate $btn1</summary>
<table class='tables' border='1px'>
	<tr>
		<th>№</th>
		<th>Фамилие И. О.</th>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
		<th>5</th>
		<th>avg</th>
	</tr>";
	if(empty($data))
		return null;
		$num = 0;
	foreach ($data as $item) {
		$num++;
		echo "<td>$num</td>";
		echo "<td>".$item['fio']."</td>";
		echo "<td>".SecToTime($item['try1'])."</td>";
		echo "<td>".SecToTime($item['try2'])."</td>";
		echo "<td>".SecToTime($item['try3'])."</td>";
		echo "<td>".SecToTime($item['try4'])."</td>";
		echo "<td>".SecToTime($item['try5'])."</td>";
		echo "<td>".SecToTime($item['avg'])."</td>";
		echo $btn2;
	}
	echo "</table>
</details>";
}

function TimeToSec ($time)
{
	unset($subSec);
	unset($sec);
	unset($min);

	$dot = strpos($time, '.');
	$dot2 = strpos($time, ':');

	$subSec = substr($time, $dot+1);
	$sec = substr($time, $dot2+1, 2);
	$min = substr($time, 0, $dot2);

	return (int)$min * 60 * 100 + (int)$sec * 100 + (int)$subSec;
}

function SecToTime ($time)
{
	unset($subSec);
	unset($sec);
	unset($min);

	$subSec = (int)$time % 100;
	$sec = ($time - $subSec) / 100;
	if($sec >= 60)
	{
		$min = ($sec - $sec % 60) / 60;
		$sec = $sec % 60;
	}

	if($min > 0)
		return "$min:$sec.$subSec";
	else
		return "$sec.$subSec";
}

function vardump($item, $name = "")
{
	echo "<pre> $name\n";
	var_dump($item);
	echo "</pre>";
}
?>