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
        <link rel="stylesheet" type="text/css" href="css/meh.css">
    </head>
    <body><div class = "headline">  
        </div>
        <div class="bdy-main">
            <div class="jumbotron text-center">
                <?php 
					echo "<h1>DONATE $fName!</h1>"
				?>
                <h2>That's what keeps us, US!</h2>
            </div>
            <div class="main text-center">
                <div class="itTags jumbotron-2" id="food">
                    <div class="middle">
                        <div class="bt">FOOD</div>
                    </div>
                </div>
                <div class="itTags jumbotron-3" id="clothes">
                    <div class="middle">
                        <div class="bt">CLOTHES</div>
                    </div>
                </div>
                <div class="itTags jumbotron-4 " id="misItems ">
                    <div class="middle">
                        <button class="bt">MSCELLANEOUS ITEMS</button>
                    </div>
                </div>
            </div>
            <div class="jumbotron text-center">
                <?php 
					echo "<h1>RECEIVE $fName!</h1>"
				?>
                <h2>We are here for you!</h2>
            </div>
            <div class="main text-center">
                <div class="itTags jumbotron-2" id="food">
                    <div class="middle">
                        <div class="bt">FOOD</div>
                    </div>
                </div>
                <div class="itTags jumbotron-3" id="clothes">
                    <div class="middle">
                        <div class="bt">CLOTHES</div>
                    </div>
                </div>
                <div class="itTags jumbotron-4 " id="misItems ">
                    <div class="middle">
                        <button class="bt">MSCELLANEOUS ITEMS</button>
                    </div>
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