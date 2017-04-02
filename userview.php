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

	}
	
	else if($xml->usertype == "User"){
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
	<title> User List </title>
</head>

<body>
	<table border="1" cellspacing="0">
		<tr> <td  colspan="4">  <center> Users </center> </td> </tr>
		<tr> <td> <p> ID </p> </td> <td> <p> Name </p> </td> <td> <p> Email </p> </td> <td> <p> User Type </p> </td> </tr>
		
<?php
	if($records = scandir('./users/')){

		foreach($records as $item){
			if($item[0] != "."){
				$files[] = $item;	 
			}
		}

		foreach($files as $file){
			$xml = new SimpleXMLElement('users/' . $file, 0, true);
				 echo "<tr> <td> <p> $xml->id </p> </td> <td> <p> $xml->name </p> </td> <td> <p> $xml->email </p> </td> <td> <p> $xml->usertype </p> </td> </tr>";
		}
	}
	else{
		header("location: error.php");
	}
?>
		<tr> <td  colspan="4"> <a href="./adminhomepage.php"> Go Home </a> </td> </tr>
	
	</table>