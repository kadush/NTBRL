 <?php

// $host = '41.220.127.198';
// $up = ping($host);

// // if site is up, send them to the site.
// if( $up ) {
//         header('Location: http://'.$host);
// }
// // otherwise, take them to another one of our sites and show them a descriptive message
// else {
//         header('Location: http://www.gadomoutonconsult.com/');
// }

// function pingAddress($ip) {
//     $pingresult = exec("/bin/ping -n 3 $ip", $outcome, $status);
//     if (0 == $status) {
//         $status = "alive";
//     } else {
//         $status = "dead";
//     }
//     echo "The IP address, $ip, is  ".$status;
// }

// pingAddress("41.220.127.198");

function ping($host, $port, $timeout) {
    $tB = microtime(true); 
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
    if (!$fP) { return "down"; } 
    $tA = microtime(true); 
    return round((($tA - $tB) * 1000), 0)." ms"; 
  }
  
  //Echoing it will display the ping if the host is up, if not it'll say "down".
  echo ping("http://41.220.127.198", 80, 10);