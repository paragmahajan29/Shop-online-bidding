
<?php

/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file does main processing of maitenance page.
*/

	session_start(); 
	error_reporting(0);
	if (!isset($_SESSION['customerid']))
	{	
		error_reporting(E_ALL);
		echo	"Login Error: User not Logged On Click <a href='login.htm' target='login.htm' >Home</a> to login";
		exit();	
	}
	
	error_reporting(E_ALL);
	
	// code to process data 
	$filename = '../../data/auction.xml';
	$dom = DOMDocument::load($filename);
	$items = $dom->getElementsByTagName('auction');
	if (isset($_POST['process'])) 
	{
		foreach($items as $item)
		{
			$itemid =  $item->getElementsByTagName('itemid')->item(0)->nodeValue;
			$enddate =  $item->getElementsByTagName('enddate')->item(0)->nodeValue;
			$endtime =  $item->getElementsByTagName('endtime')->item(0)->nodeValue;
			$end= DateTime::createFromFormat('d/m/Y H:i:s', $enddate." ".$endtime.":00");
			$status =  $item->getElementsByTagName('status')->item(0)->nodeValue;
			$bidprice =  $item->getElementsByTagName('bidprice')->item(0)->nodeValue;
			$reserveprice =  $item->getElementsByTagName('reserveprice')->item(0)->nodeValue;
			
			if (date_format( $end,'Y-m-d H:i:s') <= date('Y-m-d H:i:s') && $status == "in_progress")	
			{
				if($bidprice > $reserveprice)
					$item->getElementsByTagName('status')->item(0)->nodeValue = 'SOLD';
				
				if($bidprice < $reserveprice)
					$item->getElementsByTagName('status')->item(0)->nodeValue = 'FAILED';
			}
		}
		
		$dom->save($filename);
		
		echo " Process is complete.";
	}

	
	//code generate report using xslt
if (isset($_POST['generate'])) 
	{
		// load XML file into a DOM document
		
		// load XSL file into a DOM document 
		$xslDoc = DOMDocument::load("auction.xsl");
		// load XSL file into a DOM document

		// create a new XSLT processor object
		$proc = new XSLTProcessor;
		
		// load the XSL DOM object into the XSLT processor
		$proc->importStyleSheet($xslDoc); 
		
		// transform the XML document using the configured XSLT processor
		$strXml= $proc->transformToXML($dom);
		// echo the transformed HTML back to the client
		$dom->save($filename);
		//$xmlDoc->save("../data/auction.xml");
		echo ($strXml);

		
	
		
	}


?>
