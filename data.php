<?php
$username = 'cdrapi';
$password = 'cdrapi123';
 

date_default_timezone_set("Asia/Dubai");
$currentdate = (date("Y-m-d")); 
$substracttime = date("H:i:s.s", time() - 500);
//$url = "https://192.168.1.28:8443/cdrapi?format=JSON&startTime=" . $currentdate;

//echo $url;
  
$url = "https://192.168.1.28:8443/cdrapi?format=JSON";
       // https://192.168.1.28:8443/cdrapi?format=JSON&startTime=2019-01-14T15:26:03.03    
$ch = curl_init();
  
$headers = array(
    'Accept: application/json',
    'Content-Type: application/json'
);
  
  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
  
$result = curl_exec($ch);


$ch_error = curl_error($ch);

if ($ch_error) {
    echo "cURL Error: $ch_error";
} else {
    echo $result;
}
  
curl_close($ch);
?>