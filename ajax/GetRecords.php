<?php
include "../scripts/DBconnect.php";

$id = $_GET['id'];
$tableName = $_GET['tableName'];
$isPrivate = $_GET['isPrivate'];//true - открыто в админке

//получение всех записей открываемой таблицы
$query = "SELECT * FROM records WHERE tableid = $id ORDER BY avg";
$records = DBQuery($query);

//получение занчения публичности. Нужно для функции "открыть/закрыть таблицу"
//и получение описания таблицы
$query = "SELECT isPublic, description FROM tables WHERE id = $id";
$res = DBQuery($query);
$tableIsPublic = $res[0]['isPublic'];
$tableDescription = $res[0]['description'];

if($isPrivate == "true") {
//спасибо, динамическая типизация))))))))))))))))))))
	echo "<summary id='tableSummary$id' onclick='refreshTable(".$id.", $isPrivate)'>".$tableName." |<button class='addRecord focusOff' onclick='ShowFormAddRecord($id)' value='$tableName'>Добавить</button></summary>";
	//вертикальный слеш нужен для нахождения кнопки
	//почему бы не искать по кнопке тогда?? странное решение
}
else{
	echo "<summary id='tableSummary$id' onclick='refreshTable(".$id.", $isPrivate)'>".$tableName."</summary>";
}
	echo "<p id='oldDescription$id'>".$tableDescription."</p>";

	echo "
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
	if(!empty($records))
	{
		$num = 0;
		$da = new DefinitionAttemp();
		foreach ($records as $item) {
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
			echo $da->toColorAndTime($item['try1']);
			echo $da->toColorAndTime($item['try2']);
			echo $da->toColorAndTime($item['try3']);
			echo $da->toColorAndTime($item['try4']);
			echo $da->toColorAndTime($item['try5']);
			echo "<td><b>".toTime($item['avg'])."</b></td>";
			if($isPrivate == "true") 
			{
				echo "<td class='delRecord focusOff' onclick='DelRecord(".$item['id'].", $id)'><img src='../img/redCross.png'></td>";
			}
			echo "</tr>";
		}
	}
		echo "</table>";
		if($isPrivate == "true")//settings
		{
			echo "<details>";
			echo "<summary>Настройки</summary>";

			echo "<button class='delTable focusOff' onclick='DelTable($id)'><span>X</span> удалить таблицу</button>";
			echo "<button class='delTable focusOff' id='DefaultButton' ";

			if($tableIsPublic == 1)
				echo "onclick='ChangePublic($id, 0)'>закрыть таблицу";
			else
				echo "onclick='ChangePublic($id, 1)'>открыть таблицу";

			echo "</button>";
			echo "<br>";
			echo "<input placeholder='Новое имя' class='renameInput t$id'> <button class='delTable focusOff' id='DefaultButton' onclick='Rename($id)'>переименовать</button>";
			echo "<br>";
			echo "<textarea id='newDescription$id' class='newDescInput' cols='90' rows='3'>$tableDescription</textarea>
				<br>
				<button id='DefaultButton' class='newDescButton focusOff' onclick='ChangeDescription($id)'>изменить описание</button>";
			echo "<div class='tip' data-title='Правильный формат'>
				<input type='file' class='f$id uploadInput' onchange='UploadFile($id, this)'> 
				<a href='uploadTip.php' target='_blank' class='tip'>Инструкция</a>
			</dib>";
			#<img src='../img/tip.png' class='tip'>
			# <button class='delTable focusOff' id='DefaultButton' onclick='UploadFile($id)'>загрузить таблицу</button>
			echo "</details>";
		}

		

class DefinitionAttemp
{
	public $worst;
	public $best;

	public function toColorAndTime ($time)
	{
		$is;
		if($time == $this->best) {
			$is = "green";
		}

		if($time == $this->worst) {
			$is = "red";
		}

		$time = toTime($time);
		//до сЮда 

		switch ($is) {
			case 'green':
				return "<td class='green'>".$time."</td>";
			case 'red':
				return "<td class='red'>".$time."</td>";
			default:
				return "<td>".$time."</td>";
		}
	}
}

function toTime($time) {
	$sec = floor($time);
	$sub = round(($time - $sec) * 100);

	if($sec >= 60) {
		$min = floor($sec / 60);
		$sec = $sec % 60;
	}

	if($sub < 10 && $sub >= 0) $sub = "0".$sub;
	if($sec < 10 && $sec >= 0) $sec = "0".$sec;
	if($min > 0) $min = $min.":";

	return "$min$sec.$sub";
}

function toFixed($num, $round=2)
{
	$p = strpos($num, ".");

	return substr($num, 0, $p+1+$round);
}