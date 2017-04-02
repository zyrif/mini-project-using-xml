<html>
<head>
	<title>
		User Registration page
	</title>
</head>

<body>
	<form method="post">
	<fieldset>
		<legend>Registration</legend>
		Id: 
		<br/>
		<input type="text" name="idfield"/>
		<br/>
	
		Password: 
		<br/>
		<input type="password" name="passfield"/>
		<br/>
		
		Confirm Password: 
		<br/>
		<input type="password" name="confpassfield"/>
		<br/>
		
		Name:
		<br/>
		<input type="text" name="namefield"/>
		<br/>
		
		Email:
		<br/>
		<input type="text" name="emailfield"/>
		<br/>
		
		User Type [User/Admin]
		<br/>
		<select name="usertype">
			<option>User</option>
			<option>Admin</option>
		</select>
		
		<hr/>
		
		<input type="submit" value="Register"/>
		<a href="./login.php"> Login </a>
	
	</fieldset>
	</form>
	


</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$id = trim($_REQUEST['idfield']);
	$password = trim($_REQUEST['passfield']);
	$confirmpass = trim($_REQUEST['confpassfield']);
	$name = trim($_REQUEST['namefield']);
	$email = trim($_REQUEST['emailfield']);
	$usertype = $_REQUEST['usertype'];
	
	//set flags
	
	$idcorrect = false;
	$passcorrect = false;
	$namecorrect = false;
	$emailcorrect = false;
	$usertypecorrect = false;
	
	//open file
	
	$file = fopen("./record.txt","a+");
	
	if($file){
	
		// writeID
		$parts = explode("-", $id);
		$digits = str_split($id);
		$iflag = true;
		
		foreach ($digits as $item){
			if(!(($item >= '0' && $item <= '9') || $item == '-')){
				$iflag = false;
				break;
			}
		}
			
		if($id==""){
			echo "ID cannot be empty";
		}
		
		else if (count($parts) != 3){
			echo "ID format error";
		}
		
		else if ($iflag == false){
			echo "Characters other than 0-9 and - are not allowed";
		}
		
		else{
			$idcorrect = true;
		}
		
		//writeID end
		
		//writePass
		
		if($password == $confirmpass){
			$passcorrect = true;
		}
		
		else{
			echo "Passwords doesn't match\n";
		}
		
		
		//writePass end
		
		
		// writeName
		$words = explode(" ", $name);
		$chars = str_split($name);
		$flag1 = true;
		$flag2 = true;
		
		
		foreach ($chars as $item){
			if(!(($item >= 'a' && $item <= 'z') || ($item >= 'A' && $item <= 'Z') || $item == '.' || $item == '-' || $item == ' ')) {
				$flag1 = false;
				break;
			}
		}
		
		if(!(($chars[0] >= 'a' && $chars[0] <= 'z') || ($chars[0] >= 'A' && $chars[0] <= 'Z'))){
			$flag2 = false;
		}
		
		
		if($name==""){
			echo "Name can not be empty";
		}
		
		else if($flag1 == false){
			echo "Name should contain only a-z, A-Z, dot, dash.";
		}
		
		else if($flag2 == false){
			echo "Name should start with a letter.";
		}
		
		else{
			$namecorrect = true;
		}
		//showName ends here.
		
		echo "<br/>";
		
		//showEmail starts here
		$partemail = explode("@", $email);
		$partdomain = explode(".", $partemail[1]);
	
		if ($email == ""){
			echo "Email Address cannot be empty";
		}
		else if (count($partemail) != 2 || $partemail[0] == ""){
			echo "Invalid Email.";
		}
		else if (count($partdomain) != 2 || $partdomain[0] == ""){
			echo "Invalid Host.";
		}
		else if ($partdomain[1] == ""){
			echo "Invalid Domain.";
		}
		else {
			$emailcorrect = true;
		}
	
		//showEmail ends here
		
		echo "<br/>";
		
		//writeUserType
		
		if(!$usertype == ""){
			$usertypecorrect = true;
		}
		
		//writeUserType end
		
		//writeValuestoFile
		
		if($idcorrect == true && $passcorrect == true && $namecorrect == true && $emailcorrect == true && $usertypecorrect == true){
			$user = new DOMDocument();
			$user_id = $user->createElement("id");
			$user_id->appendChild(user->createTextNode($id)); 
			$user_pass = $user->createElement("password");
			$user_pass->appendChild(user->createTextNode($password));
			$user_name = $user->createElement("name");
			$user_name->appendChild(user->createTextNode($name));
			$user_email = $user->createElement("usertype");
			$user_email->appendChild(user->createTextNode($email));
			$user_type = $user->createElement("usertype");
			$user_type->appendChild(user->createTextNode($usertype));
			
			$user->appendChild($user_id);
			$user->appendChild($user_pass);
			$user->appendChild($user_name);
			$user->appendChild($user_email);
			$user->appendChild($user_type);
			
			$user->asXML("record.xml");
		
		}
	}
	
	else{
		echo "Error while opening file.";
	}

}	
?>

