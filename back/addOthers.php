<?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
	$category = $_POST['items'];
	$itemToAdd = $_POST['itemToAdd'];	
	$cmd = "INSERT into donationcatergory VALUES (null,'$category')";

	$statement = $conn->prepare($cmd);
	$statement->execute();
	$table = "donation".$category;

	$cmd = "SELECT MAX(itemID) AS itemID FROM donationcatergory";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$result = $statement->fetch();
	$id = $result['itemID'];
	$cmd = "INSERT into $table VALUES ($id,'$itemToAdd')";
	echo $cmd;
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$_SESSION["error"] = "Thank for the update.  $itemToAdd has been successfully added.";
    header("Location: ../main.php");   
?>