
<?php
	$to = "rzhang8277@bths.edu";
	$subject = "HTML email";

	$message = "
	<html>
	<body>
		<p>This email contains HTML Tags!</p>
		
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
?>