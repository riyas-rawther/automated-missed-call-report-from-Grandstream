<?php

header("refresh: 3;");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbgrand";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$url = file_get_contents('data.php');
$array = json_decode($url, true);

$length = count($array['cdr_root']);

//assign array keys to variables for sql insert query
// for ($i = 0; $i < $length; $i++) { 
for ($i = 0; $i < $length; $i++) { 
    $AcctId = $array['cdr_root'][$i]['AcctId'];
	$accountcode = $array['cdr_root'][$i]['accountcode'];
    $src = $array['cdr_root'][$i]['src'];
    $dst = $array['cdr_root'][$i]['dst'];
    $dcontext = $array['cdr_root'][$i]['dcontext'];
    $clid = $array['cdr_root'][$i]['clid'];
    $channel = $array['cdr_root'][$i]['channel'];
    $dstchannel = $array['cdr_root'][$i]['dstchannel'];
    $lastapp = $array['cdr_root'][$i]['lastapp'];
    $lastdata = $array['cdr_root'][$i]['lastdata'];
    $start = $array['cdr_root'][$i]['start'];
	$answer = $array['cdr_root'][$i]['answer'];
	$end = $array['cdr_root'][$i]['end'];
	$duration = $array['cdr_root'][$i]['duration'];
	$billsec = $array['cdr_root'][$i]['billsec'];
	$disposition = $array['cdr_root'][$i]['disposition'];
	$amaflags = $array['cdr_root'][$i]['amaflags'];
	$uniqueid = $array['cdr_root'][$i]['uniqueid'];
	$userfield = $array['cdr_root'][$i]['userfield'];
	$channel_ext = $array['cdr_root'][$i]['channel_ext'];
	$dstchannel_ext = $array['cdr_root'][$i]['dstchannel_ext'];
	$service = $array['cdr_root'][$i]['service'];
	$caller_name = $array['cdr_root'][$i]['caller_name'];
	$recordfiles = $array['cdr_root'][$i]['recordfiles'];
	$dstanswer = $array['cdr_root'][$i]['dstanswer'];
	$chanext = $array['cdr_root'][$i]['chanext'];
	$dstchanext = $array['cdr_root'][$i]['dstchanext'];
	$session = $array['cdr_root'][$i]['session'];
	$action_owner = $array['cdr_root'][$i]['action_owner'];
	$action_type = $array['cdr_root'][$i]['action_type'];
	$src_trunk_name = $array['cdr_root'][$i]['src_trunk_name'];
	$dst_trunk_name = $array['cdr_root'][$i]['dst_trunk_name'];


    $sql = "INSERT INTO rawcdr (AcctId
 ,accountcode
 ,src
 ,dst
 ,dcontext
 ,clid
 ,channel
 ,dstchannel
 ,lastapp
 ,lastdata
 ,start
 ,answer
 ,end
 ,duration
 ,billsec
 ,disposition
 ,amaflags
 ,uniqueid
 ,userfield
 ,channel_ext
 ,dstchannel_ext
 ,service
 ,caller_name
 ,recordfiles
 ,dstanswer
 ,chanext
 ,dstchanext
 ,session
 ,action_owner
 ,action_type
 ,src_trunk_name
 ,dst_trunk_name)
            VALUES ('$AcctId',
'$accountcode',
'$src',
'$dst',
'$dcontext',
'$clid',
'$channel',
'$dstchannel',
'$lastapp',
'$lastdata',
'$start',
'$answer',
'$end',
'$duration',
'$billsec',
'$disposition',
'$amaflags',
'$uniqueid',
'$userfield',
'$channel_ext',
'$dstchannel_ext',
'$service',
'$caller_name',
'$recordfiles',
'$dstanswer',
'$chanext',
'$dstchanext',
'$session',
'$action_owner',
'$action_type',
'$src_trunk_name',
'$dst_trunk_name')";

  //output message if successful or not
  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";


	  
  } else {
     // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //  echo "N: ";
  }
  

	
    
} // close for loop

// IF NEW RECORD HAS CREATED THEN FETCH THE NEW DATA FROM DB AND PREAPRE FOR SEND

$result = mysqli_query($conn,"SELECT * FROM rawcdr WHERE email = 0");

$mailbody =  "<table border='1'><tr><th>uniqueid</th><th>AcctId</th></tr>";

while($row = mysqli_fetch_array($result))
{
	
$mailbody .=  "<tr>";
$mailbody .=  "<td>" . $row['uniqueid'] . "</td>";
$mailbody .=  "<td>" . $row['AcctId'] . "</td>";
$mailbody .=  "</tr>";


}
$mailbody .=  "</table>";

echo $mailbody;

// update the db with 1
//mysqli_query($conn,"UPDATE rawcdr SET email = 1");




$conn->close();

?>