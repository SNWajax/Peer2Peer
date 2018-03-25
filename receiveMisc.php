<?php
	session_start();
	if(isset($_SESSION["email"])){   
		$conn = new PDO("mysql:host=localhost;dbname=peer2peer", "root", "");
		$cmd = "SELECT itemName, itemID FROM donationmisc";
		$statement = $conn->prepare($cmd);
		$statement->execute();
	}
	else
		header("Location: index.php");
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/donate.css">
    </head>
    <body>
        <div class="bdy-main">
            <div id = "form-ctn">
				<form action="back/Receive.php" class = "w3-container w3-card-4 w3-light-grey" method="post"> 
					<h1>Donate Misc</h1>
					<?php
						while($result = $statement->fetch()){
							echo "<label> $result[itemName] </label>";
							echo "<input type='number' class = 'w3-input' w3-border w3-round name='$result[itemID]' min='0' required value='0'>";
							echo "</br>";
						}
					?>
					<input id = "lng" type="hidden" name = "lng">
					<input id = "lat" type="hidden" name = "lat">
					<h3>Confirm location</h3>
					<div id="map" class="center" style="width:400px;height:400px;background:yellow"></div>
					<div class = "buttondiv">
						<input id = "submit" class="w3-input w3-border w3-round" type="submit">
					</div>
				</form>
			</div>
        </div>
		<a href = "back/logOut.php">
			<button class = "buttonReturn">
				Log out
			</button>
		</a>
		<a id = "missing" href = "others.php">
			Missing Something?
		</a>
		<a id = "return" href = "main.php">
			Previous Page
		</a>
    </body>
	<script>
	var markers = [];
	function myMap(){
		map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		center: {lat: 40.6942036, lng: -73.986579},  
		disableDoubleClickZoom: true,
		});
		
		google.maps.event.addListener(map, 'click', function(event){
			validate();
			if(markers.length>0)
				markers[0].setMap(null);
			inputMarker = {lat: event.latLng.lat(), lng: event.latLng.lng()};
			//console.log(event.latLng.lat());
			//console.log(event.latLng.lng());
			document.getElementById("lat").value = event.latLng.lat();
			document.getElementById("lng").value = event.latLng.lng();
			var marker = new google.maps.Marker({
				position: inputMarker,
				map: map
			});
			markers[0] = marker;
		});
	}
	document.getElementById('submit').disabled = true;
	function validate() {
		document.getElementById('submit').disabled = false;
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaiqxyvhOHctkfrcm5c8s1tOvwO08tihc&callback=myMap"></script>
</html>