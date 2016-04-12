<?php	
	session_start(); 
	
 	error_reporting(0);
	if ($_SESSION['customerid'] == "")
	{	
		error_reporting(E_ALL);
		
		echo	"Login Error: User not Logged On Click <a href='login.htm' >Home</a> to login";
		exit();	
	}
	
	error_reporting(E_ALL);

	$startTime = date('H:i');
	$startDate = date('m/d/Y');

	$d = $_POST['day'];
	$m = $_POST['min'];
	$h = $_POST['hour'];
		
	$date = date_create($startDate ." ". $startTime);
	date_modify($date, '+'.$d.' day +'.$m.' minute +'.$h.' hour');

	$endDate = date_format($date, 'd/m/Y');
	$endTime = date_format($date, 'H:i');
	$startDate = date_create($startDate);
	$startDate = date_format($startDate, 'd/m/Y');


	
	$filename = '../../data/auction.xml';

	// code to create 'auction.xml' file and store item data in it.
	if (!file_exists($filename)) {
	
		$xml = new DOMDocument("1.0");
		
		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;
			
		$auctions = $xml->createElement("auctions");
		$xml->appendChild($auctions);
		$parent = $xml->createElement('auction');
		$auctions->appendChild($parent);

		$child = $xml->createElement('itemid');
		$parent->appendChild($child);
		$value = $xml->createTextNode('1');
		$child->appendChild($value);
		
		$child = $xml->createElement('customerid');
		$parent->appendChild($child);
		$value = $xml->createTextNode(trim($_SESSION['customerid']));
		$child->appendChild($value);
		
		$child = $xml->createElement('itemname');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['itemname']);
		$child->appendChild($value);
		
		$child = $xml->createElement('category');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['category']);
		$child->appendChild($value);
		
		$child = $xml->createElement('description');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['description']);
		$child->appendChild($value);
		
		$child = $xml->createElement('startdate');
		$parent->appendChild($child);
		$value = $xml->createTextNode($startDate);
		$child->appendChild($value);
		
		$child = $xml->createElement('starttime');
		$parent->appendChild($child);
		$value = $xml->createTextNode($startTime);
		$child->appendChild($value);
		
		$child = $xml->createElement('enddate');
		$parent->appendChild($child);
		$value = $xml->createTextNode($endDate);
		$child->appendChild($value);
		
		$child = $xml->createElement('endtime');
		$parent->appendChild($child);
		$value = $xml->createTextNode($endTime);
		$child->appendChild($value);
		
		$child = $xml->createElement('status');
		$parent->appendChild($child);
		$value = $xml->createTextNode('in_progress');
		$child->appendChild($value);
		
		$child = $xml->createElement('bidprice');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['sprice']);
		$child->appendChild($value);
		
		$child = $xml->createElement('reserveprice');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['rprice']);
		$child->appendChild($value);
		
		$child = $xml->createElement('buyitnowprice');
		$parent->appendChild($child);
		$value = $xml->createTextNode($_POST['bprice']);
		$child->appendChild($value);
		
		$xml->save($filename);
		
		echo '<p>Thank you! Your item has been listed in ShopOnline.</p>';
		echo '<p>The item number is 1 , and the bidding starts now:' .$startTime .' on '. $startDate.'</p>';

	} else {
	
	// code to store new item with new id
	
	$dom = DOMDocument::load($filename);
	$auctions = $dom->getElementsByTagName("auction"); 
	foreach($auctions as $auction) 
	{ 
		$latest_id = $auction->getElementsByTagName("itemid");
		$latest_id = $latest_id->item(0)->nodeValue;
	}	
	
	$new_id = $latest_id + 1;
	$xml = new DOMDocument("1.0");
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;
	$xml->load($filename);
	
	$auctions_ele = $xml->firstChild;
	$parent = $xml->createElement('auction');
	$auctions_ele->appendChild($parent);
	
	$child = $xml->createElement('itemid');
	$parent->appendChild($child);
	$value = $xml->createTextNode($new_id);
	$child->appendChild($value);
	
	$child = $xml->createElement('customerid');
	$parent->appendChild($child);
	$value = $xml->createTextNode(trim($_SESSION['customerid']));
	$child->appendChild($value);
	
	$child = $xml->createElement('itemname');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['itemname']);
	$child->appendChild($value);
	
	$child = $xml->createElement('category');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['category']);
	$child->appendChild($value);
	
	$child = $xml->createElement('description');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['description']);
	$child->appendChild($value);
	
	$child = $xml->createElement('startdate');
	$parent->appendChild($child);
	$value = $xml->createTextNode($startDate);
	$child->appendChild($value);
	
	$child = $xml->createElement('starttime');
	$parent->appendChild($child);
	$value = $xml->createTextNode($startTime);
	$child->appendChild($value);
	
	$child = $xml->createElement('enddate');
	$parent->appendChild($child);
	$value = $xml->createTextNode($endDate);
	$child->appendChild($value);
	
	$child = $xml->createElement('endtime');
	$parent->appendChild($child);
	$value = $xml->createTextNode($endTime);
	$child->appendChild($value);
	
	$child = $xml->createElement('status');
	$parent->appendChild($child);
	$value = $xml->createTextNode('in_progress');
	$child->appendChild($value);
	
	$child = $xml->createElement('bidprice');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['sprice']);
	$child->appendChild($value);
	
	$child = $xml->createElement('reserveprice');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['rprice']);
	$child->appendChild($value);
	
	$child = $xml->createElement('buyitnowprice');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['bprice']);
	$child->appendChild($value);	
	
	$xml->save($filename);

	echo '<p>Thank you! Your item has been listed in ShopOnline.</p>';
	echo '<p>The item number is '. $new_id.' , and the bidding starts now:' .$startTime .' on '. $startDate.'</p>';
		
	}
	
	
?>
