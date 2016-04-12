<?xml version="1.0" encoding="utf-8"?>

<!--

/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file process items in auction.xml file to create report.
*/

-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" version="4.0" />

<xsl:template match="/">
	<table border = "1">
		<tr>
			<th> Item Id</th>
			<th> Customer Id</th>
			<th> Item Name</th>
			<th> Category </th>
			<th> Start Date </th>
			<th> Start Time </th>
			<th> End Date</th>
			<th> End Time </th>
			<th> Status </th>
			<th> Bid Price </th>
			<th> Reserve Price </th>
			<th> Buy It Now Price </th>	
		</tr>
		<xsl:for-each select="//auction[status='SOLD'] | //auction[status='FAILED']">
			<tr> 
				<td> <xsl:value-of select="itemid"/></td>
				<td> <xsl:value-of select="customerid"/></td>
				<td> <xsl:value-of select="itemname"/></td>
				<td> <xsl:value-of select="category"/></td>
				<td> <xsl:value-of select="startdate"/></td>
				<td> <xsl:value-of select="starttime"/></td>
				<td> <xsl:value-of select="enddate"/></td>
				<td> <xsl:value-of select="endtime"/></td>
				<td> <xsl:value-of select="status"/></td>
				<td> <xsl:value-of select="bidprice"/></td>
				<td> <xsl:value-of select="reserveprice"/></td>
				<td> <xsl:value-of select="buyitnowprice"/></td>
			</tr>
		</xsl:for-each>
	</table>	
<br/>
	Number of Item Sold : <xsl:value-of select="count(//auction[status='SOLD'])"/>
<br/>
	Number of Item Failed : <xsl:value-of select="count(//auction[status='FAILED'])"/>
<br/>
	
	Total revenue generated: <xsl:value-of select="sum(//auction[status='FAILED']/reserveprice) * 0.01 + sum(//auction[status='SOLD']/bidprice) * 0.03"/>
</xsl:template>
</xsl:stylesheet>