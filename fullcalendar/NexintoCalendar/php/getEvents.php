<?php
include "../dbinfo.inc";
$db=DB_DATABASE;
/* Connect to MySQL and select the database. */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//$statement="select * from $db.empEvents";
$statement="select empName,title,start,DATE_ADD(end, INTERVAL 1 DAY) as end,Description from $db.empEvents";
$result=mysqli_query($con,$statement);
if(!$result){  die("SQL Error:".mysqli_error($con));  }
  // Fetch one and one row
 $usersinfo_arr = array();
while ($row = mysqli_fetch_array($result)) {
$employeename=$row['empName'];
$eventTitle= $row['title'];
switch ($eventTitle){
  case "EarlyAvD": $mycolour='#F9F902'; break;
  case "LateAvD": $mycolour='#e67300'; break;
  case "OnCall": $mycolour='#17D6DF'; break;
  case "Event": $mycolour='#96DF17'; break;
  case "Vacation": $mycolour='#F510E7'; break;
  default: $mycolour='white';
}
$startDate= $row['start'];
$endDate= $row['end'];
$description= $row['Description'];
if($description)
  $mytitle=$eventTitle.' '.$employeename.' '.$description;
else
   $mytitle=$eventTitle.' '.$employeename;
$usersinfo_arr[] = array("title" => $mytitle, "start" => $startDate, "end" => $endDate,"color" => $mycolour);
}
// encoding array to json format
echo json_encode($usersinfo_arr);
// debug_to_console( $usersinfo_arr );
 // Free result set
mysqli_free_result($result);
mysqli_close($con);

?>
