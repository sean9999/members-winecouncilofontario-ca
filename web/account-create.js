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

function validateEmailField(field,alerttxt)
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
 
	with (field)
  	{
  		if (reg.test(value) == false)
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
		if (validateRequiredField(name,"You must enter something in the Name field.")==false)
	  	{
	  		name.focus();
	  		return false;
	  	}
	  	if (validateRequiredField(title,"You must enter something in the Title field.")==false)
	  	{
	  		title.focus();
	  		return false;
	  	}
		if (validateRequiredField(email,"You must enter something in the Email field.")==false)
	  	{
	  		email.focus();
	  		return false;
	  	}
		
		//Check for valid email address formatting
		if (validateEmailField(email,"You have entered an invalid email address in the Email field.  Please try again.")==false)
		{
			email.value = "";
			email.focus();
			return false;
		}
		if (validateRequiredField(password,"You must enter something in the Password field.")==false)
	  	{
	  		password.focus();
	  		return false;
	  	}
	  	if (validateRequiredField(password2,"You must enter something in the Re-enter Password field.")==false)
	  	{
	  		password2.focus();
	  		return false;
	  	}
	  	
	  	//Check if passwords match
	  	if (password.value != password2.value)
	  	{
	  		alert("Passwords did not match.  Please try again.");
	  		password.value = "";
	  		password2.value = "";
	  		password.focus();
	  		return false;
	  	}		  	
	  	if (validateRequiredField(wineryID,"You must select something in the Winery field.")==false)
	  	{
	  		wineryID.focus();
	  		return false;
	  	}

	}
}