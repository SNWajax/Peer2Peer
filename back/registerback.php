<?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $email = $_POST["email"];        
    $password = $_POST["password1"];
    if($FName==null || $LName==null || $email==null || $password==null)	
        $_SESSION["error"] = "You cannot leave any field blank.";
    else
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			$_SESSION["error"] = "Not a vaild email.";
		else
			if(!preg_match("/^[a-zA-Z0-9\~!@#$%^&*_]*$/",$password))
				$_SESSION["error"] = "Password may only contain A-Z, a-z, 0-9, ~, !, @, #, $, %, ^, &, *, _)";
			else{
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$statement = $conn->prepare("SELECT email FROM users WHERE email = '$email'");
				$statement->execute();
				if(($statement->fetch()) == false){
					$statement = $conn->prepare("INSERT INTO users VALUES (null,'$email','$hashedPassword','$FName','$LName')");
					$statement->execute();
					$_SESSION["error"] = "Account created.";
					}
				else
					$_SESSION["error"] = "Email is already used.";
			}    
    if($_SESSION["error"] == "Account created.") 
        header("Location: ../index.php");             
    else
        header("Location: ../register.php");            
?>