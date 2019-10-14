function SignIn()
{
	$.ajax({
		url: "elems/formSignIn.php",
		success: function (response) {
			$('body').append(response);
		}
	});
}

function SignOut()
{
	$.ajax({
		url: "AjaxScripts/SignOut.php",
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
		url: "AjaxScripts/SignIn.php",
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
		url: "elems/formAddOneResult.php",
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
		url: "AjaxScripts/DelTable.php",
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

	$.ajax({
		url: "AjaxScripts/AddRecord.php",
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
		url: "AjaxScripts/DelRecord.php",
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
		url: "AjaxScripts/CreateNewTable.php",
		data: "name="+name,
		success: function (response) {
			if(response == 1)
				location.reload();

			console.log(response);
		}
	});
}

function ChangeIsPublic (id)
{
	
}