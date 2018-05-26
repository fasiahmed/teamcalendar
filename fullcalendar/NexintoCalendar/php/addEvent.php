<?php
include "../dbinfo.inc";
$db=DB_DATABASE;
$title = $_POST['title'];
$emp = $_POST['employee'];
$start = $_POST['starts_at'];
$end = $_POST['ends_at'];
$description= $_POST['Description'];
$employeeID = $_POST['empID'];
$myHours = $_POST['durationH'];
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno())
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $statement="insert into $db.empEvents(empName,title,start,end,Description,empID,noHours)values('".$emp."','".$title."','".$start."','".$end."','".$description."','".$employeeID."','".$myHours."')";
  $result=mysqli_query($con,$statement);
  mysqli_close($con);
?>
