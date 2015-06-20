<?
/*
**    DYNAMO
**    Rambod Rahmani <rambodrahmani@yahoo.it>
*/
    class DNServer
    {
        var $func;
        var $socket;
        var $types;
        var $localip;

        function DNServer($callback, $ip = NULL)
        {
            $this->localip = $ip;
            $this->func = $callback;
            set_time_limit(0);

            $this->types = array(
                "A" => 1,
                "NS" => 2,
                "CNAME" => 5,
                "SOA" => 6,
                "WKS" => 11,
                "PTR" => 12,
                "HINFO" => 13,
                "MX" => 15,
                "TXT" => 16,
                "RP" => 17,
                "SIG" => 24,
                "KEY" => 25,
                "LOC" => 29,
                "NXT" => 30,
                "AAAA" => 28,
                "CERT" => 37,
                "A6" => 38,
                "AXFR" => 252,
                "IXFR" => 251,
                "*" => 255
            );
     
            $this->Begin();
        }
        
        function Begin()
        {
            $this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

            if ($this->socket < 0)
            {
                printf("Error in line %d", __LINE__ - 3);
                exit();
            }

            if (socket_bind($this->socket, $this->localip, "53") == false)
            {
                printf("Error in line %d", __LINE__ - 2);
                exit();
            }

            while(1)
            {
                $len = socket_recvfrom($this->socket, $buf, 1024 * 4, 0, $ip, $port);
                if ($len > 0)
                {
                    $this->HandleQuery($buf, $ip, $port);        
                }    
            }
        }
        
        function HandleQuery($buf, $clientip, $clientport)
        {
            $dominio = "";
            $tmp = substr($buf, 12);
            $e = strlen($tmp);

            for($i = 0; $i < $e; $i++)
            {
                $len = ord($tmp[$i]);

                if ($len == 0)
                    break;
                
                $dominio .= substr($tmp, $i + 1, $len) . ".";
                $i += $len;
            }

            $i++;
            $i++;

            print $DomainAsQueried;

            $querytype = array_search((string)ord($tmp[$i]), $this->types) ;

            $dominio = substr($dominio, 0, strlen($dominio) - 1);
            $callback = $this->func;
            $ips = $callback($dominio, $querytype, $clientip);

            $answ = $buf[0].$buf[1].chr(129).chr(128).$buf[4].$buf[5].$buf[4].$buf[5].chr(0).chr(0).chr(0).chr(0);
            $answ .= $tmp;
            $answ .= chr(192).chr(12);
            $answ .= chr(0).chr(1).chr(0).chr(1).chr(0).chr(0).chr(0).chr(60).chr(0).chr(4);
            $answ .= $this->TransformIP($ips);

            if (socket_sendto($this->socket,$answ, strlen($answ), 0, $clientip, $clientport) === false)
                printf("Error in socket\n");             
        }
        
        function TransformIP($ip)
        {
            $nip = "";

            foreach(explode(".",$ip) as $pip)
                $nip .= chr($pip);

            return $nip;
        }
    }
?>
