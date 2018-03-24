<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
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
			<form action="back/loginback.php" method="post">  
				<input type="text" placeholder="Email" name="email" size = "100" value = "" required>
				<input type="password" placeholder="Password" name="password" size = "100" value = "" required>
				<button type="submit" name="login"><b>LOGIN</b></button>
			</form>
			<a class="jump" href="register.php"><b>REGISTER</b></a>
		</div>
	</div>
</body>
</html>
