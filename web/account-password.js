function validateRequiredField(field,alerttxt)
{
	with (field)
  	{
  		if (value==null||value=="")
    	{
    		alert(alerttxt);
    		return false;
    	}
  		else
    	{
    		return true;
    	}
	}
}

function validateForm(thisform)
{
	with (thisform)
	{
		if (validateRequiredField(oldPassword,"You must enter something in the Old Password field.")==false)
	  	{
	  		oldPassword.focus();
	  		return false;
	  	}
		if (validateRequiredField(password,"You must enter something in the New Password field.")==false)
	  	{
	  		password.focus();
	  		return false;
	  	}
	  	if (validateRequiredField(password2,"You must enter something in the Re-enter New Password field.")==false)
	  	{
	  		password2.focus();
	  		return false;
	  	}
	  	
	  	//Check if passwords match
	  	if (password.value != password2.value)
	  	{
	  		alert("New passwords did not match.  Please try again.");
	  		password.value = "";
	  		password2.value = "";
	  		password.focus();
	  		return false;
	  	}		  	
	}
}