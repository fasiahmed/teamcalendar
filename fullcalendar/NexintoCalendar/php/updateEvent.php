<?php
include "../dbinfo.inc";
$db=DB_DATABASE;
$title = $_POST['title'];
$emp = $_POST['employee'];
$start = $_POST['startDate'];
$end = $_POST['ends_at'];
$myHours = $_POST['durationH'];
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno())
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $statement="update $db.empEvents set end ='".$end."',noHours ='".$myHours."' where empName ='".$emp."' and title ='".$title."' and start ='".$start."'";
  $result=mysqli_query($con,$statement);
  mysqli_close($con);
?>
