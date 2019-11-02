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
		url: "../AjaxScripts/SignOut.php",
		seccess: function(response) {
		}
	});
	location.reload();
}

function TrySignIn()
{
	let login = $('#signinname').val();
	let password = $('#signinpassword').val();
	//valid

	$.ajax({
		url: "../AjaxScripts/SignIn.php",
		type: 'post',
		data: 'login='+login+"&password="+password,
		success: function (response) {
			console.log(response);
			if(response !== true) {
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
function ShowFormAddRecord (this_)
{
	$.ajax({
		url: "../elems/formAddOneResult.php",
		data: "table="+this_.value,
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
		url: "../AjaxScripts/DelTable.php",
		data: "id="+id,
		success: function (response) {
			if(response == 1)
				location.reload();
		}
	});
}

function AddRecord (this_) 
{
	let table = this_.value;
	let name = $('input[name="name"]').val();
	let try1 = $('input[name="try1"]').val();
	let try2 = $('input[name="try2"]').val();
	let try3 = $('input[name="try3"]').val();
	let try4 = $('input[name="try4"]').val();
	let try5 = $('input[name="try5"]').val();

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
			alert("error " + i);
			return;
		}

		for(let j = 0; j < len; j++)
		{
			if(Number.isInteger(+item[j]) || item[j] == "."
				|| item[j] == ":" || item[j] == ",")
				console.log('ok')
			else
				return;
		}
		
	}

	$.ajax({
		url: "../AjaxScripts/AddRecord.php",
		data: "table="+table+"&name="+name+"&try1="+try1+"&try2="+
		try2+"&try3="+try3+"&try4="+try4+"&try5="+try5,
		success: function (response) {
			if(response == 1)
			{
				location.reload();
			}
		}
	});
}

function DelRecord (id)
{
	if(!confirm("Вы уверены что хотите удалит запись?"))
		return;

	$.ajax({
		url: "../AjaxScripts/DelRecord.php",
		data: "id="+id,
		success: function (response) {
			if(response == 1)
				location.reload();
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
		url: "../AjaxScripts/CreateNewTable.php",
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
		url: "../AjaxScripts/ChangePublic.php",
		data: "id="+id+"&newState="+newState,
		success: function (response) {
			if(response == 1)
				location.reload();
			else
				console.log("response: "+response);
		}
	});
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

	$.ajax({
		url: '../AjaxScripts/Rename.php',
		data: 'id='+id+'&newname='+newname,
		success: function (response) {
			if(response == 1)
				location.reload();
		}
	});
}