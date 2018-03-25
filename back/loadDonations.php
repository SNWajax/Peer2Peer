<?php
	session_start();
	if(!isset($_SESSION["email"])){  
		header("Location: index.php");
	}
	$conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
	$cmd = "SELECT * FROM donation";
	$statement = $conn->prepare($cmd);
	$statement->execute();
	$arr = array();
	while($result = $statement->fetch()){
		$conn2 = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
		if(isset($_SESSION["loadCategory"])){  
			$cmd2 = "SELECT itemType FROM donationcatergory WHERE itemID = $result[itemID] AND itemType = $_SESSION[loadCategory]";
		}
		else
			$cmd2 = "SELECT itemType FROM donationcatergory WHERE itemID = $result[itemID]";
		$statement2 = $conn2->prepare($cmd2);
		$statement2->execute();
		if ($result2 = $statement2->fetch()){
			// echo $result2['itemType'] . " ";
			$conn3 = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
			if($result2['itemType']==="Clothing"){
				$cmd3 = "SELECT * FROM donationclothing WHERE itemID = $result[itemID]";
				$statement3 = $conn3->prepare($cmd3);
				$statement3->execute();
				$result3 = $statement3->fetch();
				$itemName = $result3["name"]. " ".$result3["size"];
			}
			if($result2['itemType']==="Food"){
				$cmd3 = "SELECT * FROM donationfood WHERE itemID = $result[itemID]";
				$statement3 = $conn3->prepare($cmd3);
				$statement3->execute();
				$result3 = $statement3->fetch();
				$itemName = $result3["name"];
			}	
			if($result2['itemType']==="Misc"){
				$cmd3 = "SELECT * FROM donationmisc WHERE itemID = $result[itemID]";
				$statement3 = $conn3->prepare($cmd3);
				$statement3->execute();
				$result3 = $statement3->fetch();
				$itemName = $result3["itemName"];
			}
			$input = $itemName."&&".$result['qty']."&&".$result['email']."&&".$result['itemID']."&&".$result['Lat']."&&".$result['Lng'];
			array_push($arr,$input);
		}	
	}
	echo json_encode($arr);
?>
