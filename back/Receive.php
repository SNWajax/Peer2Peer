<?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$email = $_SESSION['email'];
	$itemName = $_POST["itemName"];
	$counter = 0;
	foreach($_POST as $key => $value){
		if(intval($value) > 0){
			$cmd = "INSERT into request VALUES ('$email',$key,$value,$lng,$lat)";
			echo $cmd;
			$statement = $conn->prepare($cmd);
			$statement->execute();
		}	
		$counter++;
		if($counter>count($_POST)-3)
			break;
	}
	$_SESSION["error"] = "Request Successful";
    header("Location: ../main.php");   
?>