
/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file allows to check login credentials.
*/

//function to check login data provided by user
function validateLogin()
{
	var errmsg = "";
	var result = true;
	var loginemail=document.forms["loginForm"]["loginemail"].value;
	if (loginemail==null || loginemail=="")
	{
		errmsg +="Please enter your email address.\n";
		result = false;
	}
	var cpass=document.forms["loginForm"]["password"].value;
	if (cpass==null || cpass=="")
	{
		errmsg +="Please enter your password.\n";
		result = false;
	}
	if(errmsg != "")
	{
		alert(errmsg);
	}
	return result;
}

//function to validate registration data
function validateRegister()
{
	var errmsg = "";
	var result = true;
	var fname=document.forms["registerForm"]["fname"].value;
	if (fname==null || fname=="")
	{
		errmsg +="Please enter your first name.\n";
		result = false;
	}
	var lname=document.forms["registerForm"]["lname"].value;
	if (lname==null || lname=="")
	{
		errmsg += "Please enter your last name.\n";
		result = false;
	}
	var email=document.forms["registerForm"]["regemail"].value;
	if(email==null || email=="")
	{
		errmsg +="Please provide your email address.\n";
		result = false;
	}
	else
	{
		var filter = /^([a-zA-Z0-9_\.\])+\@(([a-zA-Z0-9\])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(email)) 
		{
			errmsg += "Please provide a valid email address.\n";
			result = false;
		}
	}
	
	if(errmsg != "")
	{
		alert(errmsg);
	}
	return result;
}
