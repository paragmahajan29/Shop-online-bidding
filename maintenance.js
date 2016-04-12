
/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file allows to create async requests for maintainace page
*/

var xhr = createRequest();

// code to create async request for processing auction items
function processAuctionItems()
{
	var requestbody = "process=" + encodeURIComponent('1');
	if (xhr)
		createAsyncConection(xhr, "maintenance.php", "post", requestbody);	
}

//code to create async request for generating report
function generateReport()
{
	var requestbody = "generate=" + encodeURIComponent('1');
	if (xhr)
		createAsyncConection(xhr, "maintenance.php", "post", requestbody);	

}