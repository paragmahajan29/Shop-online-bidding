<?php

session_start();

$email = $_POST['regemail'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$success = 0;
$er=0;
?>
<script>
var err="";
</script>
<?php
$filename = '../../data/customer.xml';
$possibleStr = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$password = substr(str_shuffle($possibleStr), 0, 6);

//code to check duplicate emails
if (file_exists($filename))
{
	$dom = DOMDocument::load($filename);
	$user = $dom->getElementsByTagName("customer"); 
	foreach($user as $node) 
	{ 
		$e = $node->getElementsByTagName("email");
		$e = $e->item(0)->nodeValue;

		$last_cid = $node->getElementsByTagName("cid");
		$last_cid = $last_cid->item(0)->nodeValue;
		if($e == $email)
		{
			$er++;
			$success = 0;
?>
			<script>
			err = "Email address already exist. Please try some other email address.";
			</script>
<?php
			break;
		}
	}
	if($er != 0)
	{
	?>
		<script type="text/javascript">
		alert(err);
		window.location = "register.htm";
		</script>
	<?php
	}
	else
	{
		$success = 1;
		append($filename, $last_cid, $password);
	}
}
else
{
	$success = 1;
	createFile($filename, $password);
}


function createFile($xml_file, $password)
{

	$xml = new DOMDocument("1.0");
	
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;
		
	$customer = $xml->createElement("coustomers");
	$xml->appendChild($customer);
	$parent = $xml->createElement('customer');
	$customer->appendChild($parent);

	$child = $xml->createElement('cid');
	$parent->appendChild($child);
	$value = $xml->createTextNode('1');
	$child->appendChild($value);

	$child = $xml->createElement('fname');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['fname']);
	$child->appendChild($value);

	$child = $xml->createElement('lname');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['lname']);
	$child->appendChild($value);

	$child = $xml->createElement('email');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['regemail']);
	$child->appendChild($value);

	$child = $xml->createElement('password');
	$parent->appendChild($child);
	$value = $xml->createTextNode($password);
	$child->appendChild($value);

	$xml->save($xml_file);
	
	$subject = 'Welcome to ShopOnline!';			
	$message = 'Dear '.$_POST['fname'].', welcome to use ShopOnline! Your customer id is '.$new_cid.' and the password is:'.$password;
	$to = $_POST['regemail'];
	$header = 'From registration@shoponline.com.au';
			
	mail($to, $subject, $message, $header, '-r 496019x@student.swin.edu.au');
}

function append($xml_file, $last_cid, $password)
{
	$new_cid = $last_cid + 1;
	$xml = new DOMDocument("1.0");
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;
	$xml->load($xml_file);

	$customer = $xml->firstChild;
	
	$parent = $xml->createElement('customer');
	$customer->appendChild($parent);

	$child = $xml->createElement('cid');
	$parent->appendChild($child);
	$value = $xml->createTextNode($new_cid);
	$child->appendChild($value);

	$child = $xml->createElement('fname');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['fname']);
	$child->appendChild($value);

	$child = $xml->createElement('lname');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['lname']);
	$child->appendChild($value);

	$child = $xml->createElement('email');
	$parent->appendChild($child);
	$value = $xml->createTextNode($_POST['regemail']);
	$child->appendChild($value);

	$child = $xml->createElement('password');
	$parent->appendChild($child);
	$value = $xml->createTextNode($password);
	$child->appendChild($value);

	$xml->save($xml_file);
	
	$subject = 'Welcome to ShopOnline!';			
	$message = 'Dear '.$_POST['fname'].', welcome to use ShopOnline! Your customer id is '.$new_cid.' and the password is:'.$password;
	$to = $_POST['regemail'];
	$header = 'From registration@shoponline.com.au';
			
	mail($to, $subject, $message, $header, '-r 496019x@student.swin.edu.au');
	
}
if($success)
{
?>

<script>
	err = "successfully Registered. Please check your email for password.";
	alert(err);
	window.location = "bidding.htm";
</script>

<?php } ?>