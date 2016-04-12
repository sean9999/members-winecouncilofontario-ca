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
	}
}