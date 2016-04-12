<?php

/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file process place bid and buy it now functinality.
*/

// dRzwuE
	session_start(); 
	error_reporting(0);
	if ($_SESSION['customerid'] == "")
	{	
		error_reporting(E_ALL);
		echo	"Login Error: User not Logged On Click <a href='login.htm' target='login.htm' >Home</a> to login";
		exit();	
	}
	
	error_reporting(E_ALL);
	
	$filename = '../../data/auction.xml';
	$dom = DOMDocument::load($filename);
	$items = $dom->getElementsByTagName('auction');
	
	// code to add new bid to 'auction.xml' file
	if (isset($_POST['newbidprice'])) 
	{
		foreach($items as $item)
		{
			$itemid =  $item->getElementsByTagName('itemid')->item(0)->nodeValue;
				
			if($itemid == $_POST['itemid'])
			{
				$item->getElementsByTagName('customerid')->item(0)->nodeValue = trim($_SESSION['customerid']);
				$item->getElementsByTagName('bidprice')->item(0)->nodeValue = $_POST['newbidprice'];
				$dom->save($filename);
				echo '<p>Thank you! Your bid is recorded in ShopOnline</p>';
			}
		}
	}

	// code to process buy it now request
	if (isset($_POST['buyitnowitemid'])) 
	{
	
		foreach($items as $item)
		{
			$itemid =  $item->getElementsByTagName('itemid')->item(0)->nodeValue;
				
			if($itemid == $_POST['buyitnowitemid'])
			{
				$item->getElementsByTagName('customerid')->item(0)->nodeValue = trim($_SESSION['customerid']);
				$item->getElementsByTagName('bidprice')->item(0)->nodeValue = $item->getElementsByTagName('buyitnowprice')->item(0)->nodeValue;
				$item->getElementsByTagName('status')->item(0)->nodeValue = 'SOLD';
				$dom->save($filename);
				echo '<p>Thank you for purchasing this item</p>';
			}
		}
	}



?>