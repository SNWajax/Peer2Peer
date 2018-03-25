<?php
	session_start();
	if(isset($_SESSION["email"])){   
	}
	else
		header("Location: index.php");
	$_POST["donnerEmail"];
	$_POST["qty"];
	$_POST["item"];
	$_POST["aItemID"];
	$_POST["requestAmount"];
	
	$conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
	//remove from donor
	$cmd = "SELECT * FROM donation WHERE email = '$_POST[donnerEmail]' AND itemID = $_POST[aItemID]";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	echo $cmd;
	if($result = $statement->fetch()){
		if($result['qty']==$_POST["requestAmount"]){
			$cmd = "Delete FROM donation WHERE email = '$_POST[donnerEmail]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}
		else{
			$cmd = "UPDATE donation SET qty = qty - $_POST[requestAmount] WHERE email = '$_POST[donnerEmail]' AND itemID = $_POST[aItemID]";
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
		if($result['qty']==$_POST["requestAmount"]){
			$cmd = "Delete FROM request WHERE email = '$_SESSION[email]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}
		else{
			$cmd = "UPDATE request SET qty = qty - $_POST[requestAmount] WHERE email = '$_SESSION[email]' AND itemID = $_POST[aItemID]";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}	
	}	
	
	$cmd = "SELECT * FROM users WHERE email = '$_POST[donnerEmail]'";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$result = $statement->fetch();
	$donnerName = $result["fName"];
	
	$cmd = "SELECT * FROM users WHERE email = '$_SESSION[email]'";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$result = $statement->fetch();
	$receiverName = $result["fName"];
	
	$to = $_SESSION["email"];
	$subject = "Donor Found";

	$message = "
	<html>
	<body>
		"Hi $receiverName, \n\n We have an individual, $donnerName who would like to donate $_POST[requestAmount] $_POST[item]. Please feel free to contact them at $_POST[donnerEmail] at the earliest. \n\n Thank you. \n - Peer2Peer";
	</body>
	</html>
	";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);

	mail($to,$subject,$txt,$headers);
	
	$to = $_POST["donnerEmail"];
	$subject = "Receiver Found";
	$txt = "Hi $donnerName, \n\n We have an individual, $receiverName who would like to receive $_POST[requestAmount] $_POST[item]. Please feel free to contact them at $_SESSION[email]. \n\n Thank you. \n - Peer2Peer";
	$headers = "From: webmaster@example.com" . "\r\n";

	mail($to,$subject,$txt,$headers);
?>
