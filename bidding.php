<?php
/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : file to process bidding requests 
*/
// to check session still exists or not

	session_start(); 
 
	error_reporting(0);
	if ($_SESSION['customerid'] == "")
	{	
		error_reporting(E_ALL);
		echo	"Login Error: User not Logged On Click <a href='login.htm' target='login.htm' >Home</a> to login";
		exit();	
	}
	
	error_reporting(E_ALL);
	
// code to get data from aunction.xml 	
	$filename = '../../data/auction.xml';
	$dom = DOMDocument::load($filename);
	
	$items = $dom->getElementsByTagName('auction');
									
	foreach($items as $item){
		$itemid =  $item->getElementsByTagName('itemid')->item(0)->nodeValue;
		$itemname =  $item->getElementsByTagName('itemname')->item(0)->nodeValue;
		$category =  $item->getElementsByTagName('category')->item(0)->nodeValue;
		$description =  $item->getElementsByTagName('description')->item(0)->nodeValue;
		$buyitnowprice =  $item->getElementsByTagName('buyitnowprice')->item(0)->nodeValue;
		$bidprice =  $item->getElementsByTagName('bidprice')->item(0)->nodeValue;
		$enddate =  $item->getElementsByTagName('enddate')->item(0)->nodeValue;
		$endtime =  $item->getElementsByTagName('endtime')->item(0)->nodeValue;
		$status =  $item->getElementsByTagName('status')->item(0)->nodeValue;
		
		$html = "<fieldset class='biditems'>
					<table>
						<tr><td class='mleft'>Item No: </td><td class='mleft'> $itemid </td></tr>
						<tr><td class='mleft'>Item Name: </td><td class='mleft'> $itemname </td></tr>
						<tr><td class='mleft'>Item Category: </td><td class='mleft'> $category </td></tr>
						<tr><td class='mleft'>Item Description: </td><td class='mleft'> $description </td></tr>
						<tr><td class='mleft'>Buy it Now Price: </td><td class='mleft'> $buyitnowprice </td></tr>
						<tr><td class='mleft'>Bid Price: </td><td class='mleft' id='bid$itemid'> $bidprice </td></tr>";
						
		$end= DateTime::createFromFormat('d/m/Y H:i:s', $enddate." ".$endtime.":00");
		$start_date = new DateTime(date('Y-m-d H:i:s'));
		$remaing_duration = $start_date->diff(new DateTime(date_format( $end,'Y-m-d H:i:s')));
		$dur = $remaing_duration->d.' days '.$remaing_duration->h. ' hours ' .$remaing_duration->i. ' minutes and '.$remaing_duration->s. ' seconds';
		
		if (date_format( $end,'Y-m-d H:i:s') > date('Y-m-d H:i:s') && $status != "SOLD")
		{
			$html .="<tr><td class='mleft'> <i> $dur </i></td></tr>
					<tr colspan='2'>
						<td class='mcenter' id='unsold$itemid'><input type='button' onClick='placeBid($itemid,$bidprice)'value='Place Bid' id='placebid'/>
						<input type='button' onClick='buyIt($itemid)'value='Buy It Now' id='buyitnow'/> </td>
					</tr>	";
		}else if($status == "SOLD")
				$html.= "<tr><td class='mcenter'><b>Item Sold</b></td></tr>";
			else	
				$html .= "<tr><td class='mcenter'> <b><i> Time Expired </i></b></td></tr>";
				
		$html .="	</table>
				 </fieldset>	
		";
		
		echo $html;
    } 

?>
