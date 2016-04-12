
/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : file to crate XHR object and crating async request  
*/


function createRequest() 
{
	var xhr = false;	
	if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else if (window.ActiveXObject)
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	return xhr;
}

function createAsyncConection(xhrObj, url, method, requestbody)
{
	xhrObj.open(method, url, true);
	var displayNotication = document.getElementById('displayNotication');
	if (method == "post")
		xhrObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			displayNotification.innerHTML = xhr.responseText;
		} 
	} 
	xhrObj.send(requestbody); 
}//file to crate XHR object and crating async request  