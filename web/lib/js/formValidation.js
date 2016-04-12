function encryptPassword(f) {	
	f.md5Pass.value = hex_md5(f.Password.value);
	console.log = f.Password.value;
}

function dontSendRawPassword(f) {
	return (f.Password.value = 'hello123');
}

function checkSignup(f) {
	var bad_email		= 'That email sucks';
	var bad_password	= 'You must come up with a better password';
	var bad_match		= 'The passwords do not match';
	ok2go				= false;

	if (isValidEmail(f.Email,bad_email) && passwordIsComplexEnough(f.Password,bad_password) && passwordsMatch(f.Password,f.Password2,bad_match)) {
		ok2go = true;
		f.md5Pass.value		= hex_md5(f.Password.value);
		f.Password.value	= 'boing';
		f.Password2.value	= 'booop';
	}
	console.log(f);	
	return ok2go;
}

function isValidEmail(emailfobj,errmsg) {
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var isvalid = emailPattern.test(emailfobj.value);
	if (!isvalid) {
		emailfobj.value = '';
		emailfobj.focus();
		alert(errmsg);
	}
	return isvalid;
}

function passwordIsComplexEnough(fobj,errmsg) {
	var isvalid = (fobj.value.length > 0);
	if (!isvalid) {
		fobj.focus();
		alert(errmsg);
	}
	return isvalid;
}

function passwordsMatch(passfobj1,passfobj2,errmsg) {
	var isvalid = ((passfobj1.value == passfobj2.value) && (passfobj1.value.length));
	if (!isvalid) {
		passfobj1.value = '';
		passfobj2.value = '';
		passfobj1.focus();
		alert(errmsg);
	}
	return isvalid;
}