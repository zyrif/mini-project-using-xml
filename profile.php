<?php

session_start();
if($_SESSION['id'] != ""){
	$id = $_SESSION['id'];
}
else
	header("location: login.php");

if(file_exists('users/' . $id . '.xml')){
	$xml = new SimpleXMLElement('users/' . $id . '.xml', 0, true);
	
	$id = $xml->id;
	$name = $xml->name;
	$email = $xml->email;
	$usertype = $xml->usertype;
	
	if($xml->usertype == "Admin"){
		$gohome = "./adminhomepage.php";
	}
	else if ($xml->usertype == "User"){
		$gohome = "./userhomepage.php";
	}
}
	
else{
	header("location: login.php");
}

?>

<html>
<head>
	<title> User Profile </title>
</head>

<body>
	<table border="1" cellspacing="0">
		<tr> <td  colspan="2">  <center> Profile </center> </td> </tr>
		<tr> <td> <p> ID </p> </td> <td> <p> <?php echo $id;?> </p> </td> </tr>
		<tr> <td> <p> Name </p> </td> <td> <p> <?php echo $name;?> </p> </td> </tr>
		<tr> <td> <p> Email </p> </td> <td> <p> <?php echo $email;?> </p> </td> </tr>
		<tr> <td> <p> User Type </p> </td> <td> <p> <?php echo $usertype;?> </p> </td> </tr>
		<tr> <td  colspan="2"> <a href="<?php echo $gohome;?>"> Go Home </a> </td> </tr>
	
	</table>
</body>	
</html>