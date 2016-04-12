/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : file to create async request  for place bid and buy it now
*/

var xhr = createRequest();
// function to show bidding items and fresh them after every 5 seconds. 
function showBiddingItems()
{
	if (xhr)
		biddingListAsyncConection(xhr, "bidding.php", "post", "");	
	// to refresh data every 5 seconds	
	setTimeout(showBiddingItems, 5000);	
}

// async call to show items
function biddingListAsyncConection(xhrObj, url, method, requestbody)
{
	xhrObj.open(method, url, true);
	var biddingitems = document.getElementById('biddingitems');
	if (method == "post")
		xhrObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			biddingitems.innerHTML = xhr.responseText;
		} 
	} 
	xhrObj.send(requestbody); 
}

//function to place bid
function placeBid(itemid, currentbid)
{
	var newbidprice = prompt("Please enter new bid. Bid Price has to be higher then current bid " + currentbid);
	var filter = /^[0-9]+$/;
	if (newbidprice==null || newbidprice.trim()=="" || !filter.test(newbidprice.trim()) || currentbid >= newbidprice ) {
		
		alert("Sorry your bid is not valid");

	} else { 
		newbidprice = parseFloat(Number(newbidprice.trim())).toFixed(2);
		var bidpriceobj = document.getElementById("bid"+itemid);
		bidpriceobj.innerHTML = newbidprice;
		var requestbody = "itemid=" + encodeURIComponent(itemid) + "&newbidprice=" + encodeURIComponent(newbidprice);
		if (xhr)
			createAsyncConection(xhr, "process_bid.php", "post", requestbody);
	}
	
}


function buyIt(itemid)
{
	var buyitemobj = document.getElementById("unsold"+itemid);
	buyitemobj.innerHTML = "<b>Item Sold</b>";
	var requestbody = "buyitnowitemid=" + encodeURIComponent(itemid);
	if (xhr)
	    createAsyncConection(xhr, "process_bid.php", "post", requestbody);	

}