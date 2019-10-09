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
			console.log(response);
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
			if(response != true)
				location.reload();
		}
	});
}

function CloseForm ()
{
	$('.FormWrapper').remove();
}

function DelTable ()
{
	alert("NotImplement");
}

function AddRecord ()
{
	$.ajax({
		url: "elems/formAddOneResult.php",
		data: "",
		success: function (response) {
			$('body').append(response);
		}
	});
}

function DelRecord ()
{
	alert("NotImplement");
}