<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
</head>
<body>
    <div id="logo">
        <b>Peer2Peer</b>
    </div>

	<div class="center">
		<div class="imgcontainer">
			<img src="images/logo.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
		<?php
			session_start();
			if(isset($_SESSION["error"])){   
                echo "<div id = 'error'>".$_SESSION['error']."</div>";
                unset($_SESSION["error"]);
            }
		?>
		<form action="back/registerback.php" method="post">  
		  <ul>
			  <li>
				  <input type="text" placeholder="Insert your First Name" name="FName" size = "30" value = "" required>
			  </li>
			  <li>
				  <input type="text" placeholder="Insert your Last Name" name="LName" size = "30" value = "" required>
			  </li>
			  <li>
				  <input type="text" placeholder="Enter your email" name="email" size = "30" value = "" required>          
			  </li>
			  <li>
				  <input type="password" placeholder="Enter Password" id="password1" name="password1" size = "30" value = "" required>
			  </li>
			  <li>
				  <input type="password" placeholder="Retype Password" id="password2" name="password2" size = "30" value = "" required onkeyup="validate()">
			  </li>
		  </ul>
		<button type="submit" id="submit" name = "reg"><b>REGISTER</b></button>
		</form>
		<a class="jump" href="index.php"><b>LOGIN</b></a>
		</div>
	</div>
	<script>
	document.getElementById('submit').disabled = false;
	function validate() {
		var password1 = document.getElementById('password1').value;
		var password2 = document.getElementById('password2').value;
		if(password1 == password2) {
			console.log("match")
			document.getElementById('submit').innerHTML = "Register";
			document.getElementById('submit').disabled = false;
		}
		else {
		   console.log("not matching");
		   document.getElementById('submit').innerHTML = "Passwords must match";
		   document.getElementById("submit").disabled = true;
		}
	}
	</script>
</body>
</html>
