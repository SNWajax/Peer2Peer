
<?php
$to = "vm1420@nyu.edu";
$subject = "Donator Found";
$txt = "Hi, _____. \n\n Your requested item has been found.  Enjoy.  \n - Peer2Peer";
$headers = "From: webmaster@example.com" . "\r\n";

mail($to,$subject,$txt,$headers);
?>