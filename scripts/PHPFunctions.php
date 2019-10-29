<?php #functions
function PrintTable ($data, $tableName, $tableDate, $tableIsPublic = null, $tableId = null, $isPrivate = false) 
{
	if($isPrivate)
	{
		$btn1 = "| <button class='addRecord focusOff' onclick='ShowFormAddRecord(this)' value='$tableName'>Добавить</button>";
	}

	echo "<details>
<summary>$tableName | $tableDate $btn1</summary>
<table class='tables' border='1px'>
	<tr>
		<th>№</th>
		<th>Фамилии И. О.</th>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
		<th>5</th>
		<th>avg</th>
	</tr>";
	if(!empty($data))
	{
		$num = 0;
		$da = new DefinitionAttemp();
		foreach ($data as $item) {
			$best = min($item['try1'], 
						$item['try2'], 
						$item['try3'], 
						$item['try4'], 
						$item['try5'] );

			$worst = max($item['try1'], 
						$item['try2'], 
						$item['try3'], 
						$item['try4'], 
						$item['try5'] );

			$da->best = $best;
			$da->worst = $worst;

			$num++;
			echo "<tr>";
			echo "<td>$num</td>";
			echo "<td>".$item['fio']."</td>";
			echo $da->color($item['try1']);
			echo $da->color($item['try2']);
			echo $da->color($item['try3']);
			echo $da->color($item['try4']);
			echo $da->color($item['try5']);
			echo "<td>".SecToTime($item['avg'])."</td>";
			if($isPrivate) 
			{
				echo "<td class='delRecord focusOff' onclick='DelRecord(".$item['id'].")'>X</td>";
			}
			echo "</tr>";
		}
	}
		echo "</table>";
		if($isPrivate)
		{
			echo "<details>";
			echo "<summary>Настройки</summary>";
			
			echo "<button class='delTable focusOff' onclick='DelTable($tableId)'><span>X</span> удалить таблицу</button>";

			echo "<button class='delTable focusOff' id='DefaultButton' ";
			if($tableIsPublic == 1)
				echo "onclick='ChangePublic($tableId, 0)'>Закрыть таблицу";
			else
				echo "onclick='ChangePublic($tableId, 1)'>Открыть таблицу";
			echo "</button>";

			echo "<br>";
			echo "</details>";
		}
		echo"<hr></details>";
}

function TimeToSec ($time)
{
	unset($subSec);
	unset($sec);
	unset($min);
	$dot = strpos($time, '.');
	$dot2 = strpos($time, ':');
	$subSec = substr($time, $dot+1);
	$n = strlen($time) > 5 ? +1 : +0;
	$sec = substr($time, $dot2+$n, 2);//+1 for xx.xx or  +0 for xx:xx.xx
	$min = substr($time, 0, $dot2);
// mlog(strlen($time));


	return (int)$min * 60 * 100 + (int)$sec * 100 + (int)$subSec;
}

function mlog($str){echo "-------<br>$str<br>-------<br>";}
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
	// var_dump($item);
	print_r($item);
	echo "--------------------------------------------</pre>";
}

class DefinitionAttemp
{
	public $worst;
	public $best;

	public function color ($time)
	{
		if($time == $this->best)
			return "<td class='green'>".SecToTime($time)."</td>";

		if($time == $this->worst)
			return "<td class='red'>".SecToTime($time)."</td>";

		return "<td>".SecToTime($time)."</td>";
	}
}
