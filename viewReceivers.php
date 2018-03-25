<?php
	session_start();
	if(!isset($_SESSION["email"])){  
		header("Location: index.php");
	}
	if(isset($_GET["loadCategory"])){   
		$_SESSION["loadCategory"] = $_GET["loadCategory"];
	}
?>
<html onload = "loadMarkers()">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/viewDonations.css">
    </head>
    <body onload ="loadMarkers()">
		<div id="map" class="center" style="width:auto;height:98vh;background:yellow"></div>
		<div class = "top-rt">
			<a href = "back/logOut.php">
				<button class = "buttonLog">
					Log out
				</button>
			</a>
			<a id = "return" href = "main.php">
				<button class = "buttonReturn">
					Previous Page
				</button>
			</a>
			</div>
    </body>
	<script>
	var markers = [];
	function myMap(){
		map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		center: {lat: 40.6942036, lng: -73.986579},  
		disableDoubleClickZoom: true,
		});
	}
	function addMarker(aItem,aqty,anEmail,aItemID,alat,alng){
		var infowindow = new google.maps.InfoWindow({
			content: "testing"
		});	
		inputMarker = {lat: alat, lng: alng};
		infowindow.setContent('<b>'+aItem+' x'+aqty+'</b>'); 
		var marker = new google.maps.Marker({
			position: inputMarker,
			map: map,
			icon: 'images/blueMarker.png'
		});
		infowindow.open(map, marker);
		marker.addListener('click', function() {
			if (confirm('Are you sure you want to donate ' + aItem + '?')) {
				if(aqty > 1){
					ans = parseInt(prompt("How many "+aItem+ "s would you like to donate?"))
					if(ans <= 0 || ans > aqty)
						return;
				}
				else	
					ans = aqty;
				var request = new XMLHttpRequest();
				request.onreadystatechange=function(){
					if (this.readyState == 4 && this.status == 200){
						window.location.href = 'viewReceivers.php';	
					}
				};
				url = "back/alertReceiverUsers.php";
				request.open("POST", url, true);
				request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				request.send("receiverEmail="+anEmail+"&qty="+aqty+"&item="+aItem+"&aItemID="+aItemID+"&donateAmount="+ans);
			} else {
				console.log(anEmail);
			}
		});
		markers.push(marker);
	}	
	function loadMarkers(){
		var request = new XMLHttpRequest();
		request.onreadystatechange=function(){
			if (this.readyState == 4 && this.status == 200){
				console.log(this.responseText);
				var myArr = JSON.parse(this.responseText);
				console.log(myArr[0]);
				for(var i = 0; i<myArr.length;i++){
					formArray = myArr[i].split("&&");
					addMarker(formArray[0],formArray[1],formArray[2],formArray[3],parseFloat(formArray[4]),parseFloat(formArray[5]));
				}	
			}
		};
		url = "back/loadReceivers.php";
		request.open("POST", url, true);
		request.send();
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaiqxyvhOHctkfrcm5c8s1tOvwO08tihc&callback=myMap"></script>
</html>