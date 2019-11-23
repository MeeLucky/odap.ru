<div class='FormWrapper'>
	<div class="FormCover" onclick='CloseForm()'></div>
	<div class='Form addForm'>
		<input placeholder='Фамилие И. О.' name='name'>
		<br>
		<br>
		<input placeholder='Попытка 1' onkeypress="ToFormat(this)" autocomplete="off" maxlength="8" type="number" name='try1'><br>
		<input placeholder='Попытка 2' onkeypress="ToFormat(this)" autocomplete="off" maxlength="8" type="number" name='try2'><br>
		<input placeholder='Попытка 3' onkeypress="ToFormat(this)" autocomplete="off" maxlength="8" type="number" name='try3'><br>
		<input placeholder='Попытка 4' onkeypress="ToFormat(this)" autocomplete="off" maxlength="8" type="number" name='try4'><br>
		<input placeholder='Попытка 5' onkeypress="ToFormat(this)" autocomplete="off" maxlength="8" type="number" name='try5'>
		<br>
		<br>
		<button onclick="AddRecord(<?=$_GET['id']?>)">Добавить</button>
	</div>
</div>