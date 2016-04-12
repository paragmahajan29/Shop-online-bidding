
var xhr = createRequest();

// function to create asyc request and send data to lissting.php file to 
function addListing()
{
	validateData();
	
	var itemname = document.getElementById('itemname').value.trim();
	var category = document.getElementById('category').value;
	var description = document.getElementById('description').value.trim();
	var startpriced = document.getElementById('startpriced').value;
	var startpricec = document.getElementById('startpricec').value;
	var reservepriced = document.getElementById('reservepriced').value;
	var reservepricec = document.getElementById('reservepricec').value;
	var buyitnowpriced = document.getElementById('buyitnowpriced').value;
	var buyitnowpricec = document.getElementById('buyitnowpricec').value;
	var day = document.getElementById('day').value;
	var hour = document.getElementById('hour').value;
	var min = document.getElementById('min').value;

	var sprice = parseFloat(Number(startpriced + "." + startpricec)).toFixed(2);
	var rprice = parseFloat(Number(reservepriced + "." + reservepricec)).toFixed(2);
	var bprice = parseFloat(Number(buyitnowpriced + "." + buyitnowpricec)).toFixed(2);
		

	var requestbody = "itemname=" + encodeURIComponent(itemname) + "&category=" + encodeURIComponent(category) + "&description=" + encodeURIComponent(description) +
			"&sprice=" + encodeURIComponent(sprice) + "&rprice=" + encodeURIComponent(rprice) +
			"&bprice=" + encodeURIComponent(bprice) + "&day=" + encodeURIComponent(day) + "&hour=" + encodeURIComponent(hour) + "&min=" + encodeURIComponent(min);


	if (xhr)
		createAsyncConection(xhr, "listing.php", "post", requestbody);

	var listinginput = document.getElementById('listing_input');
	if(listinginput)
		listinginput.reset();
}

//function to validate user inputs
function validateData() {
		
		var itemname = document.getElementById('itemname').value.trim();
		var category = document.getElementById('category').value;
		var description = document.getElementById('description').value.trim();
		var startpriced = document.getElementById('startpriced').value;
		var startpricec = document.getElementById('startpricec').value;
		var reservepriced = document.getElementById('reservepriced').value;
		var reservepricec = document.getElementById('reservepricec').value;
		var buyitnowpriced = document.getElementById('buyitnowpriced').value;
		var buyitnowpricec = document.getElementById('buyitnowpricec').value;
		var day = document.getElementById('day').value;
		var hour = document.getElementById('hour').value;
		var min = document.getElementById('min').value;
    	
		if (itemname==null || itemname.trim()=="" || description==null || description.trim()=="" || reservepriced==null || reservepriced.trim()=="" || buyitnowpriced==null || buyitnowpriced.trim()=="" ) 
			
		{
  			alert("Please fill all details");
			exit;
  		}
		
		var filter = /^[0-9]+$/;

		if (startpriced==null || startpriced.trim()=="" || startpricec==null || startpricec.trim()=="")
			
		{
  			if (startpriced==null || startpriced.trim()=="") {document.getElementById('startpriced').value = "00";}
			if (startpricec==null || startpricec.trim()=="") {document.getElementById('startpricec').value = "00";}

  		} else if (!filter.test(startpriced.trim()) || !filter.test(startpricec.trim())) {
    		alert('Please provide a valid Start Price');
			document.registerForm.startpriced.focus();
			exit;
 		}

		if (!filter.test(reservepriced.trim()) || !filter.test(reservepricec.trim())) {
    		alert('Please provide a valid Reserve Price');
			document.registerForm.reservepriced.focus();
			exit;
 		}

    		if (!filter.test(buyitnowpriced.trim()) || !filter.test(buyitnowpricec.trim())) {
    		alert('Please provide a valid Buy-It-Now-Price');
			document.registerForm.buyitnowpriced.focus();
			exit;
 		}
		
		
		var sprice = startpriced + "." + startpricec;
		var rprice = reservepriced + "." + reservepricec;
		var bprice = buyitnowpriced + "." + buyitnowpricec;
		
		
		if (Number(sprice) >= Number(rprice))
		{
			alert('The Start Price cannot be more than the Reserve Price');
			document.registerForm.startpriced.focus();
		}

		if (Number(rprice) >= Number(bprice))
		{
			alert('The Reserve Price cannot be more than the Buy-It-Now-Price');
			document.registerForm.buyitnowpriced.focus();
		}

    		if (!filter.test(day) || !filter.test(hour) || !filter.test(min)) {
    			alert('Please provide a valid Duration');
			document.registerForm.day.focus();
			exit;
 		}

		return;

}

//function to display days
function displayTimeDay()
{
	var timeDay = "Day"
	document.write("<select value='day' name='day' id='day'>");

	for (var i=1; i <=25; i++)
	{
		document.write("<option>" + timeDay + "</option>");
		timeDay=i;
	}
	document.write("</select>");
}

//function to display hours
function displayTimeHours()
{
	var timeHours = "Hour"
	document.write("<select value='hour' name='hour' id='hour'>");

	for (var i=0; i <=24; i++)
	{
		document.write("<option>" + timeHours + "</option>");
		timeHours=i;
	}
	document.write("</select>");
}

//function to display minutes
function displayTimeMinutes()
{
	var timeMinutes = "Min";
	document.write("<select value='min' name='min' id='min'>");

	for (var i=0; i <=60; i++)
	{        	            
		document.write("<option>" + timeMinutes + "</option>");
		timeMinutes=i;
	}
	document.write("</select>");
} 	
