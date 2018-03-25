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
	<head>
	<title>HTML email</title>
	</head>
	<body>
		<div>Hi $receiverName, <br><br> We have an individual, $donnerName who would like to donate <b> $_POST[requestAmount] $_POST[item] </b>. <br> Please feel free to contact them at $_POST[donnerEmail] at the earliest. <br><br> #WeAreHereForYou <br><br> Thank you. <br> - Peer2Peer
		</div>
	</body>
	</html>
	";
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);

	$to = $_POST["donnerEmail"];
	$subject = "Receiver Found";
	$message = "
	<html>
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
		<p>Hi $donnerName, <br><br> We have an individual, $receiverName who would like to receive <b> $_POST[requestAmount] $_POST[item] </b>. <br> Please feel free to contact them at $_SESSION[email]. <br><br> #FaithInHumanityIsRestored <br><br> Thank you. <br> - Peer2Peer
		</p>
	</body>
	</html>
	";
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
?>
