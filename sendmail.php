<?php
 header("refresh: 3;");
$con=mysqli_connect("localhost","root","","dbgrand");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM rawcdr WHERE email = 0");
$row_cnt = $result->num_rows;

    printf("Result set has %d rows.\n", $row_cnt);
echo  $row_cnt;


$mailbody =  "<table 
border='1'>
<tr>
<th>uniqueid</th>
<th>AcctId</th>
<th>src</th>
<th>dst</th>
<th>start Time</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
	
$mailbody .=  "<tr>";
$mailbody .=  "<td>" . $row['uniqueid'] . "</td>";
$mailbody .=  "<td>" . $row['AcctId'] . "</td>";
$mailbody .=  "<td>" . $row['src'] . "</td>";
$mailbody .=  "<td>" . $row['dst'] . "</td>";
$mailbody .=  "<td>" . $row['start'] . "</td>";
$mailbody .=  "</tr>";


}
$mailbody .=  "</table>";

echo $mailbody;
mysqli_query($con,"UPDATE rawcdr SET email = 1");


$to       = 'riyasrawther.in@gmail.com';
$subject  = 'No Answered call report from Grandstream';
$message  = $mailbody;
$headers  = 'From: riyasrawther.in@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

if ($row_cnt > "0") {
    echo "sending mail";
	mail ($to,$subject,$message,$headers);
} else {
    echo "No New Data to send!";
}

mysqli_close($con);


?>