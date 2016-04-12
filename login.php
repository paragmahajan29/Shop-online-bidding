<?php
session_start();
/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : file to check login credentials  
*/

?>

<!DOCTYPE html>
<html lang="en">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Login</title>
		<script>
			var err = "";
		</script>
	</head>
	<body>
	<?php
		$er = 0;
		$loginemail=$_POST['loginemail'];
		$password=$_POST['password'];
		$filename = '../../data/customer.xml';

		// code check login information
		if (file_exists($filename))
		{
			$dom = DOMDocument::load($filename);
			$user = $dom->getElementsByTagName("customer"); 
			foreach($user as $node) 
			{ 
				$e = $node->getElementsByTagName("email");
				$e = $e->item(0)->nodeValue;
				$p = $node->getElementsByTagName("password");
				$p = $p->item(0)->nodeValue;
				$customerid = $node->getElementsByTagName("cid");
				$customerid = $customerid->item(0)->nodeValue;
				$name = $node->getElementsByTagName("fname");
				$name = $name->item(0)->nodeValue;
				if($e == $loginemail && $p == $password)
				{
					break;
				}
				else
				{
					$er++;
	?>
					<script>
						err = "Username and password do not match";
					</script>
<?php
				}
			}
			if($er != 0)
			{
?>
				<script type="text/javascript">
					alert(err);
					history.back();
				</script>
<?php
			}
			else
			{
			 // code set session variables after successful login
				$_SESSION['customerid']= $customerid;
				$_SESSION['name'] = $name;
				
				header("Location: bidding.htm");	
			}
		}
?>
</body>
</html>