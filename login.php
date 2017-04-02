<html>
<head>
	<title> Log In </title>
</head>

<body>
	<form method="post">
	<fieldset>
		<legend> Log In </legend>
		User Id: 
		<br/>
		<input type="text" name="idfield"/>
		<br/>
		
		Password:
		<br/>
		<input type="password" name="passfield"/>
		<br/>
			
		<input type="checkbox" name="remembercheck"/> Remember Me
		<br/>
		<hr/>	
		
		<input type="submit" name="login"/>
		<a href="./registration.php"> Register </a>
		
	</fieldset>
	</form>

</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
	
	session_start();
	
	$id = trim($_REQUEST['idfield']);
	$password = trim($_REQUEST['passfield']);
	
	if(file_exists('users/' . $id . '.xml')){
		$xml = new SimpleXMLElement('users/' . $id . '.xml', 0, true);
		if($password == $xml->password){
			$_SESSION['id'] = $id;
			if($xml->usertype == "Admin"){
				header("location: adminhomepage.php");
			}
			else if ($xml->usertype == "User"){
				header("location: userhomepage.php");
			}
		}
		
		else{
			echo "Wrong password";
		}
	}
	
	else{
		echo "User doesn't exist";
	}
}
