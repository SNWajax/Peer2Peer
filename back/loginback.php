<?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
    $email = $_POST["email"];        
    $password = $_POST["password"];
    if($email==null || $password==null)	
        $_SESSION["error"] = "You cannot leave any field blank.";
    else
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			$_SESSION["error"] = "Not a vaild email.";
		else{
			$cmd = "SELECT uPass FROM users WHERE email='$_POST[email]'";
			echo $cmd;
            $statement = $conn->prepare($cmd);
            $statement->execute();
            $result = $statement->fetch();
			echo $result["uPass"];
            if ($result && password_verify($_POST["password"], $result["uPass"]))
                $_SESSION["email"] = $email;
            else
                $_SESSION["error"] = "Not a valid account.";
        }
	if(isset($_SESSION["email"])) 
        header("Location: ../choose.php");             
    else
        header("Location: ../index.php");    
?>