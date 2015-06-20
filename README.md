# DYNAMO
DYNAMO: A Raspberry Pi based Captive Portal.

Requirements:
	1. Apache Web Server.
	2. MySQL Server.
	3. PHP (With MySQLi extension).

How-to:
	1. Get Apache and MySQL Server up and running.
	2. Execute the SQl queries in "database.sql".
	3. Some configurations are needed:
		1. Assign the IP Address of the RPi to the PRIMARY and SECONDARY DNS Server of you router.
		2. Set the required parameters in "config.php".
	4. Run start.php from terminal.
