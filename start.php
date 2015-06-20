<?

/*
**    DYNAMO
**    Rambod Rahmani <rambodrahmani@yahoo.it>
*/

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	include "DNServer.php";
	include 'config.php';

	foreach($ips as $domain=>$ip)
	{
		$ips['www.' . $domain]['A'] = $ip['A'];
	}

	function dnshandler($dominio, $tipo, $client_ip_address)
	{
		include 'config.php';
		
		$client_mac_address = null;

		$arp = "/usr/sbin/arp";
		$client_mac_address = shell_exec("sudo $arp -an " . $client_ip_address);
		preg_match('/..:..:..:..:..:../', $client_mac_address , $matches);
		$client_mac_address = @$matches[0];

		if ($debugMode == true)
		{
			echo "New Request\n";
			echo "Client IP: " . $client_ip_address . "\n";
		    echo "Client MAC: " . $client_mac_address . "\n";
		    echo "Domain: " . $dominio . "\n";
		}

		$sql = $conn->query('SELECT * FROM authenticated_devices WHERE device_mac_address = "' . $client_mac_address . '"');

		if ($sql->num_rows == 0)
		{
			if ($debugMode == true)
			{
				echo "Not authenticated. Redirecting.\n";
			}
			return BASE_URL;
		}
		else
		{
			global $ips;
			if (isset($ips[$dominio][$tipo]))
			{
				return $ips[$dominio][$tipo];
			}
			else
			{
				$dominio = $conn->real_escape_string($dominio);

				$sql = $conn->query('SELECT * FROM cached_records WHERE record_domain = "' . $dominio . '"');
			
				if ($sql->num_rows == 0) {
					if ($debugMode == true) {
						echo "Not cached. Resolving.\n";
					}
					
					$result = gethostbyname($dominio);
					$result = $conn->real_escape_string($result);

					$conn->query('INSERT INTO cached_records(record_domain, record_ip)
								  VALUES("' . $dominio . '", "' . $result . '")');
					return $result;
				}
				else
				{
					if ($debugMode == true)
					{
						echo "Cached. Returning.\n";
					}
					$result = $sql->fetch_object();
					return $result->ip; 
				}
			}
		}

		$conn->close();
	}

	$dns = new DNServer("dnshandler", BASE_URL);

?>
