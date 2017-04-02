<?php 

session_start();
if($_SESSION['id'] != ""){
	$id = $_SESSION['id'];
}
else
	header("location: login.php");

if(file_exists('users/' . $id . '.xml')){
	$xml = new SimpleXMLElement('users/' . $id . '.xml', 0, true);
	
	if($xml->usertype == "Admin"){
		$name = $xml->name;
	}
	else if ($xml->usertype == "User"){
		header("location: userhomepage.php");
	}
	else{
		header("location: login.php");
	}
}
	
else{
	header("location: login.php");
}


?>


<html>
	<head>
		<title> Admin's Homepage </title>
	</head>
	
	<body>
		<fieldset>
			<center> <h1> <b> Welcome, <?php echo $name?>! </b> </h1> </center>
			<br/>
			<center> <a href="./profile.php"> Profile </a> </center>
			<center> <a href="./passchange.php"> Change Password </a> </center>
			<center> <a href="./userview.php"> View Users </a> </center>
			<center> <a href="./logout.php"> Logout </a> </center>
		</fieldset>
	</body>
</html>