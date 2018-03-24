<?php
	session_start();
	if(isset($_SESSION["email"])){   
		$conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
		$cmd = "SELECT fName FROM users WHERE email='$_SESSION[email]'";
		$statement = $conn->prepare($cmd);
		$statement->execute();
		$result = $statement->fetch();
		$fName = $result["fName"];
	}
	else
		header("Location: index.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/choose.css">
    </head>
    <body>
        <div class = "headline">
            <?php
				echo "<h3>Welcome $fName,
					</br> 
					Are you a donor or receiver?
				</h3>"
			?>
        </div>
        <div class="half don">
            <h1>DONATE</h1>
            <h2>FOOD</h2>
            <h2>CLOTHES</h2>
            <h2>OTHER ITEMS</h2>
        </div>
        <div class="half rec">
            <h1>RECEIVE</h1>
            <h2>FOOD</h2>
            <h2>CLOTHES</h2>
            <h2>OTHER ITEMS</h2>
        </div>
		<a href = "back/logOut.php">
			<button class = "buttonReturn">
				Log out
			</button>
		</a>
    </body>
</html>
