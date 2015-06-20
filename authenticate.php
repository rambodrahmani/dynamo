<?php
/*
**    DYNAMO
**    Rambod Rahmani <rambodrahmani@yahoo.it>
*/
	include 'config.php';

	$device_authentication_type = null;
	$device_type = null;
	$device_ip_address = null;
	$arp = null;
	$device_mac_address = null;

	$device_authentication_type = $conn->real_escape_string($_GET['device_authentication_type']);
	$device_type = $conn->real_escape_string($_GET['device_type']);
	$device_ip_address = $conn->real_escape_string($_SERVER['REMOTE_ADDR']);

	$arp = "/usr/sbin/arp";
	$device_mac_address = shell_exec("$arp -an " . $device_ip_address);
	preg_match('/..:..:..:..:..:../', $device_mac_address , $matches);
	$device_mac_address = $conn->real_escape_string(@$matches[0]);

	if ($debugMode == true) {
		echo "Authenticating Device:<br>";
		echo "Client IP: " . $device_ip_address . "<br>";
	    echo "Client MAC: " . $device_mac_address . "<br>";
	    echo "Device Type: " . $device_type . "<br>";
	    echo "Authentication Type: " . $device_authentication_type . "<br>";
	}
	
	$sql = "INSERT INTO	authenticated_devices(device_ip_address, device_mac_address, device_type, device_authentication_type)
			VALUES('$device_ip_address', '$device_mac_address', '$device_type', '$device_authentication_type');";
	
	if ($conn->query($sql) === TRUE) {
		echo "SUCCESS";
	} else {
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();
?>

<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="UTF-8">
		<title>DYNAMO</title>
	</head>

	<body>
		<header>
		</header>
	
		<section>
			<h1>DYNAMO - Autenticazione avvenuta con successo.</h1>
		</section>

		<footer>
			<p>Copyright (c) 2015 Rambod Rahmani</p>
		</footer>
	</body>
</html>
