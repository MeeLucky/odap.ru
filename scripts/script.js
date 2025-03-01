function SignIn()
{
	$.ajax({
		url: "../elems/formSignIn.php",
		success: function (response) {
			$('body').append(response);
		}
	});
}

function SignOut()
{
	$.ajax({
		url: "../ajax/SignOut.php",
		seccess: function(response) {
			location.reload();
		}
	});
}

function TrySignIn()
{
	let login = $('#signinname').val();
	let password = $('#signinpassword').val();
	//valid

	$.ajax({
		url: "../ajax/SignIn.php",
		type: 'post',
		data: 'login='+login+"&password="+password,
		success: function (response) {
			console.log(response);
			if(response != 1) {
				  location.reload();
			}
		}
	});
}

function CloseForm ()
{
	$('.FormWrapper').remove();
}

//referens:  PHPFunctions.php>PrintTable()
function ShowFormAddRecord (id)//table id
{
	$.ajax({
		url: "../elems/formAddOneResult.php",
		data: "id="+id,
		success: function (response) {
			$('body').append(response);
		}
	});
}

function DelTable (id)
{
	if(!confirm("Вы уверены что хотите удалит таблицу?"))
		return;
	$.ajax({
		url: "../ajax/DelTable.php",
		data: "id="+id,
		success: function (response) {
			console.log(response);
			if(response == 1)
				location.reload();
		}
	});
}

function AddRecord (id) 
{
	let table = id;
	let name = $('input[name="name"]').val();
	let try1 = ToFixFormat($('input[name="try1"]').val());
	let try2 = ToFixFormat($('input[name="try2"]').val());
	let try3 = ToFixFormat($('input[name="try3"]').val());
	let try4 = ToFixFormat($('input[name="try4"]').val());
	let try5 = ToFixFormat($('input[name="try5"]').val());

	if(name.trim() == "") {
		alert("Заполните имя");
		return;
	}

	let tryes = [];
	tryes[0] = try1;
	tryes[1] = try2;
	tryes[2] = try3;
	tryes[3] = try4;
	tryes[4] = try5;

	for(let i = 0; i < 5; i++)
	{
		let item = tryes[i];
		let len = item.length;

		if(item === undefined || len < 4) 
		{
			alert((i + 1) + " попытка записана некорректно");
			return;
		}

		for(let j = 0; j < len; j++)
		{
			if(!(Number.isInteger(+item[j]) || item[j] == "."
				|| item[j] == ":" || item[j] == ","))
				return;
		}
	}

	$.ajax({
		url: "../ajax/AddRecord.php",
		data: "tableid="+table+"&name="+name+"&try1="+try1+"&try2="+
		try2+"&try3="+try3+"&try4="+try4+"&try5="+try5,
		success: function (response) {
			if(response == 1) {
				CloseForm();
				refreshTable(table);
			}
			else
				console.log(response);
		}
	});
}

function DelRecord (id, tableId)
{
	if(!confirm("Вы уверены что хотите удалит запись?"))
		return;

	$.ajax({
		url: "../ajax/DelRecord.php",
		data: "id="+id+"&tableId="+tableId,
		success: function (response) {
			if(response != 0)
				refreshTable(response);
		}
	});
}

function CreateTable ()
{
	let name = $('.newTableName').val();
	if(name.trim() == "")
	{
		alert("Не заданно имя таблицы");
		return;
	}

	$.ajax({
		url: "../ajax/CreateNewTable.php",
		data: "name="+name,
		success: function (response) {
			if(response == 1)
				location.reload();
			else
				console.log("response: "+response);
		}
	});
}

function ChangePublic (id, newState)
{
		console.log(newState);
	if(newState == 1)
	{
		if(!confirm("Открыть таблицу для общего просмотра?"))
			return;
	}
	else
	{
		if(!confirm("Закрыть таблицу от общего просмотра?"))
			return;
	}
	
	$.ajax({
		url: "../ajax/ChangePublic.php",
		data: "id="+id+"&newState="+newState,
		success: function (response) {
			if(response == 1)
				location.reload();
			else
				console.log("response: "+response);
		}
	});
}

function ToFixFormat (str) {//fix 2:23.2 to 22.32
	let val = str.split('');

	let dot1 = val.indexOf('.');
	let dot2 = val.indexOf(':');

	if(val.length -2 != dot1) {
		return str;
	}

	if(dot1 > 0) {
		let temp = val[dot1];
		val[dot1] = val[dot1-1]
		val[dot1-1] = temp;
	}

	if(dot2 > 0) {
		let temp = val[dot2];
		val[dot2] = val[dot2-1]
		val[dot2-1] = temp;
	}

	if(val[0] == ":")
		val[0] = "";

	let len = val.length;
	let res = "";
	for(let i = 0; i < len; i++) 
		res += val[i];
	
	return res;
}

function ToFormat (this_) {
	let res = this_.value;

	let n = res.indexOf('.');
	if(n > 0)
	{
		let str = res.substr(0, n);
		str += res.substr(n+1, res.length);
		res = str;
	}
	n = res.indexOf(':');
	if(n > 0)
	{
		let str = res.substr(0, n);
		str += res.substr(n+1, res.length);
		res = str;
	}

	if(res.length > 5) return;

	switch(res.length) {
		case 2:
			res = res[0] + '.' + res[1];
			break;
		case 3:
			this_.type = "number";
			res = res[0] + res[1] + '.' + res[2];
			break;
		case 4:
			this_.type = "text";
			res = res[0]  + ':'
				+ res[1] + res[2] + '.'
				+ res[3];
			break;
		case 5:
			res = res[0] + res[1] + ':'
				+ res[2] + res[3] + '.'
				+ res[4];
			break;
	}
	

	this_.value = res;
}

function Rename (id)
{
	let newname = $('.t'+id).val().trim();
	if(newname.length < 3) {
		alert('Слишком короткое название');
		return;
	}

	if(newname.length > 100) {
		alert('Слишком длинное название');
		return;
	}
 
	let oldname = $('#tableSummary'+id).html();
	let p = oldname.indexOf('|');
	oldname = oldname.substr(0, p-1).trim();
	if(oldname == newname) {
		alert("Таблица "+oldname+" переименована в "+newname+". Всё как раньше.");
		return;
	}

	$.ajax({
		url: '../ajax/Rename.php',
		data: 'id='+id+'&newname='+newname,
		success: function (response) {
			if(response != 1) {
				let str = $('#tableSummary'+id).html();
				let p = str.indexOf('|');
				str = response + " " + str.substr(p);
				
				$('#tableSummary'+id).html(str);
				alert("Таблица "+oldname+" переименована в "+newname+".");
			}
		}
	});
}

function UploadFile (id, input)
{	
	let file = input.files[0];

	var fd = new FormData();    
	fd.append('myfile', file);
	fd.append('id', id);

	$.ajax({
	  	url: '../ajax/ExcelParse.php',
	  	data: fd,
	  	type: 'POST',
	  	cache: false,
	  	processData: false,
	 	 contentType: false,
	  	success: function(data){
	    	// console.log(data);
	    	if(data == 1)
	    		refreshTable(id);
	    		alert("Таблица успешно импортирована");
	  	}
	});
}

function refreshTable(id, isPrivate = true) {//id таблицы
	if($("#table"+id).html().length > 300 && !isPrivate) {
		let a1 = $("#table"+id).html().length > 300;
		let a2 = !isPrivate;
		console.log(a1 + " " + a2);
		return;//не обновлять если она уже обновлена.
	} 
	//если дать не правильный ид выдаст ошибку что лендж = ундефайнед

	let tableName = $("#tableSummary"+id).html();//отрезаем кнопку "добавить"
	//22.12.2019 не отрезается

	let verticalLine = tableName.indexOf("|");
	if(verticalLine != -1) 
		tableName = tableName.substr(0, verticalLine).trim();

	$.ajax({//
		url: "../ajax/GetRecords.php",
		data: "id="+id+"&tableName="+tableName+"&isPrivate="+isPrivate,
		success: function (data) {
			$('#table'+id).html(data);
		}
	});
}

function ChangeDescription (id) {//table's id
	//get text
	let newd = $('#newDescription'+id).val();
	let oldd = $('#oldDescription'+id).html();
	// console.log(newd); console.log(oldd);

	//validate
	newd = newd.trim();
	oldd = oldd.trim();
	if(newd == oldd) {
		alert("Описание не изменилось");
		return;
	}

	//to change
	$.ajax({
		url: "../ajax/ChangeDescription.php",
		data: "id="+id+"&text="+newd,
		success: function (response) {
			if(response == 1)
				refreshTable(id);
		}
	});
}