<div class='FormWrapper'>
	<div class="FormCover" onclick='CloseForm()'></div>
	<div class='Form addForm'>
		<input placeholder='Фамилие И. О.' value="Tester" name='name'>
		<br>
		<br>
		<input placeholder='Попытка 1' value="32.12" name='try1'><br>
		<input placeholder='Попытка 2' value="42.12" name='try2'><br>
		<input placeholder='Попытка 3' value="52.12" name='try3'><br>
		<input placeholder='Попытка 4' value="42.53" name='try4'><br>
		<input placeholder='Попытка 5' value="75.23" name='try5'>
		<br>
		<br>
		<button <?="value='".$_GET['table']."'"?> 
		onclick="AddRecord(this)">Добавить</button>
	</div>
</div>