
<?php
	$to = "rzhang8277@bths.edu";
	$subject = "HTML email";

	$message = "
	<html>
	<body>
	<h1>My First Google Map</h1>

	<div id='map' style='width:400px;height:400px;background:yellow'></div>
	<script>
		var markers = [];
		function myMap(){
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 16,
			center: {lat: 40.6942036, lng: -73.986579},  
			disableDoubleClickZoom: true,
			});
			
		}
	</script>
	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCaiqxyvhOHctkfrcm5c8s1tOvwO08tihc&callback=myMap'></script>
	</body>
	</html>";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	mail($to,$subject,$message,$headers);
?>