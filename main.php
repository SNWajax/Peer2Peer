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
	if(isset($_SESSION["loadCategory"])){
		unset($_SESSION["loadCategory"]);
	}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/meh.css">
    </head>
    <body><div class = "headline">  
        </div>
        <div class="bdy-main">
            <div class="jumbotron text-center">
                <?php 
					if(isset($_SESSION["error"])){   
						echo "<h1>$_SESSION[error]</h1>";
						unset($_SESSION["error"]);
					}
					else
						echo "<h1>DONATE HERE</h1>"
				?>
                <h2>That's what keeps us, US!</h2>
				<a class = "aTag" href = "viewReceivers.php">View All Receivers</a>
            </div>
            <div class="main text-center">
                <div class="itTags jumbotron-2" id="food">
                    <div class="middle" onclick="location.href='donateFood.php'">
                        Donate FOOD
                    </div>
					<a class = "aTag" href = "viewDonations.php?loadCategory='Food'">View All Food Donations</a>
                </div>
                <div class="itTags jumbotron-3" id="clothes">
                    <div class="middle" onclick="location.href='donateClothing.php'">
                        Donate CLOTHES
                    </div>
					<a class = "aTag" href = "viewDonations.php?loadCategory='Clothing'">View All Clothing Donations</a>
                </div>
                <div class="itTags jumbotron-4 " id="misItems ">
                    <div class="middle" onclick="location.href='donateMisc.php'">
                        Donate MISCELLANEOUS ITEMS
                    </div>
					<a class = "aTag" href = "viewDonations.php?loadCategory='Misc'">View All MISC Donations</a>
                </div>
            </div>
            <div class="jumbotron-5 text-center">
                <?php 
					echo "<h1>RECEIVE HERE</h1>"
				?>
                <h2>We are here for you!</h2>
				<a class = "aTag" href = "viewDonations.php">View All Donations</a>
            </div>
            <div class="main text-center">
                <div class="itTags jumbotron-6" id="food">
                    <div class="middle" onclick="location.href='receiveFood.php'">
                        Receive FOOD
                    </div>
					<a class = "aTag" href = "viewReceivers.php?loadCategory='Food'">View All Food Receivers</a>
                </div>
                <div class="itTags jumbotron-7" id="clothes">
                    <div class="middle" onclick="location.href='receiveClothing.php'">
                        Receive CLOTHES
                    </div>
					<a class = "aTag" href = "viewReceivers.php?loadCategory='Clothing'">View All Clothing Receivers</a>
                </div>
                <div class="itTags jumbotron-8" id="misItems ">
                    <div class="middle" onclick="location.href='receiveMisc.php'">
                        Receive MISCELLANEOUS ITEMS
                    </div>
					<a class = "aTag" href = "viewReceivers.php?loadCategory='Misc'">View All Misc Receivers</a>
                </div>
            </div>
        </div>
		<a href = "back/logOut.php">
			<button class = "buttonReturn">
				Log out
			</button>
		</a>
    </body>
</html>