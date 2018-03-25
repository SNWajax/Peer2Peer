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
	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
		<div>Hi $receiverName, <br><br> We have an individual, $donnerName who would like to donate <b> $_POST[donateAmount] $_POST[item] </b>. <br> Please feel free to contact them at $_POST[receiverEmail] at the earliest. <br><br> #WeAreHereForYou <br><br> Thank you. <br> - Peer2Peer
		</div>
	</body>
	</html>
	";
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
	
	$to = $_SESSION["email"];
	$subject = $subject = "Receiver Found";
	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
		<div>Hi $donnerName, <br><br> We have an individual, $receiverName who would like to receive <b> $_POST[donateAmount] $_POST[item] </b>. <br> Please feel free to contact them at $_SESSION[email]. <br> <br> #FaithInHumanityIsRestored <br><br> Thank you. <br> - Peer2Peer
		</div>
	</body>
	</html>
	";
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
	
?>
