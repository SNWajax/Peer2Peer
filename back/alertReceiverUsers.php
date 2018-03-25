<?php
	session_start();
	if(isset($_SESSION["email"])){   
	}
	else
		header("Location: index.php");
	$_POST["receiverEmail"];
	$_POST["qty"];
	$_POST["item"];
	$_POST["aItemID"];
	$_POST["donateAmount"];
	
	$conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
	$cmd = "SELECT * FROM request WHERE email = '$_POST[receiverEmail]' AND itemID = $_POST[aItemID]";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	echo $cmd;
	if($result = $statement->fetch()){
		if($result['qty']==$_POST["donateAmount"]){
			$cmd = "Delete FROM request WHERE email = '$_POST[receiverEmail]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}
		else{
			$cmd = "UPDATE request SET qty = qty - $_POST[donateAmount] WHERE email = '$_POST[receiverEmail]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}	
	}	
	//remove from donor
	$cmd = "SELECT * FROM request WHERE email = '$_SESSION[email]' AND itemID = $_POST[aItemID]";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	echo $cmd;
	if($result = $statement->fetch()){
		if($result['qty']==$_POST["donateAmount"]){
			$cmd = "Delete FROM request WHERE email = '$_SESSION[email]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}
		else{
			$cmd = "UPDATE request SET qty = qty - $_POST[donateAmount] WHERE email = '$_SESSION[email]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}	
	}	
	
	$cmd = "SELECT * FROM users WHERE email = '$_POST[receiverEmail]'";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$result = $statement->fetch();
	$receiverName = $result["fName"];
	
	$cmd = "SELECT * FROM users WHERE email = '$_SESSION[email]'";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$result = $statement->fetch();
	$donnerName = $result["fName"];
	
	$to = $_POST["receiverEmail"];
	$subject = "Donor Found";
	$txt = "Hi $receiverName, \n\n We have an individual, $donnerName who would like to donate $_POST[donateAmount] $_POST[item]. Please feel free to contact them at $_POST[receiverEmail] at the earliest. \n\n Thank you. \n - Peer2Peer";
	$headers = "From: webmaster@example.com" . "\r\n";

	mail($to,$subject,$txt,$headers);
	
	$to = $_SESSION["email"];
	$subject = "Receiver Found";
	$txt = "Hi $donnerName, \n\n We have an individual, $receiverName who would like to receive $_POST[donateAmount] $_POST[item]. Please feel free to contact them at $_SESSION[email]. \n\n Thank you. \n - Peer2Peer";
	$headers = "From: webmaster@example.com" . "\r\n";

	mail($to,$subject,$txt,$headers);
?>
